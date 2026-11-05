@echo off
chcp 65001 > nul
title Servidor Local HabitaQ - DAW
echo ========================================================
echo       Iniciando Servidor Web HabitaQ (DAW Proyecto)
echo ========================================================
echo.
echo Abriendo navegador en http://localhost/DAW_Proyecto/ ...
start "" "http://localhost/DAW_Proyecto/"
echo.
echo Presiona Ctrl+C en esta ventana para detener el servidor.
echo ========================================================
echo.
php -S localhost:80 -t "C:\Users\paucr\Documents"
if errorlevel 1 (
    echo.
    echo [AVISO] El puerto 80 requiere permisos o esta ocupado. Iniciando en puerto 8000...
    start "" "http://localhost:8000/DAW_Proyecto/"
    php -S localhost:8000 -t "C:\Users\paucr\Documents"
)
pause
