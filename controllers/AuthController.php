<?php

class AuthController
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    // Common session handler
    private function handleSession($message, $type, $redirectUrl)
    {
        session_start();
        $_SESSION['message'] = $message;
        $_SESSION['message_type'] = $type;
        header("Location: $redirectUrl");
        exit;
    }

    public function register($username, $password)
    {
        if (empty($username) || empty($password)) {
            $this->handleSession("Username and password are required.", "danger", "register.php");
        }

        // Check if username already exists
        $stmt = $this->pdo->prepare("SELECT id FROM users WHERE username = ?");
        $stmt->execute([$username]);
        if ($stmt->fetch()) {
            $this->handleSession("Username already exists.", "danger", "register.php");
        }

        // Hash password
        $hash = password_hash($password, PASSWORD_DEFAULT);

        // Insert new user
        try {
            $stmt = $this->pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
            $stmt->bindParam(1, $username);
            $stmt->bindParam(2, $hash);
            $stmt->execute();

            $lastInsertedId = $this->pdo->lastInsertId();

            session_start();
            $_SESSION['user_id'] = $lastInsertedId;
            $_SESSION['username'] = $username;
            $_SESSION['loggedin'] = true;
            $this->handleSession("Registration successful.", "success", "dashboard.php");
        } catch (PDOException $e) {
            $this->handleSession("Error: " . $e->getMessage(), "danger", "register.php");
        }
    }

    public function login($username, $password)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch();
        
        if ($user && password_verify($password, $user['password'])) {
            session_start();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['loggedin'] = true;
            $this->handleSession("Login successful!", "success", "dashboard.php");
        } else {
            $this->handleSession("Invalid username or password.", "danger", "login.php");
        }
    }

    public function logout()
    {
        session_start();
        session_destroy();
        header("Location: login.php");
        exit;
    }
}
