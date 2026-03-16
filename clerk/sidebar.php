<!-- SIDEBAR -->
<aside class="sidebar">

<h2 class="logo">MHR System</h2>

<ul class="menu">
<?php $p = basename($_SERVER['PHP_SELF']); ?>
<li class="<?= $p == 'register_student.php' ? 'active' : '' ?>"><a href="register_student.php">Register Students</a></li>
<li class="<?= $p == 'personal_info.php' ? 'active' : '' ?>"><a href="personal_info.php">Personal Info</a></li>
<li class="<?= $p == 'print_health_records.php' ? 'active' : '' ?>"><a href="print_health_records.php">Print Student Health Records</a></li>
<li><a href="../index.php">Logout</a></li>
</ul>

</aside>
