<?php
$message = ""; // Initialize message variable

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data with basic sanitization
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $messageContent = htmlspecialchars(trim($_POST['message']));

    // Validate the email address
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = "Oops, your email address seems to be wrong.";
    } else {
        // Set the recipient email address
        $to = "contact@vuxui.de"; // Your email address

        // Set the email subject
        $subject = "New Contact Form Submission from $name";

        // Build the email content
        $email_content = "Name: $name\n";
        $email_content .= "Email: $email\n\n";
        $email_content .= "Message:\n$messageContent\n";

        // Build the email headers
        $headers = "From: $name <$email>";
        $headers .= "Reply-To: $email";

        // Send the email
        if (mail($to, $subject, $email_content, $headers)) {
            $message = "Thank you! Your message has been sent successfully.";
        } else {
            $message = "Oops! Something went wrong, and your email was not sent. Please try again.";
        }
    }

    // Redirect back to the form with the message
    header("Location: ./contact.php?message=" . urlencode($message));
    exit;
} else {
    $message = "Invalid request. Please fill out the form.";
}
?>

