<?php
// includes/logger.php

function logError($message) {
    try{
    $logFile = __DIR__ . '/../logs/error_log.txt';
    $date = date('Y-m-d H:i:s');
    $logMessage = "[$date] - $message" . PHP_EOL;
    file_put_contents($logFile, $logMessage, FILE_APPEND);
    }
     catch (Exception $e) 
    {
    echo "<script>alert('Log Error'); window.history.back();</script>";
    }
}

?>