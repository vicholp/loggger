CREATE TABLE IF NOT EXISTS `sensors` (
    `id` BIGINT PRIMARY KEY AUTO_INCREMENT,
    `name` VARCHAR(255),
    `description` VARCHAR(255),
    `type` VARCHAR(255) NOT NULL,
    `unit` VARCHAR(255) NOT NULL,
    `created_at` TIMESTAMP NOT NULL
);

CREATE TABLE IF NOT EXISTS `measures` (
    `id` BIGINT PRIMARY KEY AUTO_INCREMENT,
    `data` FLOAT NOT NULL,
    `sensor_id` BIGINT NOT NULL,
    `created_at` TIMESTAMP NOT NULL,
    FOREIGN KEY (sensor_id) REFERENCES sensors(id) ON DELETE CASCADE
);
