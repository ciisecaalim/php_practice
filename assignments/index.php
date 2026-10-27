
<?php
session_start();

$fields = [
    'Personal Information' => [
        'name' => ['Full Name', 'text'],
        'pob' => ['Place of Birth', 'text'],
        'dob' => ['Date of Birth', 'date'],
        'address' => ['Address', 'text'],
        'gender' => ['Gender', 'select', ['Male', 'Female']],
        'telephone' => ['Telephone', 'tel'],
        'email' => ['Email', 'email'],
        'image' => ['Student Image', 'file']
    ],
    'Parent Information' => [
        'parent_name' => ['Parent Name', 'text'],
        'parent_telephone' => ['Parent Telephone', 'tel'],
        'relationship' => ['Relationship', 'select', ['Father', 'Mother', 'Guardian']]
    ],
    'Academic Information' => [
        'student_id' => ['Student ID', 'text'],
        'faculty' => ['Faculty', 'text'],
        'department' => ['Department', 'text'],
        'class' => ['Class', 'text'],
        'registration_date' => ['Registration Date', 'date']
    ]
];

$errors = [];

function h($value) {
    return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [];

    // Required fields
    foreach ($fields as $section) {
        foreach ($section as $key => $config) {
            if ($key === 'image') continue;

            $data[$key] = trim((string)($_POST[$key] ?? ''));

            if ($data[$key] === '') {
                $errors[$key] = $config[0] . ' is required.';
            }
        }
    }

    // Name validation
    foreach (['name', 'parent_name'] as $key) {
        if (
            !isset($errors[$key]) &&
            !preg_match('/^[\p{L} ]+$/u', $data[$key])
        ) {
            $errors[$key] = 'Use letters and spaces only.';
        }
    }

    // Email validation
    if (
        !isset($errors['email']) &&
        !filter_var($data['email'], FILTER_VALIDATE_EMAIL)
    ) {
        $errors['email'] = 'Enter a valid email address.';
    }

    // Select validation
    foreach (
        [
            'gender' => ['Male', 'Female'],
            'relationship' => ['Father', 'Mother', 'Guardian']
        ] as $key => $choices
    ) {
        if (
            !isset($errors[$key]) &&
            !in_array($data[$key], $choices, true)
        ) {
            $errors[$key] = 'Select a valid option.';
        }
    }

    // Date validation
    foreach (['dob', 'registration_date'] as $key) {
        if (!isset($errors[$key])) {
            $date = DateTimeImmutable::createFromFormat(
                '!Y-m-d',
                $data[$key]
            );

            if (
                !$date ||
                $date->format('Y-m-d') !== $data[$key]
            ) {
                $errors[$key] = 'Enter a valid date.';
            }
        }
    }

    // Image validation
    $image = $_FILES['image'] ?? null;

    $allowed = [
        'image/jpeg' => 'jpg',
        'image/png' => 'png',
        'image/gif' => 'gif'
    ];

    $extension = '';

    if (!$image || $image['error'] === UPLOAD_ERR_NO_FILE) {
        $errors['image'] = 'Student image is required.';

    } elseif ($image['error'] !== UPLOAD_ERR_OK) {
        $errors['image'] =
            'Image upload failed. Check PHP upload settings.';

    } elseif ($image['size'] > 5 * 1024 * 1024) {
        $errors['image'] = 'Maximum file size is 5 MB.';

    } else {
        $mime = (new finfo(FILEINFO_MIME_TYPE))
            ->file($image['tmp_name']);

        if (
            !isset($allowed[$mime]) ||
            @getimagesize($image['tmp_name']) === false
        ) {
            $errors['image'] =
                'Only valid JPG, PNG or GIF images are allowed.';
        } else {
            $extension = $allowed[$mime];
        }
    }

    // Save image and redirect
    if (!$errors) {
        $folder = __DIR__ . '/uploads';

        if (!is_dir($folder) && !mkdir($folder, 0755, true)) {
            $errors['image'] = 'Cannot create uploads folder.';

        } else {
            $filename = bin2hex(random_bytes(16))
                . '.' . $extension;

            if (
                move_uploaded_file(
                    $image['tmp_name'],
                    $folder . '/' . $filename
                )
            ) {
                $data['image'] = 'uploads/' . $filename;

                $_SESSION['student_data'] = $data;

                session_write_close();

                header('Location: result.php', true, 303);
                exit;
            }

            $errors['image'] =
                'Cannot save image. Check folder permissions.';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1">

    <title>Student Registration</title>

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
            background: #0d6efd;
            color: white;
            padding: 26px;
            text-align: center;
        }

        .section-title {
            color: #0d6efd;
            font-size: 19px;
            margin: 25px 0 18px;
            padding-bottom: 10px;
            border-bottom: 1px solid #ddd;
        }

        .form-label {
            font-weight: 600;
        }

        /* Red border for invalid fields */
        .form-control.is-invalid,
        .form-select.is-invalid {
            border: 2px solid #dc3545 !important;
            background: #fff8f8;
        }

        .form-control.is-invalid:focus,
        .form-select.is-invalid:focus {
            box-shadow: 0 0 0 .2rem rgba(220,53,69,.15);
        }

        .invalid-feedback {
            color: #dc3545;
        }
    </style>
</head>

<body>

<div class="container py-5">
    <div class="card main-card shadow">

        <div class="header">
            <h2>Student Registration Form</h2>
            <p class="mb-0">
                Jamhuriya University of Science & Technology
            </p>
        </div>

        <div class="card-body p-4">

            <?php if ($errors): ?>
                <div class="alert alert-danger">
                    Please correct the highlighted fields.
                </div>
            <?php endif; ?>

            <form
                id="registrationForm"
                method="post"
                enctype="multipart/form-data"
                novalidate
            >

                <?php foreach ($fields as $heading => $section): ?>

                    <h3 class="section-title">
                        <?= h($heading) ?>
                    </h3>

                    <div class="row g-3">

                        <?php foreach ($section as $key => $config): ?>

                            <?php
                                $label = $config[0];
                                $type = $config[1];
                                $css = isset($errors[$key])
                                    ? 'is-invalid'
                                    : '';
                            ?>

                            <div class="<?= $heading === 'Parent Information'
                                ? 'col-md-4'
                                : 'col-md-6' ?>">

                                <label
                                    class="form-label"
                                    for="<?= h($key) ?>"
                                >
                                    <?= h($label) ?>
                                    <span class="text-danger">*</span>
                                </label>

                                <?php if ($type === 'select'): ?>

                                    <select
                                        id="<?= h($key) ?>"
                                        name="<?= h($key) ?>"
                                        class="form-select <?= $css ?>"
                                        required
                                    >
                                        <option value="">
                                            Select <?= h($label) ?>
                                        </option>

                                        <?php foreach ($config[2] as $choice): ?>

                                            <option
                                                value="<?= h($choice) ?>"
                                                <?= ($_POST[$key] ?? '') === $choice
                                                    ? 'selected'
                                                    : '' ?>
                                            >
                                                <?= h($choice) ?>
                                            </option>

                                        <?php endforeach; ?>

                                    </select>

                                <?php else: ?>

                                    <input
                                        id="<?= h($key) ?>"
                                        name="<?= h($key) ?>"
                                        type="<?= h($type) ?>"
                                        class="form-control <?= $css ?>"
                                        required
                                        <?= $type === 'file'
                                            ? 'accept=".jpg,.jpeg,.png,.gif"'
                                            : 'value="' . h($_POST[$key] ?? '') . '"' ?>
                                    >

                                <?php endif; ?>

                                <div class="invalid-feedback">
                                    <?= h($errors[$key] ?? '') ?>
                                </div>

                            </div>

                        <?php endforeach; ?>

                    </div>

                <?php endforeach; ?>

                <div class="text-center mt-4">
                    <button
                        class="btn btn-primary px-5 py-2"
                        type="submit"
                    >
                        Register Student
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>

<script>
const form = document.getElementById('registrationForm');

function errorFor(input, message) {
    input.classList.add('is-invalid');

    input.parentElement.querySelector(
        '.invalid-feedback'
    ).textContent = message;
}

function check(input) {
    input.classList.remove('is-invalid');

    input.parentElement.querySelector(
        '.invalid-feedback'
    ).textContent = '';

    const label = input.parentElement
        .querySelector('label')
        .textContent.replace('*', '')
        .trim();

    if (!input.value.trim()) {
        errorFor(input, label + ' is required.');
        return false;
    }

    // Name validation
    if (
        ['name', 'parent_name'].includes(input.name) &&
        !/^[\p{L} ]+$/u.test(input.value.trim())
    ) {
        errorFor(input, 'Use letters and spaces only.');
        return false;
    }

    // Email validation
    if (
        input.name === 'email' &&
        !input.validity.valid
    ) {
        errorFor(input, 'Enter a valid email address.');
        return false;
    }

    // Date validation
    if (
        input.type === 'date' &&
        !input.validity.valid
    ) {
        errorFor(input, 'Enter a valid date.');
        return false;
    }

    // Image validation
    if (input.type === 'file') {
        const file = input.files[0];

        if (
            !file ||
            ![
                'image/jpeg',
                'image/png',
                'image/gif'
            ].includes(file.type)
        ) {
            errorFor(input, 'Select a JPG, PNG or GIF image.');
            return false;
        }

        if (file.size > 5 * 1024 * 1024) {
            errorFor(input, 'Maximum file size is 5 MB.');
            return false;
        }
    }

    return true;
}

// Check all fields on submit
form.addEventListener('submit', function(event) {
    let first = null;

    form.querySelectorAll('input,select').forEach(input => {
        if (!check(input) && !first) {
            first = input;
        }
    });

    if (first) {
        event.preventDefault();
        first.focus();

        first.scrollIntoView({
            block: 'center',
            behavior: 'smooth'
        });
    }
});

// Remove error after correcting the field
form.querySelectorAll('input,select').forEach(input => {
    const eventType =
        ['file', 'date'].includes(input.type) ||
        input.tagName === 'SELECT'
            ? 'change'
            : 'input';

    input.addEventListener(eventType, () => {
        if (input.classList.contains('is-invalid')) {
            check(input);
        }
    });
});

// Focus on first server-side error
const firstServerError = form.querySelector('.is-invalid');

if (firstServerError) {
    firstServerError.focus();
}
</script>

</body>
</html>
