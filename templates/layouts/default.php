<?php
    $currentUrl = $_GET['url'] ?? '';
    $currentSegment = explode('/', $currentUrl)[0];
    if (empty($currentSegment)) {
        $currentSegment = 'accueil';
    }
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Stages</title>
    
    <!-- Bibliothèques externes -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    
    <!-- Style intégré directement dans le template -->
    <style>
    :root {
        --sidebar-width: 300px;
        --sidebar-bg-color: #2c3e50;
        --sidebar-text-color: #ecf0f1;
        --sidebar-hover-bg-color: #34495e;
        --primary-color: #2c3e50;
        --secondary-color: #34495e;
        --light-bg: #f8f9fa;
        --transition-speed: 0.3s;
    }

    /* Barre latérale */
    .sidebar {
        width: var(--sidebar-width);
        height: 100vh;
        position: fixed;
        background-color: var(--sidebar-bg-color);
        color: var(--sidebar-text-color);
        transition: all var(--transition-speed);
        box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
        z-index: 1030;
    }

    .sidebar .nav-link {
        color: var(--sidebar-text-color);
        padding: 12px 15px;
        margin: 2px 5px;
        border-radius: 4px;
        transition: background-color var(--transition-speed);
        position: relative;
        overflow: hidden;
    }

    .sidebar .nav-link:hover,
    .sidebar .nav-link.active {
        background-color: var(--sidebar-hover-bg-color);
    }

    .sidebar .nav-link i {
        margin-right: 10px;
    }

    .sidebar .nav-link::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 0;
        height: 2px;
        background-color: var(--sidebar-text-color);
        transition: width var(--transition-speed);
    }

    .sidebar .nav-link:hover::after {
        width: 100%;
    }

    /* Contenu principal */
    .main-content {
        margin-left: var(--sidebar-width);
        width: calc(100vw - var(--sidebar-width));
        transition: margin-left var(--transition-speed);
        padding: 20px;
        overflow-x: hidden;
        animation: fadeInContent var(--transition-speed) ease-out;
    }

    @keyframes fadeInContent {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    /* Responsive */
    @media (max-width: 768px) {
        .sidebar {
            transform: translateX(-100%);
        }

        .sidebar.active {
            transform: translateX(0);
        }

        .main-content {
            margin-left: 0;
            width: 100vw;
        }

        .main-content.active {
            margin-left: var(--sidebar-width);
            width: calc(100vw - var(--sidebar-width));
        }
    }

    /* Cartes */
    .card {
        border: none;
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        transition: all var(--transition-speed) ease;
        margin-bottom: 1.5rem;
    }

    .card:hover {
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        transform: translateY(-3px);
    }

    .card-header {
        background-color: #fff;
        border-bottom: 1px solid rgba(0, 0, 0, 0.1);
        padding: 1rem;
    }

    /* Formulaires */
    .form-control, .form-select {
        padding: 0.75rem 1rem;
        border-radius: 0.375rem;
        transition: border-color 0.2s ease, box-shadow 0.2s ease;
    }

    .form-control:focus, .form-select:focus {
        box-shadow: 0 0 0 0.25rem rgba(44, 62, 80, 0.15);
        border-color: var(--primary-color);
    }

    /* Boutons */
    .btn {
        padding: 0.5rem 1.25rem;
        border-radius: 0.375rem;
        transition: all 0.2s ease;
    }

    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.1);
    }

    .btn-primary {
        background-color: var(--primary-color);
        border-color: var(--primary-color);
    }

    .btn-primary:hover {
        background-color: var(--secondary-color);
        border-color: var(--secondary-color);
    }

    /* Listes */
    .list-group-item {
        transition: all 0.2s ease;
    }

    .list-group-item:hover {
        transform: translateX(5px);
        background-color: var(--light-bg);
    }

    /* Alertes */
    .alert {
        animation: fadeIn 0.5s ease-out;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Tableaux */
    .table tr {
        transition: all 0.2s ease;
    }

    .table tr:hover {
        background-color: rgba(44, 62, 80, 0.05);
    }

    /* Effet ripple */
    .ripple-effect {
        position: absolute;
        border-radius: 50%;
        background-color: rgba(255, 255, 255, 0.4);
        transform: scale(0);
        animation: ripple 0.6s linear;
        pointer-events: none;
    }

    @keyframes ripple {
        to {
            transform: scale(4);
            opacity: 0;
        }
    }
    </style>
</head>

<body>
    <div class="container-fluid p-0">
        <div class="row">
            <!-- Barre latérale -->
            <nav class="sidebar">
                <div class="d-flex flex-column p-3">
                    <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                        <span class="fs-4">Gestion des Stages</span>
                    </a>
                    <hr>
                    <ul class="nav nav-pills flex-column mb-auto">
                        <li class="nav-item">
                            <a href="/" class="nav-link <?php echo $currentSegment === 'accueil' ? 'active' : ''; ?>">
                                <i class="bi bi-house-door-fill"></i> Accueil
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/stages" class="nav-link <?php echo $currentSegment === 'stages' ? 'active' : ''; ?>">
                                <i class="bi bi-calendar-event"></i> Stages
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/entreprises" class="nav-link <?php echo $currentSegment === 'entreprises' ? 'active' : ''; ?>">
                                <i class="bi bi-building"></i> Entreprises
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/contacts" class="nav-link <?php echo $currentSegment === 'contacts' ? 'active' : ''; ?>">
                                <i class="bi bi-people-fill"></i> Contacts
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Contenu principal -->
            <main class="main-content">
                <div class="container-fluid">
                    <?= $content ?>
                </div>
            </main>
        </div>
    </div>

    <!-- Bibliothèques JavaScript -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Script intégré directement dans le template -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialisation des plugins jQuery
        if (typeof $ !== 'undefined') {
            // Select2
            if ($.fn.select2) {
                $('select').select2();
            }
            
            // Datepicker
            if ($.fn.datepicker) {
                $('input[type="date"]').datepicker({
                    dateFormat: 'yy-mm-dd'
                });
            }
        }

        // Validation des formulaires
        const forms = document.querySelectorAll('.needs-validation');
        Array.from(forms).forEach(form => {
            form.addEventListener('submit', event => {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });

        // Animation pour les cartes
        const cards = document.querySelectorAll('.card');
        cards.forEach((card, index) => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(20px)';
            setTimeout(() => {
                card.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            }, 100 * index);
        });

        // Animation pour les alertes
        const alerts = document.querySelectorAll('.alert');
        alerts.forEach(alert => {
            const closeButton = alert.querySelector('.btn-close');
            if (closeButton) {
                closeButton.addEventListener('click', function() {
                    alert.style.transition = 'all 0.3s ease';
                    alert.style.opacity = '0';
                    alert.style.transform = 'translateY(-20px)';
                });
            }
        });

        // Animation pour les boutons
        const submitButtons = document.querySelectorAll('form button[type="submit"]');
        submitButtons.forEach(button => {
            button.addEventListener('mousedown', function() {
                this.style.transform = 'scale(0.95)';
            });
            button.addEventListener('mouseup', function() {
                this.style.transform = 'scale(1)';
            });
            button.addEventListener('mouseleave', function() {
                this.style.transform = 'scale(1)';
            });
        });

        // Effet ripple pour éléments cliquables
        const clickableElements = document.querySelectorAll('.btn, .nav-link, .list-group-item');
        clickableElements.forEach(element => {
            element.addEventListener('click', function(e) {
                const ripple = document.createElement('span');
                ripple.classList.add('ripple-effect');
                
                const rect = this.getBoundingClientRect();
                const size = Math.max(rect.width, rect.height);
                
                ripple.style.width = ripple.style.height = `${size}px`;
                ripple.style.left = `${e.clientX - rect.left - size / 2}px`;
                ripple.style.top = `${e.clientY - rect.top - size / 2}px`;
                
                this.appendChild(ripple);
                
                setTimeout(() => {
                    ripple.remove();
                }, 600);
            });
        });

        // Animation pour les lignes de tableau
        const tableRows = document.querySelectorAll('table tbody tr');
        tableRows.forEach((row, index) => {
            row.style.opacity = '0';
            setTimeout(() => {
                row.style.transition = 'opacity 0.3s ease';
                row.style.opacity = '1';
            }, 50 * index);
        });

        // Menu responsive
        const toggleButton = document.createElement('button');
        toggleButton.classList.add('btn', 'btn-dark', 'd-md-none', 'position-fixed');
        toggleButton.style.left = '10px';
        toggleButton.style.top = '10px';
        toggleButton.style.zIndex = '1031';
        toggleButton.innerHTML = '<i class="bi bi-list"></i>';
        document.body.appendChild(toggleButton);

        toggleButton.addEventListener('click', function() {
            const sidebar = document.querySelector('.sidebar');
            const mainContent = document.querySelector('.main-content');
            
            sidebar.classList.toggle('active');
            mainContent.classList.toggle('active');
        });
    });
    </script>
</body>

</html>