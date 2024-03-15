<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        <!-- Titre de la page -->
        <title>Mon stage</title>
    </head>
    <!-- Body -->
    <body style="background-color: #34495e;">
        <div class="d-flex flex-column  justify-content-center">
            <!-- Header -->
            <div class="ps-0 pt-3 pb-3" style="background-color: #2c3e50;" hidden>
                <div class="container px-0">
                    <!-- Menu -->    
                    <h1>
                        <a href="/stages" class="link-offset-1-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover text-white"><?= $title_text ?></a>
                    </h1>
                </div>
            </div>

            <!-- Nav -->
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow">
                <div>
                    <a class="navbar-brand ms-3 fw-bold" href="/accueil">Mes Stages</a>
                </div>
                <div class="ms-1 collapse navbar-collapse flex-fill">
                    <ul class="navbar-nav gap-2">
                        <!-- Ajouter -->
                        <li class="nav-item dropdown">
                            <button class="btn btn-dark dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Ajouter</button>
                            <ul class="dropdown-menu dropdown-menu-dark">
                                <li><a class="dropdown-item" href="/stages/add">Un Stage</a></li>
                                <li><a class="dropdown-item" href="/contacts/add">Un Contact</a></li>
                            </ul>
                        </li>
                        <!-- Voir -->
                        <ul class="navbar-nav gap-2">
                            <li class="nav-item">
                                <a class="btn btn-dark" href="/stages">Voir les stages</a>
                            </li>
                            <li class="nav-item">
                                <a class="btn btn-dark" href="/entreprises">Voir les entreprises</a>
                            </li>
                            <li class="nav-item">
                                <a class="btn btn-dark" href="/contacts">Voir les contacts</a>
                            </li>
                        </ul>
                    </ul>
                </div>
            </nav>
            
            <!-- Content -->
            <div>
                <?= $content ?>
            </div>

        </div>
    </body>
</html>