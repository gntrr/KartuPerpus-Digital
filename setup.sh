#!/bin/bash

# Setup script for KartuPerpus Digital deployment

echo "🚀 Setting up KartuPerpus Digital..."

# Create necessary directories
echo "📁 Creating directories..."
mkdir -p members
mkdir -p public/uploads
mkdir -p logs

# Set permissions
echo "🔐 Setting permissions..."
chmod 755 members
chmod 755 public/uploads
chmod 755 logs

# Check if composer is available
if command -v composer &> /dev/null; then
    echo "📦 Installing PHP dependencies..."
    composer install --no-dev --optimize-autoloader
else
    echo "⚠️  Composer not found, skipping dependency installation"
fi

# Create basic .htaccess if not exists
if [ ! -f ".htaccess" ]; then
    echo "🔧 Creating .htaccess..."
    cat > .htaccess << 'EOF'
# Enable URL rewriting
RewriteEngine On

# Force HTTPS (uncomment if using HTTPS)
# RewriteCond %{HTTPS} off
# RewriteRule ^(.*)$ https://%{HTTP_HOST}%{REQUEST_URI} [L,R=301]

# Security headers
Header always set X-Content-Type-Options nosniff
Header always set X-Frame-Options DENY
Header always set X-XSS-Protection "1; mode=block"

# Cache static assets
<FilesMatch "\.(css|js|png|jpg|jpeg|gif|ico|svg|woff|woff2|ttf|eot)$">
    ExpiresActive On
    ExpiresDefault "access plus 1 month"
    Header set Cache-Control "public, max-age=2592000"
</FilesMatch>

# Deny access to sensitive files
<Files ~ "(\.json|\.log|\.env)$">
    Order allow,deny
    Deny from all
</Files>

# Deny access to members directory from web
<Directory "members">
    Order allow,deny
    Deny from all
</Directory>
EOF
fi

echo "✅ Setup completed successfully!"
echo "📊 You can now access the health check at: /health.php"
echo "🌐 Main application is available at: /index.php"

# Check setup
echo "🔍 Verifying setup..."
if [ -d "members" ] && [ -d "public" ]; then
    echo "✅ All directories created successfully"
else
    echo "❌ Some directories are missing"
    exit 1
fi

echo "🎉 KartuPerpus Digital is ready for deployment!"
