USE arna_tours_travels;

-- Idempotent backend completion migration. Safe to run after schema.sql or on an existing installation.

CREATE TABLE IF NOT EXISTS drivers (
 id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
 full_name VARCHAR(150) NOT NULL,
 mobile_number VARCHAR(20) NOT NULL,
 email VARCHAR(150) NULL,
 license_number VARCHAR(80) NULL UNIQUE,
 vehicle_id INT UNSIGNED NULL,
 status ENUM('AVAILABLE','ASSIGNED','OFF_DUTY','INACTIVE') NOT NULL DEFAULT 'AVAILABLE',
 notes TEXT NULL,
 created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
 updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
 INDEX idx_driver_status(status), INDEX idx_driver_name(full_name),
 CONSTRAINT fk_driver_vehicle FOREIGN KEY(vehicle_id) REFERENCES vehicles(id) ON DELETE SET NULL ON UPDATE CASCADE
);

DELIMITER $$
CREATE PROCEDURE arna_add_booking_columns()
BEGIN
  IF NOT EXISTS (SELECT 1 FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA=DATABASE() AND TABLE_NAME='bookings' AND COLUMN_NAME='vehicle_id') THEN
    ALTER TABLE bookings ADD COLUMN vehicle_id INT UNSIGNED NULL AFTER participants;
  END IF;
  IF NOT EXISTS (SELECT 1 FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA=DATABASE() AND TABLE_NAME='bookings' AND COLUMN_NAME='driver_id') THEN
    ALTER TABLE bookings ADD COLUMN driver_id INT UNSIGNED NULL AFTER vehicle_id;
  END IF;
  IF NOT EXISTS (SELECT 1 FROM INFORMATION_SCHEMA.STATISTICS WHERE TABLE_SCHEMA=DATABASE() AND TABLE_NAME='bookings' AND INDEX_NAME='idx_booking_vehicle') THEN
    ALTER TABLE bookings ADD INDEX idx_booking_vehicle(vehicle_id);
  END IF;
  IF NOT EXISTS (SELECT 1 FROM INFORMATION_SCHEMA.STATISTICS WHERE TABLE_SCHEMA=DATABASE() AND TABLE_NAME='bookings' AND INDEX_NAME='idx_booking_driver') THEN
    ALTER TABLE bookings ADD INDEX idx_booking_driver(driver_id);
  END IF;
  IF NOT EXISTS (SELECT 1 FROM INFORMATION_SCHEMA.REFERENTIAL_CONSTRAINTS WHERE CONSTRAINT_SCHEMA=DATABASE() AND TABLE_NAME='bookings' AND CONSTRAINT_NAME='fk_booking_vehicle') THEN
    ALTER TABLE bookings ADD CONSTRAINT fk_booking_vehicle FOREIGN KEY(vehicle_id) REFERENCES vehicles(id) ON DELETE SET NULL ON UPDATE CASCADE;
  END IF;
  IF NOT EXISTS (SELECT 1 FROM INFORMATION_SCHEMA.REFERENTIAL_CONSTRAINTS WHERE CONSTRAINT_SCHEMA=DATABASE() AND TABLE_NAME='bookings' AND CONSTRAINT_NAME='fk_booking_driver') THEN
    ALTER TABLE bookings ADD CONSTRAINT fk_booking_driver FOREIGN KEY(driver_id) REFERENCES drivers(id) ON DELETE SET NULL ON UPDATE CASCADE;
  END IF;
END$$
DELIMITER ;
CALL arna_add_booking_columns();
DROP PROCEDURE IF EXISTS arna_add_booking_columns;

CREATE TABLE IF NOT EXISTS website_content (
 id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
 section_name VARCHAR(100) NOT NULL DEFAULT 'General',
 content_key VARCHAR(100) NOT NULL UNIQUE,
 content_value TEXT NULL,
 updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
CREATE TABLE IF NOT EXISTS website_settings (
 id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
 setting_key VARCHAR(100) NOT NULL UNIQUE,
 setting_value TEXT NULL,
 updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
CREATE TABLE IF NOT EXISTS testimonials (
 id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
 customer_name VARCHAR(150) NOT NULL,
 message TEXT NOT NULL,
 rating TINYINT UNSIGNED NOT NULL DEFAULT 5,
 status ENUM('ACTIVE','INACTIVE') NOT NULL DEFAULT 'ACTIVE',
 created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
 updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

INSERT INTO website_settings(setting_key,setting_value) VALUES
('business_phone','+91 80079 61759'),('business_email',''),('business_address','Hubballi, Karnataka, India'),('booking_notice','Our team will contact you to confirm availability and trip details.')
ON DUPLICATE KEY UPDATE setting_value=VALUES(setting_value);

INSERT INTO website_content(section_name,content_key,content_value) VALUES
('Hero','hero_badge','ARNA TOURS & TRAVELS'),('Hero','hero_title','Go farther. Feel better.'),('Hero','hero_description','Premium taxi, chauffeur and travel booking services for local, airport and outstation journeys.'),('About','about_title','Travel made effortless.'),('About','about_description','Dependable travel support with comfort, clear communication and a premium experience.')
ON DUPLICATE KEY UPDATE content_value=VALUES(content_value);
