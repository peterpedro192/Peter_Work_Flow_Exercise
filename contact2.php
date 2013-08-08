<?php include('includes/head.inc');?>
        <title>Redux Mail PHP</title>
        <base href="http://localhost/Work_Flow_Exercise/" />
<script src="assets/libs/modernizr/min/modernizr.min.js"></script>
<link href="assets/css/core.css" rel="stylesheet" />
<style>
	section{
		display: block;
	}
	.form{
		width: 100%;
		display: table;
	}
	.form label{
		display: table-row;

	}
	.form label span{
		width: 30%;
		display: table-cell;
		margin: 1em 0;
	}
	.form label input,.form label textarea{
		width: 70%;
		display: table-cell;
		margin: 1em 0;
	}
</style>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    </head>
    <body>
        
        


<!--Page Head-->


<div id="wrapper">
<header>
        <h1>The site</h1>
        <?php include('includes/nav.inc');?>
</header>

<div id="content">
    <section>
        <h2>Contact Me Online</h2>

<!--Mail Script-->
<?php
    if(isset($_POST['submit'])){

        ini_set('SMTP', 'mail.british-study.com');

        $name= $_POST['name'];
        $email= $_POST['email'];
        $comment= $_POST['comment']; 


        $to= "peterpedro192@gmail.com";
        $subject= "Web Site Contact form submission from Work Flow Exercise";

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
        
        if(mail($to, $subject, $message, $headers)){
            echo '<h3>Thank you for your comment.</h3>';
        }else {
            echo ',<h3>Sorry, please try again later.</h3>';
        }
        
    }else{
        
        
    
    
    

?>



<!--Contact Form-->

        <form class="form" id="contactform" action="contact2.php" method="post">
                        <label>
                                <span>Name:</span>
                                <input type="text" name="name" id="name" required />
                        </label>
                        <label>
                                <span>Email:</span>
                                <input type="email" name="email" id="email" required />
                        </label>
                        <label>
                                <span>Comment:</span>
                                <textarea cols="18" rows="8" name="comment" id="comment"></textarea>
                        </label>
                        <label>
                                <span>&nbsp;</span>
                                <input type="submit" name="submit" value="Send Comment" />
                        </label>
	</form>

    <?php

    }//if submit then displays message and form disappears (not normallyu what we want), if not will re-display form. Note the spanning of php across html
    
    ?>

<!--Page Foot-->


    </section>
</div>

     <?php include('includes/foot.inc');?>
 