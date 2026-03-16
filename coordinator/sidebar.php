<!-- SIDEBAR -->
<aside class="sidebar">

<h2 class="logo">MHR System</h2>

<ul class="menu">
<?php $p = basename($_SERVER['PHP_SELF']); ?>
<li class="<?= $p == 'register_student.php' ? 'active' : '' ?>" style="padding: 0;"><a href="register_student.php" style="text-decoration:none; color:inherit; display:block; padding: 15px;">Register Students</a></li>
<li class="<?= $p == 'personal_info.php' ? 'active' : '' ?>" style="padding: 0;"><a href="personal_info.php" style="text-decoration:none; color:inherit; display:block; padding: 15px;">Personal Info</a></li>
<li class="<?= $p == 'print_health_records.php' ? 'active' : '' ?>" style="padding: 0;"><a href="print_health_records.php" style="text-decoration:none; color:inherit; display:block; padding: 15px;">Print Student Health Records</a></li>
<li style="padding: 0;"><a href="../index.php" style="text-decoration:none; color:inherit; display:block; padding: 15px;">Logout</a></li>
</ul>

</aside>