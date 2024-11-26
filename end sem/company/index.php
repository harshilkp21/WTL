<?php
// Start session to store company data
session_start();

// Initialize the companies array in the session
if (!isset($_SESSION['companies'])) {
    $_SESSION['companies'] = [];
}

// Handle search by location
$search_location = $_GET['search_location'] ?? '';
$filtered_companies = $_SESSION['companies'];

// Filter companies based on location if search is performed
if ($search_location) {
    $filtered_companies = array_filter($_SESSION['companies'], function ($company) use ($search_location) {
        return stripos($company['location'], $search_location) !== false;
    });
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Company Registration</title>
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
        <h2>Register a Company</h2>
        <form action="save_company.php" method="POST">
            <label for="company_id">Company ID:</label><br>
            <input type="text" id="company_id" name="company_id" required><br><br>
            <label for="company_name">Company Name:</label><br>
            <input type="text" id="company_name" name="company_name" required><br><br>
            <label for="location">Location:</label><br>
            <input type="text" id="location" name="location" required><br><br>
            <label for="department">Department:</label><br>
            <input type="text" id="department" name="department" required><br><br>
            <button type="submit">Register</button>
        </form>
    </div>

    <div class="table-container">
        <h2>Registered Companies</h2>
        <form action="index.php" method="GET">
            <label for="search_location">Search by Location:</label>
            <input type="text" id="search_location" name="search_location" placeholder="Enter location">
            <button type="submit">Search</button>
        </form>
        <table>
            <thead>
                <tr>
                    <th>Company ID</th>
                    <th>Company Name</th>
                    <th>Location</th>
                    <th>Department</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($filtered_companies)): ?>
                    <?php foreach ($filtered_companies as $company): ?>
                        <tr>
                            <td><?= htmlspecialchars($company['company_id']); ?></td>
                            <td><?= htmlspecialchars($company['company_name']); ?></td>
                            <td><?= htmlspecialchars($company['location']); ?></td>
                            <td><?= htmlspecialchars($company['department']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="4">No companies found</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
