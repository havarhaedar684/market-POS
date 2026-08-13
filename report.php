<?php
session_start();
include "db.php";
if(!isset($_SESSION['username']) || $_SESSION['role'] === "employee"){
    header("Location:index.php");
    exit();
}
if(isset($_GET['id'])){
$id=$_GET['id'];
$sql_delete="DELETE FROM sales_item where id=$id";
mysqli_query($conn, $sql_delete);
}
$total="SELECT sum(total_amount) AS total_revenue FROM sales_item";
$total_query=mysqli_query($conn, $total);
$total_row=mysqli_fetch_assoc($total_query);
$total_amount=$total_row['total_revenue'];
$sql="SELECT id, name, quantity, unit_price, total_amount,date_sale FROM sales_item";
$result=mysqli_query($conn, $sql);





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
          background: transparent;
          color: #0f3e53;
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

            background: #ADC4CE;
        }

        tr:not(:last-child) td {
            border-bottom: 1px solid rgba(255, 255, 255, 0.4);
        }

        .empty-message {
            text-align: center;

            padding: 30px;

            color: #78909c;

            font-size: 15px;
        }



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
        .btn-delete {
    background: #2c4a52;
    color: white;
    padding: 6px 12px;
    border-radius: 6px;
    text-decoration: none;
    font-size: 13px;
    font-weight: 600;
    transition: background 0.2s;
    display: inline-block;
}

.btn-delete:hover {
    background: #1e353b;
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

                 <li>
                    <a href="read.php">
                        <i class="fa-solid fa-user"></i>
                        Users
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

            <a href="logout.php">
                <i class="fa-solid fa-right-from-bracket"></i>
                Logout
            </a>

        </div>

    </div>


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

                             <th>
                                Action
                            </th>


                        </tr>

                    </thead>


                    <tbody>

                    <?php

                    if($result){
                     while($row=mysqli_fetch_assoc($result)){
                       

                    ?>

                        <tr>
                          <td><?php echo $row['name'] ?></td>
                          <td><?php echo $row['quantity']; ?></td>
                          <td><?php echo number_format($row['unit_price']); ?> IQD</td>
                          <td><?php echo number_format($row['total_amount']); ?> IQD </td>
                          <td><?php echo $row['date_sale']; //AI ?></td>

                         <td><a href="report.php?id=<?php echo $row['id']; ?>" class="btn-delete" onclick="return confirm('Are you sure you want to delete this?');" >Delete</a></td> 
                       
                           
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