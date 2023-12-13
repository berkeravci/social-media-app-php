<?php
  
  session_start() ;
  // check if the user authenticated before
  
 
  $userData = $_SESSION["user"] ;
//   $userData = getUser($token) ;
    // $query = "SELECT image_url FROM your_table_name WHERE email = 'avci@gmail.com'";
    // $result = mysqli_query($conn, $query);
    // if (mysqli_num_rows($result) == 1) {
    //     $row = mysqli_fetch_assoc($result);
        
    //     // Display the image associated with the email
    //     $imageURL = $row['image'];
    // }

?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile page - SocialBook - Easy Tutorials</title>
    <link rel="stylesheet" href="style3.css">
    <script src="https://kit.fontawesome.com/c4254e24a8.js" crossorigin="anonymous"></script>
    <style>
    .search-field {
      display: none;
      display: flex;
      
       /* Hide the search field by default */
    }
    #searchField{
        display: flex;
    }
    .sb{
        margin-top: 3%;
        width: 90%;
        height: 50px;
        font-style: italic;
        border-radius: 0.2cm;
        border: none;
        
    }
    .sbt{
        height: 50px;
        width: 8%;
        border-radius: 0.2cm;
        background: #1876f2;
        border: none;
        color: white;
        
    }
    #send{
        display: none;
        margin-left: 50px;
    }
    .requestarea{
        display: flex;
    }
    
  </style>
</head>
<script>
function toggleSearchField() {
      var searchField = document.getElementById("searchField");
      if (searchField.style.display === "none") {
        searchField.style.display = "flex"; // Show the search field
      } else {
        searchField.style.display = "none"; // Hide the search field
      }
    }
</script>
<script>
    function showreq(){
    var requestarea = document.getElementById("requestarea");
    requestarea.style.display = "flex";
    }
</script>
<script>
        function updateText() {
            // Get the form input value
            var inputValue1 = document.getElementById("inputField1").value;
            var inputValue2 = document.getElementById("inputField2").value;

            // Update the paragraph text with the form input value
            document.getElementById("outputText").textContent = inputValue1 + " " + inputValue2; 
            var send = document.getElementById("send");
            send.style.display = "block";
            

            
        }
    </script>
<body>
<?php
    
    // Authentication
     if ( !empty($_POST)) {
        extract($_POST) ;
        require "userdb.php";
        
        
        if(isset($_POST['search'])){
            $error = [] ;

            $data1 = $_POST['searchTerm1'];
            $data2 = $_POST['searchTerm2'];
            $data3 = $_POST['searchTerm3'];
            
            $stmt = $db->prepare("SELECT * FROM auth");
            $stmt->execute();
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (count($rows) > 0) {
                // Loop through each row and display the data
                foreach ($rows as $row) {
                    // Access the data fields using the column names
                    if($row['name'] == $data1){
                        echo "User found";
                    }
                    $name = $row['name'];
                    $email = $row['email'];
                    // ... access other fields
            
                    // Display the data
                    echo "Name: " . $name . "<br>";
                    echo "Email: " . $email . "<br>";
                    // ... display other fields
                    echo "<br>";
                }
            } else {
                echo "No rows found in the table";
            }



            
            
    
        // Redirect to a success page or perform any other necessary actions
        
        
                    
            
            ?>
            
       <?php }
        

    } 
    ?>
    
    <nav>
        <div class="nav-left">
            <a href="main.php"><img src="images/logo2.png" class="logo"></a>
        <ul>
           
            <li><img src="images/notification.png"></li>
            <li><img src="images/inbox.png"></li>
            <li><img src="images/video.png"></li>
        </ul>
        </div>
        
        <div class="nav-right">
            <div class="search-box">
                <img src="images/search.png">
                <input type="text" placeholder="Search">
            </div>
            <div class="nav-user-icon online" onclick="settingsMenuToggle()">
                <img src="images/<?= $userData["image"] ?>">
            </div>
            
        </div>
        <!-- ------dropdown-settings-menu--------- -->
        <div class="settings-menu">
            <div id="dark-btn">
                <span></span>
            </div>
            <div class="settings-menu-inner">
                <div class="user-profile">
                    <img src="images/<?= $userData["image"] ?>">
                    <div>
                        <p><?= $userData["name"] ?></p>
                        <a href="profile.php">See your profile</a>
                    </div>
                </div>
                <hr>
                <div class="user-profile">
                    <img src="images/feedback.png">
                    <div>
                        <p>Give Feedback</p>
                        <a href="">Help us improve the new deisgn</a>
                    </div>
                </div>
                <hr>
                <div class="settings-links">
                    <img src="images/setting.png" class="settings-icon">
                    <a href="">Settings & Privacy <img src="images/arrow.png" width="10px"></a>
                </div>
                <div class="settings-links">
                    <img src="images/help.png" class="settings-icon">
                    <a href="">Help & Support <img src="images/arrow.png" width="10px"></a>
                </div>
                <div class="settings-links">
                    <img src="images/display.png" class="settings-icon">
                    <a href="">Display & Accessibility <img src="images/arrow.png" width="10px"></a>
                </div>
                <div class="settings-links">
                    <img src="images/logout.png" class="settings-icon">
                    <a href="">Logout <img src="images/arrow.png" width="10px"></a>
                </div>
            </div>
            
        </div>
    </nav>

    <!-- ----profile page --------- -->

<div class="profile-container">
    <img src="images/cover.png" class="cover-img">
    <div class="profile-details">
        <div class="pd-left">
            <div class="pd-row">
                <img src="images/<?= $userData["image"] ?>" class="pd-image">
                <div>
                    <h3><?= $userData["name"] ?> <?= $userData["surname"] ?></h3>
                    <p>120 Friends - 20 mutual</p>
                    <img src="images/member-1.png">
                    <img src="images/member-2.png">
                    <img src="images/member-3.png">
                    <img src="images/member-4.png">
                </div>
            </div>
            
        </div>
        <div class="pd-right">

            <button type="button" onclick="toggleSearchField()"><img src="images/add-friends.png">Friend</button>
            <button type="button"><img src="images/message.png"> Message</button>
            <br>
            <a href=""><img src="images/more.png"></a>
        </div>
    </div>
    <div id="searchField" class="search-field">
    <form action="?" method="post" onsubmit="event.preventDefault(); updateText();">
      <input id="inputField1" class="sb"type="text" name="searchTerm1" placeholder="Enter Name">
      <input id="inputField2" class="sb"type="text" name="searchTerm2" placeholder="Enter Surname">
      <input id="inputField" class="sb"type="text" name="searchTerm3" placeholder="Enter Email">
      <button type="submit" class="sbt" name="search" onclick="showreq()" style="width: 90%">Search</button>
    </form>
  </div>
  <div class="requestarea" id="requestarea">
  <p id="outputText" style = "font-size: 30px;margin-top: 20px"></p>
        <button id="send" type="submit" class="sbt" name="send" style = "margin-top: 20px">Send Request</button>
  </div>

    <div class="profile-info">
        <div class="info-col">

            <div class="profile-intro">
                <h3>Intro</h3>
                <p class="intro-text">Believe in yourself and you can do unbelievable things. <img src="images/feeling.png"></p>
                <hr>
                <ul>
                    <li><img src="images/profile-job.png"> Director at 99media Ltd</li>
                    <li><img src="images/profile-study.png"> Studied at Amity University</li>
                    <li><img src="images/profile-study.png"> Went to DPS Delhi</li>
                    <li><img src="images/profile-home.png"> Lives in Bangalore, India</li>
                    <li><img src="images/profile-location.png"> From Bangalore, India</li>
                </ul>
            </div>

            <div class="profile-intro">
                <div class="title-box">
                    <h3>Photos</h3>
                    <a href="">All Photos</a>
                </div>
                
                <div class="photo-box">
                    <div><img src="images/photo1.png"></div>
                    <div><img src="images/photo2.png"></div>
                    <div><img src="images/photo3.png"></div>
                    <div><img src="images/photo4.png"></div>
                    <div><img src="images/photo5.png"></div>
                    <div><img src="images/photo6.png"></div>
                </div>
            </div>

            <div class="profile-intro">
                <div class="title-box">
                    <h3>Friends</h3>
                    <a href="">All Friends</a>
                </div>
                <p>120 (10 mutual)</p>
                <div class="friends-box">
                    <div><img src="images/member-1.png"> <p>Joseph N</p></div>
                    <div><img src="images/member-2.png"> <p>Nathan N</p></div>
                    <div><img src="images/member-3.png"> <p>George D</p></div>
                    <div><img src="images/member-4.png"> <p>Francis L</p></div>
                    <div><img src="images/member-5.png"> <p>Anthony E</p></div>
                    <div><img src="images/member-6.png"> <p>Michael A</p></div>
                    <div><img src="images/member-7.png"> <p>Edward M</p></div>
                    <div><img src="images/member-8.png"> <p>Bradon C</p></div>
                    <div><img src="images/member-9.png"> <p>James Doe</p></div>
                </div>
            </div>

            



        </div>



        <div class="post-col">
            <div class="write-post-container">
                <div class="user-profile">
                    <img src="images/profile-pic.png">
                    <div>
                        <p>John Nicholson</p>
                        <small>Public <i class="fas fa-caret-down"></i></small>
                    </div>
                </div>
    
                <div class="post-input-container">
                    <textarea rows="3" placeholder="What's on your mind, Jack?"></textarea>
                    <div class="add-post-links">
                        <a href="#"><img src="images/live-video.png"> Live Video</a>
                        <a href="#"><img src="images/photo.png"> Photo/Video</a>
                        <a href="#"><img src="images/feeling.png"> Feeling/Activity</a>
                    </div>
                </div>
            </div>
            <div class="post-container">
                <div class="post-row">
                    <div class="user-profile">
                        <img src="images/profile-pic.png">
                        <div>
                            <p>John Nicholson</p>
                            <span>June 24 2021, 13:40 pm</span>
                        </div>
                    </div>
                    <a href="#"><i class="fas fa-ellipsis-v"></i></a>
                </div>
                <p class="post-text">Subscribe <span>@Easy Tutorials</span> YouTube channel to watch more videos on website developement and UI designs. <a href="">#EasyTutorials</a> <a href="">#YouTubeChannel</a></p>
                <img src="images/feed-image-1.png" class="post-img">
                <div class="post-row">
                    <div class="activity-icons">
                        <div><img src="images/like-blue.png"> 120</div>
                        <div><img src="images/comments.png"> 45</div>
                        <div><img src="images/share.png"> 20</div>
                    </div>
                    <div class="post-profile-icon">
                        <img src="images/profile-pic.png"> <i class="fas fa-caret-down"></i>
                    </div>
                </div>
    
            </div>
    
            <div class="post-container">
                <div class="post-row">
                    <div class="user-profile">
                        <img src="images/profile-pic.png">
                        <div>
                            <p>John Nicholson</p>
                            <span>June 24 2021, 13:40 pm</span>
                        </div>
                    </div>
                    <a href="#"><i class="fas fa-ellipsis-v"></i></a>
                </div>
                <p class="post-text">Like and share this video with friends, tag <span>@Easy Tutorials</span> facebook page on your post. Ask you doubts in the comments <a href="">#EasyTutorials</a> <a href="">#Subscribe</a></p>
                <img src="images/feed-image-2.png" class="post-img">
                <div class="post-row">
                    <div class="activity-icons">
                        <div><img src="images/like.png"> 120</div>
                        <div><img src="images/comments.png"> 45</div>
                        <div><img src="images/share.png"> 20</div>
                    </div>
                    <div class="post-profile-icon">
                        <img src="images/profile-pic.png"> <i class="fas fa-caret-down"></i>
                    </div>
                </div>
    
            </div>
    
            <div class="post-container">
                <div class="post-row">
                    <div class="user-profile">
                        <img src="images/profile-pic.png">
                        <div>
                            <p>John Nicholson</p>
                            <span>June 24 2021, 13:40 pm</span>
                        </div>
                    </div>
                    <a href="#"><i class="fas fa-ellipsis-v"></i></a>
                </div>
                <p class="post-text">Like and share this video with friends, tag <span>@Easy Tutorials</span> facebook page on your post. Ask you doubts in the comments <a href="">#EasyTutorials</a> <a href="">#Subscribe</a></p>
                <img src="images/feed-image-3.png" class="post-img">
                <div class="post-row">
                    <div class="activity-icons">
                        <div><img src="images/like.png"> 120</div>
                        <div><img src="images/comments.png"> 45</div>
                        <div><img src="images/share.png"> 20</div>
                    </div>
                    <div class="post-profile-icon">
                        <img src="images/profile-pic.png"> <i class="fas fa-caret-down"></i>
                    </div>
                </div>
    
            </div>
    
            <div class="post-container">
                <div class="post-row">
                    <div class="user-profile">
                        <img src="images/profile-pic.png">
                        <div>
                            <p>John Nicholson</p>
                            <span>June 24 2021, 13:40 pm</span>
                        </div>
                    </div>
                    <a href="#"><i class="fas fa-ellipsis-v"></i></a>
                </div>
                <p class="post-text">Like and share this video with friends, tag <span>@Easy Tutorials</span> facebook page on your post. Ask you doubts in the comments <a href="">#EasyTutorials</a> <a href="">#Subscribe</a></p>
                <img src="images/feed-image-4.png" class="post-img">
                <div class="post-row">
                    <div class="activity-icons">
                        <div><img src="images/like.png"> 120</div>
                        <div><img src="images/comments.png"> 45</div>
                        <div><img src="images/share.png"> 20</div>
                    </div>
                    <div class="post-profile-icon">
                        <img src="images/profile-pic.png"> <i class="fas fa-caret-down"></i>
                    </div>
                </div>
    
            </div>
    
            <div class="post-container">
                <div class="post-row">
                    <div class="user-profile">
                        <img src="images/profile-pic.png">
                        <div>
                            <p>John Nicholson</p>
                            <span>June 24 2021, 13:40 pm</span>
                        </div>
                    </div>
                    <a href="#"><i class="fas fa-ellipsis-v"></i></a>
                </div>
                <p class="post-text">Like and share this video with friends, tag <span>@Easy Tutorials</span> facebook page on your post. Ask you doubts in the comments <a href="">#EasyTutorials</a> <a href="">#Subscribe</a></p>
                <img src="images/feed-image-5.png" class="post-img">
                <div class="post-row">
                    <div class="activity-icons">
                        <div><img src="images/like.png"> 120</div>
                        <div><img src="images/comments.png"> 45</div>
                        <div><img src="images/share.png"> 20</div>
                    </div>
                    <div class="post-profile-icon">
                        <img src="images/profile-pic.png"> <i class="fas fa-caret-down"></i>
                    </div>
                </div>
    
            </div>
        </div>
    </div>



</div>






    <div class="footer">
        <p>Copyright 2021 - Easy Tutorials YouTube Channel</p>
    </div>

    <script src="script.js"></script>
</body>
</html>