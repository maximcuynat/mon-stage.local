<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Stages</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Icons Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <!-- jQuery UI CSS -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <!-- Styles personnalisés -->
    <link rel="stylesheet" href="/assets/css/style.css">
    <style>
        :root {
            --sidebar-width: 300px;
            --sidebar-bg-color: #2c3e50;
            --sidebar-text-color: #ecf0f1;
            --sidebar-hover-bg-color: #34495e;
        }

        .sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            position: fixed;
            background-color: var(--sidebar-bg-color);
            color: var(--sidebar-text-color);
            transition: all 0.3s;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
        }

        .sidebar .nav-link {
            color: var(--sidebar-text-color);
            padding: 12px 15px;
            margin: 2px 5px;
            border-radius: 4px;
            transition: background-color 0.3s;
        }

        .sidebar .nav-link:hover, .sidebar .nav-link.active {
            background-color: var(--sidebar-hover-bg-color);
        }

        .sidebar .nav-link i {
            margin-right: 10px;
        }

        .main-content {
            margin-left: var(--sidebar-width);
            width: calc(100vw - var(--sidebar-width));
            transition: margin-left 0.3s;
            padding: 20px;
            overflow-x: hidden;
        }

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
                            <a href="/" class="nav-link active">
                                <i class="bi bi-house-door-fill"></i> Accueil
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/stages" class="nav-link">
                                <i class="bi bi-calendar-event"></i> Stages
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/entreprises" class="nav-link">
                                <i class="bi bi-building"></i> Entreprises
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/contacts" class="nav-link">
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

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- jQuery UI -->
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <!-- Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Script personnalisé -->
    <script src="/assets/js/script.js"></script>
    <!-- Script pour initialiser Select2 et Datepicker -->
    <script>
        $(document).ready(function() {
            // Initialiser Select2 sur les éléments select
            $('select').select2();

            // Initialiser le datepicker sur les éléments de type date
            $('input[type="date"]').datepicker({
                dateFormat: 'yy-mm-dd'
            });
        });
    </script>
</body>

</html>
