<?php
	// Include the database connection file
	require_once 'connection.php';

	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		// Retrieve user input from the form
		$username = $_POST['username'];
		$email = $_POST['email'];
		$password = $_POST['password'];

		// Hash the password for security
		$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

		// Insert user data into the database
		$sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$hashedPassword')";
		$result = mysqli_query($conn, $sql);

		if ($result) {
			// User registration successful
			echo "User registered successfully!";
		} else {
			// Error in database query
			echo "Error: " . mysqli_error($conn);
		}
	}
?>
