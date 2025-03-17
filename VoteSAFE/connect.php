<?php
$servername = "localhost";
$dbname = "votesafe";

// Create connection
$conn = new mysqli($servername, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get candidate selection from form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $candidate = $_POST["candidate"];

    // Insert vote into database
    $stmt = $conn->prepare("INSERT INTO votes (candidate) VALUES (?)");
    $stmt->bind_param("s", $candidate);
    
    if ($stmt->execute()) {
        header("Location: vote-confirmation.html"); // Redirect after successful submission
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
