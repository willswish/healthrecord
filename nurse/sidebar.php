<!DOCTYPE html>
<!-- SIDEBAR -->
<aside class="sidebar">

<h2 class="logo">MHR System</h2>

<ul class="menu">
<?php $p = basename($_SERVER['PHP_SELF']); ?>
<li class="<?= $p == 'medical_records.php' ? 'active' : '' ?>" style="padding: 0;"><a href="medical_records.php" style="text-decoration:none; color:inherit; display:block; padding: 15px;">Medical Records and History</a></li>
<li class="<?= $p == 'medical_info.php' ? 'active' : '' ?>" style="padding: 0;"><a href="medical_info.php" style="text-decoration:none; color:inherit; display:block; padding: 15px;">Medical Info</a></li>
<li class="<?= $p == 'vital_signs.php' ? 'active' : '' ?>" style="padding: 0;"><a href="vital_signs.php" style="text-decoration:none; color:inherit; display:block; padding: 15px;">Vital Signs</a></li>
<li class="<?= $p == 'medications.php' ? 'active' : '' ?>" style="padding: 0;"><a href="medications.php" style="text-decoration:none; color:inherit; display:block; padding: 15px;">Medications</a></li>
<li style="padding: 0;"><a href="../index.php" style="text-decoration:none; color:inherit; display:block; padding: 15px;">Logout</a></li>
</ul>

</aside>
