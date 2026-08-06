<?php
include "db.php";
$id = $_GET['id'] ?? ''; //AI ?? ''
if($_POST){
$name=$_POST['category_name'];

$sql="UPDATE categories SET name='$name' WHERE id=$id";
$result=mysqli_query($conn, $sql);
if($result){
    header("Location:categories.php");
    exit();
}
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Categories Dashboard</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background-color: #f4f5f7;
            display: flex;
            height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            width: 250px;
            background-color: #1e1b4b;
            color: white;
            padding: 20px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .sidebar h2 {
            font-size: 20px;
            margin-bottom: 30px;
            color: #a78bfa;
        }

        .sidebar a {
            color: #9ca3af;
            text-decoration: none;
            display: block;
            padding: 10px 0;
            font-size: 15px;
        }

        .sidebar a.active, .sidebar a:hover {
            color: white;
        }

        /* Main Content */
        .main {
            flex: 1;
            padding: 30px;
            overflow-y: auto;
        }

        h1 {
            color: #1e1b4b;
            font-size: 24px;
            margin-bottom: 25px;
        }

        .card {
            background: white;
            padding: 25px;
            border-radius: 8px;
            max-width: 900px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }

        /* Form styling matching the inputs from your table */
        .form-row {
            display: flex;
            gap: 15px;
            align-items: center;
        }

        input[type="text"] {
            flex: 1;
            padding: 12px 15px;
            border: 1px solid #e5e7eb;
            border-radius: 6px;
            font-size: 14px;
            outline: none;
        }

        input[type="text"]:focus {
            border-color: #6366f1;
        }

        .btn-update {
            background-color: #4f46e5;
            color: white;
            padding: 12px 24px;
            border: none;
            border-radius: 6px;
            font-size: 14px;
            cursor: pointer;
            font-weight: bold;
        }

        .btn-update:hover {
            background-color: #4338ca;
        }

        .btn-cancel {
            background-color: #f3f4f6;
            color: #374151;
            padding: 12px 20px;
            border-radius: 6px;
            text-decoration: none;
            font-size: 14px;
            font-weight: bold;
        }

        .btn-cancel:hover {
            background-color: #e5e7eb;
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <div>
            <h2>Dashboard</h2>
            <a href="index.php">Home</a>
            <a href="categories.php" class="active">Categories</a>
            <a href="products.php">Products</a>
        </div>
        <div>
            <a href="logout.php" style="color: #f87171;">Logout</a>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main">
        <h1>Categories Management</h1>

        <div class="card">
            <!-- Form styled exactly like your Add Category bar, but for Updating -->
            <form  method="POST">
                
                <div class="form-row">
                    <input type="text" name="category_name" placeholder="new name of category" required>
                    <button type="submit" class="btn-update">Update Category</button>
                    <a href="categories.php" class="btn-cancel">Cancel</a>
                </div>
            </form>
        </div>
    </div>

</body>
</html>