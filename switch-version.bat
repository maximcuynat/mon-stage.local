@echo off
echo === Choose Project Version ===
echo.
echo 1 - STABLE Version (main)
echo 2 - TEST Version (dev)
echo 3 - PRE-RELEASE Version (test)
echo.

set /p choix="Your choice (1/2/3) : "

if "%choix%"=="1" (
    set BRANCH=main
) else if "%choix%"=="2" (
    set BRANCH=dev
) else if "%choix%"=="3" (
    set BRANCH=test
) else (
    echo Invalid choice.
    pause
    exit /b
)

echo.
echo Switching to the branch %BRANCH%...
git checkout %BRANCH%
if errorlevel 1 (
    echo Failed to switch to the branch %BRANCH%. It may not exist locally.
    pause
    exit /b
)

echo Fetching the latest changes from %BRANCH%...
git pull origin %BRANCH%

echo.
echo === %BRANCH% branch is up to date ===
pause
