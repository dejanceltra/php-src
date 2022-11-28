<?php

function x() {
    $pdo = new \PDO("mysql:host=mysql;dbname=test", "user", "password");
    var_dump($pdo->query("SELECT 1")->fetch());

    $pid = pcntl_fork();
    if ($pid === -1) {
        throw new \Exception("Couldn't fork.");
    }

    if (!$pid) {
        // child

        register_shutdown_function(function () {
            error_log("shutdown");
            posix_kill(getmypid(), SIGKILL);
        });
        
        usleep(1000*100);
        exit(1);
    }

    // parent
    usleep(1000*200);
    var_dump($pdo->query("SELECT 1")->fetch());
}

x();
