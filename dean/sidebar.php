<!-- SIDEBAR -->
<aside class="sidebar">

<h2 class="logo">MHR System</h2>

<ul class="menu">
<?php $p = basename($_SERVER['PHP_SELF']); ?>
<li class="<?= $p == 'monitor_health.php' ? 'active' : '' ?>" style="padding: 0;"><a href="monitor_health.php" style="text-decoration:none; color:inherit; display:block; padding: 15px;">Monitor Health</a></li>
<li class="<?= $p == 'student_records.php' ? 'active' : '' ?>" style="padding: 0;"><a href="student_records.php" style="text-decoration:none; color:inherit; display:block; padding: 15px;">Student Records</a></li>
<li class="<?= $p == 'health_statistics.php' ? 'active' : '' ?>" style="padding: 0;"><a href="health_statistics.php" style="text-decoration:none; color:inherit; display:block; padding: 15px;">Health Statistics</a></li>
<li style="padding: 0;"><a href="../index.php" style="text-decoration:none; color:inherit; display:block; padding: 15px;">Logout</a></li>
</ul>

</aside>