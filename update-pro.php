<?php
include "db.php";
$id=$_GET['id'];
if($_POST){
$name=$_POST['name'];
$category=$_POST['category_id'];
$supplier=$_POST['supplier_id'];
$purchase=$_POST['purchase_price'];
$sale=$_POST['sale_price'];
$stock=$_POST['stock'];
$sql="UPDATE `products` SET `name`='$name',`category_id`='$category',`supplier_id`='$supplier',`purchase_price`='$purchase',`sale_price`='$sale',`stock`='$stock' WHERE id=$id";
$result=mysqli_query($conn, $sql);
if($result){
    header("Location:products.php");
    exit();
}
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Product Dashboard</title>
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #96B6C5;
            display: flex;
            height: 100vh;
            overflow: hidden;
            direction: ltr;
        }

        /* Sidebar Styling (Left) */
        .sidebar {
            width: 260px;
            background: #ADC4CE;
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 25px 20px;
            order: -1;
        }

        .sidebar-top h2 {
            font-size: 22px;
            margin-bottom: 35px;
            letter-spacing: 0.5px;
            color: #2c4a52;
            direction: ltr;
            text-align: left;
        }

        .nav-links {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 10px;
            padding: 0;
        }

        .nav-links li a {
            display: flex;
            align-items: center;
            gap: 14px;
            color: #334e58;
            text-decoration: none;
            padding: 12px 16px;
            border-radius: 10px;
            font-size: 15px;
            transition: all 0.3s ease;
            direction: ltr;
        }

        .nav-links li a i {
            color: #334e58;
            transition: color 0.3s ease;
        }

        .nav-links li a:hover {
            background: rgba(255, 255, 255, 0.3);
            color: #1a2f35;
        }

        .nav-links li a:hover i {
            color: #1a2f35;
        }

        .nav-links li.active a {
            background: #2c4a52;
            color: #ffffff;
        }

        .nav-links li.active a i {
            color: #ffffff;
        }

        .logout-section a {
            display: flex;
            align-items: center;
            gap: 10px;
            color: #155674;
            text-decoration: none;
            font-size: 15px;
            font-weight: 600;
            padding: 10px;
            border-radius: 8px;
            transition: all 0.2s ease;
            direction: ltr;
        }

        .logout-section a:hover {
            background: rgba(255, 255, 255, 0.2);
            color: #0f3e53;
        }

        /* Main Content Styling (Right) */
        .main-content {
            flex: 1;
            padding: 40px;
            overflow-y: auto;
            direction: ltr;
        }

        .page-title {
            font-size: 24px;
            color: #1e1b4b;
            margin-bottom: 20px;
            font-weight: 700;
        }

        /* Form Container Styling */
        .form-container {
            background: #ADC4CE;
            padding: 30px;
            border-radius: 12px;
            max-width: 600px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
        }

        .form-group {
            margin-bottom: 18px;
        }

        .form-group label {
            display: block;
            margin-bottom: 6px;
            font-weight: 600;
            color: #2c4a52;
            font-size: 14px;
        }

        .form-group input, 
        .form-group select {
            width: 100%;
            padding: 10px 15px;
            border: 1px solid #78909c;
            border-radius: 8px;
            background: #f0f4f8;
            outline: none;
            font-size: 14px;
            color: #1a2f35;
        }

        .form-group input:focus, 
        .form-group select:focus {
            border-color: #2c4a52;
            background: #ffffff;
        }

        .btn-submit {
            background: #2c4a52;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 15px;
            font-weight: 600;
            width: 100%;
            transition: background 0.3s;
            margin-top: 10px;
        }

        .btn-submit:hover {
            background: #1a2f35;
        }
    </style>
</head>
<body>

    <!-- Sidebar (Left) -->
    <div class="sidebar">
        <div class="sidebar-top">
            <h2>Dashboard</h2>
            <ul class="nav-links">
                <li><a href="#"><i class="fa-solid fa-house"></i> Home</a></li>
                <li><a href="#"><i class="fa-solid fa-list"></i> Categories</a></li>
                <li class="active"><a href="#"><i class="fa-solid fa-box"></i> Products</a></li>
                <li><a href="#"><i class="fa-solid fa-truck"></i> Suppliers</a></li>
            </ul>
        </div>
        <div class="logout-section">
            <a href="#"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
        </div>
    </div>

    <!-- Main Content (Right) -->
    <div class="main-content">
        <h1 class="page-title">Update Product</h1>

        <div class="form-container">
            <form action="#" method="POST">
                <div class="form-group">
                    <label>Product Name</label>
                    <input type="text" name="name" placeholder="Enter product name" required>
                </div>

                <div class="form-group">
                    <label>Category</label>
                    <select name="category_id" required>
                        <option value="">Select category</option>
                        <?php
                        $sql2="SELECT * FROM categories";
                        $result2=mysqli_query($conn, $sql2);
                        if($result2){
                        while($row=mysqli_fetch_assoc($result2)):
                        
                        ?>
                        <option value="<?php echo $row['id'] ?>">
                            <?php
                            echo $row['name'];
                            ?>
                        </option>
                        <?php
                        endwhile;
                        }
                        ?>
                    </select>
                </div>

                <div class="form-group">
                    <label>Supplier</label>
                    <select name="supplier_id" required>
                        <option value="">Select supplier</option>
                        <?php
                        $sql3="SELECT * FROM suppliers";
                        $result3=mysqli_query($conn, $sql3);
                        if($result3){
                        while($row=mysqli_fetch_assoc($result3)):
                        
                        ?>
                        <option value="<?php echo $row ['id'] ?>">
                            <?php
                            echo $row['name'];
                            ?>
                        </option>
                        <?php
                        endwhile;
                        }
                        ?>
                    </select>
                </div>

                <div class="form-group">
                    <label>Purchase Price</label>
                    <input type="number" step="0.01" name="purchase_price" placeholder="0.00" required>
                </div>

                <div class="form-group">
                    <label>Sale Price</label>
                    <input type="number" step="0.01" name="sale_price" placeholder="0.00" required>
                </div>

                <div class="form-group">
                    <label>Stock</label>
                    <input type="number" name="stock" placeholder="Enter stock quantity" required>
                </div>

                <button type="submit" class="btn-submit">Update Product</button>
            </form>
        </div>
    </div>

</body>
</html>