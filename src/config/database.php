<?php

    /** @noinspection PhpUndefinedVariableInspection */
    session_start();

    //=========================================== Start SQL File =======================================\\
    require_once realpath(__DIR__ . DIRECTORY_SEPARATOR . 'SQL.php');
    //=========================================== End SQL File =======================================\\

    //=========================================== Start Config File =======================================\\
    require_once realpath(__DIR__ . DIRECTORY_SEPARATOR . 'config.php');

    //=========================================== EndConfig File ==========================================\\


    use Dotenv\Dotenv;
    use Dotenv\Exception\ValidationException;
    use Rakit\Validation\Validator;

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
    } catch (ValidationException $exception) {
//        if config database is empty or not define set this error
        echo "<b>Fatal error : </b> <br/>" . PHP_EOL . $exception->getMessage(
            ) . '<br />' . PHP_EOL . 'This error occurred at this address :  ' . __DIR__ . DIRECTORY_SEPARATOR . '.env';
        die();
    }

//  set env const to define
    define('MYSQLI_HOST_NAME', $_ENV['CONFIG_MYSQLI_HOST_NAME']);
    define('MYSQLI_USER_NAME', $_ENV['CONFIG_MYSQLI_USER_NAME']);
    define('MYSQLI_PASSWORD', $_ENV['CONFIG_MYSQLI_PASSWORD']);
    define('MYSQLI_DATABASE_NAME', $_ENV['CONFIG_MYSQLI_DATABASE_NAME']);
    define('MYSQLI_PORT', $_ENV['CONFIG_MYSQLI_PORT']);
    define('MYSQLI_SOCKET', $_ENV['CONFIG_MYSQLI_SOCKET']);

//  database handler
    $connect_database = new mysqli(
        hostname: MYSQLI_HOST_NAME,
        username: MYSQLI_USER_NAME,
        password: MYSQLI_PASSWORD,
        database: MYSQLI_DATABASE_NAME,
        port: MYSQLI_PORT,
        socket: MYSQLI_SOCKET
    );
    try {
        if ($connect_database->connect_error === null) {
//          select database if everything is ok
            $connect_database->select_db(MYSQLI_DATABASE_NAME);
//          run query's
            $connect_database->query($create_table_users);
            $connect_database->query($create_table_about_section_one);
            $connect_database->query($create_table_about_section_two);
            $connect_database->query($create_table_services_box);
            $connect_database->query($create_table_services_gallery);
            $connect_database->query($create_table_protofile);
            $connect_database->query($create_table_contact_details);
            $connect_database->query($create_table_contact_form);
            $connect_database->query($create_table_footer);
            $connect_database->query($create_table_brand);
        }
//        register code
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register'])) {
//            set value
            $full_name = $_POST['full_name'];
            $email = $_POST['email'];
            $password = md5($_POST['password']);
            $role = 3;

//            validated data
            $validator = new Validator;
            $validation = $validator->make($_POST + $_FILES, [
                'full_name' => 'required',
                'email' => 'required|email',
                'password' => 'required|min:6',
            ]);

            $validation->validate();

            if ($validation->fails()) {
                // handling errors
                $errors = $validation->errors();

                foreach ($errors->firstOfAll() as $key => $error) {
                    $_SESSION[$key] = $error;
                }
            } else {
                // validation passes
                $_SESSION['success_register_form'] = "Registration was successful";
                $create_user = "INSERT INTO `users`(`full_name`, `email`, `password`, `role`) VALUES ('{$full_name}','{$email}','{$password}','{$role}')";
                try {
                    $connect_database->query($create_user);
                    header('Location:index.php', true);
                }catch (mysqli_sql_exception $exception)
                {
//                    If the email is duplicate
                    if($exception->getCode() === 1062)
                    {
                        $_SESSION['email'] = 'This email exists';
                    }
                }

            }
        }
//        login code
    } catch (mysqli_sql_exception $exception) {
        if ($exception->getCode() === 2002) {
            throw new InvalidArgumentException
            (
                message: 'An error occurred in the configuration of the .env file in the database section',
                code: 2002
            );
        }
        if ($exception->getCode() === 1049) {
            $connect_database = new mysqli(
                hostname: MYSQLI_HOST_NAME,
                username: MYSQLI_USER_NAME,
                password: MYSQLI_PASSWORD,
                port: MYSQLI_PORT,
                socket: MYSQLI_SOCKET
            );
            $connect_database->query("CREATE DATABASE IF NOT EXISTS " . MYSQLI_DATABASE_NAME);
        }
    }
