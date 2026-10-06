
<?php
 
// PAGE STYLE
 

echo "<div style='background-color:#f2f6ff; padding:20px; font-family:Arial;'>";

echo "<h2 style='color:#1e3a8a;'>PHP Assignment 1</h2>";

 
// QUESTION 1
// Compare three numbers and find greatest
// and smallest number
 

$a = 20;
$b = 10;
$c = 30;

// Find greatest number
if ($a > $b && $a > $c) {
    $greatest = $a;
} elseif ($b > $a && $b > $c) {
    $greatest = $b;
} else {
    $greatest = $c;
}

// Find smallest number
if ($a < $b && $a < $c) {
    $smallest = $a;
} elseif ($b < $a && $b < $c) {
    $smallest = $b;
} else {
    $smallest = $c;
}

echo "<div style='background-color:white; padding:15px; margin:10px;'>";
echo "<h3 style='color:blue;'>Question 1</h3>";
echo "Greatest number: $greatest<br>";
echo "Smallest number: $smallest";
echo "</div>";


 
// QUESTION 2
// Check if number is divisible by 3, 5,
// both, or none
 

$number = 15;

echo "<div style='background-color:white; padding:15px; margin:10px;'>";
echo "<h3 style='color:blue;'>Question 2</h3>";

if ($number % 3 == 0 && $number % 5 == 0) {

    echo "$number is divisible by both 3 and 5";

} elseif ($number % 3 == 0) {

    echo "$number is divisible by 3";

} elseif ($number % 5 == 0) {

    echo "$number is divisible by 5";

} else {

    echo "$number is divisible by none";

}

echo "</div>";


 
// QUESTION 3
// Print odd numbers from 2 to 20
// Print even numbers from 35 to 7
 

echo "<div style='background-color:white; padding:15px; margin:10px;'>";
echo "<h3 style='color:blue;'>Question 3</h3>";

echo "Odd numbers from 2 to 20:<br>";

for ($i = 2; $i <= 20; $i++) {

    if ($i % 2 != 0) {
        echo "$i ";
    }

}

echo "<br><br>";

echo "Even numbers from 35 to 7:<br>";

for ($i = 35; $i >= 7; $i--) {

    if ($i % 2 == 0) {
        echo "$i ";
    }

}

echo "</div>";

 
// QUESTION 4
// Print numbers divisible by 2 and 5
// from 50 to 2
 

echo "<div style='background-color:white; padding:15px; margin:10px;'>";
echo "<h3 style='color:blue;'>Question 4</h3>";

for ($i = 50; $i >= 2; $i--) {

    if ($i % 2 == 0 && $i % 5 == 0) {
        echo "$i ";
    }

}

echo "</div>";

 
// QUESTION 5
// Reverse a given number
// Do not use strrev()
 

$number = 12345;
$reverse = 0;

$temp = $number;

while ($temp > 0) {

    $digit = $temp % 10;

    $reverse = $reverse * 10 + $digit;

    $temp = ($temp - $digit) / 10;
}

echo "<div style='background-color:white; padding:15px; margin:10px;'>";
echo "<h3 style='color:blue;'>Question 5</h3>";
echo "Original number: $number<br>";
echo "Reverse number: $reverse";
echo "</div>";


 
// QUESTION 6
// Find LCM of two positive numbers
 

$a = 8;
$b = 12;

$lcm = $a;

while ($lcm % $a != 0 || $lcm % $b != 0) {

    $lcm++;

}

echo "<div style='background-color:white; padding:15px; margin:10px;'>";
echo "<h3 style='color:blue;'>Question 6</h3>";
echo "LCM of $a and $b is: $lcm";
echo "</div>";
 
// QUESTION 7
// Find HCF of two numbers
 

$a = 18;
$b = 24;

$hcf = 1;

for ($i = 1; $i <= $a && $i <= $b; $i++) {

    if ($a % $i == 0 && $b % $i == 0) {

        $hcf = $i;

    }

}

echo "<div style='background-color:white; padding:15px; margin:10px;'>";
echo "<h3 style='color:blue;'>Question 7</h3>";
echo "HCF of $a and $b is: $hcf";
echo "</div>";

 
// QUESTION 8
// Multiplication table from 1 to 12
// Using nested loops
 

echo "<div style='background-color:white; padding:15px; margin:10px;'>";
echo "<h3 style='color:blue;'>Question 8</h3>";

// Table
echo "<table border='1' style='border-collapse:collapse;'>";

// First row
echo "<tr>";

echo "<th style='background-color:blue; color:white; padding:8px;'>×</th>";

for ($i = 1; $i <= 12; $i++) {

    echo "<th style='background-color:blue; color:white; padding:8px;'>$i</th>";

}

echo "</tr>";


// Other rows
for ($i = 1; $i <= 12; $i++) {

    echo "<tr>";

    echo "<th style='background-color:blue; color:white; padding:8px;'>$i</th>";

    for ($j = 1; $j <= 12; $j++) {

        echo "<td style='background-color:#e0ecff; padding:8px; text-align:center;'>";
        echo $i * $j;
        echo "</td>";

    }

    echo "</tr>";
}

echo "</table>";

echo "</div>";

 
// QUESTION 9
// Check whether a number is prime or non-prime
 

$number = 17;
$count = 0;

for ($i = 1; $i <= $number; $i++) {

    if ($number % $i == 0) {

        $count++;

    }

}

echo "<div style='background-color:white; padding:15px; margin:10px;'>";
echo "<h3 style='color:blue;'>Question 9</h3>";

if ($count == 2) {

    echo "$number is a prime number";

} else {

    echo "$number is a non-prime number";

}

echo "</div>";
 

// QUESTION 10
// Print prime numbers from 10 to 50
 

echo "<div style='background-color:white; padding:15px; margin:10px;'>";
echo "<h3 style='color:blue;'>Question 10</h3>";

for ($number = 10; $number <= 50; $number++) {

    $count = 0;

    for ($i = 1; $i <= $number; $i++) {

        if ($number % $i == 0) {

            $count++;

        }

    }

    if ($count == 2) {

        echo "$number ";

    }

}

echo "</div>";


// Close background
echo "</div>";

?>