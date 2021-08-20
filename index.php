<?php
//post vars
$name = $email = $message = "";
 //message Vars
 $msg = '';

 if (filter_has_var(INPUT_POST, 'submit')) {

    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);
    
    //check
    if (!empty($name) && !empty($email) && !empty($message)) {
       
        //check email
        if (filter_var($email, FILTER_VALIDATE_EMAIL) === false){

        $msg = 'Please use a valid email';

        } else {
            //Passed
            $toEmail = 'workoffsets@gmail.com';
            $subject = 'Contact Request From'.$name;
            $body = '<h2>Contact Rquest</h2>
                   <h4>Name</h4><p>'.$name.'</p>
                   <h4>Email</h4><p>'.$email.'</p>
                   <h4>Message</h4><p>'.$message.'</p>';

                   //email Headers
                   $headers = "MIME-Version: 1.0" . "\r\n";
                   $headers .="Content-Type:text/html;charset=UTF-8" . "\r\n";

                   //Addi Headers
                   $headers .= "From: " .$name. "<" .$email. ">". "\r\n";

                   if (mail($toEmail, $subject, $body, $headers)) {
                       //email success
                       $msg = 'Your email has been sent';
                   } else {
                        //Email failed
                        $msg = 'Your email failed';
                   }
        }
    } else{
        $msg = 'Please fill in all fields';
    }
 }

 include 'db_connect.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);

    $sql = "INSERT INTO request(name, email, message) VALUES('$name, $email, $message')";
    $results = mysqli_query($conn, $sql);

    //save to db and check
    if (mysqli_query($conn, $sql)) {
        //success
    } else {
        echo 'query error: ' . mysqli_error($conn);
    }
    //free result from memory
    mysqli_free_result($result);

    //close connection
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resume</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <nav class="navbar navbar-default" style="background-color: black">
        <div class="container">
            <div class="navbar-header">
                <a href="#" class="navbar-brand">My Resume</a>
            </div>
        </div>
    </nav>
    <section class="slider-container">
    <div class="left-slide">
        <div class="img">
                    <img src="img/IMG.jpg" alt="Fadare"> <hr>
        </div>
        <div class="detail">
        <h4>FADARE AYODEJI</h4>
            <p>Web Developer, Programmer & Enterpreneur</p>
            <p><i class="fa fa-briefcase"></i> Backend Developer</p>
            <p><i class="fa fa-envelope"></i> Ayordejidaniel@gmail.com</p>
            <p><i class="fa fa-phone"></i> +2347062447566</p>
        </div>   
    </div>
    <div class="right-slide">
    <div class="container-1">

                <div class="skills center">
                    <h3>Skills</h3>
                    HTML5 <br>
                    CSS3 <br>
                    JavaScript <br>
                    PHP <hr>
                </div>

            <div class="container-2">
                <div class="education center">
                    <h3 class="edu">Education</h3>
                    Bsc. Radiography <br>
                    University of Lagos <br>
                    2015 - 2019 <hr>
                </div>

                <div class="softskills center">
                    <h3 class="soft">Soft Skills</h3>
                    Diligency <br>
                    Highly-motivated <br>
                    Objective-driven <br>
                    Great team player <br>
                    Good communication and interpersonal skills

                </div>
            </div>
    </div>
    </section>
    <div class="request">
        <h4>Make A Request</h4>
        <?php if($msg != ''): ?>
            <div class="red-text"><?php echo $msg; ?></div>
        <?php endif; ?>
        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post" class="my-form">
            <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" class="form" value="<?php echo isset($_POST['name']) ? $name: ''; ?>">
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="text" name="email" class="form" value="<?php echo isset($_POST['email']) ? $email: ''; ?>">
            </div>
            <div class="form-group">
                <label>Message</label>
                <textarea name="message" class="form"><?php echo isset($_POST['message']) ? $message: ''; ?></textarea>
            </div>
            <input type="submit" value="submit" class="btn">
        </form>
        <footer class="footer">
            <div class="zuri-logo">
                Zuri<b id="dot">.</b>Intenship
            </div>
            <div class="copyright">
                &copy 2021 Fadare Ayodeji
            </div>
        </footer>
    </div>
</body>
</html>