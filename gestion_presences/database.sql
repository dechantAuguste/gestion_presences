-- ============================================================
-- SNGP : Système Numérique de Gestion des Présences
-- Script de création de la base de données
-- Projet Tutoré L1 Génie Informatique, 2025-2026
-- ============================================================

CREATE DATABASE IF NOT EXISTS gestion_presences
CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE gestion_presences;

-- -----------------------------------------------------------
-- Table utilisateurs (rôles : etudiant, enseignant, administrateur)
-- -----------------------------------------------------------
CREATE TABLE utilisateurs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    matricule VARCHAR(50) UNIQUE NOT NULL,
    nom VARCHAR(100),
    prenom VARCHAR(100),
    email VARCHAR(150) UNIQUE NOT NULL,
    mot_de_passe VARCHAR(255) NOT NULL,  -- hashé (bcrypt)
    role ENUM('etudiant', 'enseignant', 'administrateur') NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- -----------------------------------------------------------
-- Table cours
-- -----------------------------------------------------------
CREATE TABLE cours (
    id INT AUTO_INCREMENT PRIMARY KEY,
    code_cours VARCHAR(20) UNIQUE NOT NULL,
    titre VARCHAR(150) NOT NULL,
    description TEXT
) ENGINE=InnoDB;

-- -----------------------------------------------------------
-- Table séances
-- -----------------------------------------------------------
CREATE TABLE seances (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cours_id INT NOT NULL,
    enseignant_id INT NOT NULL,
    date_seance DATE NOT NULL,
    heure_debut TIME NOT NULL,
    heure_fin TIME NOT NULL,
    qr_code_token VARCHAR(255) UNIQUE,
    FOREIGN KEY (cours_id) REFERENCES cours(id) ON DELETE CASCADE,
    FOREIGN KEY (enseignant_id) REFERENCES utilisateurs(id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- -----------------------------------------------------------
-- Table présences
-- -----------------------------------------------------------
CREATE TABLE presences (
    id INT AUTO_INCREMENT PRIMARY KEY,
    seance_id INT NOT NULL,
    etudiant_id INT NOT NULL,
    date_enregistrement TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    statut ENUM('present', 'en_retard', 'absent') DEFAULT 'present',
    FOREIGN KEY (seance_id) REFERENCES seances(id) ON DELETE CASCADE,
    FOREIGN KEY (etudiant_id) REFERENCES utilisateurs(id) ON DELETE CASCADE,
    UNIQUE KEY unique_presence_etudiant (seance_id, etudiant_id)
) ENGINE=InnoDB;

-- ============================================================
-- Jeu d'essai
-- ============================================================

INSERT INTO utilisateurs (matricule, nom, prenom, email, mot_de_passe, role)
VALUES ('23-001', 'LUVAMBO', 'Grace', 'grace.luvambo@etudiant.univ.com',
        '$2y$10$pUlygI6b47cM9fXU6/q0gOefN4Zt743g.s/b3eC6r/aZf10Y99WdG', -- '123456'
        'etudiant');
