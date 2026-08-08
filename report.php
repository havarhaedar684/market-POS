<?php
session_start();
include "db.php";
$total_amount=0;
if($_SESSION['cart'] ?? ''){
foreach($_SESSION['cart'] as $row_item){
$total_amount += $row_item['total_amount'];
}
}




?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Sales Report</title>

    <!-- Font Awesome -->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

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


      

        .sidebar {
            width: 280px;

            background: #ADC4CE;

            color: white;

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
        }

        .nav-links li a i {
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


       
        .report-section {
            background: #ADC4CE;

            padding: 20px;

            border-radius: 12px;

            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }

        .section-header {
            font-size: 18px;

            color: #2c4a52;

            font-weight: 700;

            margin-bottom: 15px;
        }

        .revenue-box {
            display: inline-flex;

            align-items: center;

            gap: 10px;

            background: #2c4a52;

            color: white;

            padding: 13px 18px;

            border-radius: 8px;

            font-size: 16px;

            font-weight: 600;

            margin-bottom: 18px;
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
            padding: 13px 15px;

            font-size: 14px;
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


        /* =========================
           EMPTY REPORT
        ========================= */

        .empty-message {
            text-align: center;

            padding: 30px;

            color: #78909c;

            font-size: 15px;
        }


        /* =========================
           RESPONSIVE
        ========================= */

        @media (max-width: 800px) {

            .sidebar {
                width: 220px;
            }

            .main-content {
                padding: 20px;
            }

            th,
            td {
                padding: 10px;
            }
        }

    </style>
</head>


<body>


    <div class="sidebar">

        <div class="sidebar-top">

            <h2>Dashboard</h2>

            <ul class="nav-links">

                <li>
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

                <li class="active">
                    <a href="report.php">
                        <i class="fa-solid fa-chart-line"></i>
                        Report
                    </a>
                </li>

            </ul>

        </div>


        <!-- Logout -->

        <div class="logout-section">

            <a href="#">
                <i class="fa-solid fa-right-from-bracket"></i>
                Logout
            </a>

        </div>

    </div>


    <!-- =========================
         MAIN CONTENT
    ========================= -->

    <div class="main-content">

        <h1 class="page-title">
            Sales Report
        </h1>


        <div class="report-section">

            <div class="section-header">
                Sold Products History
            </div>


            <!-- Total Revenue -->

            <div class="revenue-box">

                <i class="fa-solid fa-coins"></i>

                Total Revenue:
                <?php echo number_format($total_amount); ?> IQD

            </div>

            <div class="table-wrapper">

                <table>

                    <thead>

                        <tr>

                            <th>
                                Product Name
                            </th>

                            <th>
                                Quantity
                            </th>

                            <th>
                                Unit Price
                            </th>

                            <th>
                                Total Amount
                            </th>

                            <th>
                                Date & Time
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                    <?php

                    if($_SESSION['cart'] ?? ''){

                        foreach ($_SESSION['cart'] as $item){

                    ?>

                        <tr>
                          <td><?php echo htmlspecialchars($item['name']); ?></td>
                          <td><?php echo $item['qty']; ?></td>
                          <td><?php echo number_format($item['price']); ?> IQD</td>
                          <td><?php echo number_format($item['total_amount']); ?> IQD </td>
                          <td><?php echo date("d/m/Y H:i"); //AI ?>  </td>
                           
                        </tr>
                    <?php
                        }
                    }

                    ?>


                    </tbody>

                </table>

            </div>

        </div>

    </div>


</body>

</html>