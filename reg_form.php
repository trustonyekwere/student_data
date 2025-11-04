<?php

include('connect.php');

$email = $firstname = $lastname = $dateofbirth = $sex = $maritalstatus = $address = $image_name = '';
$errors = array(
    'email' => '', 'firstname' => '', 'lastname' => '', 'dateofbirth' => '',
    'sex' => '', 'maritalstatus' => '', 'address' => '', 'image_name' => ''
);

if (isset($_POST['submit'])) {

    // check email
    if (empty($_POST['email'])) {
        $errors['email'] = "An email is required";
    } else {
        $email = $_POST['email'];
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "Email must be a valid email address";
        }
    }

    // check first name
    if (empty($_POST['firstname'])) {
        $errors['firstname'] = "A name is required";
    } else {
        $firstname = $_POST['firstname'];
        if (!preg_match('/^[a-zA-Z\s.]+$/', $firstname)) {
            $errors['firstname'] = "First name must be letters and spaces only";
        }
    }

    // check last name
    if (empty($_POST['lastname'])) {
        $errors['lastname'] = "A name is required";
    } else {
        $lastname = $_POST['lastname'];
        if (!preg_match('/^[a-zA-Z\s.]+$/', $lastname)) {
            $errors['lastname'] = "Last name must be letters and spaces only";
        }
    }

    // check date of birth
    if (empty($_POST['dateofbirth'])) {
        $errors['dateofbirth'] = "Date of birth is required";
    } else {
        $dateofbirth = $_POST['dateofbirth'];
        // optional: validate format YYYY-MM-DD
        if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $dateofbirth)) {
            $errors['dateofbirth'] = "Invalid date format";
        }
    }

    // check marital status
    if (empty($_POST['marital_status'])) {
        $errors['maritalstatus'] = "Marital status is required";
    } else {
        $maritalstatus = $_POST['marital_status'];
    }

    // check sex
    if (empty($_POST['sex'])) {
        $errors['sex'] = "Select a sex";
    } else {
        $sex = $_POST['sex'];
        if (!in_array($sex, ['male', 'female'])) {
            $errors['sex'] = "Invalid selection for sex";
        }
    }

    // handle file upload (passport)
    if (isset($_FILES['image_name']) && $_FILES['image_name']['error'] !== UPLOAD_ERR_NO_FILE) {
        $file = $_FILES['image_name'];

        if ($file['error'] !== UPLOAD_ERR_OK) {
            $errors['image_name'] = 'File upload error (code: ' . $file['error'] . ')';
        } else {
            // basic checks
            $allowed_mime = ['image/jpeg', 'image/png', 'image/gif'];
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $mime = finfo_file($finfo, $file['tmp_name']);
            finfo_close($finfo);

            if (!in_array($mime, $allowed_mime)) {
                $errors['image_name'] = 'Only JPG, PNG or GIF images are allowed';
            }

            $maxBytes = 2 * 1024 * 1024; // 2 MB
            if ($file['size'] > $maxBytes) {
                $errors['image_name'] = 'File is too large. Max 2MB allowed';
            }

            // move file if no file-related errors
            if ($errors['image_name'] === '') {
                $uploadDir = __DIR__ . '/uploads/';
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0755, true);
                }

                $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
                $safeName = uniqid('passport_', true) . '.' . $ext;
                $destination = $uploadDir . $safeName;

                if (!move_uploaded_file($file['tmp_name'], $destination)) {
                    $errors['image_name'] = 'Failed to move uploaded file';
                } else {
                    // store relative path for DB
                    $image_name = 'uploads/' . $safeName;
                }
            }
        }
    } else {
        // no file uploaded
        $errors['image_name'] = 'Passport image is required';
    }

    // if any errors, do not insert
    if (array_filter($errors)) {
        // errors exist — they will be shown in the form below
    } else {
        // sanitize and insert
        $email = mysqli_real_escape_string($connect, $email);
        $firstname = mysqli_real_escape_string($connect, $firstname);
        $lastname = mysqli_real_escape_string($connect, $lastname);
        $dateofbirth = mysqli_real_escape_string($connect, $dateofbirth);
        $sex = mysqli_real_escape_string($connect, $sex);
        $maritalstatus = mysqli_real_escape_string($connect, $maritalstatus);
        $address = mysqli_real_escape_string($connect, $address);
        $image_name = mysqli_real_escape_string($connect, $image_name);

        // create sql
        $sql = "INSERT INTO details (email, first_name, last_name, date_of_birth, sex, marital_status, address, image_name)
                VALUES ('$email', '$firstname', '$lastname', '$dateofbirth', '$sex', '$maritalstatus', '$address', '$image_name')";

        // save to db and check
        if (mysqli_query($connect, $sql)) {
            header('Location: success.php');
            exit;
        } else {
            $errors['general'] = 'Query error: ' . mysqli_error($connect);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<?php include('templates/header.php'); ?>

<main class="container">
    <section class="justify-content-center mt-5 pt-5">
        <div class="card p-5 my-5 border-0 shadow-sm">
            <!-- submit to same page so the PHP above runs -->
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data">
                <div class="mb-5 text-center">
                    <h1 class="blue">Registration Form</h1>
                </div>

                <?php if (!empty($errors['general'])): ?>
                    <div class="alert alert-danger"><?php echo htmlspecialchars($errors['general']); ?></div>
                <?php endif; ?>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">First Name</label>
                            <input type="text" name="firstname" class="form-control" value="<?php echo htmlspecialchars($firstname); ?>">
                            <div class="text-danger"><?php echo $errors['firstname']; ?></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Last Name</label>
                            <input type="text" name="lastname" class="form-control" value="<?php echo htmlspecialchars($lastname); ?>">
                            <div class="text-danger"><?php echo $errors['lastname']; ?></div>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="emailInput" class="form-label">Email address</label>
                    <input id="emailInput" type="email" value="<?php echo htmlspecialchars($email); ?>" class="form-control" name="email" aria-describedby="emailHelp">
                    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                    <div class="text-danger"><?php echo $errors['email']; ?></div>
                </div>

                <div class="row pt-3">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label name="dateofbirth" class="form-label">Date of Birth</label>
                            <!-- added name so PHP can read it -->
                            <input type="date" name="dateofbirth" class="form-control" value="<?php echo htmlspecialchars($dateofbirth); ?>">
                            <div class="text-danger"><?php echo $errors['dateofbirth']; ?></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="maritalStatus" class="form-label">Marital Status</label>
                            <!-- keep the visible select but match the php key via name -->
                            <select class="form-select" id="maritalStatus" name="marital_status" required>
                                <option value="" disabled <?php if ($maritalstatus === '') echo 'selected'; ?>>-- Select your status --</option>
                                <option value="single" <?php if ($maritalstatus === 'single') echo 'selected'; ?>>Single</option>
                                <option value="married" <?php if ($maritalstatus === 'married') echo 'selected'; ?>>Married</option>
                                <option value="divorced" <?php if ($maritalstatus === 'divorced') echo 'selected'; ?>>Divorced</option>
                                <option value="widowed" <?php if ($maritalstatus === 'widowed') echo 'selected'; ?>>Widowed</option>
                            </select>
                            <div class="text-danger"><?php echo $errors['maritalstatus']; ?></div>
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
                            <div class="text-danger"><?php echo $errors['sex']; ?></div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="passport" class="mb-2">Passport</label><br>
                            <input class="form-control" type="file" name="image_name" id="passport" accept="image/*">
                            <div class="text-danger"><?php echo $errors['image_name']; ?></div>
                            <?php if ($image_name): ?>
                                <small class="text-success">Uploaded file: <?php echo htmlspecialchars($image_name); ?></small>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <!-- optional address field since your PHP expects $address -->
                <div class="mb-3">
                    <label class="form-label">Address (optional)</label>
                    <textarea name="address" class="form-control"><?php echo htmlspecialchars($address); ?></textarea>
                    <div class="text-danger"><?php echo $errors['address']; ?></div>
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
