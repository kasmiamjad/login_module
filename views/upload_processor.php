<?php
// Check if a file has been uploaded
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['fileUpload'])) {
    $file = $_FILES['fileUpload'];

    // Check for errors
    if ($file['error'] === UPLOAD_ERR_OK) {
        // Check file size - for example, limit to 5MB
        if ($file['size'] > 5000000) {
            session_start();
            $_SESSION['message'] = "File size exceeds the maximum limit.";
            $_SESSION['message_type'] = "danger";
            header("Location: dashboard.php");
            exit;
        }

        // Validate the file type for security
        $allowed = ['jpg', 'jpeg', 'png', 'gif', 'pdf'];
        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

        if (!in_array($ext, $allowed)) {
            session_start();
            $_SESSION['message'] = "Invalid file type.";
            $_SESSION['message_type'] = "danger";
            header("Location: dashboard.php");
            exit;
        }

        // Define a destination
        $destination = "../public/uploads/" . $file['name']; // Ensure the 'uploads' folder exists and is writable

        // Move the file from the temporary location to the destination
        if (move_uploaded_file($file['tmp_name'], $destination)) {
            session_start();
            $_SESSION['message'] = "File uploaded successfully!";
            $_SESSION['message_type'] = "success";
            header("Location: dashboard.php");
            exit;
        

        } else {
            $_SESSION['message'] = "Error moving the uploaded file.";
            $_SESSION['message_type'] = "danger";
            header("Location: dashboard.php");
            exit;
        }
    } else {
            $_SESSION['message'] = "Error uploading file. Code: " . $file['error'];
            $_SESSION['message_type'] = "danger";
            header("Location: dashboard.php");
            exit;
    }
} else {
            $_SESSION['message'] = "No file uploaded or bad request.";
            $_SESSION['message_type'] = "danger";
            header("Location: dashboard.php");
            exit;
}
?>
