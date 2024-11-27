<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Day of the Week</title>
</head>
<body>
    <h1>Find the Day of the Week</h1>
    <form method="POST">
        <label for="dayNumber">Enter a number (1-7): </label>
        <input type="number" id="dayNumber" name="dayNumber" min="1" max="7" required>
        <button type="submit">Enter</button>
    </form>

    <?php
    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get the input number
        $dayNumber = intval($_POST["dayNumber"]);

        // Determine the day of the week using switch-case
        switch ($dayNumber) {
            case 1:
                echo "<p>The day is: <strong>Monday</strong></p>";
                break;
            case 2:
                echo "<p>The day is: <strong>Tuesday</strong></p>";
                break;
            case 3:
                echo "<p>The day is: <strong>Wednesday</strong></p>";
                break;
            case 4:
                echo "<p>The day is: <strong>Thursday</strong></p>";
                break;
            case 5:
                echo "<p>The day is: <strong>Friday</strong></p>";
                break;
            case 6:
                echo "<p>The day is: <strong>Saturday</strong></p>";
                break;
            case 7:
                echo "<p>The day is: <strong>Sunday</strong></p>";
                break;
            default:
                echo "<p><strong>Invalid number.</strong> Please enter a number between 1 and 7.</p>";
        }
    }
    ?>
</body>
</html>
