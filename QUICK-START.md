# 🚀 Quick Start - Deploy to Coolify

## ✅ Issue RESOLVED
**Problem**: Persistent Nixpacks configuration parsing errors
**Solution**: Removed nixpacks.toml, using auto-detection + setup script

## 🏃‍♂️ Quick Deploy Steps

### 1. Commit Latest Changes
```bash
git add .
git commit -m "Remove nixpacks.toml, use auto-detection with Docker fallback"
git push origin main
```

### 2. Deploy in Coolify (Auto-Detection)
1. Go to your Coolify dashboard
2. Find your KartuPerpus-Digital application
3. **Build Type**: Should auto-detect as "Nixpacks - PHP"
4. Click "Deploy" button
5. Monitor the build logs

### 3. If Auto-Detection Fails → Switch to Docker
1. In Coolify dashboard → Application Settings
2. **Change Build Type**: From "Nixpacks" to "Dockerfile"
3. Save settings
4. Click "Deploy" again
5. Monitor Docker build logs

### 4. Set Environment Variables
In Coolify dashboard, add:
```
APP_ENV=production
APP_DEBUG=false
```

### 5. Verify Deployment
- Access your application URL
- Check `/health.php` endpoint: `https://your-domain.com/health.php`
- Test registration form

## 🔧 Current Configuration (Auto-Detection)

**composer.json** (Setup handled automatically):
```json
{
    "scripts": {
        "post-install-cmd": ["php setup.php"]
    }
}
```

**setup.php** (Creates required directories):
```php
$directories = ['members', 'logs', 'public/uploads'];
// Creates directories with proper permissions
```

## � Dockerfile Configuration (Fallback)

If auto-detection fails, Dockerfile is ready with:
- PHP 8.2 + FPM
- Nginx web server
- Supervisor process manager
- All required directories
- Health checks
- Security headers

## 📊 Expected Build Output

### Auto-Detection Success:
```
✓ Detected PHP application
✓ Installing composer dependencies
✓ Running post-install setup
✓ Created directory: members
✓ Created directory: logs
✓ Created directory: public/uploads
✓ Application started successfully
```

### Docker Success:
```
✓ Building Dockerfile
✓ Installing PHP 8.2 and dependencies
✓ Configuring nginx and php-fpm
✓ Setting up directories and permissions
✓ Health check passed
✓ Application ready on port 8080
```

## 🎯 Post-deployment Tests

1. **Health Check**: 
   ```
   GET https://your-domain.com/health.php
   Expected: HTTP 200 with JSON status
   ```

2. **Main Page**: 
   ```
   GET https://your-domain.com/
   Expected: KartuPerpus Digital homepage
   ```

3. **Registration Form**: 
   ```
   GET https://your-domain.com/register.php
   Expected: Registration form loads
   ```

4. **Static Assets**: 
   ```
   GET https://your-domain.com/public/style.css
   Expected: CSS file loads
   ```

## 🛠️ Troubleshooting

### If Deployment Still Fails:

1. **Check Coolify Logs**:
   - Look for specific error messages
   - Note which step fails

2. **Try Different Approaches**:
   - ✅ Auto-detection (current)
   - ✅ Docker build (fallback)
   - 🔄 Manual PHP setup (last resort)

3. **Verify File Structure**:
   - All required files present
   - No missing dependencies
   - Proper file permissions

### Common Issues & Solutions:

| Issue | Solution |
|-------|----------|
| Auto-detection fails | Switch to Dockerfile |
| Port conflicts | Use port 8080 |
| Permission errors | Check directory permissions in logs |
| Health check fails | Verify `/health.php` endpoint |

## 📞 Support Resources

- **Project Documentation**: `TROUBLESHOOTING.md`
- **Alternative Configs**: `ALTERNATIVE-CONFIG.md`
- **Deployment Status**: Check Coolify application logs
- **Health Monitoring**: `/health.php` endpoint

---
**Status**: ✅ Ready for deployment with dual approach (auto-detection + Docker fallback)

**Next Action**: Commit changes and deploy with auto-detection first!
