<?php

require 'vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Create a connection
$conn = new mysqli('localhost', 'zhepcabuser', 'Zh9fk45@312', 'zhepcab','3307');

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
session_start(); // Start the session

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["contact_submit"])) {
  
    // Retrieve form data
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $message = $_POST["message"];
    //sendmail();

    // Prepare the SQL statement
    $sql = "INSERT INTO home_page_form (name, email, phone, message) VALUES ('$name', '$email', '$phone', '$message')";

    if ($conn->query($sql) === TRUE) {
        // Data submitted successfully, set alert message in session
        $_SESSION["alertMessage"] = "Form submitted successfully!";
        $_SESSION["icon"] = "success";
    } else {
        // Error occurred, set alert message in session
        $_SESSION["alertMessage"] = "Oops, something went wrong. Please try again later.";
        $_SESSION["icon"] = "error";

    }

    // Redirect back to the previous page
    header("Location: " . $_SERVER["HTTP_REFERER"]);
    exit();
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["local_submit"])) {
 
    // Retrieve form data
    $pick_up_location = $_POST["pick_up_location"];
    $drop_location = $_POST["drop_location"];
    $phone = $_POST["phone"];

    // Prepare the SQL statement
    $sql = "INSERT INTO home_page_enquiry  (pick_up_location, drop_location, phone,type) VALUES ('$pick_up_location', '$drop_location', '$phone','Local')";
    sendmail('Local',NULL,$pick_up_location,$drop_location,$phone);
   

    if ($conn->query($sql) === TRUE) {
        // Data submitted successfully, set alert message in session
        $_SESSION["alertMessage"] = "Enquiry submitted successfully!";
        $_SESSION["icon"] = "success";
    } else {
        // Error occurred, set alert message in session
        $_SESSION["alertMessage"] = "Oops, something went wrong. Please try again later.";
        $_SESSION["icon"] = "error";

    }


    // Redirect back to the previous page
    header("Location: " . $_SERVER["HTTP_REFERER"]);
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["rental_submit"])) {
 
    // Retrieve form data
    $pick_up_location = $_POST["pick_up_location"];
    $drop_location = $_POST["drop_location"];
    $phone = $_POST["phone"];
    $package = $_POST["package"];

    // Prepare the SQL statement
    $sql = "INSERT INTO home_page_enquiry  (pick_up_location, drop_location, phone,package,type) VALUES ('$pick_up_location', '$drop_location', '$phone','$package','Rental')";
   
    sendmail('Rental',$package,$pick_up_location,$drop_location,$phone);

    if ($conn->query($sql) === TRUE) {
        // Data submitted successfully, set alert message in session
        $_SESSION["alertMessage"] = "Enquiry submitted successfully!";
        $_SESSION["icon"] = "success";
    } else {
        // Error occurred, set alert message in session
        $_SESSION["alertMessage"] = "Oops, something went wrong. Please try again later.";
        $_SESSION["icon"] = "error";

    }

    // Redirect back to the previous page
    header("Location: " . $_SERVER["HTTP_REFERER"]);
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["outstation_submit"])) {
 
    // Retrieve form data
    $pick_up_location = $_POST["pick_up_location"];
    $drop_location = $_POST["drop_location"];
    $phone = $_POST["phone"];

    // Prepare the SQL statement
    $sql = "INSERT INTO home_page_enquiry  (pick_up_location, drop_location, phone,type) VALUES ('$pick_up_location', '$drop_location', '$phone','Outstation')";
   
    sendmail('Outstation',NULL,$pick_up_location,$drop_location,$phone);

    if ($conn->query($sql) === TRUE) {
        // Data submitted successfully, set alert message in session
        $_SESSION["alertMessage"] = "Enquiry submitted successfully!";
        $_SESSION["icon"] = "success";
    } else {
        // Error occurred, set alert message in session
        $_SESSION["alertMessage"] = "Oops, something went wrong. Please try again later.";
        $_SESSION["icon"] = "error";

    }

    // Redirect back to the previous page
    header("Location: " . $_SERVER["HTTP_REFERER"]);
    exit();
}


function sendmail($type,$package,$pick_up_location,$drop_location,$phone){
    $mail = new PHPMailer();
    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 587;
        $mail->SMTPAuth = true;
       
       
        $mail->Username = 'zheptoursandtravels@gmail.com';
        $mail->Password = 'wuhdhvchucgsqayk';

        $mail->setFrom('zheptoursandtravels@gmail.com', 'Zhep Cab');
        $mail->addAddress('zheptoursandtravels@gmail.com', 'Zhep Cab');

        // Set the email subject
        $subject = "New enquiry";
        $mail->Subject = $subject;
        $body = '<html>
        <head>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f7f7f7;
                margin: 0;
                padding: 0;
            }
            .container {
                max-width: 600px;
                margin: 0 auto;
                background-color: #ffffff;
                border-radius: 5px;
                border:1px solid #ec3323;
                box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            }
            .header {
                background-color: #ec3323;
                color:#fff;
                padding: 10px 20px;
                text-align: center;
            }
            .content {
                font-size:14px;
                padding: 20px;
            }
           
        </style>
    </head>
    <body>
        <div class="container">
            <div class="header">
                <h1>New Enquiry</h1>
            </div>
            <div class="content">
            <p>Enquiry For: '.$type.' '.(isset($package) && $package!=null ? '['.$package.']' : '').' </p>
            <p>Pick Up Location: '.ucfirst($pick_up_location).'</p>
                <p>Drop Location: '.ucfirst($drop_location).'</p>
                <p>Mobile Number: '.$phone.'</p>
                <p>Thank you.</p>
            </div>
           
        </div>
    </body>
    </html>';

        $mail->Body = $body;

        // Enable HTML content
        $mail->isHTML(true);

        // Send the email
        $isEmailSent = $mail->send();
       
        echo "Email sent successfully!";
    } catch (Exception $e) {
        echo "Error sending email: " . $mail->ErrorInfo;
    }

    return 1;
}
// Close the database connection
$conn->close();
?>
