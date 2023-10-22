<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the form data
    $title = isset($_POST["title"]) ? $_POST["title"] : "";
    // $body = isset($_POST["text-editor"]) ? $_POST["text-editor"] : "";
    $body =isset($_POST['editor']) ?($_POST['editor']): "";
    $topic = isset($_POST["topic"]) ? $_POST["topic"] : "";
    $published = isset($_POST["published"]) ? "Yes" : "No";

    // echo "<h1>Posted Data:</h1>";
    // echo "<p><strong>Title:</strong> " . $title . "</p>";
    // echo "<p><strong>Body:</strong> " . $body . "</p>";
    // echo "<p><strong>Topic:</strong> " . $topic . "</p>";
    // echo "<p><strong>Published:</strong> " . $published . "</p>";
    // Create a database connection (update with your database credentials)
 $server = "localhost";
  $username = "root";
  $password = "";
$dbname = "blog_website";

 $conn = new mysqli($server, $username, $password, $dbname);

  // Check the connection
 if ($conn->connect_error) {
//         die("Connection failed: " . $conn->connect_error);
 }

   // Insert the data into the database
   $sql = "INSERT INTO posts (title, body, topic, published) VALUES (?, ?, ?, ?)";
   $stmt = $conn->prepare($sql);
   $stmt->bind_param("ssss", $title, $body, $topic, $published);

     if ($stmt->execute()) {
        echo "Data inserted into the database successfully.";
     } else {
       echo "Error: " . $stmt->error;
    }

//     // Close the database connection
    $stmt->close();
     $conn->close();
} else {
//     // Print an error message for invalid requests
    echo "Invalid request. Please submit the form with valid data.";
}
?>
