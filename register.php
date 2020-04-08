<?php

// Include configuration file
require_once "test.php";

// Define variables and initialize with empty values
$full_name = $password = $confirm_password = "";
$full_name_error = $password_error = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validate full name
    if (empty(trim($_POST["username"]))) {
        $full_name_error = "Please enter a full name.";
    } else {
        // Prepare a select statement
        $sql = "SELECT aid FROM attendees WHERE full_name = :full_name";

        if ($stmt = $pdo->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":full_name", $param_full_name, PDO::PARAM_STR);

            // Set parameters
            $param_full_name = trim($_POST["username"]);

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {

                    $username = trim($_POST["username"]);

            } else {
                echo "Something went wrong. Please try again later.";
            }

            // Close statement
            unset($stmt);
        }
    }

    // Validate password
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter a password.";
    } elseif (strlen(trim($_POST["password"])) < 6) {
        $password_err = "Password must have at least 6 characters.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Check input errors before inserting in database
    if (empty($username_error) && empty($password_error)) {

        // Prepare an insert statement
        $sql = "INSERT INTO users (full_name, password) VALUES (:full_name, :password)";

        if ($stmt = $pdo->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":full_name", $param_full_name, PDO::PARAM_STR);
            $stmt->bindParam(":password", $param_password, PDO::PARAM_STR);

            // Set parameters
            $param_full_name = $full_name;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                // Redirect to login page
                header("location: user.html");
            } else {
                echo "Something went wrong. Please try again later.";
            }

            // Close statement
            unset($stmt);
        }
    }

    // Close connection
    unset($pdo);
}