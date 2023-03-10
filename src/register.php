<?php

    require_once realpath(__DIR__ . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'database.php');
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.108.0">
    <title>Register</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/sign-in/">


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">


    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

        .b-example-divider {
            height: 3rem;
            background-color: rgba(0, 0, 0, .1);
            border: solid rgba(0, 0, 0, .15);
            border-width: 1px 0;
            box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
        }

        .b-example-vr {
            flex-shrink: 0;
            width: 1.5rem;
            height: 100vh;
        }

        .bi {
            vertical-align: -.125em;
            fill: currentColor;
        }

        .nav-scroller {
            position: relative;
            z-index: 2;
            height: 2.75rem;
            overflow-y: hidden;
        }

        .nav-scroller .nav {
            display: flex;
            flex-wrap: nowrap;
            padding-bottom: 1rem;
            margin-top: -1px;
            overflow-x: auto;
            text-align: center;
            white-space: nowrap;
            -webkit-overflow-scrolling: touch;
        }

        html,
        body {
            height: 100%;
        }

        body {
            display: flex;
            align-items: center;
            padding-top: 40px;
            padding-bottom: 40px;
            background-color: #f5f5f5;
        }

        .form-signin {
            max-width: 330px;
            padding: 15px;
        }

        .form-signin .form-floating:focus-within {
            z-index: 2;
        }

        .form-signin input[type="email"] {
            margin-bottom: -1px;
            border-bottom-right-radius: 0;
            border-bottom-left-radius: 0;
        }

        .form-signin input[type="password"] {
            margin-bottom: 10px;
            border-top-left-radius: 0;
            border-top-right-radius: 0;
        }

    </style>


    <!-- Custom styles for this template -->
    <link href="sign-in.css" rel="stylesheet">
</head>
<body class="text-center">

<main class="form-signin w-100 m-auto">
    <!--    start login form-->
    <form method="post" action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>">
        <h1 class="h3 mb-3 fw-normal">Please register</h1>
        <!--        full name partial -->
        <div class="form-floating my-2">
            <input type="text"
                   name="full_name"
                   class="form-control"
                   id="floatingInput"
                   placeholder="Enter your Full Name"
                   value="<?= $full_name ?? '' ?>"
            >
            <label for="floatingInput">Full Name</label>
            <?php
                if (isset($_SESSION['full_name'])) {
                    echo "<span class='text-danger'> {$_SESSION['full_name']} </span>";
                }
                unset($_SESSION['full_name']);
            ?>
        </div>
        <!--        end full name partial-->

        <!--        start email partial-->
        <div class="form-floating my-2">
            <input type="text"
                   name="email"
                   class="form-control"
                   id="floatingInput"
                   placeholder="name@example.com"
                   value="<?= isset($email) ? $email : ''?>"
            >
            <label for="floatingInput">Email address</label>
            <?php
                if (isset($_SESSION['email'])) {
                    echo "<span class='text-danger'> {$_SESSION['email']} </span>";
                }
                unset($_SESSION['email']);
            ?>
        </div>
        <!--        end email partial -->

        <!--        start password partial -->
        <div class="form-floating my-2">
            <input type="password"
                   name="password"
                   class="form-control"
                   id="floatingPassword"
                   placeholder="Password"
            >
            <label for="floatingPassword">Password</label>
            <?php
                if (isset($_SESSION['password'])) {
                    echo "<span class='text-danger'> {$_SESSION['password']} </span>";
                }
                unset($_SESSION['password']);
            ?>
        </div>
        <!--        end password partial-->

        <!--        start register button-->
        <button class="w-100 btn btn-lg btn-primary my-2" type="submit" name="register">Register</button>
        <!--      end  register button-->

        <p class="mt-5 mb-3 text-muted">&copy; 2022???2023</p>
    </form>

    <!--    end login form-->
</main>


<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"
        integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD"
        crossorigin="anonymous"></script>

</body>
</html>
