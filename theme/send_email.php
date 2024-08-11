<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    // Validate inputs
    if (!empty($name) && !empty($email) && !empty($subject) && !empty($message)) {
        $to = "v.mudrow@gmail.com";
        $headers = "From: $email" . "\r\n" .
                   "Reply-To: $email" . "\r\n" .
                   "X-Mailer: PHP/" . phpversion();

        if (mail($to, $subject, $message, $headers)) {
            echo "Your Message was sent successfully";
        } else {
            echo "Something went wrong, please try again later";
        }
    } else {
        echo "Please fill out all fields";
    }
} else {
    echo "Form not submitted correctly.";
}
?>

