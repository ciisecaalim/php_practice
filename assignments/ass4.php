
<?php
$error = "";
$success = false;

if (isset($_POST['register'])) {

    $name = trim($_POST['name'] ?? '');
    $pob = trim($_POST['pob'] ?? '');
    $dob = $_POST['dob'] ?? '';
    $address = trim($_POST['address'] ?? '');
    $gender = $_POST['gender'] ?? '';
    $telephone = trim($_POST['telephone'] ?? '');
    $email = trim($_POST['email'] ?? '');

    $parent_name = trim($_POST['parent_name'] ?? '');
    $parent_telephone = trim($_POST['parent_telephone'] ?? '');
    $relationship = $_POST['relationship'] ?? '';

    $student_id = trim($_POST['student_id'] ?? '');
    $faculty = trim($_POST['faculty'] ?? '');
    $department = trim($_POST['department'] ?? '');
    $class = trim($_POST['class'] ?? '');
    $registration_date = $_POST['registration_date'] ?? '';

    // Required Fields
    if (
        $name == "" || $pob == "" || $dob == "" ||
        $address == "" || $gender == "" ||
        $telephone == "" || $email == "" ||
        $parent_name == "" || $parent_telephone == "" ||
        $relationship == "" || $student_id == "" ||
        $faculty == "" || $department == "" ||
        $class == "" || $registration_date == ""
    ) {
        $error = "All fields are required.";
    }

    // Name Validation
    if ($error == "" && !preg_match("/^[a-zA-Z ]+$/", $name)) {
        $error = "Name must contain only letters and spaces.";
    }

    // Parent Name Validation
    if ($error == "" && !preg_match("/^[a-zA-Z ]+$/", $parent_name)) {
        $error = "Parent name must contain only letters and spaces.";
    }

    // Email Validation
    if ($error == "" && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email address.";
    }

    // Image Validation
    if ($error == "" && (
        !isset($_FILES['image']) ||
        $_FILES['image']['error'] != 0
    )) {
        $error = "Please upload an image.";
    }

    if ($error == "") {

        $image_name = $_FILES['image']['name'];
        $image_tmp = $_FILES['image']['tmp_name'];

        $extension = strtolower(
            pathinfo($image_name, PATHINFO_EXTENSION)
        );

        if (
            $extension != "jpg" &&
            $extension != "jpeg" &&
            $extension != "png" &&
            $extension != "gif"
        ) {
            $error = "Only JPG, JPEG, PNG and GIF images are allowed.";
        }

        if ($error == "" && getimagesize($image_tmp) == false) {
            $error = "Invalid image file.";
        }

        if ($error == "") {

            $image_path = "uploads/" . uniqid() . "." . $extension;

            if (move_uploaded_file($image_tmp, $image_path)) {
                $success = true;
            } else {
                $error = "Image upload failed. Check uploads folder.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Student Registration</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container my-5">

    <!-- REGISTRATION FORM -->

    <div class="card shadow mb-4">

        <div class="card-header bg-primary text-white text-center py-3">
            <h3>Student Registration Form</h3>
        </div>

        <div class="card-body p-4">

            <?php if ($error != "") { ?>
                <div class="alert alert-danger">
                    <?php echo htmlspecialchars($error); ?>
                </div>
            <?php } ?>

            <form method="POST" enctype="multipart/form-data">

                <!-- PERSONAL INFORMATION -->

                <h5 class="text-primary">Personal Information</h5>
                <hr>

                <div class="row g-3">

                    <div class="col-md-6">
                        <label class="form-label">Full Name</label>
                        <input type="text" name="name" class="form-control"
                            value="<?php echo $success ? '' : htmlspecialchars($_POST['name'] ?? ''); ?>"
                            pattern="[A-Za-z ]+" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Place of Birth</label>
                        <input type="text" name="pob" class="form-control"
                            value="<?php echo $success ? '' : htmlspecialchars($_POST['pob'] ?? ''); ?>"
                            required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Date of Birth</label>
                        <input type="date" name="dob" class="form-control"
                            value="<?php echo $success ? '' : htmlspecialchars($_POST['dob'] ?? ''); ?>"
                            required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Address</label>
                        <input type="text" name="address" class="form-control"
                            value="<?php echo $success ? '' : htmlspecialchars($_POST['address'] ?? ''); ?>"
                            required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Gender</label>
                        <select name="gender" class="form-select" required>

                            <option value="">Select Gender</option>

                            <option value="Male"
                                <?php
                                if ($success == false && ($_POST['gender'] ?? '') == "Male") {
                                    echo "selected";
                                }
                                ?>>
                                Male
                            </option>

                            <option value="Female"
                                <?php
                                if ($success == false && ($_POST['gender'] ?? '') == "Female") {
                                    echo "selected";
                                }
                                ?>>
                                Female
                            </option>

                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Telephone</label>
                        <input type="tel" name="telephone" class="form-control"
                            value="<?php echo $success ? '' : htmlspecialchars($_POST['telephone'] ?? ''); ?>"
                            required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control"
                            value="<?php echo $success ? '' : htmlspecialchars($_POST['email'] ?? ''); ?>"
                            required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Image</label>
                        <input type="file" name="image" class="form-control"
                            accept=".jpg,.jpeg,.png,.gif" required>
                    </div>

                </div>

                <!-- PARENT INFORMATION -->

                <h5 class="text-primary mt-4">Parent Information</h5>
                <hr>

                <div class="row g-3">

                    <div class="col-md-4">
                        <label class="form-label">Parent Name</label>
                        <input type="text" name="parent_name" class="form-control"
                            value="<?php echo $success ? '' : htmlspecialchars($_POST['parent_name'] ?? ''); ?>"
                            pattern="[A-Za-z ]+" required>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Parent Telephone</label>
                        <input type="tel" name="parent_telephone" class="form-control"
                            value="<?php echo $success ? '' : htmlspecialchars($_POST['parent_telephone'] ?? ''); ?>"
                            required>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Relationship</label>
                        <select name="relationship" class="form-select" required>

                            <option value="">Select Relationship</option>

                            <option value="Father"
                                <?php
                                if ($success == false && ($_POST['relationship'] ?? '') == "Father") {
                                    echo "selected";
                                }
                                ?>>
                                Father
                            </option>

                            <option value="Mother"
                                <?php
                                if ($success == false && ($_POST['relationship'] ?? '') == "Mother") {
                                    echo "selected";
                                }
                                ?>>
                                Mother
                            </option>

                            <option value="Guardian"
                                <?php
                                if ($success == false && ($_POST['relationship'] ?? '') == "Guardian") {
                                    echo "selected";
                                }
                                ?>>
                                Guardian
                            </option>

                        </select>
                    </div>

                </div>

                <!-- ACADEMIC INFORMATION -->

                <h5 class="text-primary mt-4">Academic Information</h5>
                <hr>

                <div class="row g-3">

                    <div class="col-md-6">
                        <label class="form-label">Student ID</label>
                        <input type="text" name="student_id" class="form-control"
                            value="<?php echo $success ? '' : htmlspecialchars($_POST['student_id'] ?? ''); ?>"
                            required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Faculty</label>
                        <input type="text" name="faculty" class="form-control"
                            value="<?php echo $success ? '' : htmlspecialchars($_POST['faculty'] ?? ''); ?>"
                            required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Department</label>
                        <input type="text" name="department" class="form-control"
                            value="<?php echo $success ? '' : htmlspecialchars($_POST['department'] ?? ''); ?>"
                            required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Class</label>
                        <input type="text" name="class" class="form-control"
                            value="<?php echo $success ? '' : htmlspecialchars($_POST['class'] ?? ''); ?>"
                            required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Registration Date</label>
                        <input type="date" name="registration_date" class="form-control"
                            value="<?php echo $success ? '' : htmlspecialchars($_POST['registration_date'] ?? ''); ?>"
                            required>
                    </div>

                </div>

                <div class="text-center mt-4">
                    <button type="submit" name="register"
                            class="btn btn-primary px-5">
                        Register Student
                    </button>
                </div>

            </form>
        </div>
    </div>

    <!-- RESULT BELOW THE FORM -->

    <?php if ($success == true) { ?>

        <div class="card shadow mt-4">

            <div class="card-header bg-success text-white text-center py-3">
                <h3>Registration Successful</h3>
            </div>

            <div class="card-body p-4">

                <div class="text-center mb-4">

                    <img src="<?php echo htmlspecialchars($image_path); ?>"
                         width="150" height="150"
                         class="rounded border"
                         style="object-fit:cover">

                    <h4 class="mt-3">
                        <?php echo htmlspecialchars($name); ?>
                    </h4>

                </div>

                <!-- PERSONAL INFORMATION TABLE -->

                <h5 class="text-primary">Personal Information</h5>

                <table class="table table-bordered table-striped">
                    <tr>
                        <th>Name</th>
                        <td><?php echo htmlspecialchars($name); ?></td>
                    </tr>
                    <tr>
                        <th>Place of Birth</th>
                        <td><?php echo htmlspecialchars($pob); ?></td>
                    </tr>
                    <tr>
                        <th>Date of Birth</th>
                        <td><?php echo htmlspecialchars($dob); ?></td>
                    </tr>
                    <tr>
                        <th>Address</th>
                        <td><?php echo htmlspecialchars($address); ?></td>
                    </tr>
                    <tr>
                        <th>Gender</th>
                        <td><?php echo htmlspecialchars($gender); ?></td>
                    </tr>
                    <tr>
                        <th>Telephone</th>
                        <td><?php echo htmlspecialchars($telephone); ?></td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td><?php echo htmlspecialchars($email); ?></td>
                    </tr>
                    <tr>
                        <th>Image</th>
                        <td><?php echo htmlspecialchars($image_name); ?></td>
                    </tr>
                </table>

                <!-- PARENT INFORMATION TABLE -->

                <h5 class="text-primary mt-4">Parent Information</h5>

                <table class="table table-bordered table-striped">
                    <tr>
                        <th>Parent Name</th>
                        <td><?php echo htmlspecialchars($parent_name); ?></td>
                    </tr>
                    <tr>
                        <th>Telephone</th>
                        <td><?php echo htmlspecialchars($parent_telephone); ?></td>
                    </tr>
                    <tr>
                        <th>Relationship</th>
                        <td><?php echo htmlspecialchars($relationship); ?></td>
                    </tr>
                </table>

                <!-- ACADEMIC INFORMATION TABLE -->

                <h5 class="text-primary mt-4">Academic Information</h5>

                <table class="table table-bordered table-striped">
                    <tr>
                        <th>Student ID</th>
                        <td><?php echo htmlspecialchars($student_id); ?></td>
                    </tr>
                    <tr>
                        <th>Faculty</th>
                        <td><?php echo htmlspecialchars($faculty); ?></td>
                    </tr>
                    <tr>
                        <th>Department</th>
                        <td><?php echo htmlspecialchars($department); ?></td>
                    </tr>
                    <tr>
                        <th>Class</th>
                        <td><?php echo htmlspecialchars($class); ?></td>
                    </tr>
                    <tr>
                        <th>Registration Date</th>
                        <td><?php echo htmlspecialchars($registration_date); ?></td>
                    </tr>
                </table>

            </div>
        </div>

    <?php } ?>

</div>

</body>
</html>
