<!DOCTYPE html>
<html class="no-js">
<head>
<meta charset="UTF-8">
<title>Using PHP to move files </title>
</head>
<body>

        <?php
        //isset checks to make sure form has been submitted by the user clicking the submit button
        if(isset($_POST['submit'])){
            $file_name= basename($_FILES['file']['name']); //ignores path and takes file name of whatever u select
            //this then moves the selected file into a temp position and then finally stores it in the selected path on the server
            if(move_uploaded_file($_FILES['file']['tmp_name'],"images".$file_name)){
                echo '<h2> File Uploaded successfully</h2>';
                
                //Locate file on sever
                $load= "images".$file_name;
                
                //Create file names to store new image set to lowercase
                $savesml= strtolower("images/sml_".$file_name);
                $savelrg= strtolower("images/lrg_".$file_name);
                
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
                        <a href="images/lrg_'.$file_name.'">
                        <img src="images/sml_'.$file_name.'" alt="Image" width="200" />
                        </a>
                    </p>
                    
                    

                ';
                
               
            }else{
                echo '<h2> File did not upload. Please check file and try again</h2>';
            }
        }


        ?>

        <form action="upload.php" method="post" enctype="multipart/form-data">
            <p>
                Please select file:
                <input type="file" name="file" id="file" />
            </p>
            <p>
                <input type="submit" name="submit" value="Upload File" />
            </p>
        </form>
    </body>
</html>