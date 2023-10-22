<!DOCTYPE html>
<html>
<head>
    <title>Posted Data</title>
</head>
<body>
    <?php
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $title = $_POST["title"];
        $body = $_POST["body"];
        $topic = $_POST["topic"];
        $published = isset($_POST["published"]) ? "Yes" : "No";

        echo "<h1>Posted Data:</h1>";
        echo "<p><strong>Title:</strong> " . $title . "</p>";
        echo "<p><strong>Body:</strong> " . $body . "</p>";
        echo "<p><strong>Topic:</strong> " . $topic . "</p>";
        echo "<p><strong>Published:</strong> " . $published . "</p>";
    }
    ?>
</body>
</html>
