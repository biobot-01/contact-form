<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        //check if its an ajax request, exit if not
        if (!isset($_SERVER["HTTP_X_REQUESTED_WITH"]) && strtolower($_SERVER["HTTP_X_REQUESTED_WITH"]) != "xmlhttprequest") {
            //exit script outputting json data
            $output = json_encode(
                array(
                    'type' => 'error',
                    'text' => 'Request is not a valid Ajax request.'
                )
            );
            die($output);
        }

        //check $_POST vars are set, exit if any missing
        if (!isset($_POST["fullName"]) || !isset($_POST["email"]) || !isset($_POST["subject"]) || !isset($_POST["message"]) ) {
            $output = json_encode(
                array(
                    'type' => 'error',
                    'text' => 'Highlighted input fields cannot be left blank!'
                )
            );
            die($output);
        }

        if (isset($_POST["submit"]) && isset($_POST["url"]) && $_POST["url"] == '' && isset($_POST["fullName"]) && isset($_POST["email"]) && isset($_POST["subject"]) && isset($_POST["message"])) {
            $fullName = htmlspecialchars(stripslashes(trim($_POST["fullName"])));
            $email = htmlspecialchars(stripslashes(trim($_POST["email"])));
            $phoneNumber = htmlspecialchars(stripslashes(trim($_POST["phoneNumber"])));
            $subject = htmlspecialchars(stripslashes(trim($_POST["subject"])));
            $message = htmlspecialchars(stripslashes(trim($_POST["message"])));

            $fullNamePattern = "/^[A-Za-z .'-]+$/";
            $emailPattern = "/^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/";
            $contactNumberPattern = "/^(\+44\s?7\d{3}|\(?07\d{3}\)?)\s?\d{3}\s?\d{3}$/";
            $subjectPattern = "/^[A-Za-z .'-]+$/";

            if (strlen($fullName) < 4) && (!preg_match($fullNamePattern, $fullName)) {
                $output = json_encode(
                    array(
                        'type' => 'error',
                        'text' => 'Name is too short.'
                    )
                );
                die($output);
            }
            if (!preg_match($emailPattern, $email)) {
                $output = json_encode(
                    array(
                        'type' => 'error',
                        'text' => 'Please enter a valid email address.'
                    )
                );
                die($output);
            }
            if (strlen($phoneNumber) < 11) && (!preg_match($contactNumberPattern, $phoneNumber)) {
                $output = json_encode(
                    array(
                        'type' => 'error',
                        'text' => 'Phone number is too short.'
                    )
                );
                die($output);
            }
            if (strlen($subject) < 4) && (!preg_match($subjectPattern, $subject)) {
                $output = json_encode(
                    array(
                        'type' => 'error',
                        'text' => 'Subject name is too short.'
                    )
                );
                die($output);
            }
            if (strlen($message) === 0) && (strlen($message) < 5) {
                $output = json_encode(
                    array(
                        'type' => 'error',
                        'text' => 'Message is too short.'
                    )
                );
                die($output);
            }

            $to = "youremail@address.com"; // edit here
            $headers = "From: '.$fullName. '<'.$email.'>'.'" . "\r\n".
                "Reply-To: '.$email.'" . "\r\n".
                "X-Mailer: PHP/" . phpversion().
                "MIME-Version: 1.0" . "\r\n".
                "Content-Type: text/html; charset=UTF-8" . "\r\n";
            $body = "<html>
                <head>
                    <title>Your Website Contact Form</title>
                </head>
                <body>
                    <p><strong>From:</strong> $fullName</p>
                    <p><strong>Email:</strong> $email</p>
                    <p><strong>Phone:</strong> $phoneNumber</p>
                    <p><strong>Subject:</strong> $subject</p>
                    <p><strong>Message:</strong> $message</p>
                </body>
            </html>";

            $sentMail = mail($to, $subject, $headers, $body);
            if (!$sentMail) {
                $output = json_encode(
                    array(
                        'type' => 'error',
                        'text' => 'Could not send mail! Please contact administrator.'
                    )
                );
                die($output);
            } else {
                $output = json_encode(
                    array(
                        'type' => 'success',
                        'text' => 'Hi '.$name.' Thank you for contacting us! We typically reply within 24 hours of receiveing your mail! Please keep an eye on those mails.'
                    )
                );
                die($output);
            }
        }
    }
?>
