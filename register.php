<?php
  
  require "userdb.php" ;
  
  

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Register</title>
</head>
<body>
    <?php
    // Authentication
    
        if ( !empty($_POST)) {
        extract($_POST) ; 
        $error = [] ;

        //$name = mysqli_real_escape_string($db, $_POST['name']);
        
        //$email = mysqli_real_escape_string($db, $_POST['username']);
        //$password = mysqli_real_escape_string($db, $_POST['password']);
        
        
        //$sql = "INSERT INTO auth(email, password, name) VALUES ('$email', '$password', '$name')";
        //mysqli_query($conn, $sql);
        $target_dir = "images/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        $email = $_POST["email"];
        $password = $_POST["pass"];
        $name = $_POST["name"];
        
        $birthdate = $_POST["birthdate"];
        // $picture = $_POST["picture"];
        
        $surname = $_POST["surname"];
        // $check = getimagesize($_FILES["image"]["tmp_name"]);
        // if($check !== false) {
        //     echo "File is an image - " . $check["mime"] . ".";
        //     $uploadOk = 1;
        // } else {
        //     echo "File is not an image.";
        //     $uploadOk = 0;
        // }
        if (empty($name) || empty($email) || empty($surname) || empty($password)){
            $error["field"] = "Fill all of the fields!";
        }
        else if (filter_var($email, FILTER_VALIDATE_EMAIL) === false){
            $error["email"] = "Not a valid email" ;
        }
        
        else if (strlen($password)<5){
            $error["password"] = "Enter larger password";
        }
        else if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
            $error["image"] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        }

        
       // if($email = "" or $name = "" or $email = "" or $email = "" or $email = "" or $email = "" or)
        // if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        //     echo "The file ". htmlspecialchars( basename( $_FILES["image"]["name"])). " has been uploaded.";
        //   } else {
        //     echo "Sorry, there was an error uploading your file.";
        //   }
        $image = $_FILES["image"]["name"];
        if ( empty($error)) {
        // $targetDirectory = "/Applications/MAMP/htdocs/11-Authentication/images"; // Replace with the desired destination folder path
        // $targetFile = $targetDirectory . basename($_FILES["picture"]);
        
        // // Check if the file is an image (optional)
        // $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
        // $allowedExtensions = array("jpg", "jpeg", "png", "gif"); // Add any additional allowed extensions
        /*if (!in_array($imageFileType, $allowedExtensions)) {
            echo "Only JPG, JPEG, PNG, and GIF files are allowed.";
            exit;
        }*/
        // $image = $_FILES["image"];
        // $imagePath = "/Applications/MAMP/htdocs/11-Authentication/images/" . basename($image["name"]);
        // // Move the uploaded file to the destination folder
        // if (move_uploaded_file($image["tmp_name"], $imagePath)) {
        //     echo "Image uploaded successfully.";
        // } else {
        //     echo "Sorry, there was an error uploading your image.";
        // }

    // Perform any necessary validation and sanitization

    // Hash the password
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
        // Insert new user into the database
        $stmt = $db->prepare("INSERT INTO auth (email, password,name,surname,birthdate,image) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$email, $hashedPassword,$name,$surname,$birthdate,$image]);
        

    // Redirect to a success page or perform any other necessary actions
    
    header("Location: index.php") ;
     // redirect to main page
                exit ;
    
                
        }
        else{
            foreach( $error as $e) {
                
                echo "<p class='error_msg'>$e</p>" ;
             }
        }
        ?>
        
        
            
    <?php } ?>
        
        
        

    
    
    <h1>Register</h1>
    <form action="?" method="post" enctype="multipart/form-data" class="regform">
        Name : <input type="text" name="name" >
        <br><br>
        Surname : <input type="text" name="surname" >
        <br><br>
        Email : <input type="text" name="email" value="<?= $email ?? '' ?>">
        <br><br>
        Birth Date : <input type="date" name="birthdate" >
        <br><br>
        Profile Picture : <input type="file" name="image" >
        <br><br>
        Passw : <input type="password" name="pass" >
        <br><br>
        
        
        
        <button type="submit" name="register">Register</button>
    </form>
    
</body>
</html>