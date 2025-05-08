@echo off
echo === Mise à jour du projet ===

REM Vérifie que Git est dispo
where git >nul 2>&1
if errorlevel 1 (
    echo Git n'est pas installé ou pas dans le PATH.
    pause
    exit /b
)

REM Demande sur quelle branche on est
for /f "tokens=*" %%i in ('git rev-parse --abbrev-ref HEAD') do set BRANCH=%%i

echo Vous êtes sur la branche : %BRANCH%
echo Récupération des dernières modifications...
git pull origin %BRANCH%

echo.
echo === Mise à jour terminée ===
pause
