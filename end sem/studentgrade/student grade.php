<?php
// Database connection details
$host = 'localhost';
$dbname = 'your_database_name';
$username = 'your_username';
$password = 'your_password';

try {
    // Create a new PDO instance
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Create the Students table if it doesn't exist
    $createTableQuery = "
        CREATE TABLE IF NOT EXISTS Students (
            rollNo INT PRIMARY KEY,
            studName VARCHAR(100) NOT NULL,
            studDept VARCHAR(50) NOT NULL,
            passingYear INT NOT NULL,
            classGrades ENUM('First Class', 'Second Class', 'Pass') NOT NULL
        )
    ";
    $pdo->exec($createTableQuery);

    // Sample data insertion (uncomment this part if you need sample data for testing)
    /*
    $insertDataQuery = "
        INSERT INTO Students (rollNo, studName, studDept, passingYear, classGrades) VALUES
        (1, 'Alice', 'CSE', 2024, 'First Class'),
        (2, 'Bob', 'CSE', 2023, 'Second Class'),
        (3, 'Charlie', 'ECE', 2024, 'First Class'),
        (4, 'David', 'CSE', 2022, 'First Class')
    ";
    $pdo->exec($insertDataQuery);
    */

    // Query to filter and display First-Class students in CSE
    $query = "
        SELECT rollNo, studName, passingYear
        FROM Students
        WHERE studDept = 'CSE' AND classGrades = 'First Class'
    ";

    $stmt = $pdo->query($query);

    // Display the filtered students
    echo "<h2>First-Class Students in CSE</h2>";
    echo "<table border='1'>
            <tr>
                <th>Roll No</th>
                <th>Name</th>
                <th>Passing Year</th>
            </tr>";

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>
                <td>{$row['rollNo']}</td>
                <td>{$row['studName']}</td>
                <td>{$row['passingYear']}</td>
              </tr>";
    }

    echo "</table>";

} catch (PDOException $e) {
    echo "Database error: " . $e->getMessage();
}
?>
