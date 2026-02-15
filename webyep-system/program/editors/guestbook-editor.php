<?php
// WebYep
// (C) Objective Development Software GmbH
// http://www.obdev.at

// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Correct include path
$webyep_sIncludePath = $_SERVER['DOCUMENT_ROOT'] . "/webyep-system/program/";
include_once($webyep_sIncludePath . "webyep.php");

$sResponse = "";
if (isset($goApp)) {
    $goApp->outputWarningPanels(); // give App a chance to say something
}

// Debugging output to trace the problem
if (!isset($goApp)) {
    echo "goApp is not set.";
} else {
    echo "goApp is set.";
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['WEBYEP_GB_MAGIC']) && $_POST['WEBYEP_GB_MAGIC'] == 4711) {
    $sName = $_POST['WEBYEP_GB_NAME'];
    $sEmail = $_POST['WEBYEP_GB_EMAIL'];
    $sMessage = $_POST['WEBYEP_GB_MESSAGE'];
    
    // Debugging output to trace the problem
    echo "Form data received: Name - $sName, Email - $sEmail, Message - $sMessage";
    
    // Add the entry to the guestbook
    webyep_guestbook("TheGuestbook", 200, "my@email.com", true);
    
    // Display success message
    $sResponse = "Your message has been added successfully!";
}
?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="UTF-8">
    <title>Guestbook Editor</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Helvetica, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f0f2f5;
        }
        .form-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            max-width: 550px;
            margin: auto;
        }
        .form-container h2 {
            margin-bottom: 20px;
            font-size: 24px;
            color: #333;
        }
        .form-container input[type="text"],
        .form-container textarea {
            width: calc(100% - 20px);
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
            box-sizing: border-box;
        }
        .form-container input[type="text"]::placeholder,
        .form-container textarea::placeholder {
            color: #999;
        }
        .form-container input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .form-container input[type="submit"]:hover {
            background-color: #0056b3;
        }
        .response {
            text-align: center;
            margin-top: 20px;
            font-size: 16px;
            color: green;
        }
        h2 {
            font-size: 18px !important;
        }
        ::placeholder {
            font-size: 14px !important;
        }
        .form-row {
            display: flex;
            gap: 10px;
        }
        .form-row input {
            flex: 1;
        }
        .form-container textarea {
            width: 100%;
        }
    </style>
</head>
<body>
<div class="form-container">
    <h2>Leave a Comment</h2>
    <form name="form1" method="post" action="">
        <div class="form-row">
            <input name="WEBYEP_GB_NAME" type="text" id="WEBYEP_GB_NAME" placeholder="Name" required>
            <input name="WEBYEP_GB_EMAIL" type="text" id="WEBYEP_GB_EMAIL" placeholder="Email" required>
        </div>
        <textarea name="WEBYEP_GB_MESSAGE" id="WEBYEP_GB_MESSAGE" rows="5" placeholder="Message" required></textarea>
        <input type="submit" name="Submit" value="Send">
        <input type="hidden" name="WEBYEP_GB_MAGIC" value="4711">
    </form>
    <?php if ($sResponse) echo "<div class='response'>$sResponse</div>"; ?>
</div>
</body>
</html>
