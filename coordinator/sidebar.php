<!-- SIDEBAR -->
<aside class="sidebar">

<h2 class="logo">MHR System</h2>

<ul class="menu">
<?php $p = basename($_SERVER['PHP_SELF']); ?>
<li class="<?= $p == 'health_records.php' ? 'active' : '' ?>" style="padding: 0;"><a href="health_records.php" style="text-decoration:none; color:inherit; display:block; padding: 15px;">Health Records</a></li>
<li class="<?= $p == 'medical_info.php' ? 'active' : '' ?>" style="padding: 0;"><a href="medical_info.php" style="text-decoration:none; color:inherit; display:block; padding: 15px;">Medical Info</a></li>
<li class="<?= $p == 'reports.php' ? 'active' : '' ?>" style="padding: 0;"><a href="reports.php" style="text-decoration:none; color:inherit; display:block; padding: 15px;">Health Reports</a></li>
 <li style="padding: 0;"><a href="../index.php" style="text-decoration:none; color:inherit; display:block; padding: 15px;">Logout</a></li>
 </ul>

</aside>