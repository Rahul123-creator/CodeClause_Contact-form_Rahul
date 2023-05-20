<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact form design</title>

    <link rel="stylesheet" href="style.css">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<body>
    <div class="contact-form">
    <h2>CONTACT US</h2>
    <form method="post" action="">
        <input type="text" name="name" placeholder="Your Name" required>
        <input type="text" name="phone" placeholder="Phone number" required>
        <input type="email" name="email" placeholder="Your Email" required>
        <textarea name="message" placeholder="Your message" required></textarea>
        <div class="g-recaptcha" data-sitekey="6LdDBSQmAAAAAAhCD8JVhUET_VGUjwlwmYqAhSoG"></div>
        <input type="submit" name="submit" placeholder="Send meassage" class="submit-btn">
    </form>
    <div class="status">

        <?php
        if(isset($_POST['submit']))
        {
            $User_name = $_POST['name'];
            $phone = $_POST['phone'];
            $User_email = $_POST['email'];
            $User_message = $_POST['message'];

            $email_from = 'noreply@localhost';
            $email_subject = "Form Submission";
            $email_body = "Name: $User_name.\n".
                          "Phone number: $phone.\n".
                          "Email Id: $User_email.\n".
                          "User Message: $User_message.\n";

            $to_email = "rahulpaulkv12@gmail.com";
            $headers = "From: $email_from \r\n";
            $headers = "Reply-To: $User_email\r\n";
            
            $secretKey = "6LdDBSQmAAAAAMesqYj5fqngwgey-N-Bc7EbRyek";
            $responseKey = $_POST['g-recaptcha-response'];
            $UserIp = $_SERVER['REMOTE_ADDR'];
            $url = "https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$responseKey&remoteip=$UserIp";

            $response = file_get_contents($url);
            $response = json_decode($response);

            if($response->success)
            {
                mail($to_email,$email_subject,$email_body,$headers);
                echo "Message sent Successfully";
            }
            else
            {
                echo "<span>Invalid Captcha, Please Try Again</span>";
            }
        } 
        ?>
    </div>
    </div>
</body>
</html>