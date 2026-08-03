<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #f8fafc;
            display: flex;
            height: 100vh;
        }

        /* ستایلی سایدبار */
        .sidebar {
            width: 260px;
            background: #1e1b4b;
            color: white;
            padding: 25px 20px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .sidebar-brand {
            font-size: 22px;
            font-weight: 700;
            color: #818cf8;
            text-align: center;
            margin-bottom: 40px;
        }

        .sidebar-menu {
            display: flex;
            flex-direction: column;
            gap: 10px;
            flex-grow: 1;
        }

        .sidebar-menu a {
            color: #cbd5e1;
            text-decoration: none;
            padding: 12px 15px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 15px;
            transition: all 0.3s ease;
        }

        .sidebar-menu a:hover, .sidebar-menu a.active {
            background: #312e81;
            color: white;
        }

        /* ستایلی دوگمەی Logout لە سایدباردا */
        .logout-btn {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            color: white;
            padding: 12px 15px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 15px;
            font-weight: 600;
            text-decoration: none;
            box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
            transition: all 0.3s ease;
        }

        .logout-btn:hover {
            background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%);
            box-shadow: 0 6px 16px rgba(239, 68, 68, 0.5);
            transform: translateY(-1px);
        }

        /* ناوەڕۆکی سەرەکی داشبۆرد */
        .main-content {
            flex-grow: 1;
            padding: 40px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .welcome-card {
            background: white;
            padding: 40px;
            border-radius: 16px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
            width: 100%;
            max-width: 500px;
            text-align: center;
            border: 1px solid #e2e8f0;
        }

        .welcome-card h1 {
            color: #1e293b;
            font-size: 24px;
            margin-bottom: 12px;
            font-weight: 700;
        }

        .welcome-card p {
            color: #64748b;
            font-size: 15px;
        }
    </style>
</head>
<body>

    <!-- سایدبار -->
    <div class="sidebar">
        <div>
            <div class="sidebar-brand">Dashboard</div>
            <div class="sidebar-menu">
                <a href="#" class="active"><i class="fa-solid fa-house"></i> Home</a>
                <a href="#"><i class="fa-solid fa-box"></i> Products</a>
                <a href="#"><i class="fa-solid fa-user"></i> Profile</a>
            </div>
        </div>
        
        <!-- دوگمەی Logout لە خوارەوەی سایدبار -->
        <a href="logout.php" class="logout-btn">  <!--bastnaway logouti naw dashboard ba logout.php -->
            <i class="fa-solid fa-right-from-bracket"></i> Logout
        </a>
    </div>

    <!-- ناوەڕۆکی سەرەکی -->
    <div class="main-content">
        <div class="welcome-card">
            <h1>بەخێر بێیت بۆ داشبۆرد</h1>
            <p>لێرەدا دەتوانیت بەڕێوەبەرایەتی سیستەمەکەت بکەیت.</p>
        </div>
    </div>

</body>
</html>