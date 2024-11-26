<?php
// Start session to access and store company data
session_start();

// Get form data
$company_id = $_POST['company_id'];
$company_name = $_POST['company_name'];
$location = $_POST['location'];
$department = $_POST['department'];

// Add the company to the session array
$_SESSION['companies'][] = [
    'company_id' => $company_id,
    'company_name' => $company_name,
    'location' => $location,
    'department' => $department
];

// Redirect back to the main page
header('Location: index.php');
exit;
?>
