<? 

// phpinfo();
// broken


echo "<h1>Hello World</h1>";
echo "Goodbye World\n\t";

// = is assignment operator
$a = 5;

// stting Interpolation
echo "<div>I have $a thing's</div>\n";
echo '<div>I have $a things</div>';

// VALUE TYPES

// Number
// interger (whole number)
$b = 15;
// float 
$b = 0.576;

$b = 10;

// String
$name = "Yerdude";
$name = 'Cynthia'; //string of just charator

// Boolean (is a binary variable, ie: true or false)
$isOn = true;


// function, class, object


// Math

// Order of Operatior
// PEMDAS stands for () n^x * / + -
// + addition operator
// * multipul operator
echo (5+2)*3;


// Concatenation (act to combine or link)
echo "<div>b + a = c</div>";
echo "<div>$b + $a = " . ($b+$a) . "</div>";



?>


<hr>
<div>This is my name</div>
<div>
<?php

$firstname = 'Cynthia';
$lastname = 'Yu';
$fullname = "$firstname $lastname";

echo $fullname;

?>
</div>



<hr>

<?php

// Superglobal (create creating infinite webpages)
echo "Name is: ".$_GET['name'];
echo "<div><a href='?name=Bob'>Bob</a></div>";
echo "<div><a href='?name=Grace'>Grace</a></div>";


echo "<div><a href='?name={$_GET['name']}&type=h1'>H1</a></div>";
echo "<div><a href='?name={$_GET['name']}&type=textarea'>Textarea</a></div>";
echo "Name is: <{$_GET['type']}>{$_GET['name']}</{$_GET['type']}>";



?>

<hr>

<?php

//arrays
$colors = array("red","green","blue");
$colors = ["red","green","blue"];
// index starts with 0


echo $colors[2]; 

echo "
	<br>$colors[0]
	<br>$colors[1]
	<br>$colors[2]
";

echo count($colors);

?>

<div style= "color:<?= $colors[1] ?>">
	This text is green
</div>


<hr>

<?php 

// Associative Array
$colorsAssoc = [
   "red" => "#f00",
   "green" => "#0f0",
   "blue" => "#00f"
];

echo $colorsAssoc['red'];

 ?>

<hr>

<?php

//casting
$c = "$a"; //$c will be string from $a
$d = $c*1; //in order to make string as number *1


$colorsObject = (object)$colorsAssoc;

// echo $colorsObject


echo "<hr>";

//Array Index Notation
echo $colors [0]."<br>";
echo $colorsAssoc ['red']."<br>";
echo $colorsAssoc [$colors[0]]."<br>";

// Object Property Notation
echo $colorsObject ->red. "<br>";
echo $colorsObject ->{$colors[0]}. "<br>";


 ?>


<hr>

<?php

// print_r($colors) (print out in a readable way)

var_dump($colors);
echo "<hr>";
var_dump($colorsAssoc);
echo "<pre>",var_dump($colorsObject),"</pre>";

//i dont have a concole. i must know how to var_dump



//CUSTOM FUNCTIONS
function pretty_dump($data){
	echo "<pre>",var_dump($colorsObject),"</pre>";
}

pretty_dump($colors);


?>



















