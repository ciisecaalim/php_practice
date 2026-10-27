
<?php
session_start();

// Check whether registration data exists
if (
    !isset($_SESSION['student_data']) ||
    !is_array($_SESSION['student_data'])
) {
    header('Location: index.php');
    exit;
}

$student = $_SESSION['student_data'];

// Escape data before displaying
function h($value) {
    return htmlspecialchars(
        (string)$value,
        ENT_QUOTES,
        'UTF-8'
    );
}

// Information displayed in result tables
$sections = [
    'Personal Information' => [
        'name' => 'Full Name',
        'pob' => 'Place of Birth',
        'dob' => 'Date of Birth',
        'address' => 'Address',
        'gender' => 'Gender',
        'telephone' => 'Telephone',
        'email' => 'Email',
        'image' => 'Student Image'
    ],

    'Parent Information' => [
        'parent_name' => 'Parent Name',
        'parent_telephone' => 'Parent Telephone',
        'relationship' => 'Relationship'
    ],

    'Academic Information' => [
        'student_id' => 'Student ID',
        'faculty' => 'Faculty',
        'department' => 'Department',
        'class' => 'Class',
        'registration_date' => 'Registration Date'
    ]
];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1">

    <title>Registration Result</title>

    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
    >

    <style>
        body {
            background: #f3f6fb;
        }

        .main-card {
            max-width: 960px;
            margin: auto;
            border: 0;
            border-radius: 14px;
            overflow: hidden;
        }

        .header {
            background: #198754;
            color: white;
            text-align: center;
            padding: 28px;
        }

        .student-image {
            width: 140px;
            height: 140px;
            border-radius: 12px;
            object-fit: cover;
            border: 3px solid #eee;
        }

        .section-title {
            color: #0d6efd;
            font-size: 20px;
            margin-top: 28px;
            margin-bottom: 14px;
        }

        .table th {
            width: 35%;
            background: #f8f9fa !important;
        }

        .table td,
        .table th {
            padding: 12px;
            vertical-align: middle;
        }

        @media print {
            .actions {
                display: none !important;
            }

            body {
                background: white;
            }

            .main-card {
                box-shadow: none !important;
            }
        }
    </style>
</head>

<body>

<div class="container py-5">

    <div class="card main-card shadow">

        <!-- Success Header -->

        <div class="header">
            <h2>Registration Successful!</h2>

            <p class="mb-0">
                Student Registration Details
            </p>
        </div>

        <div class="card-body p-4">

            <!-- Student Profile -->

            <div class="text-center mb-4">

                <img
                    class="student-image"
                    src="<?= h($student['image'] ?? '') ?>"
                    alt="Student Image"
                >

                <h3 class="mt-3">
                    <?= h($student['name'] ?? '') ?>
                </h3>

                <p class="text-muted">
                    Student ID:
                    <?= h($student['student_id'] ?? '') ?>
                </p>

            </div>

            <!-- Registration Tables -->

            <?php foreach ($sections as $title => $rows): ?>

                <h4 class="section-title">
                    <?= h($title) ?>
                </h4>

                <div class="table-responsive">

                    <table
                        class="table table-bordered table-striped"
                    >

                        <tbody>

                            <?php foreach ($rows as $key => $label): ?>

                                <tr>

                                    <th scope="row">
                                        <?= h($label) ?>
                                    </th>

                                    <td>

                                        <?php if ($key === 'image'): ?>

                                            <img
                                                src="<?= h($student['image'] ?? '') ?>"
                                                alt="Student"
                                                width="90"
                                                height="90"
                                                style="object-fit:cover;border-radius:8px"
                                            >

                                        <?php else: ?>

                                            <?= h($student[$key] ?? '') ?>

                                        <?php endif; ?>

                                    </td>

                                </tr>

                            <?php endforeach; ?>

                        </tbody>

                    </table>

                </div>

            <?php endforeach; ?>

            <!-- Action Buttons -->

            <div class="actions text-center mt-4 d-flex gap-2 justify-content-center flex-wrap">

                <a
                    href="index.php"
                    class="btn btn-primary"
                >
                    Register Another Student
                </a>

                <button
                    type="button"
                    onclick="window.print()"
                    class="btn btn-outline-secondary"
                >
                    Print Details
                </button>

            </div>

        </div>

    </div>

</div>

</body>
</html>
