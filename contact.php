<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize input data
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $message = htmlspecialchars(trim($_POST['message']));

    // Validate inputs
    $errors = [];
    
    if (empty($name)) {
        $errors[] = "Full name is required";
    }
    
    if (empty($email)) {
        $errors[] = "Email address is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format";
    }
    
    if (empty($message)) {
        $errors[] = "Message cannot be empty";
    }

    // If no errors, send email
    if (empty($errors)) {
        $to = "atikul.ruet21@gmail.com";
        $subject = "New Contact Form Submission";
        $email_body = "Name: $name\n";
        $email_body .= "Email: $email\n\n";
        $email_body .= "Message:\n$message";
        $headers = "From: $email";

        if (mail($to, $subject, $email_body, $headers)) {
            echo "<h3>Thank you! Your message has been sent.</h3>";
            echo "<p>We'll get back to you soon.</p>";
        } else {
            echo "<h3>Error: Message could not be sent.</h3>";
            echo "<p>Please try again later.</p>";
        }
    } else {
        // Display errors
        echo "<h3>Error:</h3>";
        foreach ($errors as $error) {
            echo "<p>$error</p>";
        }
        echo '<p><a href="contact.html">Go back to form</a></p>';
    }
} else {
    // Redirect if accessed directly
    header("Location: contact.html");
    exit;
}
?>