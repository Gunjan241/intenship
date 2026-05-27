<!DOCTYPE html>
<html>
<head>

<title>Employee Management System</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
rel="stylesheet">

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

body{
    background:#f4f6f9;
    font-family:'Poppins',sans-serif;
    overflow-x:hidden;
}

/* ANIMATION */

@keyframes fadeIn{

    from{
        opacity:0;
        transform:translateY(20px);
    }

    to{
        opacity:1;
        transform:translateY(0);
    }
}

/* SIDEBAR */

.sidebar{
    width:260px;
    height:100vh;
    position:fixed;
    background:linear-gradient(to bottom,#111827,#1e3a8a);
    padding-top:20px;
    overflow:auto;
    box-shadow:4px 0px 15px rgba(0,0,0,0.1);

    animation:fadeIn 0.7s ease;
}

.sidebar h3{
    color:white;
    text-align:center;
    margin-bottom:40px;
    font-weight:600;
    letter-spacing:1px;
    transition:0.3s;
}

.sidebar h3:hover{
    transform:scale(1.05);
}

/* SIDEBAR LINKS */

.sidebar a{
    display:flex;
    align-items:center;

    color:white;
    padding:15px 25px;
    text-decoration:none;

    transition:all 0.3s ease;

    border-left:4px solid transparent;

    font-size:17px;

    position:relative;
    overflow:hidden;
}

.sidebar a i{
    margin-right:12px;
    font-size:20px;
}

/* HOVER EFFECT */

.sidebar a:hover{

    background:rgba(255,255,255,0.1);

    border-left:4px solid #0d6efd;

    padding-left:35px;

    color:white;

    transform:translateX(5px);
}

/* GLOW EFFECT */

.sidebar a::before{

    content:"";

    position:absolute;

    left:-100%;

    top:0;

    width:100%;
    height:100%;

    background:rgba(255,255,255,0.1);

    transition:0.5s;
}

.sidebar a:hover::before{
    left:100%;
}

/* MAIN CONTENT */

.main-content{
    margin-left:260px;
    padding:25px;

    animation:fadeIn 0.8s ease;
}

/* TOPBAR */

.topbar{

    background:rgba(255,255,255,0.7);

    backdrop-filter:blur(10px);

    padding:18px 25px;

    border-radius:15px;

    margin-bottom:25px;

    box-shadow:0px 4px 15px rgba(0,0,0,0.08);

    display:flex;

    justify-content:space-between;

    align-items:center;

    transition:0.3s;

}

.topbar:hover{
    transform:translateY(-2px);
}

.topbar h4{
    margin:0;
    font-weight:600;
}

/* LOGOUT BUTTON */

.logout-btn{

    background:#dc3545;

    color:white;

    padding:10px 22px;

    border-radius:10px;

    text-decoration:none;

    transition:all 0.3s ease;

    font-weight:500;
}

.logout-btn:hover{

    background:#bb2d3b;

    color:white;

    transform:translateY(-3px) scale(1.03);

    box-shadow:0px 8px 20px rgba(220,53,69,0.4);
}

/* BUTTONS */

.btn{

    border-radius:10px !important;

    font-weight:500;

    transition:all 0.3s ease !important;
}

.btn:hover{

    transform:translateY(-3px) scale(1.03);

    box-shadow:0px 8px 20px rgba(0,0,0,0.15);
}

/* CARD */

.card{

    border:none !important;

    border-radius:18px !important;

    overflow:hidden;

    transition:all 0.3s ease;
}

.card:hover{

    transform:translateY(-5px);

    box-shadow:0px 10px 25px rgba(0,0,0,0.12);
}

/* TABLE */

.table{
    border-radius:15px;
    overflow:hidden;
}

/* IMAGE HOVER */

img{
    transition:0.3s;
}

img:hover{
    transform:scale(1.05);
}

/* SCROLLBAR */

::-webkit-scrollbar{
    width:8px;
}

::-webkit-scrollbar-thumb{
    background:#888;
    border-radius:10px;
}

::-webkit-scrollbar-thumb:hover{
    background:#555;
}

</style>

</head>

<body>

<!-- SIDEBAR -->

<div class="sidebar">

<h3>EMS Panel</h3>

<a href="/employee-management/admin/dashboard.php">

<i class="bi bi-speedometer2"></i>
Dashboard

</a>

<a href="/employee-management/admin/employees/create.php">

<i class="bi bi-person-plus"></i>
Add Employee

</a>

<a href="/employee-management/admin/employees/view.php">

<i class="bi bi-people"></i>
View Employees

</a>

<a href="/employee-management/admin/employees/documents.php">

<i class="bi bi-upload"></i>
Upload Documents

</a>

<a href="/employee-management/admin/employees/view_documents.php">

<i class="bi bi-file-earmark"></i>
View Documents

</a>

<a href="/employee-management/logout.php">

<i class="bi bi-box-arrow-right"></i>
Logout

</a>

</div>

<!-- MAIN CONTENT -->

<div class="main-content">

<!-- TOPBAR -->

<div class="topbar">

<h4>
Employee Management System
</h4>

<a href="/employee-management/logout.php"
class="logout-btn">

Logout

</a>

</div>