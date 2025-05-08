@echo off
echo === Project Update ===

REM Check if Git is available
where git >nul 2>&1
if errorlevel 1 (
    echo Git is not installed or not in the PATH.
    pause
    exit /b
)

REM Get the current branch
for /f "tokens=*" %%i in ('git rev-parse --abbrev-ref HEAD') do set BRANCH=%%i

echo You are on the branch: %BRANCH%
echo Fetching the latest changes...
git pull origin %BRANCH%

echo.
echo === Update completed ===
pause