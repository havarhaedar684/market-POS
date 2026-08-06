<?php
include "db.php";
if($_POST){
$name=$_POST['category_name'];
$sql="INSERT INTO categories (name)values('$name')";
$result=mysqli_query($conn,$sql);
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categories Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #f8fafc;
            display: flex;
            height: 100vh;
            overflow: hidden;
        }

        /* Sidebar Styling */
        .sidebar {
            width: 260px;
            background: #1e1b4b;
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 25px 20px;
        }

        .sidebar-top h2 {
            font-size: 22px;
            margin-bottom: 35px;
            letter-spacing: 0.5px;
            color: #818cf8;
        }

        .nav-links {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .nav-links li a {
            display: flex;
            align-items: center;
            gap: 14px;
            color: #94a3b8;
            text-decoration: none;
            padding: 12px 16px;
            border-radius: 10px;
            font-size: 15px;
            transition: all 0.3s ease;
        }

        .nav-links li.active a, .nav-links li a:hover {
            background: #312e81;
            color: #ffffff;
        }

        .logout-section a {
            display: flex;
            align-items: center;
            gap: 10px;
            color: #ef4444;
            text-decoration: none;
            font-size: 15px;
            font-weight: 600;
            padding: 10px;
            transition: color 0.2s;
        }

        .logout-section a:hover {
            color: #f87171;
        }

        /* Main Content Styling */
        .main-content {
            flex: 1;
            padding: 40px;
            overflow-y: auto;
        }

        .page-title {
            font-size: 24px;
            color: #1e1b4b;
            margin-bottom: 25px;
            font-weight: 700;
        }

        /* Input / Add Form Card */
        .form-card {
            background: #ffffff;
            padding: 20px 25px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.03);
            border: 1px solid #e2e8f0;
            display: flex;
            gap: 15px;
            align-items: center;
            margin-bottom: 25px;
        }

        .form-card input {
            flex: 1;
            padding: 12px 18px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            font-size: 14px;
            outline: none;
            transition: border-color 0.2s;
        }

        .form-card input:focus {
            border-color: #4f46e5;
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
        }

        .btn-add {
            background: #4f46e5;
            color: white;
            border: none;
            padding: 12px 28px;
            border-radius: 8px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s, transform 0.1s;
        }

        .btn-add:hover {
            background: #4338ca;
        }

        .btn-add:active {
            transform: scale(0.98);
        }
         
        /* Table Card Container */
        .table-card {
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.03);
            border: 1px solid #e2e8f0;
            overflow: hidden;
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }

        .data-table th, .data-table td {
            padding: 16px 20px;
            border-bottom: 1px solid #f1f5f9;
            font-size: 14px;
        }

        .data-table th {
            background-color: #f8fafc;
            color: #475569;
            font-weight: 600;
        }

        .data-table td {
            color: #334155;
        }

        .data-table tr:last-child td {
            border-bottom: none;
        }

        .data-table tr:hover {
            background-color: #f8fafc;
        }

        .action-btns {
            display: flex;
            gap: 10px;
        }

        .btn-update {
            background: #e0e7ff;
            color: #4f46e5;
            padding: 6px 12px;
            border-radius: 6px;
            text-decoration: none;
            font-size: 13px;
            font-weight: 600;
            transition: background 0.2s;
        }

        .btn-update:hover {
            background: #c7d2fe;
        }

        .btn-delete {
            background: #fee2e2;
            color: #dc2626;
            padding: 6px 12px;
            border-radius: 6px;
            text-decoration: none;
            font-size: 13px;
            font-weight: 600;
            transition: background 0.2s;
        }

        .btn-delete:hover {
            background: #fecaca;
        }
    </style>
</head>
<body>

    <!-- Sidebar Section -->
    <div class="sidebar">
        <div class="sidebar-top">
            <h2>Dashboard</h2>
            <ul class="nav-links">
                <li><a href="home.php"><i class="fa-solid fa-house"></i> Home</a></li>
                <li class="active"><a href="categories.php"><i class="fa-solid fa-list"></i> Categories</a></li>
                <li><a href="products.php"><i class="fa-solid fa-box"></i> Products</a></li>
            </ul>
        </div>
        <div class="logout-section">
            <a href="logout.php"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
        </div>
    </div>

    <!-- Main Content Panel -->
    <div class="main-content">
        <h1 class="page-title">Categories Management</h1>

        <!-- Add Category Form Bar -->
        <form action="categories.php" method="POST" class="form-card">
            <input type="text" name="category_name" placeholder="Enter new category name..." required>
            <button type="submit" class="btn-add">Add Category</button>

        </form>

        <!-- Categories Table Container -->
        <div class="table-card">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Category Name</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql2="SELECT * FROM categories";
                    $result2=mysqli_query($conn, $sql2);
                    if($result2){
                        while($row=mysqli_fetch_assoc($result2)):
                    ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['created_at']; ?></td>
                        <td>
                            <div class="action-btns">
                             <a href="update-cat.php?id= <?php echo $row['id']; ?>"class="btn-update">Update</a>
                                <a href="delete-cat.php?id=<?php echo $row['id'];?>" class="btn-delete">Delete</a>
                            </div>
                        </td>
                    </tr>
                    <?php
                        endwhile;
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>