<?php

// Settings
$settings = [];

// Path settings
$settings['root'] = dirname(__DIR__);
$settings['temp'] = $settings['root'] . '/tmp';
$settings['public'] = $settings['root'] . '/public';

// Error Handling Middleware settings
$settings['error'] = [
    'display_error_details' => true,
    'log_errors' => true,
    'log_error_details' => true,
];

$settings['db'] = [
    'dbname' => '/chatDB.db',
];

return $settings;
