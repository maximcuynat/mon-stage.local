@echo off
echo WARNING: This will completely reset Docker and remove all containers, images, volumes, networks, and builds associated with the project!
echo This operation cannot be undone. All data will be lost.
echo.
set /p confirm="Are you sure you want to proceed? Type 'yes' to confirm: "

:: Set your project tag or name here
set PROJECT_TAG=my_project_tag

if /i "%confirm%"=="yes" (
    echo Proceeding with Docker reset for project: %PROJECT_TAG%...
    echo.

    :: Stop and remove containers related to the project
    echo Stopping all containers related to the project...
    docker stop $(docker ps -aq --filter "ancestor=%PROJECT_TAG%")
    if %errorlevel% neq 0 (
        echo An error occurred while stopping containers.
    )

    echo Removing all containers related to the project...
    docker rm $(docker ps -aq --filter "ancestor=%PROJECT_TAG%")
    if %errorlevel% neq 0 (
        echo An error occurred while removing containers.
    )

    :: Remove images related to the project
    echo Removing all images related to the project...
    docker rmi $(docker images --filter "reference=%PROJECT_TAG%" -q)
    if %errorlevel% neq 0 (
        echo An error occurred while removing images.
    )

    :: Remove volumes related to the project
    echo Removing all volumes related to the project...
    docker volume ls --filter "name=%PROJECT_TAG%" -q | docker volume rm
    if %errorlevel% neq 0 (
        echo An error occurred while removing volumes.
    )

    :: Remove networks related to the project
    echo Removing all networks related to the project...
    docker network ls --filter "name=%PROJECT_TAG%" -q | docker network rm
    if %errorlevel% neq 0 (
        echo An error occurred while removing networks.
    )

    :: Remove Docker build cache associated with the project
    echo Removing all Docker build cache for project: %PROJECT_TAG%...
    docker builder prune --filter "label=%PROJECT_TAG%" -a -f
    if %errorlevel% neq 0 (
        echo An error occurred while removing build cache.
    )

    echo Docker has been completely reset for project: %PROJECT_TAG%.
) else (
    echo Docker reset cancelled.
)

pause
exit /b