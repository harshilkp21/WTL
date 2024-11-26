<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Admission Form</title>
</head>
<body>
    <h2>Student Admission Form</h2>
    <form method="POST" action="process_form.php">
        <label for="student_id">Student ID:</label>
        <input type="text" id="student_id" name="student_id" required><br><br>

        <label for="student_name">Student Name:</label>
        <input type="text" id="student_name" name="student_name" required><br><br>

        <label for="email">Email ID:</label>
        <input type="email" id="email" name="email" required><br><br>

        <label for="grade_12">12th Grade (%):</label>
        <input type="number" id="grade_12" name="grade_12" min="0" max="100" required><br><br>

        <label for="jee_score">JEE Score:</label>
        <input type="number" id="jee_score" name="jee_score" min="0" max="360" required><br><br>

        <button type="submit">Submit</button>
    </form>
</body>
</html>
