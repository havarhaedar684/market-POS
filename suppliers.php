<?php
include "db.php";
if($_POST){
$name=$_POST['supplier_name'];
$phone=$_POST['supplier_phone'];
$create=$_POST['created_at'];
$sql="INSERT INTO suppliers (name, phone, create_at) Values ('$name', '$phone', '$create')";
$result=mysqli_query($conn, $sql);
if($result){
    header("Location:suppliers.php");
    exit();
}
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suppliers Dashboard</title>
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
}

        /* Sidebar Styling */
       .sidebar {
       width: 260px;
       background: #ADC4CE;
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
        color: #2c4a52; /* Harmonized dark title color */
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
        color: #334e58; /* Clear, readable dark slate for unselected items */
        text-decoration: none;
        padding: 12px 16px;
        border-radius: 10px;
        font-size: 15px;
        transition: all 0.3s ease;
        }

        /* Sidebar link icons matching text color */
        .nav-links li a i {
        color: #334e58;
        transition: color 0.3s ease;
        }

        /* Smooth hover effect matching the sidebar theme */
        .nav-links li a:hover {
        background: rgba(255, 255, 255, 0.3); /* Soft translucent white highlight */
        color: #1a2f35;
        }

        .nav-links li a:hover i {
         color: #1a2f35;
        }

        /* Active page styling using a deep cohesive tone */
        .nav-links li.active a {
        background: #2c4a52; 
        color: #ffffff; /* Clean white text for visibility */
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
        }        

     .logout-section a:hover {
    background: rgba(255, 255, 255, 0.2);
    color: #0f3e53;
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

        .form-card input[type="text"],
        .form-card input[type="tel"] {
            flex: 1;
            padding: 12px 18px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            font-size: 14px;
            outline: none;
            transition: border-color 0.2s;
        }

        .form-card input[type="text"]:focus,
        .form-card input[type="tel"]:focus {
            border-color: #4f46e5;
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
        }

        /* Field & Input Container Styling */
        .field {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .field label {
            font-size: 12px;
            font-weight: 600;
            color: #475569;
        }

        .input-container {
            display: flex;
            align-items: center;
            background: #ffffff;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            padding: 0 12px;
            transition: border-color 0.2s;
        }

        .input-container:focus-within {
            border-color: #4f46e5;
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
        }

        .input-container i {
            color: #94a3b8;
            margin-right: 8px;
        }

        .input-container input[type="datetime-local"] {
            border: none;
            outline: none;
            padding: 10px 0;
            font-size: 14px;
            color: #334155;
            background: transparent;
        }

        .btn-add {
            background: #155674;
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
            background: #0891b2;
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
                <li><a href="categories.php"><i class="fa-solid fa-list"></i> Categories</a></li>
                <li><a href="products.php"><i class="fa-solid fa-box"></i> Products</a></li>
                <li class="active"><a href="suppliers.php"><i class="fa-solid fa-truck"></i> Suppliers</a></li>
                <li ><a href="sales.php"><i class="fa-solid fa-cart-shopping"></i> Sales</a></li>
                 <li><a href="report.php"><i class="fa-solid fa-chart-line"></i> Report</a></li>
            </ul>
        </div>
        <div class="logout-section">
            <a href="logout.html"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
        </div>
    </div>

    <!-- Main Content Panel -->
    <div class="main-content">
        <h1 class="page-title">Suppliers Management</h1>

        <!-- Add Supplier Form -->
        <form  method="POST" class="form-card">
            <input type="text" name="supplier_name" placeholder="Enter supplier name..." required>
            <input type="tel" name="supplier_phone" placeholder="Enter supplier phone..." required>
            <div class="field">
                <label for="created_at">Created At</label>
                <div class="input-container">
                    <i class="fa-solid fa-calendar"></i>
                    <input type="datetime-local" id="created_at" name="created_at" required>
                </div>
            </div>
            <button type="submit" class="btn-add">Add Supplier</button>
        </form>

        <!-- Suppliers Table Container -->
        <div class="table-card">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Supplier Name</th>
                        <th>Phone</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                   <?php
                 $sql2=" SELECT * FROM suppliers";
                 $result2=mysqli_query($conn, $sql2);
                 if($result2){
                 while($row=mysqli_fetch_assoc($result2)):
                   
                    ?>
                    <tr>
                    <td><?php echo $row['id'];?></td>
                    <td><?php echo $row['name'];?></td>
                    <td><?php echo $row['phone'];?></td>
                    <td><?php echo $row['create_at'];?></td>  
                        <td>
                           
                            <div class="action-btns">
                                <a href="update-sup.php?id= <?php echo $row['id'];?>" class="btn-update">Update</a>
                                <a href="delete-sup.php?id=<?php echo $row['id'];?>" class="btn-delete">Delete</a>
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