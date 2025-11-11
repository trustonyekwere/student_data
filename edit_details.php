<?php

include('connect.php');

if ($_GET['id']) {
    session_start();
    $student_id = $_GET['id'];
    
    $get_details = "SELECT * FROM `student_reg` WHERE `id` = '$student_id' ";

    $send_query = mysqli_query($connect, $get_details);

    $student_data = mysqli_fetch_assoc($send_query);

} else {
    echo "No Student ID Selected";
};

$username =  $_SESSION['username'] ?? 'Guest';

$update_id = $first_name = $last_name = $email = $phone_number = $address = "";


if (isset($_POST['update'])) {
    $update_id = $_POST['update_id'];
    
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $address = $_POST['address'];

    // sql to update student details
    $update_sql = "UPDATE student_reg SET 
        first_name = '$first_name',
        last_name = '$last_name',
        email = '$email',
        phone_number = '$phone_number',
        address = '$address'
        WHERE id = '$update_id' ";

    $send_update_query = mysqli_query($connect, $update_sql);

    if ($update_sql) {
        $_SESSION['success'] = "Details edited successfully";
        // redirect to student details page after update
        header("Location: student_details.php?id=$update_id");
        exit();
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit <?php echo $student_data['last_name'];?> Details</title>
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

    <main class="container">
        <section class="justify-content-center mt-5 pt-5">
            <div class="card p-5 my-5 border-0 shadow-lg">
                <!-- submit to same page so the PHP above runs -->
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                    
                    <!-- retains the unique id -->
                    <input type="text" hidden id="update_id" name="update_id" value="<?php echo $student_data['id'];?>">

                    <div class="mb-5 text-center">
                        <h1 class="blue">Edit Details</h1>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">First Name</label>
                                <input type="text" name="first_name" class="form-control" value="<?php echo $student_data['first_name']; ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Last Name</label>
                                <input type="text" name="last_name" class="form-control" value="<?php echo $student_data['last_name']; ?>">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="emailInput" class="form-label">Email address</label>
                                <input id="emailInput" type="email" value="<?php echo $student_data['email']; ?>" class="form-control" name="email" aria-describedby="emailHelp">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Phone Number</label>
                                <input type="text" name="phone_number" class="form-control" value="<?php echo $student_data['phone_number']; ?>">
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Address (optional)</label>
                        <textarea name="address" class="form-control"><?php echo $student_data['address']; ?></textarea>
                    </div>

                    <div class="text-center">
                        <button type="submit" name="update" class="btn btn-primary mt-3">Update</button>
                    </div>
                </form>
            </div>
        </section>
    </main>

<?php include('templates/footer.php'); ?>

</html>
