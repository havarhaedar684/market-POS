<?php
session_start();
include "db.php";
//bo products
$p_sql="SELECT COUNT(*) AS total FROM products";
$p_result=mysqli_query($conn, $p_sql);
$p_row=mysqli_fetch_assoc($p_result);
$total_products=$p_row['total'];


//bo categories
$c_sql="SELECT COUNT(*) AS total FROM categories";
$c_result=mysqli_query($conn, $c_sql);
if($c_result ?? ''){
$c_row=mysqli_fetch_assoc($c_result);
$total_category=$c_row['total'];
}
else{
 $total_category=0;
}

//bo supplires
$s_sql="SELECT COUNT(*) AS total FROM suppliers";
$s_result=mysqli_query($conn, $s_sql);
if($s_result ?? ''){
$s_row=mysqli_fetch_assoc($s_result);
$total_suppliers=$s_row['total'];
}
else{
    $total_suppliers=0;
}


//bo total-sales in today
$total_sales_today=0;
if($_SESSION['cart'] ?? ''){
foreach($_SESSION['cart'] as $item_row){
$total_sales_today += $item_row['total_amount'];
}
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard</title>

    <link rel="stylesheet" href="home.css">

    <!-- Font Awesome -->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<style>
    * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;

    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}


/* =========================
   BODY
========================= */

body {
    background-color: #96B6C5;

    display: flex;

    min-height: 100vh;

    direction: ltr;
}


/* =========================
   SIDEBAR
========================= */

.sidebar {
    width: 280px;

    min-height: 100vh;

    background: #ADC4CE;

    display: flex;

    flex-direction: column;

    justify-content: space-between;

    padding: 25px 20px;

    flex-shrink: 0;
}


.sidebar-top h2 {
    font-size: 22px;

    margin-bottom: 35px;

    letter-spacing: 0.5px;

    color: #2c4a52;
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
}


.nav-links li a i {
    width: 18px;

    color: #334e58;
}


.nav-links li a:hover {
    background: rgba(255, 255, 255, 0.3);

    color: #1a2f35;
}


.nav-links li.active a {
    background: #2c4a52;

    color: white;
}


.nav-links li.active a i {
    color: white;
}


/* =========================
   LOGOUT
========================= */

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

    transition: 0.2s ease;
}


.logout-section a:hover {
    background: rgba(255, 255, 255, 0.2);
}


/* =========================
   MAIN CONTENT
========================= */

.main-content {
    flex: 1;

    padding: 30px;

    overflow-y: auto;
}


.page-title {
    font-size: 24px;

    color: #1e1b4b;

    margin-bottom: 20px;

    font-weight: 700;
}


/* =========================
   WELCOME BOX
========================= */

.welcome-box {
    background: #ADC4CE;

    border-radius: 12px;

    padding: 20px 25px;

    margin-bottom: 20px;

    display: flex;

    align-items: center;

    justify-content: space-between;

    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
}


.welcome-box h2 {
    color: #2c4a52;

    font-size: 20px;

    margin-bottom: 7px;
}


.welcome-box p {
    color: #4d6871;

    font-size: 14px;
}


.welcome-icon {
    font-size: 45px;

    color: #2c4a52;

    opacity: 0.8;

    margin-right: 15px;
}
.stats-grid {
    display: grid;

    grid-template-columns:
        repeat(4, 1fr);

    gap: 15px;

    margin-bottom: 20px;
}
.stat-card {
    background: #ADC4CE;
    border-radius: 12px;
    padding: 20px;
    display: flex;
    align-items: center;
    gap: 15px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
    transition: 0.2s ease;
}

.stat-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.08);
}


.stat-icon {
    width: 48px;
    height: 48px;
    border-radius: 10px;
    background: #2c4a52;
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 19px;
    flex-shrink: 0;
}


.stat-info p {
    color: #4d6871;
    font-size: 13px;
    margin-bottom: 5px;
}


.stat-info h2 {
    color: #1e1b4b;
    font-size: 21px;
}


.stat-info h2 small {
    font-size: 12px;
    font-weight: 600;
}

.dashboard-grid {
    display: grid;
    grid-template-columns:
        1.6fr 1fr;
    gap: 20px;
    margin-bottom: 20px;
}


.dashboard-card {
    background: #ADC4CE;
    border-radius: 12px;
    padding: 20px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
}

.card-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 15px;
}

.card-header h3,
.dashboard-card > h3 {
    color: #2c4a52;
    font-size: 18px;
}

.card-header a {
    color: #155674;
    text-decoration: none;
    font-size: 13px;
    font-weight: 600;
}


.card-header a:hover {
    text-decoration: underline;
}

.table-wrapper {
    background: white;
    border-radius: 8px;
    overflow: hidden;
}


table {
    width: 100%;
    border-collapse: collapse;
    text-align: left;
}

th,
td {
    padding: 11px 13px;
    font-size: 13px;
}

th {
    background: #8aa4b0;
    color: #1a2f35;
    font-weight: 700;
}


td {
    color: #2c4a52;
    background: white;
}


tr:not(:last-child) td {
    border-bottom: 1px solid #f0f4f8;
}
.quick-card {
    display: flex;
    flex-direction: column;
    gap: 10px;
}


.quick-card > h3 {
    margin-bottom: 5px;
}

.quick-button {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 11px;
    border-radius: 9px;
    background: #f0f4f8;
    text-decoration: none;
    color: #2c4a52;
    transition: 0.2s ease;
}

.quick-button:hover {
    background: white;
    transform: translateX(2px);
}


.quick-button > span {
    width: 38px;
    height: 38px;
    border-radius: 8px;
    background: #2c4a52;
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.quick-button div {
    display: flex;
    flex-direction: column;
    flex: 1;
}

.quick-button strong {
    font-size: 14px;
}


.quick-button small {
    color: #78909c;
    font-size: 11px;
    margin-top: 2px;
}

.quick-button .arrow {
    font-size: 12px;
    color: #78909c;
}

.low-stock-card {
    margin-bottom: 20px;
}


.stock-list {
    display: flex;
    flex-direction: column;
}


.stock-item {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 12px 5px;
    border-bottom: 1px solid rgba(255, 255, 255, 0.5);
}


.stock-item:last-child {
    border-bottom: none;
}

.product-stock {
    display: flex;
    align-items: center;
    gap: 12px;
}


.product-icon {
    width: 38px;
    height: 38px;
    border-radius: 8px;
    background: #8aa4b0;
    color: #2c4a52;
    display: flex;
    align-items: center;
    justify-content: center;
}


.product-stock div {
    display: flex;
    flex-direction: column;
}


.product-stock strong {
    color: #2c4a52;
    font-size: 14px;
}


.product-stock small {
    color: #78909c;
    font-size: 11px;
    margin-top: 2px;
}


.stock-number {
    color: #155674;
    font-size: 13px;
    font-weight: 700;
    background: #d9e7ec;
    padding: 6px 10px;
    border-radius: 6px;
}

@media (max-width: 1100px) {

    .stats-grid {
        grid-template-columns:
            repeat(2, 1fr);
    }

    .dashboard-grid {
        grid-template-columns: 1fr;
    }
}


@media (max-width: 750px) {

    .sidebar {
        width: 220px;
    }

    .main-content {
        padding: 20px;
    }

    .stats-grid {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 600px) {

    body {
        flex-direction: column;
    }

    .sidebar {
        width: 100%;
        min-height: auto;
        padding: 15px;
    }

    .sidebar-top h2 {
        margin-bottom: 15px;
    }

    .nav-links {
        flex-direction: row;
        flex-wrap: wrap;
    }

    .nav-links li {
        flex: 1;
    }

    .nav-links li a {
        justify-content: center;
        padding: 10px 8px;
        font-size: 12px;
    }

    .nav-links li a i {
        display: none;
    }

    .logout-section {
        display: none;
    }

    .main-content {
        padding: 15px;
    }

    .welcome-icon {
        display: none;
    }

    .dashboard-grid {
        grid-template-columns: 1fr;
    }
}
</style>
<body>


    <aside class="sidebar">

        <div class="sidebar-top">

            <h2>Dashboard</h2>

            <ul class="nav-links">

                <li class="active">
                    <a href="home.php">
                        <i class="fa-solid fa-house"></i>
                        Home
                    </a>
                </li>

                <li>
                    <a href="categories.php">
                        <i class="fa-solid fa-list"></i>
                        Categories
                    </a>
                </li>

                <li>
                    <a href="products.php">
                        <i class="fa-solid fa-box"></i>
                        Products
                    </a>
                </li>

                <li>
                    <a href="suppliers.php">
                        <i class="fa-solid fa-truck"></i>
                        Suppliers
                    </a>
                </li>

                <li>
                    <a href="sales.php">
                        <i class="fa-solid fa-cart-shopping"></i>
                        Sales
                    </a>
                </li>

                <li>
                    <a href="report.php">
                        <i class="fa-solid fa-chart-line"></i>
                        Report
                    </a>
                </li>

            </ul>

        </div>
        <!-- Logout -->

        <div class="logout-section">

            <a href="index.php">
                <i class="fa-solid fa-right-from-bracket"></i>
                Logout
            </a>

        </div>

    </aside>



    <!-- =========================
         MAIN CONTENT
    ========================= -->

    <main class="main-content">

        <h1 class="page-title">
            Dashboard
        </h1>


        <!-- =========================
             WELCOME
        ========================= -->

        <div class="welcome-box">

            <div>

                <h2>
                    Welcome to Market POS
                </h2>

                <p>
                    Manage your products, sales and inventory from one place.
                </p>

            </div>

            <i class="fa-solid fa-store welcome-icon"></i>

        </div>

        <div class="stats-grid">


            <!-- Products -->

            <div class="stat-card">

                <div class="stat-icon">
                    <i class="fa-solid fa-box"></i>
                </div>

                <div class="stat-info">

                    <p>
                        Total Products
                    </p>

                    <h2>
                        <?php echo $total_products ?>
                    </h2>

                </div>

            </div>


            <!-- Categories -->

            <div class="stat-card">

                <div class="stat-icon">
                    <i class="fa-solid fa-list"></i>
                </div>

                <div class="stat-info">

                    <p>
                        Categories
                    </p>

                     <h2>
                         <?php echo $total_category; ?>
                    </h2>

                </div>

            </div>


            <!-- Suppliers -->

            <div class="stat-card">

                <div class="stat-icon">
                    <i class="fa-solid fa-truck"></i>
                </div>

                <div class="stat-info">

                    <p>
                        Suppliers
                    </p>

                    <h2>
                    <?php echo $total_suppliers; ?>
                    </h2>

                </div>

            </div>


            <!-- Today's Sales -->

            <div class="stat-card">

                <div class="stat-icon">
                    <i class="fa-solid fa-coins"></i>
                </div>

                <div class="stat-info">

                    <p>
                        Today's Sales
                    </p>

                    <h2>
                    <?php echo $total_sales_today; ?>
                        <small>IQD</small>
                    </h2>

                </div>

            </div>

        </div>



        <!-- =========================
             LOWER SECTION
        ========================= -->

        <div class="dashboard-grid">


            <!-- =========================
                 RECENT SALES
            ========================= -->

            <section class="dashboard-card">

                <div class="card-header">

                    <h3>
                        Recent Sales
                    </h3>

                    <a href="report.php">
                        View All
                    </a>

                </div>


                <div class="table-wrapper">

                    <table>

                        <thead>

                            <tr>

                                <th>
                                    Product
                                </th>

                                <th>
                                    Qty
                                </th>

                                <th>
                                    Amount
                                </th>

                                <th>
                                   Total_Amount
                                </th>

                            </tr>

                        </thead>


                        <tbody>
                            <?php
                        if($_SESSION['cart'] ?? ''){
                            foreach($_SESSION['cart'] as $item_row){
                            ?>
                            <tr>

                                <td>
                                   <?php echo $item_row['name'] ;?>
                                </td>
                                  
                                <td>
                                 <?php echo $item_row['qty'] ;?>
                                </td>

                                <td>
                                    <?php echo $item_row['price'];?>
                                </td>

                                <td>
                                    <?php echo $item_row['total_amount'];?>
                                </td>



                            </tr>
                      <?php
                        }
                        }
                         ?>

                        </tbody>

                    </table>

                </div>

            </section>



            <!-- =========================
                 QUICK ACTIONS
            ========================= -->

            <section class="dashboard-card quick-card">

                <h3>
                    Quick Actions
                </h3>


                <a href="sales.php" class="quick-button">

                    <span>
                        <i class="fa-solid fa-cart-plus"></i>
                    </span>

                    <div>
                        <strong>
                            New Sale
                        </strong>

                        <small>
                            Create a new invoice
                        </small>
                    </div>

                    <i class="fa-solid fa-chevron-right arrow"></i>

                </a>


                <a href="products.php" class="quick-button">

                    <span>
                        <i class="fa-solid fa-plus"></i>
                    </span>

                    <div>
                        <strong>
                            Add Product
                        </strong>

                        <small>
                            Add a new product
                        </small>
                    </div>

                    <i class="fa-solid fa-chevron-right arrow"></i>

                </a>


                <a href="report.php" class="quick-button">

                    <span>
                        <i class="fa-solid fa-chart-line"></i>
                    </span>

                    <div>
                        <strong>
                            Sales Report
                        </strong>

                        <small>
                            View sales history
                        </small>
                    </div>

                    <i class="fa-solid fa-chevron-right arrow"></i>

                </a>
    </main>

</body>
</html>