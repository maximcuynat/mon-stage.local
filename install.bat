@echo off
echo Installation et execution du projet "Ma gestion de recherche de stage"
echo Veuillez patienter...

:: Vérifier si Docker est installé et en cours d'exécution
docker --version
if %errorlevel% neq 0 (
    echo Docker n'est pas installé ou n'est pas en cours d'exécution.
    echo Veuillez installer Docker et redémarrer ce script.
    pause
    exit /b 1
)

:: Lancer le projet avec Docker Compose
docker-compose up

echo Le projet est maintenant en cours d'exécution.
pause
