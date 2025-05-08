@echo off
echo Installation and execution of the project "My Stage Search Management"
echo Please wait...

:: Check if Docker is installed and running
docker --version >nul 2>&1
if %errorlevel% neq 0 (
    echo Docker is not installed or is not running.
    echo Please install Docker and restart this script.
    exit /b 1
)

:: Check if Docker Compose is installed
docker-compose --version >nul 2>&1
if %errorlevel% neq 0 (
    echo Docker Compose is not installed.
    echo Please install Docker Compose and restart this script.
    exit /b 1
)

:: Start the project with Docker Compose
echo Starting the project with Docker Compose...
docker-compose up

:: Check if docker-compose up failed
if %errorlevel% neq 0 (
    echo An error occurred while starting the project with Docker Compose.
    echo Please check the logs above for more information.
    exit /b 1
)

echo The project is now running.
exit /b