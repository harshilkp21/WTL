<?php
// Start session to temporarily store data
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $studentid = $_POST['studentid'];
    $studentname = $_POST['studentname'];
    $email = $_POST['email'];
    $grade12 = $_POST['grade12'];
    $jeescore = $_POST['jeescore'];
    $department = $_POST['department'];

    // Save submitted data in a session array
    if (!isset($_SESSION['students'])) {
        $_SESSION['students'] = [];
    }

    $_SESSION['students'][] = [
        'studentid' => $studentid,
        'studentname' => $studentname,
        'email' => $email,
        'grade12' => $grade12,
        'jeescore' => $jeescore,
        'department' => $department
    ];
}

// Find the top 5 students in CSE based on JEE score
$topStudents = [];
if (isset($_SESSION['students'])) {
    // Filter students enrolled in CSE
    $cseStudents = array_filter($_SESSION['students'], function ($student) {
        return $student['department'] === 'CSE';
    });

    // Sort students by JEE score in descending order
    usort($cseStudents, function ($a, $b) {
        return $b['jeescore'] - $a['jeescore'];
    });

    // Get the top 5 students
    $topStudents = array_slice($cseStudents, 0, 5);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admission Form and Top Students</title>
</head>
<body>
    <h2>Admission Form</h2>
    <form action="" method="post">
        <label for="studentid">Student ID:</label><br>
        <input type="text" id="studentid" name="studentid" required><br><br>

        <label for="studentname">Student Name:</label><br>
        <input type="text" id="studentname" name="studentname" required><br><br>

        <label for="email">Email ID:</label><br>
        <input type="email" id="email" name="email" required><br><br>

        <label for="grade12">12th Grade Percentage:</label><br>
        <input type="number" id="grade12" name="grade12" required><br><br>

        <label for="jeescore">JEE Score:</label><br>
        <input type="number" id="jeescore" name="jeescore" required><br><br>

        <label for="department">Department:</label><br>
        <select id="department" name="department" required>
            <option value="CSE">CSE</option>
            <option value="ECE">ECE</option>
            <option value="MECH">Mechanical</option>
            <option value="CIVIL">Civil</option>
        </select><br><br>

        <button type="submit">Submit</button>
    </form>

    <h2>Top 5 Students in CSE (Based on JEE Score)</h2>
    <?php if (!empty($topStudents)): ?>
        <table border="1">
            <tr>
                <th>Student ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>12th Grade %</th>
                <th>JEE Score</th>
            </tr>
            <?php foreach ($topStudents as $student): ?>
                <tr>
                    <td><?php echo htmlspecialchars($student['studentid']); ?></td>
                    <td><?php echo htmlspecialchars($student['studentname']); ?></td>
                    <td><?php echo htmlspecialchars($student['email']); ?></td>
                    <td><?php echo htmlspecialchars($student['grade12']); ?></td>
                    <td><?php echo htmlspecialchars($student['jeescore']); ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php else: ?>
        <p>No students registered in the CSE department yet.</p>
    <?php endif; ?>
</body>
</html>
