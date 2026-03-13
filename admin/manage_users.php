<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Manage Users - MHR System</title>
<link rel="stylesheet" href="dashboard.css">
<link rel="stylesheet" href="manage_users.css">
</head>

<body>

<div class="dashboard">

<?php include 'sidebar.php'; ?>

<!-- MAIN CONTENT -->
<main class="main">

<header class="topbar">
<h1>Manage Users</h1>

<div class="admin">
<img src="https://i.pravatar.cc/40">
<span>Administrator</span>
</div>
</header>


<!-- USERS CONTENT -->
<section class="users-container">

<div class="user-controls">
    <div class="search-box">
        <input type="text" placeholder="Search by name or role...">
    </div>
    <button class="btn-add-user">+ Add New User</button>
</div>

<div class="table-responsive">
    <table class="users-table">
        <thead>
            <tr>
                <th>id</th>
                <th>username</th>
                <th>password</th>
                <th>role</th>
                <th>created at</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>user1</td>
                <td>********</td>
                <td>Health Nurse</td>
                <td>2023-10-25 10:30:00</td>
            </tr>
            <tr>
                <td>2</td>
                <td>user2</td>
                <td>********</td>
                <td>Health Clerk</td>
                <td>2023-10-25 10:32:00</td>
            </tr>
            <tr>
                <td>3</td>
                <td>user3</td>
                <td>********</td>
                <td>Health Coordinator</td>
                <td>2023-10-25 10:35:00</td>
            </tr>
        </tbody>
    </table>
</div>

</section>

</main>

</div>

</body>
</html>