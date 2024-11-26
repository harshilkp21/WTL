<?php
// Hardcoded student data
$students = [
    ['roll_number' => 1, 'student_name' => 'John Doe', 'department' => 'Computer Science', 'passing_year' => 2024, 'class_grades' => 'First Class'],
    ['roll_number' => 2, 'student_name' => 'Jane Smith', 'department' => 'Mechanical', 'passing_year' => 2023, 'class_grades' => 'Second Class'],
    ['roll_number' => 3, 'student_name' => 'Alice Brown', 'department' => 'Electrical', 'passing_year' => 2025, 'class_grades' => 'Pass'],
    ['roll_number' => 4, 'student_name' => 'Bob White', 'department' => 'Computer Science', 'passing_year' => 2024, 'class_grades' => 'First Class'],
    ['roll_number' => 5, 'student_name' => 'Charlie Black', 'department' => 'Civil', 'passing_year' => 2023, 'class_grades' => 'Pass'],
    ['roll_number' => 6, 'student_name' => 'Eve Green', 'department' => 'Mechanical', 'passing_year' => 2024, 'class_grades' => 'First Class'],
];

// Initialize filter variables
$gradeFilter = '';
$departmentFilter = '';

// Check if the filter form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and assign the filter values from POST request
    $gradeFilter = $_POST['grade'];
    $departmentFilter = $_POST['department'];
}

// Filter the student data based on grade and department
$filteredStudents = array_filter($students, function($student) use ($gradeFilter, $departmentFilter) {
    $matchGrade = empty($gradeFilter) || $student['class_grades'] == $gradeFilter;
    $matchDepartment = empty($departmentFilter) || $student['department'] == $departmentFilter;
    
    return $matchGrade && $matchDepartment;
});
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Grading System</title>
</head>
<body>

<h2>Student Grading System</h2>

<!-- Filter Form -->
<form action="" method="post">
    <label for="grade">Select Grade:</label>
    <select name="grade" id="grade">
        <option value="">All Grades</option>
        <option value="First Class" <?php echo ($gradeFilter == 'First Class') ? 'selected' : ''; ?>>First Class</option>
        <option value="Second Class" <?php echo ($gradeFilter == 'Second Class') ? 'selected' : ''; ?>>Second Class</option>
        <option value="Pass" <?php echo ($gradeFilter == 'Pass') ? 'selected' : ''; ?>>Pass</option>
    </select>

    <label for="department">Select Department:</label>
    <select name="department" id="department">
        <option value="">All Departments</option>
        <option value="Computer Science" <?php echo ($departmentFilter == 'Computer Science') ? 'selected' : ''; ?>>Computer Science</option>
        <option value="Mechanical" <?php echo ($departmentFilter == 'Mechanical') ? 'selected' : ''; ?>>Mechanical</option>
        <option value="Electrical" <?php echo ($departmentFilter == 'Electrical') ? 'selected' : ''; ?>>Electrical</option>
        <option value="Civil" <?php echo ($departmentFilter == 'Civil') ? 'selected' : ''; ?>>Civil</option>
    </select>

    <input type="submit" value="Filter">
</form>

<h3>Filtered Students</h3>

<!-- Display the results in a table -->
<table border="1" cellpadding="10" cellspacing="0">
    <tr>
        <th>Roll Number</th>
        <th>Student Name</th>
        <th>Department</th>
        <th>Passing Year</th>
        <th>Class Grades</th>
    </tr>

    <?php
    // Check if there are any filtered students
    if (count($filteredStudents) > 0) {
        // Output each row of the filtered results
        foreach ($filteredStudents as $student) {
            echo "<tr>";
            echo "<td>" . $student['roll_number'] . "</td>";
            echo "<td>" . $student['student_name'] . "</td>";
            echo "<td>" . $student['department'] . "</td>";
            echo "<td>" . $student['passing_year'] . "</td>";
            echo "<td>" . $student['class_grades'] . "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='5'>No results found.</td></tr>";
    }
    ?>

</table>

</body>
</html>
