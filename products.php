<?php
session_start();
include "db.php";
//$sql="SELECT p.id,p.name,c.name,p As catt,s.name AS sup,p.supplier_id,p.purchase_price,p.sale_price,p.stock FROM
 //products p join categories c on p.category_id = c.id join suppliers s on p.supplier_id = s.id ";
if(isset($_GET['search']) && !empty($_GET['search'])){
    $search=$_GET['search'];
 $sql = "SELECT p.id, p.name, c.name AS catt, s.name AS sup, p.supplier_id, p.purchase_price, p.sale_price, p.stock FROM
  products p JOIN categories c ON p.category_id = c.id JOIN suppliers s ON p.supplier_id = s.id WHERE p.name LIKE '$search%'";

  }else
  {$sql = "SELECT p.id, p.name, c.name AS catt, s.name AS sup, p.supplier_id, p.purchase_price, p.sale_price, p.stock FROM
  products p JOIN categories c ON p.category_id = c.id JOIN suppliers s ON p.supplier_id = s.id";
  }
$result=mysqli_query($conn, $sql);
 




?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products Dashboard</title>
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
            margin-bottom: 25px;
            font-weight: 700;
        }

        /* Products Table & Header Controls */
        .top-controls {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .search-box input {
            padding: 10px 15px;
            width: 250px;
            border: 1px solid #78909c;
            border-radius: 8px;
            background: #f0f4f8;
            outline: none;
            text-align: left;
        }

        .btn-add {
            background: #2c4a52;
            color: white;
            padding: 10px 18px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            text-decoration: none;
            font-weight: 600;
            transition: background 0.3s;
        }

        .btn-add:hover {
            background: #1a2f35;
        }

        .table-container {
            background: #ADC4CE;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }

        th, td {
            padding: 14px 18px;
            font-size: 14px;
        }

        th {
            background: #8aa4b0;
            color: #1a2f35;
            font-weight: 700;
        }

        tr:not(:last-child) td {
            border-bottom: 1px solid rgba(255, 255, 255, 0.4);
        }

        td {
            color: #2c4a52;
        }

        .action-btns a {
            background: #2c4a52;
            color: white;
            padding: 6px 12px;
            border-radius: 6px;
            text-decoration: none;
            font-size: 13px;
            font-weight: 600;
            transition: background 0.2s;
             }

            .action-btns a.delete {
             background: #2c4a52;
             color: white;
             padding: 6px 12px;
             border-radius: 6px;
             text-decoration: none;
             font-size: 13px;
             font-weight: 600;
             transition: background 0.2s;
             }

        .action-btns a:hover {
           background: #1e353b;
        }
        .low-stock-section {
    background: #ADC4CE;
    padding: 20px;
    border-radius: 12px;
    margin-top: 20px;
    width: 100%;
    max-width: 500px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
}

.low-stock-header {
    font-size: 18px;
    color: #2c4a52;
    font-weight: 700;
    margin-bottom: 15px;
    display: flex;
    align-items: center;
    gap: 10px;
}

.low-stock-header i {
    color: #d9534f;
}

.low-stock-table-wrap {
    background: white;
    border-radius: 8px;
    overflow: hidden;
}

.low-stock-table-wrap table {
    width: 100%;
    border-collapse: collapse;
    text-align: left;
}

.low-stock-table-wrap th, 
.low-stock-table-wrap td {
    padding: 12px 15px;
    font-size: 14px;
}

.low-stock-table-wrap th {
    background: #8aa4b0;
    color: #1a2f35;
    font-weight: 700;
}

.low-stock-table-wrap tr:not(:last-child) td {
    border-bottom: 1px solid #f0f4f8;
}

.low-stock-table-wrap td {
    color: #2c4a52;
}

.low-stock-badge {
    color: #d9534f;
    font-weight: 700;
}
    </style>
</head>
<body>

    <!-- Sidebar (Left) -->
    <div class="sidebar">
        <div class="sidebar-top">
            <h2>Dashboard</h2>
            <ul class="nav-links">
                <li><a href="home.php"><i class="fa-solid fa-house"></i> Home</a></li>
                <li><a href="categories.php"><i class="fa-solid fa-list"></i> Categories</a></li>
                <li class="active"><a href="products.php"><i class="fa-solid fa-box"></i> Products</a></li>
                <li><a href="suppliers.php"><i class="fa-solid fa-truck"></i> Suppliers</a></li>
                <li><a href="sales.php"><i class="fa-solid fa-cart-shopping"></i> Sales</a></li>
                <li><a href="read.php"><i class="fa-solid fa-user"></i> Users</a></li>
                 <li><a href="report.php"><i class="fa-solid fa-chart-line"></i> Report</a></li>
            </ul>
        </div>
        <div class="logout-section">
            <a href="logout.php"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
        </div>
    </div>

    <!-- Main Content (Right) -->
    <div class="main-content">
        <h1 class="page-title">Products Management</h1>

        <div class="top-controls">
    <form method="GET" action="" style="display: flex; gap: 10px; align-items: center;">
        <div class="search-box">
            
            <input type="text" name="search" placeholder="Search products..." value="<?php echo htmlspecialchars($_GET['search'] ?? ''); ?>">
        </div>
        <button type="submit" class="btn-add" style="padding: 10px 15px;">Search</button>
        <?php if(isset($_GET['search']) && $_GET['search'] != ''): ?>
            <a href="products.php" class="btn-add" style="background: #78909c; text-decoration: none; display: flex; align-items: center;">Reset</a>
        <?php endif; ?>
    </form>
            <a href="add-products.php" class="btn-add"><i class="fa-solid fa-plus"></i> Add Product</a>
        </div>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Product Name</th>
                        <th>Category</th>
                        <th>Supplier</th>
                        <th>Purchase Price</th>
                        <th>Sale Price</th>
                        <th>Stock</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while($row=mysqli_fetch_assoc($result)):
                        
                    ?>
                    <tr>
                     <td><?php echo number_format( $row['id']);?></td>
                     <td><?php echo $row['name']; ?></td>
                     <td><?php echo $row['catt']; ?></td>
                     <td><?php echo $row['sup']; ?></td>
                     <td><?php echo $row['purchase_price']; ?></td>
                     <td><?php echo $row['sale_price']; ?></td>
                     <td><?php echo $row['stock']; ?></td>
                   
                    
                     <td class="action-btns">
                            <a href="update-pro.php?id=<?php echo $row['id']; ?>">Edit</a>
                            <a href="delete-pro.php?id=<?php echo $row['id'];?>" class="delete">Delete</a>
                        </td>  
                    </tr>
                    
                     <?php    
                        endwhile;
                        ?>
                        
                </tbody>
                
            </table>
        </div>
    </div>

</body>
</html>