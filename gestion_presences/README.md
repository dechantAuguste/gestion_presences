# SNGP - Système Numérique de Gestion des Présences Universitaires

Projet Tutoré L1 Génie Informatique — Faculté des Sciences, 2025-2026

## Description

Application web de gestion des présences en salle de cours via QR Code dynamique.

- **Étudiant** : authentification, scan QR code, historique des présences
- **Enseignant** : génération QR code, validation manuelle, suivi en temps réel
- **Administrateur** : rapports PDF, analyse globale

## Stack technique

- PHP 8+ (architecture MVC)
- MySQL (via PDO)
- XAMPP (Apache + MySQL)
- HTML5 / CSS3 / JavaScript
- QR Code via api.qrserver.com

## Installation

1. Lancer Apache et MySQL dans XAMPP
2. Créer la base `gestion_presences` via phpMyAdmin
3. Importer `database.sql`
4. Placer le projet dans `C:\xampp\htdocs\gestion_presences`
5. Accéder à `http://localhost/gestion_presences`

## Équipe

| Rôle | Responsable |
|------|-------------|
| Chef de Projet | Idris |
| DB Admin | — |
| Lead Frontend | — |
| Lead Backend | — |
| QA / Testeur | — |

## Workflow Git

- Branche `main` : code stable et validé
- Branches `feature/*` par fonctionnalité
- Pull Requests avec revue avant merge
- Messages de commit normés : `feat:`, `fix:`, `docs:`, `refactor:`
