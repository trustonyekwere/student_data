<?php



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
                        <h1 class="blue">Registration Form</h1>
                    </div>

                    <?php if (array_filter($errors)): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>There were some problems:</strong>
                            <ul class="mb-0">
                            <?php foreach ($errors as $msg): if ($msg): ?>
                                <li><?php echo htmlspecialchars($msg); ?></li>
                            <?php endif; endforeach; ?>
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">First Name</label>
                                <input type="text" name="firstname" class="form-control" value="<?php echo htmlspecialchars($firstname); ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Last Name</label>
                                <input type="text" name="lastname" class="form-control" value="<?php echo htmlspecialchars($lastname); ?>">
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="emailInput" class="form-label">Email address</label>
                        <input id="emailInput" type="email" value="<?php echo htmlspecialchars($email); ?>" class="form-control" name="email" aria-describedby="emailHelp">
                        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                    </div>

                    <div class="row pt-3">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label name="dateofbirth" class="form-label">Date of Birth</label>
                                <!-- added name so PHP can read it -->
                                <input type="date" name="dateofbirth" class="form-control" value="<?php echo htmlspecialchars($dateofbirth); ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="maritalStatus" class="form-label">Marital Status</label>
                                <!-- keep the visible select but match the php key via name -->
                                <select class="form-select" id="maritalStatus" name="marital_status">
                                    <option value="" disabled <?php if ($maritalstatus === '') echo 'selected'; ?>>-- Select your status --</option>
                                    <option value="single" <?php if ($maritalstatus === 'single') echo 'selected'; ?>>Single</option>
                                    <option value="married" <?php if ($maritalstatus === 'married') echo 'selected'; ?>>Married</option>
                                    <option value="divorced" <?php if ($maritalstatus === 'divorced') echo 'selected'; ?>>Divorced</option>
                                    <option value="widowed" <?php if ($maritalstatus === 'widowed') echo 'selected'; ?>>Widowed</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row pt-3">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Sex</label>
                                <div class="d-flex gap-3 align-items-center">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" id="male" name="sex" value="male" <?php if ($sex === 'male') echo 'checked'; ?>>
                                        <label class="form-check-label" for="male">Male</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" id="female" name="sex" value="female" <?php if ($sex === 'female') echo 'checked'; ?>>
                                        <label class="form-check-label" for="female">Female</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="passport" class="mb-2">Passport</label><br>
                                <input class="form-control" type="file" name="image_name" id="passport" accept="image/*">
                                <?php if ($image_name): ?>
                                    <small class="text-success">Uploaded file: <?php echo htmlspecialchars($image_name); ?></small>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Address (optional)</label>
                        <textarea name="address" class="form-control"><?php echo htmlspecialchars($address); ?></textarea>
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
