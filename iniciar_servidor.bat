@echo off
chcp 65001 > nul
setlocal enabledelayedexpansion
title Servidor Local HabitaQ - DAW

echo ========================================================
echo       Iniciando Servidor Web HabitaQ (DAW Proyecto)
echo ========================================================
echo.

:: 1. Rutas 100% relativas a la carpeta del repositorio
set "SCRIPT_DIR=%~dp0"
for %%I in ("%~dp0..") do set "PARENT_DIR=%%~fI"
for %%I in ("%~dp0.") do set "PROJECT_NAME=%%~nxI"

echo [OK] Repositorio detectado: %PROJECT_NAME%
echo [OK] Directorio padre relativo: %PARENT_DIR%
echo.

:: 2. Detectar ruta de instalacion de XAMPP si existe en el sistema
set "XAMPP_DIR="
if exist "%SystemDrive%\xampp" set "XAMPP_DIR=%SystemDrive%\xampp"
if not defined XAMPP_DIR if exist "C:\xampp" set "XAMPP_DIR=C:\xampp"
if not defined XAMPP_DIR if exist "D:\xampp" set "XAMPP_DIR=D:\xampp"

:: 3. Si el proyecto esta dentro de htdocs de XAMPP, usar el Apache de XAMPP
echo %SCRIPT_DIR% | findstr /I "htdocs" >nul
if %errorlevel% equ 0 goto USAR_XAMPP_APACHE

goto BUSCAR_PHP

:USAR_XAMPP_APACHE
if defined XAMPP_DIR (
    echo [INFO] Proyecto detectado dentro de htdocs de XAMPP en: !XAMPP_DIR!
    if exist "!XAMPP_DIR!\apache_start.bat" (
        echo [INFO] Iniciando servicio Apache de XAMPP...
        start "" /min "!XAMPP_DIR!\apache_start.bat"
    )
    timeout /t 2 >nul
    echo Abriendo navegador en http://localhost/%PROJECT_NAME%/ ...
    start "" "http://localhost/%PROJECT_NAME%/"
    echo.
    echo ========================================================
    echo Servidor Apache de XAMPP activo.
    echo ========================================================
    pause
    exit /b 0
)

:BUSCAR_PHP
:: 4. Localizar php.exe (en PATH, en XAMPP o en WinGet)
set "PHP_CMD="
where php >nul 2>nul
if %errorlevel% equ 0 set "PHP_CMD=php"

if not defined PHP_CMD if defined XAMPP_DIR if exist "!XAMPP_DIR!\php\php.exe" set "PHP_CMD=!XAMPP_DIR!\php\php.exe"
if not defined PHP_CMD if exist "%SystemDrive%\xampp\php\php.exe" set "PHP_CMD=%SystemDrive%\xampp\php\php.exe"
if not defined PHP_CMD if exist "C:\xampp\php\php.exe" set "PHP_CMD=C:\xampp\php\php.exe"
if not defined PHP_CMD if exist "D:\xampp\php\php.exe" set "PHP_CMD=D:\xampp\php\php.exe"

if not defined PHP_CMD if exist "%LocalAppData%\Microsoft\WinGet\Packages" (
    for /d %%D in ("%LocalAppData%\Microsoft\WinGet\Packages\PHP*") do (
        if exist "%%D\php.exe" set "PHP_CMD=%%D\php.exe"
    )
)

:: 5. Si no se encuentra ni PHP ni XAMPP
if not defined PHP_CMD (
    echo [ERROR] No se ha encontrado PHP ni XAMPP en el sistema.
    echo Para solucionarlo:
    echo   1. Instala XAMPP por defecto en C:\xampp, o
    echo   2. Anade php.exe al PATH de Windows.
    echo.
    pause
    exit /b 1
)

:: 6. Lanzar servidor web PHP en el directorio superior relativo
echo [INFO] Motor PHP localizado: !PHP_CMD!
echo.
echo Abriendo navegador en http://localhost/%PROJECT_NAME%/ ...
start "" "http://localhost/%PROJECT_NAME%/"
echo.
echo Presiona Ctrl+C para detener el servidor.
echo ========================================================
echo.

"!PHP_CMD!" -S localhost:80 -t "%PARENT_DIR%"
if errorlevel 1 (
    echo.
    echo [AVISO] El puerto 80 requiere permisos de administrador o esta ocupado.
    echo Conmutando automaticamente al puerto 8000 alternativo...
    start "" "http://localhost:8000/%PROJECT_NAME%/"
    "!PHP_CMD!" -S localhost:8000 -t "%PARENT_DIR%"
)

pause
