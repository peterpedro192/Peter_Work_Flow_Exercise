<?php
//this checks to see if the person has submitted the form by clicking the submit button on contact page, if they attempt to go to the submit page (that says thanks/error) by going directly
//to the url for that page this will redirect them to the contact page so they can fill out form first
if(isset($_POST['submit'])){
    
    date_default_timezone_set('GMT');
    //Change ini_set values TODO: must emove in production, for example changing the email setting to your computer's so u can test before placing on server
    //or changing the size setting for uploads allowed by server e.g. to upload large image files
    ini_set('SMTP', 'mail.british-study.com');

    //phpinfo(); - used to test that php working correctly


    //Store form varialbls
    $name= $_POST['name'];
    $email= $_POST['email'];
    $comment= $_POST['comment'];




/*
    //Create to, message, subject and header - FOR A PLAIN TEXT EMAIL
    $to = "peterpedro192@gmail.com";
    $subject= "Contact form submission from Work Flow Exercise";
    $message= "$name has contacted you via your web site and they have commented \n\r $comment";
    $headers= "From: $email";
    //Can use single or double quotation menthod, single is more often used as most like to store emails as html

*/
 /*   
   //Create to, message, subject and header - FOR A HTML TEXT EMAIL
    $to= "peterpedro192@gmail.com";
    $subject= "Contact form submission from Work Flow Exercise";
    $message= '<h2>'.$name.' has contacted you via your web site and they have commented</h2><h3>'.$comment.'</h3>';
    $headers= "MIME-Version: 1.0 \r\n";
    $headers.= "Content-type: text/html; charset=utf-8 \r\n";
    $headers.= "From:".$email."\r\n";
   
  
  */

    
    //Creating a proper formatted html email response 
   //Create to, message, subject and header - FOR A HTML TEXT EMAIL
    $to= "peterpedro192@gmail.com";
    $subject= "Contact form submission from Work Flow Exercise";

    $headers= "MIME-Version: 1.0 \r\n";
    $headers.= "Content-type: text/html; charset=utf-8 \r\n";
    $headers.= "From:".$email."\r\n";
    
    
    $message= '
    
    <!DOCTYPE html>
    <html>
        <head>
            <title>Workflow Exercise Comment</title>
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
            <style>
                body{
                    width: 500px;
                    margin: 0 auto;
                    background: #EEEEFF;
                }
            </style>
        </head>
        <body>
            <h1>Workflow Exercise</h1>
            <p>
                <img src="http://www.hovecollege.co.uk/images/header.gif" alt="Hove College Logo" />
            </p>
            <p>
                Thank you. we have received your comment and will contact you shortly. Please feel free to 
                <a href="http://localhost/Work_Flow_Exercise/">visit our web site</a>
                and enjoy our current features free of charge.
            </p>
            <p>
                Thank you again we value your opinion.
            </p>
            <p>
                The Marketing Team
            </p>
        </body>
    </html>
    
    ';

    
    //Send email
    if(mail($to, $subject, $message, $headers)){
    //If sent say thank you
        echo '<h2>Your comment was sent thank you.</h2>';

    }else{
    //If not sent report an error
        echo '<h2>Sorry there has been a problem. Please try again.</h2>';

    }
    
}else{
    header('Location: ../../contact.html');
}

