<!-- chapter1 -->

<?php
echo "Hello World!";
echo"<br>";
echo"<br>";
echo"hello World!", "my name is yassir", "I am a student";

echo"<br>";
echo"<br>";

// print("Hello World!", "my name is yassir", "I am a student");error

$x=10;
$y=20;
//$x<$y? print"x is less than y": print "x is greater than y";
// $x<$y ? echo "x is less than y" : echo "x is greater than y"; //error
//echo $x<$y ? "x is less than y" : "x is greater than y";
print $x<$y ? "x is less than y" : "x is greater than y";


//quets
$a=10;
$b=20;
$c=30;
$d= $a+$b+$c;
echo"<br>";
echo "total numbers $a + $b + $c =  $d";


//strnlen
echo"<br>";
$variable1 = "Hello World!";
echo strlen($variable1); // 12

//str_word_count
echo"<br>"; 
$my_str = "The quick brown fox jumps over the lazy dog."; 
echo str_word_count($my_str); // 9

//contant variale
define("PI", 3.14159);
echo"<br>";
echo PI;
echo"<br>";
echo"<br>";

//if statement
$age = 20;
if($age >= 18){
    echo "$age is eligible to vote.";
}else{
    echo "$age is not eligible to vote.";
}


echo"<br>";
echo"<br>";


//swich statement
$page = "home";
switch($page){
    case "home":
        echo "Welcome to the home page.";
        break;
    case "about":
        echo "Welcome to the about page.";
        break;
    case "contact":
        echo "Welcome to the contact page.";
        break;
    default:
        echo "Page not found.";
};

echo"<br>";
echo"<br>";
echo"<br>";
 

$ans = "y";

switch($ans){
    case"Y" || "y":
        echo "You answered yes.";
        break;
        case"N" || "n":
            echo "You answered no.";
            break;
}


?>