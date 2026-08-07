<?php
session_start();
include "db.php";
if($_POST){
$product=$_POST['product_all'];
$qty=$_POST['qty-q'];
$sql="SELECT * FROM products where id=$product";
$result=mysqli_query($conn, $sql);
$row=mysqli_fetch_assoc($result);
if($row){
    $item=[
    'name' => $row['name'],
    'price' => $row['sale_price'],
    'qty'=>$qty,
    'total_amount' => $row['sale_price'] * $qty
   ];

   $_SESSION['cart'][]=$item;//hallgrtni datakan ba shewayaki kati
}

}



?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales Dashboard</title>
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
            padding: 30px;
            overflow-y: auto;
            direction: ltr;
        }

        .page-title {
            font-size: 24px;
            color: #1e1b4b;
            margin-bottom: 20px;
            font-weight: 700;
        }

        /* Sales Layout Grid */
        .sales-container {
            display: grid;
            grid-template-columns: 1fr 400px;
            gap: 20px;
        }

        /* Left Box: Product Selection */
        .products-section {
            background: #ADC4CE;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
        }

        .section-header {
            font-size: 18px;
            color: #2c4a52;
            font-weight: 700;
            margin-bottom: 15px;
        }

        .controls-row {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
        }

        .controls-row select, 
        .controls-row input {
            padding: 10px 15px;
            border: 1px solid #78909c;
            border-radius: 8px;
            background: #f0f4f8;
            outline: none;
            font-size: 14px;
            color: #1a2f35;
        }

        .controls-row select {
            flex: 2;
        }

        .controls-row input {
            flex: 1;
        }

        .btn-add-item {
            background: #2c4a52;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            transition: background 0.3s;
        }

        .btn-add-item:hover {
            background: #1a2f35;
        }

        /* Table inside Sales */
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

        th, td {
            padding: 12px 15px;
            font-size: 14px;
        }

        th {
            background: #8aa4b0;
            color: #1a2f35;
            font-weight: 700;
        }

        tr:not(:last-child) td {
            border-bottom: 1px solid #f0f4f8;
        }

        td {
            color: #2c4a52;
        }

        .btn-delete-row {
            color: #b91c1c;
            background: none;
            border: none;
            cursor: pointer;
            font-weight: 600;
        }

        /* Right Box: Invoice Summary */
        .invoice-section {
            background: #ADC4CE;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .invoice-details {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .invoice-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 16px;
            font-weight: 600;
            color: #2c4a52;
        }

        .invoice-row span.amount {
            font-size: 20px;
            color: #1e1b4b;
        }

        .invoice-input-group {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .invoice-input-group label {
            font-size: 14px;
            color: #2c4a52;
            font-weight: 600;
        }

        .invoice-input-group input {
            width: 100%;
            padding: 10px 15px;
            border: 1px solid #78909c;
            border-radius: 8px;
            background: #f0f4f8;
            outline: none;
            font-size: 16px;
            color: #1a2f35;
            font-weight: 700;
        }

        .divider {
            height: 1px;
            background: rgba(255, 255, 255, 0.5);
            margin: 10px 0;
        }

        .btn-save-invoice {
            background: #2c4a52;
            color: white;
            padding: 14px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
            font-weight: 700;
            width: 100%;
            transition: background 0.3s;
            text-align: center;
        }

        .btn-save-invoice:hover {
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
                <li><a href="#"><i class="fa-solid fa-box"></i> Products</a></li>
                <li><a href="#"><i class="fa-solid fa-truck"></i> Suppliers</a></li>
                <li class="active"><a href="#"><i class="fa-solid fa-cart-shopping"></i> Sales</a></li>
            </ul>
        </div>
        <div class="logout-section">
            <a href="#"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
        </div>
    </div>

    <!-- Main Content (Right) -->
    <div class="main-content">
        <h1 class="page-title">Sales & Invoice</h1>

        
        <div class="sales-container">
            <!-- Left Side: Products Selection & List -->
            <div class="products-section">
                <div class="section-header">Add Product to Invoice</div>
                <form method="POST">
                <div class="controls-row">
                    <select name="product_all">
                        <option value="">Select Product</option>
                        <?php
                        $sql1="SELECT * FROM products";
                        $result1=mysqli_query($conn, $sql1);
                        if($result1){
                        while($row=mysqli_fetch_assoc($result1)):
                        
                        ?>
                        <option value="<?php echo $row ['id']; ?>">
                            <?php
                           echo $row['name']." -> IQD".$row['sale_price'];
                           
                            ?>
                        </option>
                        <?php
                        endwhile;
                        }
                        ?>
                    </select>
                    <input type="number"name="qty-q" value="1" min="1" placeholder="Qty">
                    <button class="btn-add-item"><i class="fa-solid fa-plus"></i> Add</button>
                </div>
                </form>

                <div class="table-wrapper">
                    <table>
                        <thead>
                            <tr>
                                <th>Product Name</th>
                                <th>Price</th>
                                <th>Qty</th>
                                <th>Subtotal</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            //bo away button (add) yaksar esh nakat (isset)dadanam la pesh yakam if
                             if(isset($_SESSION['cart'])){
                             foreach($_SESSION['cart'] as $row_item){
                            ?>
                            <tr>
                                <td><?php echo $row_item['name']; ?></td>
                                <td><?php echo $row_item['price']; ?></td>
                                <td><?php echo $row_item['qty']; ?></td>
                                <td><?php echo $row_item['total_amount'];?></td>
                                
                               
                                <td><button class="btn-delete-row"><i class="fa-solid fa-trash"></i></button></td>
                          
                            </tr>
                                  <?php
                             }
                             }

                            ?>  
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Right Side: Invoice Summary & Calculation -->
            <div class="invoice-section">
                <div class="invoice-details">
                    <div class="section-header">Invoice Summary</div>
                    
                    <div class="invoice-row">
                        <span>Total Amount:</span>
                        <span class="amount">$1000.00</span>
                    </div>

                    <div class="divider"></div>

                    <div class="invoice-input-group">
                        <label>Received Amount</label>
                        <input type="number" placeholder="0.00">
                    </div>

                    <div class="invoice-row" style="margin-top: 5px;">
                        <span>Change (گەڕاوە):</span>
                        <span class="amount" style="color: #065f46;">$0.00</span>
                    </div>
                </div>

                <button class="btn-save-invoice"><i class="fa-solid fa-check"></i> Save Invoice</button>
            </div>
        </div>
    </div>

</body>
</html>