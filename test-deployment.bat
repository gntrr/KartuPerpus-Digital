@echo off
REM Test script untuk memverifikasi deployment (Windows)

echo 🧪 Testing KartuPerpus Digital Deployment...

REM Test 1: Check if main files exist
echo 📁 Checking main files...
set "files=index.php register.php dashboard.php health.php config.php logger.php"
for %%f in (%files%) do (
    if exist "%%f" (
        echo ✅ %%f exists
    ) else (
        echo ❌ %%f missing
    )
)

REM Test 2: Check directories
echo 📂 Checking directories...
set "dirs=members logs public public\uploads"
for %%d in (%dirs%) do (
    if exist "%%d" (
        echo ✅ %%d exists
    ) else (
        echo ❌ %%d missing
    )
)

REM Test 3: Check configuration files
echo ⚙️  Checking configuration...
if exist "nixpacks.toml" (
    echo ✅ nixpacks.toml exists
) else (
    echo ❌ nixpacks.toml missing
)

if exist "composer.json" (
    echo ✅ composer.json exists
) else (
    echo ❌ composer.json missing
)

REM Test 4: Check static assets
echo 🎨 Checking static assets...
if exist "public\style.css" (
    echo ✅ CSS file exists
) else (
    echo ❌ CSS file missing
)

if exist "public\Font-Awesome-6.x" (
    echo ✅ Font Awesome directory exists
) else (
    echo ❌ Font Awesome directory missing
)

echo 🏁 Testing completed!
echo.
echo 📋 Summary:
echo - Make sure all ✅ items are present
echo - Fix any ❌ items before deployment
echo - Test the application manually after deployment
echo.
echo 🚀 Ready for Coolify deployment!
pause
