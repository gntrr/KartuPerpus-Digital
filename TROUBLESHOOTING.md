# Troubleshooting Coolify Deployment

## Issue: Failed to parse Nixpacks config file (PERSISTENT)

### Problem
```
Error: Failed to parse Nixpacks config file `/artifacts/thegameplan.json`
Caused by: invalid length 0, expected struct Phase with 11 elements at line 57 column 19
```

### Root Cause
Nixpacks has compatibility issues with custom PHP configuration when auto-detection conflicts with manual overrides.

### Solution: Multiple Approaches

## ✅ SOLUTION 1: Auto-Detection (Recommended)
**Status**: Implemented

1. **Removed nixpacks.toml** - Let Coolify auto-detect PHP
2. **Updated composer.json** - Added post-install setup script
3. **Added setup.php** - Handles directory creation automatically

**Current configuration**:
```json
{
    "scripts": {
        "post-install-cmd": ["php setup.php"]
    }
}
```

## ✅ SOLUTION 2: Docker Fallback
**Status**: Ready as backup

If auto-detection still fails, switch to Docker build in Coolify:

1. **Build Type**: Change from "Nixpacks" to "Dockerfile"
2. **Dockerfile**: Already created and ready
3. **Port**: 8080 (configured in Dockerfile)

## 🔧 Implementation Steps

### For Auto-Detection (Try First)
1. **Ensure nixpacks.toml is deleted** ✅
2. **Commit changes**:
   ```bash
   git add .
   git commit -m "Remove nixpacks.toml, use auto-detection with setup script"
   git push origin main
   ```
3. **Deploy in Coolify** - Should work with auto-detection
4. **Verify** - Check `/health.php`

### For Docker Fallback (If Auto-Detection Fails)
1. **In Coolify Dashboard**:
   - Go to your application settings
   - Change "Build Type" from "Nixpacks" to "Dockerfile"
   - Save settings
2. **Deploy again**
3. **Monitor logs** - Should build successfully with Docker

## 📋 Current File Status

### ✅ Working Files
- `composer.json` - Optimized for auto-detection
- `setup.php` - Creates required directories
- `Dockerfile` - Ready as fallback
- `health.php` - Health check endpoint
- All application files

### ❌ Removed Files
- `nixpacks.toml` - Removed to prevent conflicts

## 🎯 Expected Results

### Auto-Detection Success
```
Found application type: php.
Installing PHP dependencies...
Running post-install setup...
✓ Created directory: members
✓ Created directory: logs
✓ Created directory: public/uploads
Starting PHP application...
```

### Docker Success
```
Building Dockerfile...
Installing dependencies...
Configuring nginx and php-fpm...
Health check passed...
Application ready on port 8080
```

## 🔍 Debugging Commands

After deployment, verify:
```bash
# Health check
curl https://your-domain.com/health.php

# Directory structure
curl https://your-domain.com/health.php | grep -i "directory"

# Application response
curl https://your-domain.com/
```

## 📞 Next Steps if Both Fail

1. **Check Coolify logs** for specific error messages
2. **Try alternative PHP version** (8.1 instead of 8.2)
3. **Contact Coolify support** with error logs
4. **Use external hosting** (Vercel, Netlify, etc.)

## 📈 Success Indicators
- ✅ No Nixpacks parsing errors
- ✅ Composer install completes
- ✅ Directories created successfully
- ✅ Health endpoint responds
- ✅ Application loads properly

---
**Status**: Ready for deployment with auto-detection + Docker fallback
