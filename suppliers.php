<?php
include "db.php";
if($_POST){
$name=$_POST['supplier_name'];
$phone=$_POST['supplier_phone'];
$sql="INSERT INTO suppliers (name, phone) Values ('$name', '$phone')";
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
    background: transparent;
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
    background: transparent;
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

/* Form Card & Inputs */
.form-card {
    background: #ADC4CE;
    padding: 20px 25px;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.10);
    border: 1px solid rgba(255, 255, 255, 0.25);
    display: flex;
    gap: 15px;
    align-items: center;
    margin-bottom: 25px;
}

.form-card input[type="text"],
.form-card input[type="tel"] {
    flex: 1;
    padding: 12px 18px;
    border: 1px solid #78909c;
    border-radius: 8px;
    font-size: 14px;
    outline: none;
    background: #f0f4f8;
    color: #334e58;
}

/* Field */
.field {
    display: flex;
    flex-direction: column;
    gap: 4px;
}

.field label {
    font-size: 12px;
    font-weight: 600;
    color: #2c4a52;
}

/* Input Container for Date */
.input-container {
    display: flex;
    align-items: center;
    background: #f0f4f8;
    border: 1px solid #78909c;
    border-radius: 8px;
    padding: 0 12px;
}

.input-container i {
    color: #78909c;
    margin-right: 8px;
}

.input-container input[type="datetime-local"] {
    border: none;
    outline: none;
    padding: 10px 0;
    font-size: 14px;
    color: #334e58;
    background: transparent;
}

/* Add Button */
.btn-add {
    background: #2c4a52;
    color: white;
    border: none;
    padding: 12px 28px;
    border-radius: 8px;
    font-size: 15px;
    font-weight: 600;
    cursor: pointer;
    transition: background 0.3s;
}

.btn-add:hover {
    background: #1a2f35;
}

/* Table Container & Layout */
.table-card,
.table-container {
    background: #ADC4CE;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 6px rgba(0,0,0,0.05);
}

table, .data-table {
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
    border-bottom: 1px solid rgba(255, 255, 255, 0.4);
}

tr:not(:last-child) td {
    border-bottom: 1px solid rgba(255, 255, 255, 0.4);
}

td {
    color: #2c4a52;
    background: #ADC4CE;
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
                <li><a href="read.php"><i class="fa-solid fa-user"></i> Users</a></li>
                 <li><a href="report.php"><i class="fa-solid fa-chart-line"></i> Report</a></li>
            </ul>
        </div>
        <div class="logout-section">
            <a href="logout.php"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
        </div>
    </div>

    <!-- Main Content Panel -->
    <div class="main-content">
        <h1 class="page-title">Suppliers Management</h1>

        <!-- Add Supplier Form -->
        <form  method="POST" class="form-card">
            <input type="text" name="supplier_name" placeholder="Enter supplier name..." required>
            <input type="tel" name="supplier_phone" placeholder="Enter supplier phone..." required>
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
                    <td><?php echo $row['date_went'];?></td>  
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