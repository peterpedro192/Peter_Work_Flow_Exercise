<?php include('includes/head.inc');?>
        <title>Redux Contact Form with Mail Script</title>
        <base href="http://localhost/Peter_Work_Flow_Exercise/" />
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
            //Additon of image upload script
            if(!empty($_FILES['file'])){
            $file_name= basename($_FILES['file']['name']); //ignores path and takes file name of whatever u select
            //this then moves the selected file into a temp position and then finally stores it in the selected path on the server
            if(move_uploaded_file($_FILES['file']['tmp_name'],"assets/scripts/images/".$file_name)){
                echo '<h2> File Uploaded successfully</h2>';
                
                         //Locate file on sever
                $load= "assets/scripts/images/".$file_name;
                
                //Create file names to store new image set to lowercase
                $savesml= strtolower("assets/scripts/images/sml_".$file_name);
                $savelrg= strtolower("assets/scripts/images/lrg_".$file_name);
                
                //Detect type of file
                $ext=$_FILES['file']['type'];
                if(($ext=="image/jpg")||($ext=="image/jpeg")){
                    $src=  imagecreatefromjpeg($load);
                }else if($ext=="image.png"){
                    $src= imagecreatefrompng($load);
                }else{
                    $src = imagecreatefromgif($load);
                }
                
                //Detect current file dimensions
                list($width,$height) = getimagesize($load);
                
                //Set size of new small image
                $newwidth=200;
                    
                    //Calculate proportional size 
                    $newheight=($height/$width)*$newwidth;
                    //Create blank canvas
                    $tmp = imagecreatetruecolor($newwidth, $newheight);
                //copy image from original and resize to canvas
                imagecopyresampled($tmp, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
                //save image in to jpeg and store in folder with new name
                imagejpeg($tmp,$savesml,80);
                
                
                
                //Set size of new large image
                $newwidth=800;
                    
                    //Calculate proportional size 
                    $newheight=($height/$width)*$newwidth;
                    //Create blank canvas
                    $tmp = imagecreatetruecolor($newwidth, $newheight);
                //copy image from original and resize to canvas
                imagecopyresampled($tmp, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
                //save image in to jpeg and store in folder with new name
                imagejpeg($tmp,$savelrg,80);
                
                
                
                echo '
                    <p>
                        <a href="assets/scripts/images/lrg_'.$file_name.'">
                        <img src="assets/scripts/images/sml_'.$file_name.'" alt="Image" width="200" />
                        </a>
                    </p>
                    
                    

                ';

                }else{
                    echo '<h2> File did not upload. Please check file and try again</h2>';
                }
            }
        
                    

               
            }
        else {
            echo ',<h3>Sorry, please try again later.</h3>';
        }
        
    }
    

?>



<!--Contact Form-->

        <form class="form" id="contactform" action="contact2.php" method="post" enctype="multipart/form-data">
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
                        <!--Addition of file input on form here -->
                        <label>
                            
                            <span>Upload Image:</span>
                            <input type="file" name="file" id="file" />
                        </label>
            
                        <label>
                                <span>&nbsp;</span>
                                <input type="submit" name="submit" id="submit" value="Send Comment" />
                        </label>
                       
                      
                           
	</form>

  

<!--Page Foot-->


    </section>
</div>

     <?php include('includes/foot.inc');?>
 