<?php
require '../config/database.php';  
require '../controllers/AuthController.php';   

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Initialize variables and sanitize inputs
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

    // Validate inputs
    $errors = [];
    if (empty($name)) {
        $errors[] = "Name is required.";
    }
    if (empty($password)) {
        $errors[] = "Password is required.";
    }
    if (strlen($password) < 6) {
        $errors[] = "Password must be at least 6 characters long.";
    }

    // Check for any errors
    if (count($errors) === 0) {
        $authController = new AuthController($pdo);
        $result = $authController->register($name, $password);
       
    } else {
        // Display all errors
        foreach ($errors as $error) {
            $_SESSION['message'] = $error . '<br>';
            $_SESSION['message_type'] = "danger";
            header("Location: login.php");
            exit;
        }
    }
}
?>
