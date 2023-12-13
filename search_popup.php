<?php
session_start();
require "userdb.php";

// Check if the user is authenticated
if (!validSession()) {
    header("Location: index.php?error");
    exit;
}

// Check if search form is submitted
if (isset($_POST['search'])) {
    $searchTerm = $_POST['searchTerm']; // Get the search term entered by the user

    // Retrieve friends from the database based on the search term
    $query = "SELECT * FROM your_table_name WHERE name LIKE '%$searchTerm%' OR surname LIKE '%$searchTerm%' OR email LIKE '%$searchTerm%'"; // Modify "your_table_name" with the actual table name and adjust column names

    $result = mysqli_query($conn, $query); // Assuming you have a database connection established

    // Check if any rows were returned
    if (mysqli_num_rows($result) > 0) {
        // Loop through each row and display the friend's data
        while ($row = mysqli_fetch_assoc($result)) {
            echo "Name: " . $row['name'] . "<br>";
            echo "Surname: " . $row['surname'] . "<br>";
            echo "Email: " . $row['email'] . "<br>";
            // Display other relevant data
            echo "<br>";
        }
    } else {
        echo "No friends found matching the search criteria";
    }

    // Close the database connection
    mysqli_close($conn);
}
?>

<!-- HTML form for the search functionality -->
<form method="POST" action="">
    <input type="text" name="searchTerm" placeholder="Search by name, surname, or email">
    <button type="submit" name="search">Search</button>
</form>
