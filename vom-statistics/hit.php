<?php
    $SETUP_FILE = '../config/setup.json';
    $DEFAULT_LOG_PATH = 'hits.log';

    if(!empty($_GET['cp'])){
        $checkpoint = $_GET['cp'];
        $setup_log_path = json_decode(file_get_contents($SETUP_FILE), true)['statistics']['log'];
        $log_file_path = (isset($setup_log_path) && $setup_log_path !== '') ? ($setup_log_path) : ($DEFAULT_LOG_PATH);

        $timestamp = strval(time());
        $data = "{$checkpoint};{$timestamp}\n";

        $file = fopen($log_file_path, 'a');

        if ($file === false) {
            echo "Cannot open log file at: {$log_file_path}";
            exit;
        }

        fwrite($file, $data);
        fclose($file);

        echo "Log successful";
    }
?>