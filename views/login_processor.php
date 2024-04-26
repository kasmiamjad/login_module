<?php
require '../config/database.php';  
require '../controllers/AuthController.php';  

$controller = new AuthController($pdo);

// Check if the form data is posted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize input
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

    // Initialize error array to collect validation issues
    $errors = [];

    // Validate input
    if (empty($username)) {
        $errors[] = "Username is required.";
    }
    if (empty($password)) {
        $errors[] = "Password is required.";
    }

    // Proceed only if there are no errors
    if (empty($errors)) {
        // Call the login function
        $response = $controller->login($username, $password);
        
        // Depending on the response, you can redirect or show a message
        if ($response === true) {
            // Redirect to dashboard or home page
            

        } else {
            // For demonstration, you could display the error
            echo "Login failed: Invalid username or password.";
        }
    } else {
        // Display errors
        foreach ($errors as $error) {
            echo $error . "<br>";
        }
    }
}
?>
