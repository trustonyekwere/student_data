<?php

include('connect.php');

// get student id from url
$student_id = $_GET['id'] ?? '';



// Initialize variables to hold existing data
$firstname = '';
$lastname = '';
$email = '';
$dateofbirth = '';
$maritalstatus = '';
$sex = '';
$image_name = '';
$address = '';

// sql to fetch student details
$sql = "SELECT * FROM student_reg WHERE id = '$student_id' ";

$query = mysqli_query($connect, $sql);

$row = mysqli_fetch_assoc($query);

?>

<!DOCTYPE html>
<html lang="en">

<?php include('templates/header.php'); ?>

    <main class="container">
        <section class="justify-content-center mt-5 pt-5">
            <div class="card p-5 my-5 border-0 shadow-lg">
                <!-- submit to same page so the PHP above runs -->
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data">
                    <div class="mb-5 text-center">
                        <h1 class="blue">Edit Details</h1>
                    </div>

                    <!-- <?php // if (array_filter($errors)): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>There were some problems:</strong>
                            <ul class="mb-0">
                            <?php // foreach ($errors as $msg): if ($msg): ?>
                                <li><?php // echo htmlspecialchars($msg); ?></li>
                            <?php // endif; endforeach; ?>
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php // endif; ?> -->

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">First Name</label>
                                <input type="text" name="firstname" class="form-control" value="<?php echo $row['first_name']; ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Last Name</label>
                                <input type="text" name="lastname" class="form-control" value="<?php echo $row['last_name']; ?>">
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="emailInput" class="form-label">Email address</label>
                        <input id="emailInput" type="email" value="<?php echo $row['email']; ?>" class="form-control" name="email" aria-describedby="emailHelp">
                        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Address (optional)</label>
                        <textarea name="address" class="form-control"><?php echo $row['address']; ?></textarea>
                    </div>

                    <div class="text-center">
                        <button type="submit" name="submit" class="btn btn-primary mt-3">Submit</button>
                    </div>
                </form>
            </div>
        </section>
    </main>

<?php include('templates/footer.php'); ?>

</html>
