<?php
  session_start();
  require_once "userdb.php" ;
  
  // auto login 
  if ( validSession()) {
      header("Location: main.php") ;
      exit ;
  }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style2.css">
    <title>Login</title>
    <style>
        .hint { color: #AAA; font-style: italic }
        .error { color: red; font-style: italic;}
    </style>
</head>
<body>
    <?php
    
    // Authentication
     if ( !empty($_POST)) {
        extract($_POST) ;
        
        if (isset($_POST['login'])) {
           
            if ( checkUser($email, $pass) ) {
            // the user is authenticated
            // Store data to use in other php files.
                
                $_SESSION["user"] = getUser($email) ;
                header("Location: main.php") ; // redirect to main page
                exit ;
            }
            $authError = true ;
        }
        
        else if(isset($_POST['register'])){
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
        
        
                    
            }
            else{
                foreach( $error as $e) {
                    
                    echo "<p class='error_msg'>$e</p>" ;
                 }
            }
            ?>
            
       <?php }
        

    } 
    ?>

<div class="container">
    <input type="checkbox" id="flip">
    <div class="cover">
      <div class="front">
        <img src="picture/frontImg.jpg" alt="">
        <div class="text">
          <span class="text-1">Every new friend is a <br> new adventure</span>
          <span class="text-2">Let's get connected</span>
        </div>
      </div>
      <div class="back">
        <img class="backImg" src="picure/backImg.jpg" alt="">
        <div class="text">
          <span class="text-1">Complete miles of journey <br> with one step</span>
          <span class="text-2">Let's get started</span>
        </div>
      </div>
    </div>
    <div class="forms">
        <div class="form-content">
          <div class="login-form">
            <div class="title">Login</div>
          <form action="?" method="post">
            <div class="input-boxes">
              <div class="input-box">
                <i class="fas fa-envelope"></i>
                <input type="text" placeholder="Enter your email" required name="email" value="<?= $email ?? '' ?>">
              </div>
              <div class="input-box">
                <i class="fas fa-lock"></i>
                <input type="password" placeholder="Enter your password" name="pass" required>
              </div>
              <div class="text"><a href="#">Forgot password?</a></div>
              <div class="button input-box">
                <input type="submit" value="Submit" name="login">
              </div>
              <div class="text sign-up-text">Don't have an account? <label for="flip">Signup now</label></div>
            </div>
        </form>
      </div>
        <div class="signup-form">
          <div class="title">Signup</div>
        <form action="?" method="post" enctype="multipart/form-data">
            <div class="input-boxes">
              <div class="input-box">
                <i class="fas fa-user"></i>
                <input type="text" placeholder="Enter your email" required name="email" value="<?= $email ?? '' ?>">
              </div>
              <div class="input-box">
                <i class="fas fa-envelope"></i>
                <input type="text" placeholder="Enter your name" name="name" required>
              </div>
              <div class="input-box">
                <i class="fas fa-user"></i>
                <input type="text" placeholder="Enter your surname" name="surname" required>
              </div>
              <div class="input-box">
                <i class="fas fa-lock"></i>
                <input type="date" placeholder="Enter your birthdate" name="birthdate" required>
              </div>
              <div class="input-box">
                <i class="fas fa-lock"></i>
                <input type="file" placeholder="Select picture for profile" name="image" required>
              </div>
              <div class="input-box">
                <i class="fas fa-lock"></i>
                <input type="password" placeholder="Enter your password" name="pass" required>
              </div>
              <div class="button input-box">
                <input type="submit" value="Submit" name="register">
              </div>
              <div class="text sign-up-text">Already have an account? <label for="flip">Login now</label></div>
            </div>
      </form>
    </div>
    </div>
    </div>
  </div>


    
    

    <?php
      // Authentication Error Message
      if( isset($authError)) {
        echo "<p class='error'>Wrong email or password</p>" ;
      }

      // Direct access to main page error message
      if ( isset($_GET["error"])) {
          echo "<p class='error'>You tried to access main.php directly</p>" ;
      }

    ?>
</body>
</html>