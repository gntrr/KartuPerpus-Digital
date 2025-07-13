#!/bin/bash

# Test script untuk memverifikasi deployment
echo "🧪 Testing KartuPerpus Digital Deployment..."

# Test 1: Check if main files exist
echo "📁 Checking main files..."
files=("index.php" "register.php" "dashboard.php" "health.php" "config.php" "logger.php")
for file in "${files[@]}"; do
    if [ -f "$file" ]; then
        echo "✅ $file exists"
    else
        echo "❌ $file missing"
    fi
done

# Test 2: Check directories
echo "📂 Checking directories..."
dirs=("members" "logs" "public" "public/uploads")
for dir in "${dirs[@]}"; do
    if [ -d "$dir" ]; then
        echo "✅ $dir exists"
    else
        echo "❌ $dir missing"
    fi
done

# Test 3: Check file permissions
echo "🔐 Checking permissions..."
if [ -w "members" ]; then
    echo "✅ members directory is writable"
else
    echo "❌ members directory is not writable"
fi

# Test 4: Check PHP syntax
echo "🔍 Checking PHP syntax..."
find . -name "*.php" -exec php -l {} \; 2>/dev/null | grep -v "No syntax errors"

# Test 5: Test health endpoint
echo "🏥 Testing health endpoint..."
if command -v curl &> /dev/null; then
    response=$(curl -s -o /dev/null -w "%{http_code}" http://localhost:8080/health.php)
    if [ "$response" = "200" ]; then
        echo "✅ Health endpoint responding"
    else
        echo "❌ Health endpoint not responding (HTTP $response)"
    fi
else
    echo "⚠️  curl not available, skipping health check"
fi

# Test 6: Check configuration
echo "⚙️  Checking configuration..."
if [ -f "nixpacks.toml" ]; then
    echo "✅ nixpacks.toml exists"
else
    echo "❌ nixpacks.toml missing"
fi

if [ -f "composer.json" ]; then
    echo "✅ composer.json exists"
else
    echo "❌ composer.json missing"
fi

# Test 7: Check static assets
echo "🎨 Checking static assets..."
if [ -f "public/style.css" ]; then
    echo "✅ CSS file exists"
else
    echo "❌ CSS file missing"
fi

if [ -d "public/Font-Awesome-6.x" ]; then
    echo "✅ Font Awesome directory exists"
else
    echo "❌ Font Awesome directory missing"
fi

echo "🏁 Testing completed!"
echo ""
echo "📋 Summary:"
echo "- Make sure all ✅ items are present"
echo "- Fix any ❌ items before deployment"
echo "- Test the application manually after deployment"
echo ""
echo "🚀 Ready for Coolify deployment!"
