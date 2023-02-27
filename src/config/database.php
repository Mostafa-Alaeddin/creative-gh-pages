<?php

    use Dotenv\Dotenv;
    use Dotenv\Exception\ValidationException;

//    added dot env for database file
    $dotenv = Dotenv::createImmutable(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR);
    $dotenv->load();

//    validated data in env file || required parameters
    try {
        $dotenv->required([
            'CONFIG_MYSQLI_HOST_NAME',
            'CONFIG_MYSQLI_USER_NAME',
            'CONFIG_MYSQLI_PASSWORD',
            'CONFIG_MYSQLI_DATABASE_NAME',
            'CONFIG_MYSQLI_PORT',
            'CONFIG_MYSQLI_SOCKET'
        ]);
    }catch (ValidationException $exception)
    {
//        if config database is empty or not define set this error
        echo "<b>Fatal error : </b> <br/>". PHP_EOL . $exception->getMessage() . '<br />'. PHP_EOL . 'This error occurred at this address :  '. __DIR__ . DIRECTORY_SEPARATOR . '.env';
        die();
    }

//  set env const to define
    define('MYSQLI_HOST_NAME',          $_ENV['CONFIG_MYSQLI_HOST_NAME']);
    define('MYSQLI_USER_NAME',          $_ENV['CONFIG_MYSQLI_USER_NAME']);
    define('MYSQLI_PASSWORD',           $_ENV['CONFIG_MYSQLI_PASSWORD']);
    define('MYSQLI_DATABASE_NAME',      $_ENV['CONFIG_MYSQLI_DATABASE_NAME']);
    define('MYSQLI_PORT',               $_ENV['CONFIG_MYSQLI_PORT']);
    define('MYSQLI_SOCKET',             $_ENV['CONFIG_MYSQLI_SOCKET']);

//  database handler
    try {
        $connect_database = new mysqli(
            hostname:   MYSQLI_HOST_NAME,
            username:   MYSQLI_USER_NAME,
            password:   MYSQLI_PASSWORD,
            database:   MYSQLI_DATABASE_NAME,
            port:       MYSQLI_PORT,
            socket:     MYSQLI_SOCKET
        );
        if($connect_database->connect_error === null)
        {
//            select database if everything is ok
            $connect_database->select_db(MYSQLI_DATABASE_NAME);
        }
    } catch (mysqli_sql_exception $exception) {
        if($exception->getCode() === 2002){
            throw new InvalidArgumentException
            (
                message: 'An error occurred in the configuration of the .env file in the database section',
                code:2002
            );
        }
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
