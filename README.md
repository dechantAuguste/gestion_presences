# SNGP — Système Numérique de Gestion des Présences Universitaires

Projet Tutoré L1 Génie Informatique — Faculté des Sciences et Technologie (ULPGL), 2025-2026

---

## Description

Application web de gestion des présences en salle de cours via **QR Code dynamique**.

Chaque séance de cours génère un QR code unique que les étudiants scannent pour marquer leur présence. L'enseignant suit en temps réel, et l'administrateur peut exporter des rapports.

### Rôles utilisateurs

| Rôle | Fonctionnalités |
|---|---|
| **Étudiant** | Connexion par matricule, scan QR code, historique de ses présences |
| **Enseignant** | Création de séance → génération QR code, validation manuelle, suivi temps réel |
| **Administrateur** | Rapports PDF, analyse globale des présences par cours/période |

---

## Stack technique

| Couche | Technologie |
|---|---|
| Backend | PHP 8+ (architecture MVC, PDO) |
| Base de données | MySQL / MariaDB |
| Serveur local | XAMPP (Apache + MySQL) |
| Frontend | HTML5, CSS3, JavaScript vanilla |
| QR Code | [api.qrserver.com](https://api.qrserver.com) |
| Versionning | Git + GitHub |

---

## Arborescence du projet

```
gestion_presences/
├── index.php                          # Point d'entrée — Routeur MVC
├── database.sql                       # Script de création des tables
├── .gitignore                         # Fichiers exclus du versionning
├── .gitattributes                     # Normalisation des fins de ligne
│
├── controleurs/
│   ├── auth_controleur.php            # Login / Logout / Session
│   └── presence_controleur.php        # Séances, tokens, QR code
│
├── modeles/
│   ├── connexion_bdd.php              # Connexion PDO à MySQL
│   └── etudiant_modele.php            # Requêtes : utilisateurs, présences
│
├── vues/
│   ├── login.php                      # Page de connexion
│   ├── dashboard.php                  # Dashboard étudiant
│   └── enseignant.php                 # Dashboard enseignant
│
└── assets/
    └── css/
        └── style.css                  # Palette académique + styles
```

---

## Installation (poste local)

### Prérequis

- **XAMPP** (Apache + MySQL) — [télécharger](https://www.apachefriends.org/fr/index.html)
- **Git** — [télécharger](https://git-scm.com/downloads)
- Un compte GitHub

### Étapes

```bash
# 1. Cloner le projet
cd C:\xampp\htdocs
git clone https://github.com/dechantAuguste/gestion_presences.git

# 2. Lancer Apache et MySQL dans le panneau XAMPP

# 3. Créer la base de données
#    → Ouvrir phpMyAdmin (http://localhost/phpmyadmin)
#    → Créer une base nommée "gestion_presences" (utf8mb4_general_ci)
#    → Importer le fichier database.sql

# 4. Accéder à l'application
#    → http://localhost/gestion_presences
```

---

## Conventions de code

### PHP

- **Nommage** : `snake_case` pour les fonctions et variables
- **Indentation** : 4 espaces
- **Fichiers** : un fichier = une responsabilité
- **Sécurité** : toujours utiliser `password_hash()` / `password_verify()` pour les mots de passe, requêtes préparées PDO pour les entrées utilisateur

### Git

- **Branche `main`** : code stable et validé (protégée)
- **Branches `feature/*`** : une par fonctionnalité (ex: `feature/login`, `feature/qrcode`)
- **Messages de commit** : format conventionnel

| Préfixe | Usage |
|---|---|
| `feat:` | Nouvelle fonctionnalité |
| `fix:` | Correction de bug |
| `docs:` | Documentation |
| `style:` | CSS, mise en forme |
| `refactor:` | Réorganisation du code |
| `test:` | Ajout de tests |

- **Pull Requests** : obligatoires pour merger dans `main`, avec au moins 1 revue

---

## Équipe & Répartition

| Rôle | Responsable | Tâches principales |
|---|---|---|
| **Chef de Projet** | — | Coordination, planning, suivi, README |
| **DB Admin** | — | Modélisation MCD/MLD, `database.sql`, `connexion_bdd.php` |
| **Lead Backend** | — | Contrôleurs (`auth`, `presence`), modèles, routeur `index.php` |
| **Lead Frontend** | — | Vues (`login`, `dashboard`, `enseignant`), `style.css` |
| **QA / Testeur** | — | Tests fonctionnels, rapports de bugs, scénarios de test |

---

## Comment contribuer (Workflow)

```
1. git checkout main && git pull                    # Se mettre à jour
2. git checkout -b feature/ma-fonctionnalite        # Créer une branche
3. # Coder...
4. git add -A && git commit -m "feat: description"  # Commiter
5. git push -u origin feature/ma-fonctionnalite     # Pousser
6. # Ouvrir une Pull Request sur GitHub
7. # Attendre la revue → merge dans main
```

---

## Base de données (schéma prévisionnel)

> À compléter dans `database.sql` par le **DB Admin**

Tables à créer :

| Table | Rôle |
|---|---|
| `utilisateurs` | Étudiants, enseignants, admin (matricule, nom, email, mot_de_passe_hash, role) |
| `cours` | Liste des matières/cours |
| `cours_enseignants` | Association enseignant ↔ cours (qui enseigne quoi) |
| `seances` | Une séance = un cours à une date/heure, avec token unique |
| `presences` | Enregistrement des scans (étudiant, séance, horodatage, statut) |

---

## Licence

Projet éducatif — Usage interne Faculté des Sciences Et Technogie (ULPGL).
