<?php
// Simple logging utility for KartuPerpus Digital

class Logger {
    private $logFile;
    
    public function __construct($logFile = 'logs/app.log') {
        $this->logFile = $logFile;
        
        // Create logs directory if it doesn't exist
        $logDir = dirname($this->logFile);
        if (!is_dir($logDir)) {
            mkdir($logDir, 0755, true);
        }
    }
    
    public function log($level, $message, $context = []) {
        $timestamp = date('Y-m-d H:i:s');
        $contextStr = !empty($context) ? json_encode($context) : '';
        $logEntry = "[{$timestamp}] {$level}: {$message} {$contextStr}" . PHP_EOL;
        
        file_put_contents($this->logFile, $logEntry, FILE_APPEND | LOCK_EX);
    }
    
    public function info($message, $context = []) {
        $this->log('INFO', $message, $context);
    }
    
    public function error($message, $context = []) {
        $this->log('ERROR', $message, $context);
    }
    
    public function warning($message, $context = []) {
        $this->log('WARNING', $message, $context);
    }
    
    public function debug($message, $context = []) {
        $this->log('DEBUG', $message, $context);
    }
}

// Global logger instance
$logger = new Logger();

// Function to log member registration
function logMemberRegistration($nim, $nama, $status = 'success') {
    global $logger;
    $logger->info("Member registration", [
        'nim' => $nim,
        'nama' => $nama,
        'status' => $status,
        'ip' => $_SERVER['REMOTE_ADDR'] ?? 'unknown'
    ]);
}

// Function to log member lookup
function logMemberLookup($nim, $found = false) {
    global $logger;
    $logger->info("Member lookup", [
        'nim' => $nim,
        'found' => $found,
        'ip' => $_SERVER['REMOTE_ADDR'] ?? 'unknown'
    ]);
}

// Function to log errors
function logError($message, $context = []) {
    global $logger;
    $logger->error($message, array_merge($context, [
        'ip' => $_SERVER['REMOTE_ADDR'] ?? 'unknown',
        'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? 'unknown'
    ]));
}

// Function to get recent logs
function getRecentLogs($lines = 50) {
    $logFile = 'logs/app.log';
    if (!file_exists($logFile)) {
        return [];
    }
    
    $logs = file($logFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    return array_slice($logs, -$lines);
}

// Function to clear old logs (keep last 1000 lines)
function cleanupLogs() {
    $logFile = 'logs/app.log';
    if (!file_exists($logFile)) {
        return;
    }
    
    $logs = file($logFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    if (count($logs) > 1000) {
        $recentLogs = array_slice($logs, -1000);
        file_put_contents($logFile, implode(PHP_EOL, $recentLogs) . PHP_EOL);
    }
}

// Auto cleanup on every 100th request (simple approach)
if (rand(1, 100) === 1) {
    cleanupLogs();
}
?>
