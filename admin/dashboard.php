<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Hospital Admin Dashboard</title>
<link rel="stylesheet" href="dashboard.css">
</head>

<body>

<div class="dashboard">

<?php include 'sidebar.php'; ?>

<!-- MAIN CONTENT -->
<main class="main">

<header class="topbar">
<h1>Office of the Administrator</h1>

<div class="admin">
<img src="https://i.pravatar.cc/40">
<span>Administrator</span>
</div>
</header>


<!-- STATS CARDS -->
<section class="cards">

<div class="card">
<h3>Total Users</h3>
<p class="value">324</p>
</div>

<div class="card">
<h3>Patients Today</h3>
<p class="value">87</p>
</div>

<div class="card">
<h3>Active Staff</h3>
<p class="value">54</p>
</div>

<div class="card">
<h3>System Status</h3>
<p class="value green">Online</p>
</div>

</section>


<!-- GRID CONTENT -->
<section class="grid">

<div class="panel">
<h3>Recent User Registrations</h3>

<table>
<tr>
<th>Name</th>
<th>Role</th>
<th>Status</th>
</tr>

<tr>
<td>Dr. Maria Santos</td>
<td>Health Nurse</td>
<td class="active">Active</td>
</tr>

<tr>
<td>Juan Cruz</td>
<td>Health Clerk</td>
<td class="active">Active</td>
</tr>

<tr>
<td>Ana Reyes</td>
<td>Health Coordinator</td>
<td class="pending">Pending</td>
</tr>

</table>
</div>


<div class="panel">

<h3>System Performance</h3>

<div class="monitor">

<div class="monitor-item">
<span>CPU Usage</span>
<div class="bar"><div class="fill cpu"></div></div>
</div>

<div class="monitor-item">
<span>Database Load</span>
<div class="bar"><div class="fill db"></div></div>
</div>

<div class="monitor-item">
<span>Network</span>
<div class="bar"><div class="fill net"></div></div>
</div>

</div>

</div>

</section>

</main>

</div>

</body>
</html>