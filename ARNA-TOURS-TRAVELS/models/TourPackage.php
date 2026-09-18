<?php
declare(strict_types=1);
require_once __DIR__ . '/../config/database.php';
class TourPackage {
 private PDO $db;
 public function __construct(){ $this->db=Database::getConnection(); }
 public function all(?string $search=null, ?string $status=null): array {
  $sql='SELECT * FROM tour_packages WHERE 1=1'; $p=[];
  if($search){$sql.=' AND (package_name LIKE :q OR destination LIKE :q)';$p[':q']='%'.$search.'%';}
  if($status && in_array($status,['ACTIVE','INACTIVE'],true)){$sql.=' AND status=:status';$p[':status']=$status;}
  $sql.=' ORDER BY status="INACTIVE", package_name ASC'; $s=$this->db->prepare($sql);$s->execute($p);return $s->fetchAll();
 }
 public function find(int $id): ?array {$s=$this->db->prepare('SELECT * FROM tour_packages WHERE id=? LIMIT 1');$s->execute([$id]);$r=$s->fetch();return $r?:null;}
 public function create(array $d): int {$s=$this->db->prepare('INSERT INTO tour_packages (package_name,destination,duration,price,image,description,status) VALUES (?,?,?,?,?,?,?)');$s->execute([$d['package_name'],$d['destination'],$d['duration']?:null,$d['price']!==''?$d['price']:null,$d['image']?:null,$d['description']?:null,$d['status']]);return (int)$this->db->lastInsertId();}
 public function update(int $id,array $d): bool {$s=$this->db->prepare('UPDATE tour_packages SET package_name=?,destination=?,duration=?,price=?,image=?,description=?,status=? WHERE id=?');return $s->execute([$d['package_name'],$d['destination'],$d['duration']?:null,$d['price']!==''?$d['price']:null,$d['image']?:null,$d['description']?:null,$d['status'],$id]);}
 public function delete(int $id): bool {$s=$this->db->prepare('DELETE FROM tour_packages WHERE id=?');return $s->execute([$id]);}
}
