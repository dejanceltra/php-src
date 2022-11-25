<?php

$pdo = new \PDO("mysql:host=mysql;dbname=test", "user", "password");

$pid = pcntl_fork();
if ($pid === -1) {
    throw new \Exception("Couldn't fork.");
}

if (!$pid) {
    // child

    // override signal handling for the child
    pcntl_async_signals(true);
    pcntl_signal(SIGTERM, function () { exit(0);  });
    pcntl_signal(SIGINT, function () { exit(0); });

    
    sleep(1);
    exit(0);
}

// parent
error_log("parent {$pid}");
