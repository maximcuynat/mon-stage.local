<?php
// Paramètres: $type (success, danger, warning, info), $message, $errors (tableau optionnel)
$type = $type ?? 'info';
?>
<div class="alert alert-<?= $type ?> alert-dismissible fade show" role="alert">
    <?php if (isset($errors) && is_array($errors) && !empty($errors)): ?>
        <ul class="mb-0">
            <?php foreach ($errors as $err): ?>
                <li><?= htmlspecialchars($err) ?></li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <?= htmlspecialchars($message ?? '') ?>
    <?php endif; ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>