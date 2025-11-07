<?php

include('connect.php');

$username = $password = "";

$errors = array ('username' => '', 'password' => '');

if (isset($_POST['submit'])) {
    
    session_start();
    $_SESSION['username'] = $_POST['username'];
    
    // Check username
    if (empty($_POST['username'])) {
        $error['username'] = 'Username is required <br />';
    }   else {
        $username = $_POST['username'];
        // only allow alphanumeric characters and underscores
        if (!preg_match("/^[a-zA-Z0-9_]+$/", $username)) {
            $error['username'] = 'Username can only contain letters, numbers, and underscores.';
        }
    }

    // Check password
    if (empty($_POST['password'])) {
        $error['password'] = 'Password is required <br />';
    }   else {
        $password = $_POST['password'];
        // Minimum length of 8 characters
        if (strlen($password) < 8) {
            $error['password'] = 'Password must be at least 8 characters long.';
        }
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login | CORE-TECH</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
</head>

<body class="bg-light">
    <header>
        <nav class="navbar fixed-top navbar-expand-lg navbar-light bg-white">
            <div class="container">
                <a class="navbar-brand" href="https://coresystech.ng/"><img src="img/logo.png" class="brand" alt=""></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <div class="text-center d-lg-none d-flex justify-content-center">
                            <li class="nav-item" style="width: 12rem; list-style: none;">
                                <a class="nav-link btn btn-secondary" href="https://coresystech.ng/" target="_blank">Back To Home</a>
                            </li>
                        </div>
                        <div class="d-none d-lg-block">
                            <li class="nav-item">
                                <a class="nav-link btn btn-secondary" href="https://coresystech.ng/" target="_blank">Back To Home</a>
                            </li>
                        </div>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <main style="font-family: cera_light !important ;">
        <div class="container mt-5 py-5 justify-content-center align-items-center d-flex">
            <div class="card p-5 mt-5 border-0 shadow-lg" style="width: 35rem;">
                <h2 class="blue mb-4 text-center" >Admin Login</h2>
                <?php if (!empty($_SESSION['success'])): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?php echo htmlspecialchars($_SESSION['success']); unset($_SESSION['success']); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                    <div>
                        <label class="form-label">Username:</label>
                        <input class="form-control" type="text" name="username" placeholder="Enter your username"><br>
                    </div>
                    <div>
                        <label class="form-label">Password:</label>
                        <input class="form-control" type="password" name="password" placeholder="Enter your password"><br><br>
                    </div>
                    <div class="text-center">
                        <input type="submit" class="btn btn-primary" value="Login">
                    </div>
                </form>
            </div>
        </div>
    </main>

    <?php include('templates/footer.php'); ?>

</html>