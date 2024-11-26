<?php
// Function to determine the grade based on marks
function determineGrade($marks) {
    if ($marks >= 60) {
        return "First Division";
    } elseif ($marks >= 45 && $marks < 60) {
        return "Second Division";
    } elseif ($marks >= 33 && $marks < 45) {
        return "Third Division";
    } else {
        return "Fail";
    }
}

// Input: marks obtained by the student
$marks = 30; // You can change this value to test other scenarios

// Display the result
echo "Marks: $marks%<br>";
echo "Grade: " . determineGrade($marks);
?>
