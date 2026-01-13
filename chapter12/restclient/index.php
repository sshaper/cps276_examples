<?php
require_once 'php/callApi.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Management</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-5">
        <h1 class="text-center mb-4">Library Management</h1>
        
        <?php echo "<p>$msg</p>"; ?>
        <form action="index.php" method="POST" class="mb-4 row g-3">
            <!-- Search Field -->
            <div class="col-md-8">
                <label for="search" class="form-label">Search for a Book</label>
                <input type="text" class="form-control" id="search" name="search" value="<?php echo $searchTerm;  ?>" placeholder="Search by title or author">
            </div>
            <div class="col-md-4 d-flex align-items-end">
                <button type="submit" name="action" value="search" class="btn btn-primary w-100">Search</button>
            </div>
        <!--</form>-->

        <!--<form action="index.php" method="POST" class="mb-4 row g-3">-->
            <!-- Add/Update/Delete Fields -->
            <div class="col-md-4">
                <label for="title" class="form-label">Book Title</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="Enter book title">
            </div>
            <div class="col-md-4">
                <label for="author" class="form-label">Author</label>
                <input type="text" class="form-control" id="author" name="author" placeholder="Enter author name">
            </div>
            <div class="col-md-2">
                <label for="id" class="form-label">Book ID</label>
                <input type="number" class="form-control" id="id" name="id" placeholder="ID for update/delete">
            </div>
            <div class="col-md-2 d-flex align-items-end">
                <button type="submit" class="btn btn-success w-100 mb-1 me-1" name="action" value="add">Add</button>
                <button type="submit" class="btn btn-warning w-100 mb-1 me-1" name="action" value="update">Update</button>
                <button type="submit" class="btn btn-danger w-100 mb-1" name="action" value="delete">Delete</button>
            </div>
        </form>
        <?php echo $list; ?>
    </div>
</body>
</html>
