# Configuration spéciale pour les tests fonctionnels
Cette branche contient une page de tests fonctionnels accessible à l'URL `/debug`. Cette page n'est active que dans cette branche grâce à la configuration `environment: 'test'`.

## Workflow Git adapté
### 1. Récupérer les mises à jour de dev pour tester

```bash
git checkout test
git pull origin test
git merge dev --no-commit    # Merge sans commit automatique
# À ce stade, les fichiers sont mergés mais non commités
```

### 2. Gérer les configurations spécifiques à l'environnement
```bash
# Ajuster la configuration pour l'environnement de test
echo "<?php 
return [
    'db' => [
        'host' => 'db',
        'name' => 'internships',
        'user' => 'root',
        'pass' => 'rootpassword',
        'charset' => 'utf8'
    ],
    'app' => [
        'environment' => 'test'
    ]
]; " > src/Config/config.local.php

# Vérifier les changements
git status

# Ajouter les fichiers modifiés, y compris la configuration
git add .

# Compléter le merge avec un message approprié
git commit -m "merge: fusion de dev vers test avec config d'environnement test"

# Pousser vers la branche distante
git push origin test
```

### 3. Tester les fonctionnalités
Accédez à l'URL `/debug` pour exécuter tous les tests fonctionnels et voir les résultats dans l'interface web.

### 4. Appliquer un commit spécifique (cherry-pick)
```bash
git checkout test
git cherry-pick <hash_commit_de_dev>

# Ajuster la configuration après le cherry-pick si nécessaire
echo "<?php return ['app' => ['environment' => 'test']]; " > src/Config/config.local.php
git add src/Config/config.local.php
git commit --amend --no-edit   # Amender le commit précédent sans changer le message

git push origin test
```

### 5. Passer en production (branche main)
```bash
git checkout main
git pull origin main
git merge test --no-commit      # Merge sans commit automatique

# Ajuster la configuration pour l'environnement de production
echo "<?php 
return [
    'db' => [
        'host' => 'production-db-host',
        'name' => 'internships',
        'user' => 'prod-user',
        'pass' => 'prod-password-secure',
        'charset' => 'utf8'
    ],
    'app' => [
        'environment' => 'production'
    ]
]; " > src/Config/config.local.php

# Compléter le merge
git add .
git commit -m "release: déploiement en production"
git push origin main

# Tagger la release
git tag vX.X.X
git push origin vX.X.X
```

## Astuce pour maintenir des configurations différentes
Le fichier `.gitignore` contient normalement `src/Config/config.local.php` pour éviter de versionner les configurations locales. Cependant, dans ce workflow, nous voulons délibérément committer ce fichier pour chaque environnement.
Une alternative serait d'utiliser un script de post-checkout qui configure automatiquement l'environnement en fonction de la branche:

```bash
# À placer dans .git/hooks/post-checkout (rendre exécutable avec chmod +x)
#!/bin/bash

BRANCH=$(git symbolic-ref --short HEAD)

if [ "$BRANCH" = "test" ]; then
    echo "Configuration pour l'environnement de test"
    echo "<?php return ['app' => ['environment' => 'test']]; " > src/Config/config.local.php
elif [ "$BRANCH" = "main" ]; then
    echo "Configuration pour l'environnement de production"
    echo "<?php return ['app' => ['environment' => 'production']]; " > src/Config/config.local.php
else
    echo "Configuration pour l'environnement de développement"
    echo "<?php return ['app' => ['environment' => 'development']]; " > src/Config/config.local.php
fi
```
Ce hook s'exécutera automatiquement à chaque changement de branche, adaptant votre configuration en conséquence.