<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['submit']) && isset($_POST['url']) && $_POST['url'] == '') {
            $fullName = htmlspecialchars(stripslashes(trim($_POST['fullName'])));
            $email = htmlspecialchars(stripslashes(trim($_POST['email'])));
            $phoneNumber = htmlspecialchars(stripslashes(trim($_POST['phoneNumber'])));
            $subject = htmlspecialchars(stripslashes(trim($_POST['subject'])));
            $message = htmlspecialchars(stripslashes(trim($_POST['message'])));

            $fullNamePattern = "/^[A-Za-z .'-]+$/";
            $emailPattern = "/^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/";
            $contactNumberPattern = "/^(\+44\s?7\d{3}|\(?07\d{3}\)?)\s?\d{3}\s?\d{3}$/";
            $subjectPattern = "/^[A-Za-z .'-]+$/";

            if (!preg_match($fullNamePattern, $fullName)) {
                $fullName_error = 'Invalid name';
            }
            if (!preg_match($emailPattern, $email)) {
                $email_error = 'Invalid email';
            }
            if (!preg_match($contactNumberPattern, $phoneNumber)) {
                $phoneNumber = 'Invalid contact number';
            }
            if (!preg_match($subjectPattern, $subject)) {
                $subject_error = 'Invalid subject';
            }
            if (strlen($message) === 0) {
                $message_error = 'Your message should not be empty';
            }
        }

        if (isset($_POST['submit']) && !isset($fullName_error) && !isset($email_error) && !isset($phoneNumber_error) && !isset($subject_error) && !isset($message_error) && isset($_POST['url']) && $_POST['url'] == '') {
            $to = "youremail@address.com"; // edit here
            $from = "Your Website Contact Form"
            $body = " Name: $fullName\n E-mail: $email\n Phone Number: $phoneNumber\n Message:\n $message";

            if (wp_mail($to, $from, $subject, $body)) {
                header('Location: http://www.example.com/thankyou.php');
                exit('Redirecting you to http://www.example.como/thankyou.php');
            } else {
                echo '<p>Error occurred, please try again later</p>';
            }
        }
    }
?>
