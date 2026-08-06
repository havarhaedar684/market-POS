<?php
include "db.php";
$id=$_GET['id'];
if($_POST){
$user=$_POST['username'];
$email=$_POST['email'];
$pass=$_POST['password'];
$role=$_POST['role'];
$sql = "UPDATE users SET username='$user', email='$email', password='$pass', role='$role' WHERE id=$id";
$result=mysqli_query($conn, $sql);
if($result){
    header("Location:read.php");
    exit();
}
}
//this is update in categories:


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Market POS - Add User</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background:#96B6C5;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
        }

        .login-card {
            background:#ADC4CE;
            backdrop-filter: blur(10px);
            padding: 40px 35px;
            border-radius: 16px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
            width: 100%;
            max-width: 400px;
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

        .login-header {
            text-align: center;
            margin-bottom: 25px;
        }

        .logo-icon {
            width: 60px;
            height: 60px;
            background: #155674;
            color: white;
            font-size: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 14px;
            margin: 0 auto 15px auto;
            box-shadow: 0 8px 16px rgba(79, 70, 229, 0.3);
        }

        .login-card h2 {
            color: #1e1b4b;
            font-size: 26px;
            font-weight: 700;
            margin-bottom: 6px;
            letter-spacing: -0.5px;
        }

        .login-card p {
            color: #64748b;
            font-size: 14px;
        }

        .field {
            margin-bottom: 16px;
        }

        .field label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: #475569;
            margin-bottom: 6px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .input-container {
            position: relative;
            display: flex;
            align-items: center;
        }

        .input-container i {
            position: absolute;
            left: 14px;
            color: #94a3b8;
            font-size: 16px;
            transition: color 0.3s;
        }

        .field input, .field select {
            width: 100%;
            padding: 12px 14px 12px 45px;
            border: 2px solid #e2e8f0;
            border-radius: 10px;
            font-size: 15px;
            color: #1e293b;
            outline: none;
            background-color: #f8fafc;
            transition: all 0.3s ease;
        }

        .field select {
            appearance: none;
            cursor: pointer;
        }

        .field input:focus, .field select:focus {
            border-color: #4f46e5;
            background-color: #ffffff;
            box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1);
        }

        .field input:focus + i,
        .input-container:focus-within i {
            color: #4f46e5;
        }

        .login-btn {
            width: 100%;
            background: #155674;
            color: white;
            border: none;
            padding: 14px;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            margin-top: 10px;
            box-shadow: 0 4px 12px rgba(79, 70, 229, 0.4);
            transition: all 0.3s ease;
        }

        .login-btn:hover {
            background: linear-gradient(135deg, #4338ca 0%, #3730a3 100%);
            box-shadow: 0 6px 16px rgba(79, 70, 229, 0.6);
            transform: translateY(-1px);
        }

        .login-btn:active {
            transform: translateY(0);
        }
    </style>
</head>
<body>

    <div class="login-card">
        <div class="login-header">
            <div class="logo-icon">
                <i class="fa-solid fa-user-plus"></i>
            </div>
            <h2>Market POS</h2>
            <p>Add new system user</p>
        </div>
        <form method="POST">
            <div class="field">
                <label for="username">Username</label>
                <div class="input-container">
                    <i class="fa-solid fa-user"></i>
                    <input type="text" id="username" name="username" placeholder="Enter username" required>
                </div>
            </div>

            <div class="field">
                <label for="email">Email</label>
                <div class="input-container">
                    <i class="fa-solid fa-envelope"></i>
                    <input type="email" id="email" name=email placeholder="Enter email address" required>
                </div>
            </div>
            
            <div class="field">
                <label for="password">Password</label>
                <div class="input-container">
                    <i class="fa-solid fa-lock"></i>
                    <input type="password" id="password" name=password placeholder="Enter password" required>
                </div>
            </div>

            <div class="field">
                <label for="role">Role</label>
                <div class="input-container">
                    <i class="fa-solid fa-user-tag"></i>
                    <select id="role" name=role required>
                        <option value="" disabled selected>Select user role</option>
                        <option value="employee">Employee</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>
            </div>
            
            <button type="submit" class="login-btn">Add User</button>
        </form>
    </div>

</body>
</html>