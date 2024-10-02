<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Photo Album</title>
   
    <!-- Link to external CSS file -->
    <link rel="stylesheet" href="style.css">
    <!-- Google Fonts import for Playfair Display font -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1>Photo Gallery</h1>
        <!-- Help button in the top right corner -->
        <button class="help-button" id="helpBtn">?</button>
        <?php
        // Set up variables for image directory and file types
        $imagesDir = 'images/';
        $images = glob($imagesDir . '*.{jpg,jpeg,png,gif}', GLOB_BRACE);
        
        // Set up pagination
        $imagesPerPage = 3;
        $totalPages = ceil(count($images) / $imagesPerPage);
        $currentPage = isset($_GET['page']) ? max(1, min($totalPages, intval($_GET['page']))) : 1;
        $startIndex = ($currentPage - 1) * $imagesPerPage;

        // Display image grid
        echo '<div class="image-grid">';
        for ($i = $startIndex; $i < min($startIndex + $imagesPerPage, count($images)); $i++) {
            $imageClass = ($i == $startIndex) ? 'main-image' : 'small-image';
            echo "<div class='$imageClass'><img src='{$images[$i]}' alt='Image " . ($i + 1) . "' loading='lazy' onclick='openFullSize(this.src)'></div>";
        }
        echo '</div>';

        // Display pagination controls
        echo '<div class="pagination">';
        if ($currentPage > 1) {
            echo "<a href='?page=" . ($currentPage - 1) . "'>Previous</a>";
        }
        echo "<span>Page $currentPage of $totalPages</span>";
        if ($currentPage < $totalPages) {
            echo "<a href='?page=" . ($currentPage + 1) . "'>Next</a>";
        }
        echo '</div>';
        ?>
    </div>

    <!-- Help modal -->
    <div id="helpModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>How to Use the Photo Album</h2>
            <ul>
                <li>Browse through the images using the 'Previous' and 'Next' buttons at the bottom of the page.</li>
                <li>Each page displays 3 images: one large main image and two smaller images.</li>
                <li>Click on an image to view it in full size.</li>
                <li>The current page number and total number of pages are shown between the navigation buttons.</li>
                <li>Images are displayed in their original orientation.</li>
                <li>Enjoy the smooth transitions and hover effects!</li>
            </ul>
        </div>
    </div>

    <!-- Full size image modal -->
    <div id="fullSizeModal">
        <span class="close" onclick="closeFullSize()">&times;</span>
        <img id="fullSizeImage" src="" alt="Full Size Image">
    </div>

    <!-- Link to external JavaScript file -->
    <script src="script.js"></script>
</body>
</html>
































