<?php

require 'database.php';

// Use the $pdo object
$stmt = $pdo->query('SELECT * FROM users');
while ($row = $stmt->fetch()) {
    echo $row['name'] . "\n";
}