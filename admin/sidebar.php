<!-- SIDEBAR -->
<aside class="sidebar">

<h2 class="logo">MHR System</h2>

<ul class="menu">
<?php $p = basename($_SERVER['PHP_SELF']); ?>
<li class="<?= $p == 'dashboard.php' ? 'active' : '' ?>" style="padding: 0;"><a href="dashboard.php" style="text-decoration:none; color:inherit; display:block; padding: 15px;">Dashboard</a></li>
<li class="<?= $p == 'manage_users.php' ? 'active' : '' ?>" style="padding: 0;"><a href="manage_users.php" style="text-decoration:none; color:inherit; display:block; padding: 15px;">Manage Users</a></li>
<li class="<?= $p == 'roles_permissions.php' ? 'active' : '' ?>" style="padding: 0;"><a href="roles_permissions.php" style="text-decoration:none; color:inherit; display:block; padding: 15px;">Roles & Permissions</a></li>
<li class="<?= $p == 'medical_records.php' ? 'active' : '' ?>" style="padding: 0;"><a href="medical_records.php" style="text-decoration:none; color:inherit; display:block; padding: 15px;">Medical Records</a></li>
<li class="<?= $p == 'reports.php' ? 'active' : '' ?>" style="padding: 0;"><a href="reports.php" style="text-decoration:none; color:inherit; display:block; padding: 15px;">Reports</a></li>
<li class="<?= $p == 'system_monitor.php' ? 'active' : '' ?>" style="padding: 0;"><a href="system_monitor.php" style="text-decoration:none; color:inherit; display:block; padding: 15px;">System Monitor</a></li>
<li style="padding: 0;"><a href="../index.php" style="text-decoration:none; color:inherit; display:block; padding: 15px;">Logout</a></li>
</ul>

</aside>