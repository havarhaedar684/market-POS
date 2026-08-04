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
            background: linear-gradient(135deg, #1e1b4b 0%, #312e81 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .main-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            padding: 40px 35px;
            border-radius: 16px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
            width: 100%;
            max-width: 900px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            animation: fadeIn 0.6s ease-out;
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
            background: linear-gradient(135deg, #4f46e5 0%, #6366f1 100%);
            color: white;
            font-size: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 14px;
            box-shadow: 0 8px 16px rgba(79, 70, 229, 0.3);
        }

        .card-header h2 {
            color: #1e1b4b;
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 4px;
            letter-spacing: -0.5px;
        }

        .card-header p {
            color: #64748b;
            font-size: 14px;
        }

        .logout-btn {
            background: #fee2e2;
            color: #dc2626;
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
            background: #fecaca;
            transform: translateY(-1px);
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 25px;
            background: #ffffff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            border: 1px solid #e2e8f0;
        }

        .data-table th, .data-table td {
            padding: 14px 16px;
            text-align: left;
            border-bottom: 1px solid #e2e8f0;
            font-size: 14px;
        }

        .data-table th {
            background-color: #f8fafc;
            color: #475569;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .data-table td {
            color: #1e293b;
        }

        .data-table tr:last-child td {
            border-bottom: none;
        }
        .table-footer-actions {
            display: flex;
            justify-content: flex-end;
            margin-top: 15px;
        }

        .data-table tr:hover {
            background-color: #f1f5f9;
        }
    </style>
</head>
<body>

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
                    <th>ID
                       
                    </th>
                    <th>Username
                       
                    </th>
                    <th>Email</th>
                    
                    <th>Password (Hash)</th>

                    <th>Role</th>

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
                       echo  "<td>". $row['password']."</td>";
                 ?>

                 <?php
                       echo  "<td>". $row['role']."</td>";
                 ?>
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