# 🚀 Quick Start - Deploy to Coolify

## ✅ Issue Fixed
**Problem**: `Failed to parse Nixpacks config file`
**Solution**: Fixed nixpacks.toml configuration

## 📋 Pre-deployment Checklist
- [x] Fixed nixpacks.toml configuration
- [x] Simplified composer.json
- [x] All required files present
- [x] Directories created
- [x] Security configurations applied

## 🏃‍♂️ Quick Deploy Steps

### 1. Commit Fixed Configuration
```bash
git add .
git commit -m "Fix nixpacks configuration for Coolify deployment"
git push origin main
```

### 2. Deploy in Coolify
1. Go to your Coolify dashboard
2. Find your KartuPerpus-Digital application
3. Click "Deploy" button
4. Monitor the build logs

### 3. Set Environment Variables
In Coolify dashboard, add:
```
APP_ENV=production
APP_DEBUG=false
```

### 4. Verify Deployment
- Access your application URL
- Check `/health.php` endpoint
- Test registration form

## 🔧 Current Working Configuration

**nixpacks.toml** (Fixed):
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

## 🛠️ If Deployment Still Fails

Try these alternatives in order:

### Option A: Minimal Configuration
Replace nixpacks.toml content with:
```toml
[phases.setup]
nixPkgs = ["php82", "php82Packages.composer"]

[phases.build]
cmds = ["composer install --no-dev --optimize-autoloader --no-scripts"]

[phases.start]
cmd = "php -S 0.0.0.0:$PORT -t ."
```

### Option B: Auto-detect
Delete nixpacks.toml completely and let Coolify auto-detect.

### Option C: Switch to Dockerfile
Use the Dockerfile provided in `ALTERNATIVE-CONFIG.md`.

## 📊 Expected Build Output
```
Found application type: php.
Building docker image started.
...
✅ Build completed successfully
✅ Application started on port 8080
✅ Health check passed
```

## 🎯 Post-deployment Tests
1. **Health Check**: `https://your-domain.com/health.php`
2. **Main Page**: `https://your-domain.com/`
3. **Registration**: Test form submission
4. **Dashboard**: Check member lookup

## 📞 Support
- Check `TROUBLESHOOTING.md` for common issues
- Review `ALTERNATIVE-CONFIG.md` for other options
- Monitor Coolify logs for detailed error messages

---
**Status**: ✅ Ready for deployment with fixed configuration!
