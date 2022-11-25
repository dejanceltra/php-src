<?php

$pdo = new \PDO("mysql:host=mysql;dbname=test", "user", "password");
var_dump($pdo->query("SELECT 1")->fetch());
$pid = pcntl_fork();
if ($pid === -1) {
    throw new \Exception("Couldn't fork.");
}

if (!$pid) {
    // child

    register_shutdown_function(function () {
        error_log("SHUT");
        posix_kill(getmypid(), SIGKILL);
    });

    // override signal handling for the child
    pcntl_async_signals(true);
    pcntl_signal(SIGTERM, function () { exit(0);  });
    pcntl_signal(SIGINT, function () { exit(0); });

    var_dump($pdo->query("SELECT 1")->fetch());
    
    usleep(1000*100);
    exit(0);
}

// parent
usleep(1000*200);
error_log("parent {$pid}");
var_dump($pdo->query("SELECT 1")->fetch());
