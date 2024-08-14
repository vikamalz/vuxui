<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form fields and remove whitespace
    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $subject = trim($_POST["subject"]);
    $message = trim($_POST["message"]);

    // Set the recipient email address
    $to = "contact@vuxui.de"; 

    // Set the email subject
    $email_subject = "New contact form submission: $subject";

    // Create the email content
    $email_content = "Name: $name\n";
    $email_content .= "Email: $email\n\n";
    $email_content .= "Message:\n$message\n";

    // Set the email headers
    $headers = "From: $name <$email>";

    // Send the email
    if (mail($to, $email_subject, $email_content, $headers)) {
        // Success message
        echo json_encode(["status" => "success", "message" => "Your message was sent successfully."]);
    } else {
        // Error message
        echo json_encode(["status" => "error", "message" => "Something went wrong, please try again later."]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Invalid request."]);
}
?>
