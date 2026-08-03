<?php
error_reporting(E_ALL); ini_set('display_errors', 1);

session_start();
include "db.php";
if($_SERVER["REQUEST_METHOD"]=='POST'){
$email=$_POST['email'];
$pass=$_POST['password'];
$sql="SELECT * FROM users WHERE email='$email'";
$result=mysqli_query($conn, $sql);
if(mysqli_num_rows($result)>0){
    $row=mysqli_fetch_assoc($result);
if(password_verify($pass, $row['password'])){
    $_SESSION['username']=$row['username'];
    header("Location:dashboard.php");
    exit();

}
}
}






?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Market POS - Login</title>
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
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
        }

        .login-card {
            background: rgba(255, 255, 255, 0.95);
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
            margin-bottom: 30px;
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
            margin-bottom: 20px;
        }

        .field label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: #475569;
            margin-bottom: 8px;
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

        .field input {
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

        .field input:focus {
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
            background: linear-gradient(135deg, #4f46e5 0%, #4338ca 100%);
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
                <i class="fa-solid fa-cash-register"></i>
            </div>
            <h2>Market POS</h2>
            <p>Sign in to your terminal</p>
        </div>
        <form method="POST">
            <div class="field">
                <label for="email">Email</label>
                <div class="input-container">
                    <i class="fa-solid fa-user"></i>
                    <input type="text" id="email" name="email" placeholder="Enter your email" required>
                </div>
            </div>
            
            <div class="field">
                <label for="password">Password</label>
                <div class="input-container">
                    <i class="fa-solid fa-lock"></i>
                    <input type="password" id="password" name="password" placeholder="Enter your password" required>
                </div>
            </div>
            
            <button type="submit" class="login-btn">Login</button>
        </form>
    </div>

</body>
</html>