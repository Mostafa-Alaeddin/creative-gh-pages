<?php

    use Dotenv\Dotenv;

    $dotenv = Dotenv::createImmutable(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR);
    $dotenv->load();

    define('MYSQLI_HOST_NAME',          $_ENV['CONFIG_MYSQLI_HOST_NAME']);
    define('MYSQLI_USER_NAME',          $_ENV['CONFIG_MYSQLI_USER_NAME']);
    define('MYSQLI_PASSWORD',           $_ENV['CONFIG_MYSQLI_PASSWORD']);
    define('MYSQLI_DATABASE_NAME',      $_ENV['CONFIG_MYSQLI_DATABASE_NAME']);
    define('MYSQLI_PORT',               $_ENV['CONFIG_MYSQLI_PORT']);
    define('MYSQLI_SOCKET',             $_ENV['CONFIG_MYSQLI_SOCKET']);


    try {
        $connect_database = new mysqli(
            hostname:   MYSQLI_HOST_NAME,
            username:   MYSQLI_USER_NAME,
            password:   MYSQLI_PASSWORD,
            database:   MYSQLI_DATABASE_NAME,
            port:       MYSQLI_PORT,
            socket:     MYSQLI_SOCKET
        );
    } catch (mysqli_sql_exception $exception) {
        if ($exception->getCode() === 1049) {
            $connect_database = new mysqli(
                hostname:   MYSQLI_HOST_NAME,
                username:   MYSQLI_USER_NAME,
                password:   MYSQLI_PASSWORD,
                port:       MYSQLI_PORT,
                socket:     MYSQLI_SOCKET
            );
            $connect_database->query("CREATE DATABASE IF NOT EXISTS " . MYSQLI_DATABASE_NAME);
        }
    }
