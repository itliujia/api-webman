<?php

$serverHost = getenv('SERVER_PORT');
$serverName = getenv('SERVER_NAME');

return [
    'listen' => "http://127.0.0.1:$serverHost",
    'transport' => 'tcp',
    'context' => [],
    'name' => $serverName,
    'count' => cpu_count() * 4,
    'user' => '',
    'group' => '',
    'reusePort' => false,
    'event_loop' => '',
    'stop_timeout' => 2,
    'pid_file' => runtime_path() . '/webman.pid',
    'status_file' => runtime_path() . '/webman.status',
    'stdout_file' => runtime_path() . '/logs/stdout.log',
    'log_file' => runtime_path() . '/logs/workerman.log',
    'max_package_size' => 10 * 1024 * 1024
];
