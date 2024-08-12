<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    // Set the recipient email address
    $to = "v.mudrow@gmail.com"; // Your email address

    // Set the email subject
    $subject = "New Contact Form Submission from $name";

    // Build the email content
    $email_content = "Name: $name\n";
    $email_content .= "Email: $email\n\n";
    $email_content .= "Message:\n$message\n";

    // Build the email headers
    $headers = "From: $name <$email>";

    // Send the email
    if (mail($to, $subject, $email_content, $headers)) {
        // Redirect to a thank you page (optional)
        header("Location: thank-you.html");
        exit;
    } else {
        echo "Oops! Something went wrong, and we couldn't send your message.";
    }
} else {
    // If not a POST request, redirect to the contact page
    header("Location: index.html");
    exit;
}
?>
