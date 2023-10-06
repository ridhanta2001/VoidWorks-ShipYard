<?php

include "authguard.php";
include_once "../shared/connection.php";

// Function to extract file name from a path
function extractFileName($path) {
    $parts = explode('/', $path);
    return end($parts); // Get the last part, which is the file name
}

// Get all image paths from both tables
$query = "SELECT impath FROM product UNION SELECT impath FROM orders";
$result = mysqli_query($conn, $query);

if (!$result) {
    echo "Error: " . mysqli_error($conn);
} else {
    $imagePaths = array();

    while ($row = mysqli_fetch_assoc($result)) {
        // Extract the file name from the full path and store it in the array
        $imageName = extractFileName($row['impath']);
        $imagePaths[] = $imageName;
    }

    // Directory where images are stored
    $imageDirectory = '../shared/images/';
    
    // Get all files in the directory
    $allFiles = scandir($imageDirectory);
    
    // Filter out . and .. from the list
    $existingImages = array_diff($allFiles, array('..', '.'));

    $deletedImages = 0;

    // Compare the images in the directory with the database
    foreach ($existingImages as $fileName) {
        if (!in_array($fileName, $imagePaths)) {
            // Delete the image
            unlink($imageDirectory . $fileName);
            $deletedImages++;
        }
    }

    if ($deletedImages > 0) {
        echo '<script>alert("Deleted ' . $deletedImages . ' images."); window.location="home.php";</script>';
    } else {
        echo '<script>alert("No images deleted."); window.location="home.php";</script>';
    }
}

mysqli_close($conn);
?>
