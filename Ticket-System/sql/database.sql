DROP DATABASE IF EXISTS ticket_system;

CREATE DATABASE IF NOT EXISTS ticket_system
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

USE ticket_system;

CREATE TABLE tickets (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    priority ENUM(
        'Niedrig',
        'Mittel',
        'Hoch',
        'Kritisch'
    ) NOT NULL,
    status ENUM(
        'Neu',
        'In Bearbeitung',
        'Geschlossen'
    ) NOT NULL DEFAULT 'Neu',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);