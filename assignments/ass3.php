<?php

// ==================================================
// QUESTION 1
// ==================================================

echo "<h3>QUESTION 1</h3>";

// 1. Declare array
$numbers = array(5, -7, 12, 10, -7, 11, -6, 12, 1, -7, 2, 9);


// 2. Print all elements
echo "All elements: ";

foreach ($numbers as $number) {
    echo $number . " ";
}

echo "<br>";


// 3. Total of all elements
$total = 0;

foreach ($numbers as $number) {
    $total = $total + $number;
}

echo "Total of all elements: " . $total;
echo "<br>";


// 4. Total of even elements
$evenTotal = 0;

foreach ($numbers as $number) {

    if ($number % 2 == 0) {
        $evenTotal = $evenTotal + $number;
    }

}

echo "Total of even elements: " . $evenTotal;
echo "<br>";


// 5. Total of odd elements
$oddTotal = 0;

foreach ($numbers as $number) {

    if ($number % 2 != 0) {
        $oddTotal = $oddTotal + $number;
    }

}

echo "Total of odd elements: " . $oddTotal;
echo "<br>";


// 6. Minimum
$minimum = $numbers[0];

foreach ($numbers as $number) {

    if ($number < $minimum) {
        $minimum = $number;
    }

}

echo "Minimum element: " . $minimum;
echo "<br>";

echo "Minimum positions: ";

for ($i = 0; $i < count($numbers); $i++) {

    if ($numbers[$i] == $minimum) {
        echo $i . " ";
    }

}

echo "<br>";


// 7. Maximum
$maximum = $numbers[0];

foreach ($numbers as $number) {

    if ($number > $maximum) {
        $maximum = $number;
    }

}

echo "Maximum element: " . $maximum;
echo "<br>";

echo "Maximum positions: ";

for ($i = 0; $i < count($numbers); $i++) {

    if ($numbers[$i] == $maximum) {
        echo $i . " ";
    }

}

echo "<br><br>";




// ==================================================
// QUESTION 2
// ==================================================

echo "<h3>QUESTION 2</h3>";

$colors = array(

    "Light" => array(
        "Red" => "Light Red",
        "Green" => "Light Green",
        "Blue" => "Light Blue"
    ),

    "Normal" => array(
        "Red" => "Normal Red",
        "Green" => "Normal Green",
        "Blue" => "Normal Blue"
    ),

    "Dark" => array(
        "Red" => "Dark Red",
        "Green" => "Dark Green",
        "Blue" => "Dark Blue"
    )

);


// Table start
echo "<table border='1' cellpadding='10' cellspacing='0'>";


// Column titles
echo "<tr>";

echo "<th style='background-color:lightgray;'></th>";
echo "<th style='background-color:lightgray;'>Red</th>";
echo "<th style='background-color:lightgray;'>Green</th>";
echo "<th style='background-color:lightgray;'>Blue</th>";

echo "</tr>";


// Print rows
foreach ($colors as $rowName => $row) {

    echo "<tr>";

    // Left key
    echo "<th style='background-color:lightgray;'>";
    echo $rowName;
    echo "</th>";

    foreach ($row as $value) {

        echo "<td>";
        echo $value;
        echo "</td>";

    }

    echo "</tr>";

}

echo "</table>";

echo "<br><br>";




// ==================================================
// QUESTION 3
// ==================================================

echo "<h3>QUESTION 3</h3>";

$array = array(

    array(2, -6, 8),

    array(-6, 1, 6),

    array(7, 8, -6)

);


// Print array as table
echo "<table border='1' cellpadding='10' cellspacing='0'>";


// Column titles
echo "<tr>";

echo "<th style='background-color:lightgray;'></th>";
echo "<th style='background-color:lightgray;'>Column 1</th>";
echo "<th style='background-color:lightgray;'>Column 2</th>";
echo "<th style='background-color:lightgray;'>Column 3</th>";

echo "</tr>";


for ($i = 0; $i < 3; $i++) {

    echo "<tr>";

    // Row title
    echo "<th style='background-color:lightgray;'>";
    echo "Row " . ($i + 1);
    echo "</th>";

    for ($j = 0; $j < 3; $j++) {

        echo "<td>";
        echo $array[$i][$j];
        echo "</td>";

    }

    echo "</tr>";

}

echo "</table>";

echo "<br>";


// 3. Total odd
$oddTotal = 0;

for ($i = 0; $i < 3; $i++) {

    for ($j = 0; $j < 3; $j++) {

        if ($array[$i][$j] % 2 != 0) {

            $oddTotal = $oddTotal + $array[$i][$j];

        }

    }

}

echo "Total odd elements: " . $oddTotal;
echo "<br>";


// 4. Total even
$evenTotal = 0;

for ($i = 0; $i < 3; $i++) {

    for ($j = 0; $j < 3; $j++) {

        if ($array[$i][$j] % 2 == 0) {

            $evenTotal = $evenTotal + $array[$i][$j];

        }

    }

}

echo "Total even elements: " . $evenTotal;
echo "<br>";


// 5. Row totals
for ($i = 0; $i < 3; $i++) {

    $rowTotal = 0;

    for ($j = 0; $j < 3; $j++) {

        $rowTotal = $rowTotal + $array[$i][$j];

    }

    echo "Total Row " . ($i + 1) . ": " . $rowTotal;
    echo "<br>";

}


// 6. Column totals
for ($j = 0; $j < 3; $j++) {

    $columnTotal = 0;

    for ($i = 0; $i < 3; $i++) {

        $columnTotal = $columnTotal + $array[$i][$j];

    }

    echo "Total Column " . ($j + 1) . ": " . $columnTotal;
    echo "<br>";

}


// 7. Diagonals
$diagonal1 = 0;
$diagonal2 = 0;

for ($i = 0; $i < 3; $i++) {

    $diagonal1 = $diagonal1 + $array[$i][$i];

    $diagonal2 = $diagonal2 + $array[$i][2 - $i];

}

echo "First diagonal total: " . $diagonal1;
echo "<br>";

echo "Second diagonal total: " . $diagonal2;
echo "<br>";


// 8. Total all elements
$total = 0;

for ($i = 0; $i < 3; $i++) {

    for ($j = 0; $j < 3; $j++) {

        $total = $total + $array[$i][$j];

    }

}

echo "Total all elements: " . $total;
echo "<br>";


// 9. Minimum
$minimum = $array[0][0];

for ($i = 0; $i < 3; $i++) {

    for ($j = 0; $j < 3; $j++) {

        if ($array[$i][$j] < $minimum) {

            $minimum = $array[$i][$j];

        }

    }

}

echo "Minimum element: " . $minimum;
echo "<br>";

echo "Minimum positions: ";

for ($i = 0; $i < 3; $i++) {

    for ($j = 0; $j < 3; $j++) {

        if ($array[$i][$j] == $minimum) {

            echo "[" . $i . "," . $j . "] ";

        }

    }

}

echo "<br>";


// 10. Maximum
$maximum = $array[0][0];

for ($i = 0; $i < 3; $i++) {

    for ($j = 0; $j < 3; $j++) {

        if ($array[$i][$j] > $maximum) {

            $maximum = $array[$i][$j];

        }

    }

}

echo "Maximum element: " . $maximum;
echo "<br>";

echo "Maximum positions: ";

for ($i = 0; $i < 3; $i++) {

    for ($j = 0; $j < 3; $j++) {

        if ($array[$i][$j] == $maximum) {

            echo "[" . $i . "," . $j . "] ";

        }

    }

}

echo "<br><br>";




// ==================================================
// QUESTION 4
// ==================================================

echo "<h3>QUESTION 4</h3>";

$students = array(

    array(
        "Code" => "CA221",
        "Name" => "Mohamed Ahmed Ali",
        "Phone" => "0648440403",
        "Address" => "Laba Dhagax, Wardhiigley"
    ),

    array(
        "Code" => "CA223",
        "Name" => "Ahmed Abdi Jama",
        "Phone" => "0647223201",
        "Address" => "Taleex, Hodan"
    ),

    array(
        "Code" => "CA221",
        "Name" => "Amina Nur Adan",
        "Phone" => "0646990276",
        "Address" => "Macmacaanka, Dharkeynley"
    )

);


// Start table
echo "<table border='1' cellpadding='10' cellspacing='0'>";


// Titles
echo "<tr>";

echo "<th style='background-color:lightgray;'>Code</th>";
echo "<th style='background-color:lightgray;'>Name</th>";
echo "<th style='background-color:lightgray;'>Phone</th>";
echo "<th style='background-color:lightgray;'>Address</th>";

echo "</tr>";


// Students
foreach ($students as $student) {

    echo "<tr>";

    // Left column gray
    echo "<th style='background-color:lightgray;'>";
    echo $student["Code"];
    echo "</th>";

    echo "<td>";
    echo $student["Name"];
    echo "</td>";

    echo "<td>";
    echo $student["Phone"];
    echo "</td>";

    echo "<td>";
    echo $student["Address"];
    echo "</td>";

    echo "</tr>";

}

echo "</table>";

echo "<br><br>";




// ==================================================
// QUESTION 5
// ==================================================

echo "<h3>QUESTION 5</h3>";

$transcript = array(

    "Semester 1" => array(

        array(
            "Course" => "subject1",
            "CW1" => 9,
            "MidTerm" => 26,
            "CW2" => 10,
            "Final" => 40,
            "Total" => 85,
            "Status" => "Pass"
        ),

        array(
            "Course" => "subject2",
            "CW1" => 9,
            "MidTerm" => 26,
            "CW2" => 10,
            "Final" => 40,
            "Total" => 85,
            "Status" => "Pass"
        ),

        array(
            "Course" => "subject3",
            "CW1" => 9,
            "MidTerm" => 26,
            "CW2" => 10,
            "Final" => 40,
            "Total" => 85,
            "Status" => "Pass"
        )

    ),


    "Semester 2" => array(

        array(
            "Course" => "subject1",
            "CW1" => 9,
            "MidTerm" => 26,
            "CW2" => 10,
            "Final" => 0,
            "Total" => 45,
            "Status" => "Fail"
        ),

        array(
            "Course" => "subject2",
            "CW1" => 9,
            "MidTerm" => 26,
            "CW2" => 10,
            "Final" => 40,
            "Total" => 85,
            "Status" => "Pass"
        ),

        array(
            "Course" => "subject3",
            "CW1" => 9,
            "MidTerm" => 26,
            "CW2" => 10,
            "Final" => 40,
            "Total" => 85,
            "Status" => "Pass"
        )

    )

);


// Start table
echo "<table border='1' cellpadding='10' cellspacing='0'>";


// Titles
echo "<tr>";

echo "<th style='background-color:lightgray;'>Semester</th>";
echo "<th style='background-color:lightgray;'>Course</th>";
echo "<th style='background-color:lightgray;'>CW1</th>";
echo "<th style='background-color:lightgray;'>MidTerm</th>";
echo "<th style='background-color:lightgray;'>CW2</th>";
echo "<th style='background-color:lightgray;'>Final</th>";
echo "<th style='background-color:lightgray;'>Total</th>";
echo "<th style='background-color:lightgray;'>Status</th>";

echo "</tr>";


// Print transcript
foreach ($transcript as $semester => $courses) {

    foreach ($courses as $course) {

        echo "<tr>";

        // Left column gray
        echo "<th style='background-color:lightgray;'>";
        echo $semester;
        echo "</th>";

        echo "<td>";
        echo $course["Course"];
        echo "</td>";

        echo "<td>";
        echo $course["CW1"];
        echo "</td>";

        echo "<td>";
        echo $course["MidTerm"];
        echo "</td>";

        echo "<td>";
        echo $course["CW2"];
        echo "</td>";

        echo "<td>";
        echo $course["Final"];
        echo "</td>";

        echo "<td>";
        echo $course["Total"];
        echo "</td>";

        echo "<td>";
        echo $course["Status"];
        echo "</td>";

        echo "</tr>";

    }

}

echo "</table>";

?>