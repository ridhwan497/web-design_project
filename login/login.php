<?php
// Include the database connection file
require_once 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve user input from the login form
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare the SQL query to retrieve the user's data from the database
    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        // Check if the user exists in the database
        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            $storedPassword = $row['password'];

            // Verify the password using password_verify()
            if (password_verify($password, $storedPassword)) {
                // Password is correct, user is authenticated

                // Start a session and store user information (optional but useful for further actions)
                session_start();
                $_SESSION['username'] = $row['username'];
                $_SESSION['user_id'] = $row['id'];

                // Redirect to index.html after successful login
                header('Location: ../index.html');
                exit(); // Make sure to exit after the redirect
            } else {
                // Incorrect password
                echo "Incorrect username or password.";
            }
        } else {
            // User not found in the database
            echo "Incorrect username or password.";
        }
    } else {
        // Error in database query
        echo "Error: " . mysqli_error($conn);
    }
}
?>
