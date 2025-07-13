# Alternative Configuration for Coolify

## Option 1: Minimal nixpacks.toml (Recommended)
```toml
[phases.setup]
nixPkgs = ["php82", "php82Packages.composer"]

[phases.build]
cmds = ["composer install --no-dev --optimize-autoloader --no-scripts"]

[phases.start]
cmd = "php -S 0.0.0.0:$PORT -t ."

[variables]
PHP_VERSION = "8.2"
```

## Option 2: Auto-detect (No nixpacks.toml)
Delete nixpacks.toml file completely and let Coolify auto-detect PHP configuration.

## Option 3: Docker-based (Fallback)
Create Dockerfile if nixpacks continues to fail:

```dockerfile
FROM php:8.2-cli

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    zip \
    unzip

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /app

# Copy application files
COPY . .

# Install dependencies
RUN composer install --no-dev --optimize-autoloader --no-scripts

# Create required directories
RUN mkdir -p members logs public/uploads
RUN chmod 755 members logs public/uploads

# Expose port
EXPOSE 8080

# Start application
CMD ["php", "-S", "0.0.0.0:8080", "-t", "."]
```

## Current Working Configuration

**nixpacks.toml**:
```toml
[phases.setup]
nixPkgs = ["php82", "php82Packages.composer"]

[phases.build]
cmds = [
  "composer install --no-dev --optimize-autoloader --no-scripts",
  "mkdir -p members logs public/uploads",
  "chmod 755 members logs public/uploads"
]

[phases.start]
cmd = "php -S 0.0.0.0:$PORT -t ."

[variables]
PHP_VERSION = "8.2"
```

**composer.json**:
```json
{
    "name": "kartuperpus/digital",
    "description": "Kartu Perpustakaan Digital",
    "type": "project",
    "require": {
        "php": ">=8.0"
    },
    "scripts": {
        "start": "php -S 0.0.0.0:${PORT:-8080} -t .",
        "dev": "php -S localhost:8080 -t ."
    },
    "config": {
        "optimize-autoloader": true,
        "preferred-install": "dist"
    }
}
```

## Environment Variables for Coolify
```
APP_ENV=production
APP_DEBUG=false
```

## Deployment Steps
1. **Commit changes**: `git add . && git commit -m "Fix nixpacks configuration"`
2. **Push to repo**: `git push origin main`
3. **Redeploy in Coolify**: Click "Deploy" button
4. **Monitor logs**: Check build logs for errors
5. **Test health**: Access `/health.php`

## If Still Having Issues
Try these in order:
1. Use minimal nixpacks.toml (Option 1)
2. Remove nixpacks.toml completely (Option 2)
3. Switch to Dockerfile (Option 3)
4. Contact Coolify support
