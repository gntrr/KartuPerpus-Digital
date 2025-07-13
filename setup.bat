@echo off
REM Setup script for KartuPerpus Digital deployment (Windows)

echo 🚀 Setting up KartuPerpus Digital...

REM Create necessary directories
echo 📁 Creating directories...
if not exist "members" mkdir members
if not exist "public\uploads" mkdir public\uploads
if not exist "logs" mkdir logs

REM Check if composer is available
where composer >nul 2>nul
if %errorlevel% == 0 (
    echo 📦 Installing PHP dependencies...
    composer install --no-dev --optimize-autoloader
) else (
    echo ⚠️  Composer not found, skipping dependency installation
)

REM Create basic .htaccess if not exists
if not exist ".htaccess" (
    echo 🔧 Creating .htaccess...
    echo # Enable URL rewriting > .htaccess
    echo RewriteEngine On >> .htaccess
    echo. >> .htaccess
    echo # Security headers >> .htaccess
    echo Header always set X-Content-Type-Options nosniff >> .htaccess
    echo Header always set X-Frame-Options DENY >> .htaccess
    echo Header always set X-XSS-Protection "1; mode=block" >> .htaccess
    echo. >> .htaccess
    echo # Cache static assets >> .htaccess
    echo ^<FilesMatch "\.(css^|js^|png^|jpg^|jpeg^|gif^|ico^|svg^|woff^|woff2^|ttf^|eot)$"^> >> .htaccess
    echo     ExpiresActive On >> .htaccess
    echo     ExpiresDefault "access plus 1 month" >> .htaccess
    echo     Header set Cache-Control "public, max-age=2592000" >> .htaccess
    echo ^</FilesMatch^> >> .htaccess
)

echo ✅ Setup completed successfully!
echo 📊 You can now access the health check at: /health.php
echo 🌐 Main application is available at: /index.php

REM Check setup
echo 🔍 Verifying setup...
if exist "members" if exist "public" (
    echo ✅ All directories created successfully
) else (
    echo ❌ Some directories are missing
    exit /b 1
)

echo 🎉 KartuPerpus Digital is ready for deployment!
pause
