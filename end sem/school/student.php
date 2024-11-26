<?php
// Start session to store student data
session_start();

// Initialize the students array in the session
if (!isset($_SESSION['students'])) {
    $_SESSION['students'] = [];
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $student_id = $_POST['student_id'];
    $student_name = $_POST['student_name'];
    $email_id = $_POST['email_id'];
    $grade_12 = $_POST['grade_12'];
    $jee_score = $_POST['jee_score'];

    // Save student data in session
    $_SESSION['students'][] = [
        'student_id' => $student_id,
        'student_name' => $student_name,
        'email_id' => $email_id,
        'grade_12' => $grade_12,
        'jee_score' => (int)$jee_score // Ensure JEE score is treated as an integer
    ];
}

// Get top 5 students based on JEE score
$students = $_SESSION['students'];
usort($students, function ($a, $b) {
    return $b['jee_score'] <=> $a['jee_score']; // Sort in descending order
});
$top_students = array_slice($students, 0, 5);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Admission Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .form-container, .table-container {
            margin-bottom: 30px;
        }
        form {
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Student Admission Form</h2>
        <form action="" method="POST">
            <label for="student_id">Student ID:</label><br>
            <input type="text" id="student_id" name="student_id" required><br><br>
            <label for="student_name">Student Name:</label><br>
            <input type="text" id="student_name" name="student_name" required><br><br>
            <label for="email_id">Email ID:</label><br>
            <input type="email" id="email_id" name="email_id" required><br><br>
            <label for="grade_12">12th Grade (%):</label><br>
            <input type="number" id="grade_12" name="grade_12" required><br><br>
            <label for="jee_score">JEE Score:</label><br>
            <input type="number" id="jee_score" name="jee_score" required><br><br>
            <button type="submit">Submit</button>
        </form>
    </div>

    <div class="table-container">
        <h2>Top 5 Students Based on JEE Score</h2>
        <table>
            <thead>
                <tr>
                    <th>Student ID</th>
                    <th>Student Name</th>
                    <th>Email ID</th>
                    <th>12th Grade (%)</th>
                    <th>JEE Score</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($top_students)): ?>
                    <?php foreach ($top_students as $student): ?>
                        <tr>
                            <td><?= htmlspecialchars($student['student_id']); ?></td>
                            <td><?= htmlspecialchars($student['student_name']); ?></td>
                            <td><?= htmlspecialchars($student['email_id']); ?></td>
                            <td><?= htmlspecialchars($student['grade_12']); ?></td>
                            <td><?= htmlspecialchars($student['jee_score']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="5">No students registered yet.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
