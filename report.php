<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales Report</title>
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
            color: #2c4a52;
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
            color: #334e58;
            text-decoration: none;
            padding: 12px 16px;
            border-radius: 10px;
            font-size: 15px;
            transition: all 0.3s ease;
        }

        .nav-links li a:hover {
            background: rgba(255, 255, 255, 0.3);
            color: #1a2f35;
        }

        .nav-links li.active a {
            background: #2c4a52;
            color: #ffffff;
        }

        /* Main Content Styling */
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

        /* Report Box & Table */
        .report-section {
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
    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-top">
            <h2>Dashboard</h2>
            <ul class="nav-links">
                <li><a href="sales.php"><i class="fa-solid fa-cart-shopping"></i> Sales</a></li>
                <li class="active"><a href="#"><i class="fa-solid fa-chart-line"></i> Report</a></li>
            </ul>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <h1 class="page-title">Sales Report</h1>

        <div class="report-section">
            <div class="section-header">All Invoices History</div>
            
            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>Invoice ID</th>
                            <th>Total Amount</th>
                            <th>Date & Time</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- لێرەدا دواتر PHPـەکەی تێدەخەین بۆ هێنانی داتا -->
                        <tr>
                            <td>1</td>
                            <td>15,000 IQD</td>
                            <td>2026-08-08 12:00:00</td>
                            <td><button style="background: #2c4a52; color: white; border: none; padding: 5px 10px; border-radius: 6px; cursor: pointer;">View</button></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>
</html>