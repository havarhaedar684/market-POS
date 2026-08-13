<?php
//this page for show table in database by(crud=>Create, Read, Update, Delete);
include "db.php";
$sql="SELECT * FROM users";
$result=mysqli_query($conn,$sql);
//while($row=mysqli_fetch_assoc($result)){
// echo $row['id']."</br>";
// echo $row['username']."</br>";
// echo $row['email']."</br>";

// echo password_hash($row['password'], PASSWORD_DEFAULT)."</br>";


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Market POS - Users Table</title>
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
    flex-shrink: 0;
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

.main-card {
    background: #ADC4CE;
    backdrop-filter: blur(10px);
    padding: 40px 35px;
    border-radius: 16px;
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
    width: 100%;
    max-width: 1000px;
    border: 1px solid rgba(255, 255, 255, 0.3);
    animation: fadeIn 0.6s ease-out;
    margin: 0 auto;
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(-20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.card-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 30px;
}

.header-left {
    display: flex;
    align-items: center;
    gap: 15px;
}

.logo-icon {
    width: 60px;
    height: 60px;
    background: #2c4a52;
    color: white;
    font-size: 24px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 14px;
    box-shadow: 0 8px 16px rgba(44, 74, 82, 0.2);
}

.card-header h2 {
    color: #2c4a52;
    font-size: 24px;
    font-weight: 700;
    margin-bottom: 4px;
    letter-spacing: -0.5px;
}

.card-header p {
    color: #4d6871;
    font-size: 14px;
}

.logout-btn {
    background: #2c4a52;
    color: white;
    border: none;
    padding: 10px 16px;
    border-radius: 10px;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
    text-decoration: none;
    display: flex;
    align-items: center;
    gap: 8px;
    transition: all 0.3s ease;
}

.logout-btn:hover {
    background: #1a2f35;
    transform: translateY(-1px);
}

.data-table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 25px;
    background: #ADC4CE;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    border: 1px solid rgba(255, 255, 255, 0.4);
}

.data-table th, .data-table td {
    padding: 14px 16px;
    text-align: left;
    font-size: 14px;
}

.data-table th {
    background-color: #8aa4b0;
    color: #1a2f35;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    border-bottom: 1px solid rgba(255, 255, 255, 0.4);
}

.data-table td {
    color: #2c4a52;
    background-color: #ADC4CE;
    border-bottom: 1px solid rgba(255, 255, 255, 0.4);
}

.data-table tr:last-child td {
    border-bottom: none;
}

.action-btns {
    display: flex;
    gap: 8px;
}

.btn-update {
    background: #2c4a52;
    color: white;
    padding: 6px 12px;
    border-radius: 6px;
    text-decoration: none;
    font-size: 13px;
    font-weight: 600;
    transition: background 0.2s;
}

.btn-update:hover {
    background: #2c4a52;
}

.btn-delete {
   background: #2c4a52;
    color: white;
    padding: 6px 12px;
    border-radius: 6px;
    text-decoration: none;
    font-size: 13px;
    font-weight: 600;
    transition: background 0.2s;
}

.btn-delete:hover {
    background: #2c4a52;
}

.table-footer-actions {
    display: flex;
    justify-content: flex-end;
    margin-top: 20px;
}

.add-user-btn {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    background: #2c4a52;
    color: #ffffff;
    text-decoration: none;
    padding: 12px 28px;
    border-radius: 50px;
    font-size: 15px;
    font-weight: 600;
    cursor: pointer;
    border: none;
    outline: none;
    box-shadow: 0 4px 14px rgba(44, 74, 82, 0.3);
    transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
}

.add-user-btn:hover {
    background: #1a2f35;
    box-shadow: 0 6px 20px rgba(44, 74, 82, 0.4);
    transform: translateY(-2px);
}

.add-user-btn:active {
    transform: translateY(1px);
    box-shadow: 0 2px 8px rgba(44, 74, 82, 0.2);
}

.data-table tr:hover td {
    background-color: rgba(255, 255, 255, 0.15);
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
                <li><a href="products.php"><i class="fa-solid fa-box"></i> Products</a></li>
                <li><a href="suppliers.php"><i class="fa-solid fa-truck"></i> Suppliers</a></li>
                <li><a href="sales.php"><i class="fa-solid fa-cart-shopping"></i> Sales</a></li>
                 <li class="active"><a href="read.php"><i class="fa-solid fa-user"></i> Users</a></li>
                 <li><a href="report.php"><i class="fa-solid fa-chart-line"></i> Report</a></li>

            </ul>
        </div>
        <div class="logout-section">
            <a href="logout.php"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
        </div>
    </div>


    <div class="main-card">
        <div class="card-header">
            <div class="header-left">
                <div class="logo-icon">
                    <i class="fa-solid fa-users"></i>
                </div>
                <div>
                    <h2>Users Records</h2>
                    <p>Market POS Management Panel</p>
                </div>
            </div>
            <a href="logout.php" class="logout-btn">
                <i class="fa-solid fa-right-from-bracket"></i> Logout
            </a>
        </div>
<form action="insert.php">
        <table class="data-table">
            <thead>
                <tr>
                    <th>ID</th>

                    <th>Username</th>
                    
                    <th>Email</th>

                    <th>Role</th>

                    <th>action</th>

                </tr>
                </form>
            </thead>
            <tbody>
               <?php
               while($row=mysqli_fetch_assoc($result)) :       
               ?>
               <tr>

               <?php
                       echo  "<td>". $row['id']."</td>";
                ?>

                <?php
                       echo  "<td>". $row['username']."</td>";       
                ?>

                <?php
                       echo  "<td>". $row['email']."</td>";
                 ?>


                 <?php
                       echo  "<td>".$row['role']."</td>";
                 ?>
                 <td>
                 <div class='action-btns'>
                               <a href="update.php?id=<?php echo $row['id'];?>" class='btn-update'><i></i> Edit</a>
                               <a href="delete.php?id= <?php echo $row['id']; ?>" class='btn-delete'><i ></i> Delete</a>
                           </div>
                           </td>
                   </tr>
                 <?php
                 endwhile;
                 ?>

            </tbody>
        </table>

        <div class="table-footer-actions">
            <a href="insert.php" class="add-user-btn">
                <i class="fa-solid fa-user-plus"></i> Add New User
            </a>
        </div>
    </div>

</body>
</html>