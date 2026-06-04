<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SNGP - Tableau de Bord Enseignant</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <?php
    session_start();
    if (!isset($_SESSION['utilisateur_id']) || $_SESSION['utilisateur_role'] === 'etudiant') {
        header('Location: index.php?action=login');
        exit;
    }
    require_once 'controleurs/presence_controleur.php';
    $cours = getListeCours();
    $seances = getSeancesEnseignant($_SESSION['utilisateur_id']);
    ?>

    <header class="header">
        <div class="header-content">
            <h1>SNGP — Enseignant</h1>
            <nav>
                <span class="user-info">
                    <?= htmlspecialchars($_SESSION['utilisateur_prenom'] . ' ' . $_SESSION['utilisateur_nom']) ?>
                </span>
                <a href="index.php?action=deconnexion" class="btn btn-outline">Se déconnecter</a>
            </nav>
        </div>
    </header>

    <main class="container">
        <!-- Créer une séance -->
        <section class="card">
            <h2>Nouvelle séance</h2>
            <form method="POST" action="controleurs/presence_controleur.php">
                <input type="hidden" name="action" value="creer_seance">
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="cours_id">Cours</label>
                        <select id="cours_id" name="cours_id" required>
                            <option value="">— Sélectionner —</option>
                            <?php foreach ($cours as $c): ?>
                                <option value="<?= $c['id'] ?>">
                                    <?= htmlspecialchars($c['code_cours'] . ' - ' . $c['titre']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="date_seance">Date</label>
                        <input type="date" id="date_seance" name="date_seance" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="heure_debut">Heure début</label>
                        <input type="time" id="heure_debut" name="heure_debut" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="heure_fin">Heure fin</label>
                        <input type="time" id="heure_fin" name="heure_fin" required>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">
                    Créer la séance + QR Code
                </button>
            </form>
        </section>

        <!-- QR Code actif -->
        <?php if (!empty($seances)): ?>
        <section class="card qr-section">
            <h2>QR Code actif</h2>
            <?php 
            $derniere = $seances[0];
            $token = $derniere['qr_code_token'];
            $qrUrl = 'https://api.qrserver.com/v1/create-qr-code/?size=250x250&data=' . urlencode($token);
            ?>
            <img src="<?= $qrUrl ?>" alt="QR Code" class="qr-code">
            <p class="text-center">
                <strong>Cours :</strong> <?= htmlspecialchars($derniere['cours_titre']) ?><br>
                <strong>Date :</strong> <?= htmlspecialchars($derniere['date_seance']) ?><br>
                <strong>Code :</strong> <code><?= htmlspecialchars($token) ?></code>
            </p>
        </section>
        <?php endif; ?>

        <!-- Historique des séances -->
        <section class="card">
            <h2>Mes séances</h2>
            <?php if (empty($seances)): ?>
                <p class="text-muted">Aucune séance créée pour le moment.</p>
            <?php else: ?>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Cours</th>
                            <th>Horaire</th>
                            <th>Code</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($seances as $s): ?>
                        <tr>
                            <td><?= htmlspecialchars($s['date_seance']) ?></td>
                            <td><?= htmlspecialchars($s['cours_titre']) ?></td>
                            <td><?= substr($s['heure_debut'], 0, 5) ?> - <?= substr($s['heure_fin'], 0, 5) ?></td>
                            <td><code><?= htmlspecialchars(substr($s['qr_code_token'], 0, 8)) ?>...</code></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </section>
    </main>
</body>
</html>
