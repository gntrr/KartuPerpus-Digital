# Troubleshooting Coolify Deployment

## Issue: Failed to parse Nixpacks config file

### Problem
```
Error: Failed to parse Nixpacks config file `/artifacts/thegameplan.json`
Caused by: invalid length 0, expected struct Phase with 11 elements at line 60 column 19
```

### Solution
The issue was with the `nixpacks.toml` configuration. Fixed by:

1. **Removed invalid `[build]` section** - This section is not valid for nixpacks
2. **Simplified build commands** - Removed unnecessary commands
3. **Removed PORT variable** - Let Coolify handle port configuration
4. **Added `--no-scripts` flag** - Prevent composer scripts from running during build

### Fixed Configuration

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

### Key Changes
- ✅ Removed `[build]` section from nixpacks.toml
- ✅ Removed `bash` from nixPkgs (not needed)
- ✅ Simplified build commands
- ✅ Removed PORT variable (let Coolify handle it)
- ✅ Added `--no-scripts` to composer install
- ✅ Removed post-install-cmd from composer.json

### Environment Variables for Coolify
Set these in Coolify dashboard:
```
APP_ENV=production
APP_DEBUG=false
```

### Next Steps
1. Commit and push the fixed configuration
2. Retry deployment in Coolify
3. Check deployment logs for any other issues
4. Access `/health.php` to verify deployment

## Common Nixpacks Issues

### 1. Invalid Configuration Sections
- Only use `[phases.setup]`, `[phases.build]`, `[phases.start]`, and `[variables]`
- Avoid custom sections like `[build]`

### 2. Command Formatting
- Use array format for multiple commands: `cmds = ["cmd1", "cmd2"]`
- Use string format for single command: `cmd = "single command"`

### 3. PHP Version
- Use `php82` for PHP 8.2
- Use `php81` for PHP 8.1
- Always include `php82Packages.composer` for composer

### 4. Port Configuration
- Let Coolify handle port with `$PORT` variable
- Don't hardcode port numbers in production

## Verification Commands

After deployment, verify:
1. Health check: `curl https://your-domain.com/health.php`
2. Main page: `curl https://your-domain.com/`
3. Registration: Test form submission

## Support
If deployment still fails, check:
1. Nixpacks documentation: https://nixpacks.com/docs/providers/php
2. Coolify documentation
3. Application logs in Coolify dashboard
