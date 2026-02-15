<?php
// WebYep init WebYepV1
/* ><table><tr><td bgcolor=white><h2>WebYep message: Error, PHP inactive</h2>
<font color=red>The PHP code in this page can not be executed!<ul>
<li>Are you launching this page directly form your harddisc (e.g. using a
&quot;Preview in Browser&quot function of your web design application instead of accessing it via a webserver?</li>
<li>Has this file the correct file extension for PHP scripts?
WebYep pages must have the &quot;.php&quot; extension and <b>not</b> ".html" or ".htm"!</li>
</ul></font></td></tr></table><!--
*/
$webyep_sIncludePath = "./";
$iDepth = 0;
while (!file_exists($webyep_sIncludePath . "webyep-system")) {
    $iDepth++;
    if ($iDepth > 10) {
        error_log("webyep-system folder not found.", 0);
        echo "<html><head><title>WebYep</title></head><body><b>WebYep:</b> This page can not be displayed <br>Problem: The webyep-system folder was not found!</body></html>";
        exit;
    }
    $webyep_sIncludePath = ($webyep_sIncludePath == "./") ? ("../"):("$webyep_sIncludePath../");
}
if (file_exists("${webyep_sIncludePath}webyep-system/programm")) $webyep_sIncludePath .= "webyep-system/programm";
else $webyep_sIncludePath .= "webyep-system/program";
include("$webyep_sIncludePath/webyep.php");
// -->?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Guestbook Element Test</title>
<style>
    /* Main container styling */
    .WY-container {
        font-family: 'Helvetica', 'Arial', sans-serif; /* Font family for the container */
        background-color: #f0f2f5; /* Background color of the container */
        margin: 0; /* No margin */
        padding: 26px 20px 18px 20px;  /* Padding around the container */
        display: flex; /* Flexbox layout for centering content */
        justify-content: center; /* Center horizontally */
        align-items: center; /* Center vertically */
        flex-direction: column; /* Column layout */
        width: 100%; /* Full width */
        box-sizing: border-box; /* Include padding and border in the element's total width and height */
        overflow-x: hidden; /* Prevent horizontal scroll */
    }
	
    /* Form container styling */
    .WY-form-container {
        background-color: #fff; /* White background for the form */
        padding: 20px; /* Padding inside the form */
        border-radius: 8px; /* Rounded corners */
       /* max-width: 600px;*/   /* Maximum width - Disabled for full width*/
        width: 100%; /* Full width */
        box-sizing: border-box; /* Include padding and border in the element's total width and height */
    }
	
    /* Form header styling */
    .WY-form-container h2.WY-from-header  {
        font-size: 18px; /* Font size */
        color: #333; /* Text color */
		margin: 0 0 15px 0; /* Space below the header */
    }
	
    /* Form input and textarea styling */
    .WY-form-container input[type="text"],
    .WY-form-container textarea {
        width: 100%; /* Full width */
        padding: 10px; /* Padding inside the input */
        margin-bottom: 20px; /* Space below the input */
        border: 1px solid #ccc; /* Border color and style */
        border-radius: 4px; /* Rounded corners */
        font-size: 14px; /* Font size */
        box-sizing: border-box; /* Include padding and border in the element's total width and height */
    }
	
    /* Textarea specific styling */
    .WY-form-container textarea {
        resize: vertical; /* Prevent horizontal resizing */
    }
	
    /* Submit button styling */
    .WY-form-container input[type="submit"] {
        background-color: #007bff; /* Background color */
        color: #fff; /* Text color */
        border: none; /* No border */
        padding: 10px 20px; /* Padding inside the button */
        border-radius: 4px; /* Rounded corners */
        font-size: 16px; /* Font size */
        cursor: pointer; /* Pointer cursor on hover */
        transition: background-color 0.3s ease; /* Smooth background color transition */
    }
	
    /* Submit button hover effect */
    .WY-form-container input[type="submit"]:hover {
        background-color: #0056b3; /* Background color on hover */
    }
	
    /* Guestbook entries container styling */
    .WY-guestbook-entries {
        margin-top: 16px; /* Space above the entries */
        width: 100%; /* Full width */
        font-size: 14px; /* Font size */
    }
	
    /* Individual guestbook entry styling */
    .WY-guestbook-entry {
        background-color: #fff; /* White background */
        padding: 20px; /* Padding inside the entry */
        margin-bottom: 10px; /* Space below the entry */
        border-radius: 8px; /* Rounded corners */
        border: 1px solid #ccc; /* Border color and style */
    }
	
    /* Guestbook entry header styling */
    .WY-guestbook-entry h3 {
        margin: 0; /* No margin */
        font-size: 16px; /* Font size */
        color: #333; /* Text color */
    }
	
    /* Guestbook entry paragraph styling */
    .WY-guestbook-entry p {
        margin: 10px 0 0; /* Space above the paragraph */
        color: #666; /* Text color */
    }
	
    /* Guestbook entry span styling */
    .WY-guestbook-entry span {
        display: block; /* Block display */
        margin-top: 10px; /* Space above the span */
        font-size: 12px; /* Font size */
        color: #999; /* Text color */
    }
	
    /* Guestbook entry CSS class */
    .WebYepGBEntry {
        margin: 0 0 0 0; /* Margin */
    }
	
	
	.WebYepGBName {
		font-weight: bold;
	}
	.WebYepGBDateTime {
		font-style: italic;
		font-size: 12px;
		color:grey;
	}
	.WebYepGBEMail {
		font-size: 11px;
	}
	.WebYepGBEntry a:link {
		color: blue;
		text-decoration: none;
	}
	.WebYepGBEntry a:active {
		color: #996600;
		text-decoration: none;
	}
	.WebYepGBEntry a:visited {
		color: #996600;
		text-decoration: none;
	}
	.WebYepGBEntry a:hover {
		color: #999999;
		text-decoration: none;
	}
	.WebYepGBMessage {
		padding-bottom: 10px;
	}
	
    /* Divider styling */
    .WY-GB-divider {
        color: #fff; /* Divider color */
    }
	
    /* Form row styling */
    .form-row {
        display: flex; /* Flexbox layout */
        gap: 15px; /* Space between items */
    }
	
    /* Form row input field styling */
    .form-row input[type="text"] {
        width: 100%; /* Full width */
    }
    
</style>
</head>
<body>
	<p> <?php webyep_logonButton(true); // WebYepV1/2 ?> </p>
<div class="WY-container">
    <div class="WY-form-container">
        <h2 class="WY-from-header">Leave a Comment</h2>
        <form name="webyep-guestbook-form" method="post" action="<?=$_SERVER['PHP_SELF']?>" onsubmit="this.WEBYEP_GB_MAGIC.value=4711;">
            <div class="form-row">
                <input name="WEBYEP_GB_NAME" type="text" id="WEBYEP_GB_NAME" placeholder="Name" required>
                <input name="WEBYEP_GB_EMAIL" type="text" id="WEBYEP_GB_EMAIL" placeholder="Email" required>
            </div>
            <textarea name="WEBYEP_GB_MESSAGE" id="WEBYEP_GB_MESSAGE" rows="5" placeholder="Message" required></textarea>
            <input type="submit" name="Submit" value="Send">
            <input type="hidden" name="WEBYEP_GB_MAGIC" value="">
        </form>
    </div>
    <div class="WY-guestbook-entries">
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['WEBYEP_GB_MAGIC']) && $_POST['WEBYEP_GB_MAGIC'] == 4711) {
            $sName = $_POST['WEBYEP_GB_NAME'];
            $sEmail = $_POST['WEBYEP_GB_EMAIL'];
            $sMessage = $_POST['WEBYEP_GB_MESSAGE'];
            
            // Add the entry to the guestbook (change the email address to a real email address)
            webyep_guestbook("TheGuestbook", 200, "example@nowheremail.com", true);
            
            // Redirect to avoid form resubmission
            header("Location: " . $_SERVER['PHP_SELF']);
            exit;
        } // WebYepV3 ?>
        <hr class="WY-GB-divider">
		<!-- Change the email address to a real email address -->
        <?php webyep_guestbook("TheGuestbook", 200, "example@nowheremail.com", true); // WebYepV3 ?>
        <hr class="WY-GB-divider">
    </div>
</div>
</body>
</html>
