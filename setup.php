<?php
// Setup script untuk membuat direktori yang diperlukan
echo "Setting up KartuPerpus Digital...\n";

$directories = ['members', 'logs', 'public/uploads'];

foreach ($directories as $dir) {
    if (!is_dir($dir)) {
        if (mkdir($dir, 0755, true)) {
            echo "✓ Created directory: $dir\n";
        } else {
            echo "✗ Failed to create directory: $dir\n";
        }
    } else {
        echo "✓ Directory already exists: $dir\n";
    }
    
    // Set permissions
    if (is_dir($dir)) {
        chmod($dir, 0755);
    }
}

echo "Setup completed!\n";
?>
