@echo off
echo === Choix de la version du projet ===
echo.
echo 1 - Version STABLE (main)
echo 2 - Version TEST (dev)
echo 3 - Version PRE-RELEASE (test)
echo.

set /p choix="Votre choix (1/2/3) : "

if "%choix%"=="1" (
    set BRANCH=main
) else if "%choix%"=="2" (
    set BRANCH=dev
) else if "%choix%"=="3" (
    set BRANCH=test
) else (
    echo Choix invalide.
    pause
    exit /b
)

echo.
echo Passage à la branche %BRANCH%...
git checkout %BRANCH%
git pull origin %BRANCH%

echo.
echo === Branche %BRANCH% à jour ===
pause
