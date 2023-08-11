<!DOCTYPE html>
<html>

<head>
    <title>Pagination Example</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>

    <div class="container mt-5">
        <h2>Pagination Example</h2>

        <?php
    // Configuration
    $itemsPerPage = 100;
    
    // Database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "masakhane";
    
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    // Get total number of items
    $totalItemsQuery = "SELECT COUNT(*) AS total FROM members";
    $totalResult = $conn->query($totalItemsQuery);
    $totalItems = $totalResult->fetch_assoc()["total"];
    
    // Calculate total pages
    $totalPages = ceil($totalItems / $itemsPerPage);
    
    // Get current page
    $currentPage = isset($_GET['page']) ? intval($_GET['page']) : 1;
    
    // Calculate the starting item index
    $startIndex = ($currentPage - 1) * $itemsPerPage;
    
    // Retrieve items for the current page
    $itemsQuery = "SELECT * FROM members LIMIT $startIndex, $itemsPerPage";
    $result = $conn->query($itemsQuery);
    
    if ($result->num_rows > 0) {
        echo "<ul class='list-group'>";
        while($row = $result->fetch_assoc()) {
            echo "<li class='list-group-item'>" . $row['fullname'] . "</li>";
        }
        echo "</ul>";
    } else {
        echo "No items found.";
    }
    
    // Generate pagination links
    echo "<div class='mt-3'>";
    for ($page = 1; $page <= $totalPages; $page++) {
        $activeClass = ($page == $currentPage) ? 'active' : '';
        echo "<a class='btn btn-primary mr-2 $activeClass' href='?page=$page'>$page</a>";
    }
    echo "</div>";
    
    $conn->close();
    ?>

    </div>

</body>

</html>