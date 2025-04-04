<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Combattant</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5">
    <h1 class="text-center mb-4">Détails du Combattant</h1>
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card shadow-sm mb-4">
                <div class="card-body text-center">
                    <h5 class="card-title text-primary">Nom : <?= htmlspecialchars($combattant['nom']) ?></h5>
                    <p class="card-text"><strong>Force : </strong> <?= $combattant['force'] ?></p>
                    <p class="card-text"><strong>Santé : </strong> <?= $combattant['sante'] ?></p>
                    <p class="card-text"><strong>Niveau : </strong> <?= $combattant['niveau'] ?></p>
                    <p class="card-text"><strong>Style : </strong> <?= htmlspecialchars($combattant['style']) ?></p>
                </div>
            </div>

            <div class="card shadow-sm mb-4">
                <div class="card-header text-center bg-primary text-white">
                    <strong>Aptitudes</strong>
                </div>
                <div class="card-body">
                    <?php if (count($aptitudes) > 0): ?>
                        <ul class="list-group">
                            <?php foreach ($aptitudes as $aptitude): ?>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span class="fw-bold"><?= htmlspecialchars($aptitude['nom']) ?></span>
                                    <span class="badge bg-info text-white"><?= $aptitude['note'] ?></span>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php else: ?>
                        <p class="text-muted text-center">Aucune aptitude disponible pour ce combattant.</p>
                    <?php endif; ?>
                </div>
            </div>

            <div class="text-center">
                <a href="/combattants" class="btn btn-primary">Retour à la liste</a>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
