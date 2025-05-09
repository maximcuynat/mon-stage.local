<div class="container my-4">
    <h1 class="mb-4">Tests Fonctionnels</h1>
    
    <div class="card mb-4">
        <div class="card-header">
            <h2 class="h5 mb-0">Résumé</h2>
        </div>
        <div class="card-body">
            <div class="d-flex justify-content-between">
                <div>
                    <p><strong>Total de tests:</strong> <?= $summary['total'] ?></p>
                    <p><strong>Tests réussis:</strong> <span class="text-success"><?= $summary['passed'] ?></span></p>
                    <p><strong>Tests échoués:</strong> <span class="text-danger"><?= $summary['failed'] ?></span></p>
                </div>
                <div>
                    <?php if ($summary['failed'] === 0): ?>
                        <div class="alert alert-success">Tous les tests ont réussi!</div>
                    <?php else: ?>
                        <div class="alert alert-danger">
                            <?= $summary['failed'] ?> test(s) ont échoué.
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h2 class="h5 mb-0">Détails des tests</h2>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped mb-0">
                    <thead>
                        <tr>
                            <th>Test</th>
                            <th>Statut</th>
                            <th>Message</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($results as $result): ?>
                            <tr>
                                <td><?= htmlspecialchars($result['name']) ?></td>
                                <td>
                                    <?php if ($result['status'] === 'success'): ?>
                                        <span class="badge bg-success">Succès</span>
                                    <?php else: ?>
                                        <span class="badge bg-danger">Échec</span>
                                    <?php endif; ?>
                                </td>
                                <td><?= htmlspecialchars($result['message']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>