<!-- Code to Insert Blog Post Data -->
<?php
$title = $_POST["title"];
$body = $_POST["text-editor"];
//$image = $_FILES["image"]["name"];  // Use $_FILES to get the uploaded image name
$topic = $_POST["topic"];

$host = "localhost";
$username = "root";
$password = "";
$dbname = "blog_website";

// Create connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Use prepared statements to prevent SQL injection
$sql = "INSERT INTO post(title, body, topic) VALUES (?, ?, ?)";

// Prepare the statement
$stmt = $conn->prepare($sql);

if ($stmt) {
  // Bind the parameters
  $stmt->bind_param("ssss", $title, $body, $topic);

  // Execute the statement
  if ($stmt->execute()) {
    echo "New record created successfully";
  } else {
    echo "Error: " . $stmt->error;
  }

  // Close the statement
  $stmt->close();
} else {
  echo "Error: " . $conn->error;
}

// Close the connection
$conn->close();
?>


<!--Code to Handle Image Upload-->
<?php
if (isset($_POST['submit'])) {
    $folder = 'images/'; // The directory where you want to save the images
    $image_file = $_FILES['image']['name'];
    $file = $_FILES['image']['tmp_name'];
    $path = $folder . $image_file;
    $target_file = $folder . basename($image_file);
    $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);

    $error = array(); // Initialize an error array

    // Check if the file type is allowed (jpg, jpeg, png)
    $allowed_extensions = array('jpg', 'jpeg', 'png');
    if (!in_array(strtolower($imageFileType), $allowed_extensions)) {
        $error[] = 'Sorry, only JPG, JPEG, and PNG files are allowed.';
    }

    // Check the file size (for example, limit it to 1 MB)
    $max_file_size = 1 * 1024 * 1024; // 1 MB
    if ($_FILES['image']['size'] > $max_file_size) {
        $error[] = 'File size is too large. Maximum allowed size is 1 MB.';
    }

    if (empty($error)) {
        if (move_uploaded_file($file, $target_file)) {
            echo "Image uploaded successfully.";
            // The image path is now in $target_file
        } else {
            echo "Error uploading the image.";
        }
    } else {
        // Display validation errors
        foreach ($error as $err) {
            echo $err . "<br>";
        }
    }
}
?>