<?php
declare(strict_types=1);
require_once __DIR__ . '/admin-layout.php';
require_once __DIR__ . '/../models/TourPackage.php';

$m = new TourPackage();
$flash = getFlashMessage();
$message = $flash['message'] ?? '';
$type = $flash['type'] ?? 'success';
$editing = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        if (!verifyAdminCsrf()) {
            throw new RuntimeException('Security token expired. Refresh the page.');
        }

        $action = $_POST['action'] ?? '';
        $id = (int) ($_POST['id'] ?? 0);

        if ($action === 'save') {
            $name = trim((string) ($_POST['package_name'] ?? ''));
            $dest = trim((string) ($_POST['destination'] ?? ''));
            $status = (string) ($_POST['status'] ?? 'ACTIVE');

            if ($name === '' || $dest === '') {
                throw new RuntimeException('Package name and destination are required.');
            }
            if (!in_array($status, ['ACTIVE', 'INACTIVE'], true)) {
                throw new RuntimeException('Invalid status.');
            }

            $price = trim((string) ($_POST['price'] ?? ''));
            if ($price !== '' && (!is_numeric($price) || (float) $price < 0)) {
                throw new RuntimeException('Price must be a valid non-negative number.');
            }

            $data = [
                'package_name' => $name,
                'destination' => $dest,
                'duration' => trim((string) ($_POST['duration'] ?? '')),
                'price' => $price,
                'image' => trim((string) ($_POST['image'] ?? '')),
                'description' => trim((string) ($_POST['description'] ?? '')),
                'status' => $status,
            ];

            if ($id > 0) {
                if (!$m->find($id)) {
                    throw new RuntimeException('Package not found.');
                }
                $m->update($id, $data);
                $success = 'Tour package updated successfully.';
            } else {
                $m->create($data);
                $success = 'Tour package added successfully.';
            }

            // POST/Redirect/GET prevents browser refresh from submitting the INSERT again.
            setFlashMessage($success);
            header('Location: packages.php');
            exit;
        }

        if ($action === 'delete') {
            if ($id < 1 || !$m->find($id)) {
                throw new RuntimeException('Invalid package.');
            }
            $m->delete($id);
            setFlashMessage('Tour package deleted successfully.');
            header('Location: packages.php');
            exit;
        }
    } catch (Throwable $e) {
        $message = $e->getMessage();
        $type = 'danger';
    }
}

if (isset($_GET['edit'])) {
    $editing = $m->find((int) $_GET['edit']);
}

$search = trim((string) ($_GET['search'] ?? ''));
$statusFilter = strtoupper(trim((string) ($_GET['status'] ?? '')));
$rows = $m->all($search, $statusFilter);
$csrf = adminCsrfToken();
adminHeader('Tour Packages', 'Create and manage destination-based packages.');
?>
<div class="admin-card mb-4">
    <div class="admin-card-head">
        <div>
            <h2><?= $editing ? 'Edit Tour Package' : 'Add Tour Package' ?></h2>
            <p>Keep duration, pricing and descriptions editable from the admin panel.</p>
        </div>
        <?php if ($editing): ?><a class="btn-admin btn-light" href="packages.php">Cancel</a><?php endif; ?>
    </div>
    <?php if ($message): ?>
        <div class="px-4 pt-3"><div class="alert alert-<?= e($type) ?> border-0 mb-0"><?= e($message) ?></div></div>
    <?php endif; ?>
    <form method="post" class="row g-3 p-4">
        <input type="hidden" name="csrf_token" value="<?= e($csrf) ?>">
        <input type="hidden" name="action" value="save">
        <input type="hidden" name="id" value="<?= (int) ($editing['id'] ?? 0) ?>">
        <div class="col-md-6"><label class="form-label">Package Name *</label><input class="form-control" name="package_name" required maxlength="150" value="<?= e($editing['package_name'] ?? '') ?>"></div>
        <div class="col-md-6"><label class="form-label">Destination *</label><input class="form-control" name="destination" required maxlength="150" value="<?= e($editing['destination'] ?? '') ?>"></div>
        <div class="col-md-3"><label class="form-label">Duration</label><input class="form-control" name="duration" placeholder="3 Days / 2 Nights" value="<?= e($editing['duration'] ?? '') ?>"></div>
        <div class="col-md-3"><label class="form-label">Price (₹)</label><input class="form-control" type="number" min="0" step="0.01" name="price" value="<?= e((string) ($editing['price'] ?? '')) ?>"></div>
        <div class="col-md-3"><label class="form-label">Status</label><select class="form-select" name="status"><option value="ACTIVE" <?= ($editing['status'] ?? 'ACTIVE') === 'ACTIVE' ? 'selected' : '' ?>>Active</option><option value="INACTIVE" <?= ($editing['status'] ?? '') === 'INACTIVE' ? 'selected' : '' ?>>Inactive</option></select></div>
        <div class="col-md-3"><label class="form-label">Image Path / URL</label><input class="form-control" name="image" value="<?= e($editing['image'] ?? '') ?>"></div>
        <div class="col-12"><label class="form-label">Description</label><textarea class="form-control" name="description" rows="4"><?= e($editing['description'] ?? '') ?></textarea></div>
        <div class="col-12"><button class="btn-admin btn-primary" type="submit"><i class="ri-save-line"></i> <?= $editing ? 'Update Package' : 'Add Package' ?></button></div>
    </form>
</div>
<div class="admin-card">
    <div class="admin-card-head"><div><h2>Packages</h2><p><?= count($rows) ?> package(s)</p></div>
        <form class="toolbar" method="get"><input class="form-control" name="search" placeholder="Search package or destination" value="<?= e($search) ?>"><select class="form-select" name="status"><option value="">All</option><option value="ACTIVE" <?= $statusFilter === 'ACTIVE' ? 'selected' : '' ?>>Active</option><option value="INACTIVE" <?= $statusFilter === 'INACTIVE' ? 'selected' : '' ?>>Inactive</option></select><button class="btn-admin btn-primary">Search</button></form>
    </div>
    <div class="table-responsive"><table class="table admin-table align-middle mb-0"><thead><tr><th>Package</th><th>Destination</th><th>Duration</th><th>Price</th><th>Status</th><th class="text-end">Actions</th></tr></thead><tbody>
    <?php foreach ($rows as $r): ?><tr><td><strong><?= e($r['package_name']) ?></strong><div class="small text-muted"><?= e($r['description'] ?? '') ?></div></td><td><?= e($r['destination']) ?></td><td><?= e($r['duration'] ?? '—') ?></td><td><?= $r['price'] !== null ? '₹' . number_format((float) $r['price'], 2) : 'On request' ?></td><td><span class="status-pill status-<?= strtolower($r['status']) ?>"><?= e($r['status']) ?></span></td><td class="text-end"><a class="btn-admin btn-light btn-sm" href="packages.php?edit=<?= (int) $r['id'] ?>">Edit</a> <form class="d-inline" method="post" onsubmit="return confirm('Delete this package?')"><input type="hidden" name="csrf_token" value="<?= e($csrf) ?>"><input type="hidden" name="action" value="delete"><input type="hidden" name="id" value="<?= (int) $r['id'] ?>"><button class="btn-admin btn-danger-soft btn-sm" type="submit">Delete</button></form></td></tr><?php endforeach; ?>
    <?php if (!$rows): ?><tr><td colspan="6" class="text-center py-5 text-muted">No packages found.</td></tr><?php endif; ?>
    </tbody></table></div>
</div>
<?php adminFooter();
