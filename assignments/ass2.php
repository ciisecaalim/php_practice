<?php

echo "<div style='background-color: black; color: white; width'>";



$student = array(
    array("Ca231", "isse alimahmed", "619810803", "Address"),
    array("Ca232", "ali alimahmed", "618239487", "Address"),
    array("yassir", "yussuf alimahmed", "619810803", "Address"),
    array("ahmed", "isse alimahmed", "619810803", "Address")
);

foreach ($student as $s) {
    foreach ($s as $v) {
        echo "$v, ";
    }
    echo "<br>";
}

echo "</div>";

?>