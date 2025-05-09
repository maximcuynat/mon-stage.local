<?php
/**
 * Composant d'alerte standardisé
 */

// Valeurs par défaut
$type = $type ?? 'info';
$icon = '';

// Sélection de l'icône selon le type
switch($type) {
    case 'success':
        $icon = '<i class="bi bi-check-circle-fill me-2"></i>';
        break;
    case 'danger':
        $icon = '<i class="bi bi-exclamation-triangle-fill me-2"></i>';
        break;
    case 'warning':
        $icon = '<i class="bi bi-exclamation-circle-fill me-2"></i>';
        break;
    case 'info':
    default:
        $icon = '<i class="bi bi-info-circle-fill me-2"></i>';
        break;
}
?>
<div class="alert alert-<?= $type ?> alert-dismissible fade show" role="alert">
    <?php if (isset($errors) && is_array($errors) && !empty($errors)): ?>
        <ul class="mb-0">
            <?php foreach ($errors as $err): ?>
                <li><?= $icon ?><?= htmlspecialchars($err) ?></li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <?= $icon ?><?= htmlspecialchars($message ?? '') ?>
    <?php endif; ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>