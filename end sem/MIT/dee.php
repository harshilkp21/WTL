<?php
// Function to display arrays in a structured format
function displayArray($title, $array) {
    echo "<h3>$title</h3>";
    echo "<pre>";
    print_r($array);
    echo "</pre>";
}

// Numeric Array
$numericArray = [5, 2, 9, 1, 7];
displayArray("Original Numeric Array", $numericArray);

// Sort numeric array in ascending order
sort($numericArray);
displayArray("Sorted Numeric Array (sort())", $numericArray);

// Associative Array
$associativeArray = [
    "apple" => 3,
    "banana" => 1,
    "cherry" => 2
];
displayArray("Original Associative Array", $associativeArray);

// Sort associative array by values in ascending order
asort($associativeArray);
displayArray("Associative Array Sorted by Values (asort())", $associativeArray);

// Sort associative array by keys in ascending order
ksort($associativeArray);
displayArray("Associative Array Sorted by Keys (ksort())", $associativeArray);

// Multidimensional Array
$multiArray = [
    ["name" => "John", "age" => 28],
    ["name" => "Alice", "age" => 24],
    ["name" => "Bob", "age" => 32]
];
displayArray("Original Multidimensional Array", $multiArray);

// Sort multidimensional array by "age" using usort
usort($multiArray, function($a, $b) {
    return $a['age'] <=> $b['age'];
});
displayArray("Multidimensional Array Sorted by Age (usort())", $multiArray);
?>
