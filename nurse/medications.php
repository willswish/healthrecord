<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Nurse Medications - MHR System</title>
<link rel="stylesheet" href="medications.css">
<link rel="stylesheet" href="dashboard.css">
</head>

<body>

<div class="dashboard">

<?php include 'sidebar.php'; ?>

<!-- MAIN CONTENT -->
<main class="main">

<header class="topbar">
<h1>Medications</h1>

<div class="admin">
<img src="https://i.pravatar.cc/40">
<span>Nurse</span>
</div>
</header>

<!-- RECORDS CONTENT -->
<section class="medications-container">

    <div class="medications-controls">
        <div class="search-box">
            <input type="text" placeholder="Search by student ID, medication, or prescriber...">
        </div>
        <button class="btn-add-record">
            <span>+ New Medication Record</span>
        </button>
    </div>

    <div class="table-responsive">
        <table class="medications-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Student ID</th>
                    <th>Date</th>
                    <th>Medication Name</th>
                    <th>Dosage</th>
                    <th>Frequency</th>
                    <th>Duration</th>
                    <th>Prescriber</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>2021-00123</td>
                    <td>2023-10-24</td>
                    <td>Paracetamol</td>
                    <td>500mg</td>
                    <td>Every 6 hours</td>
                    <td>5 days</td>
                    <td>Dr. Smith</td>
                    <td>Active</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>2022-00456</td>
                    <td>2023-10-23</td>
                    <td>Amoxicillin</td>
                    <td>250mg</td>
                    <td>3 times daily</td>
                    <td>7 days</td>
                    <td>Dr. Johnson</td>
                    <td>Active</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>2020-00789</td>
                    <td>2023-10-22</td>
                    <td>Ibuprofen</td>
                    <td>400mg</td>
                    <td>Every 8 hours</td>
                    <td>3 days</td>
                    <td>Dr. Lee</td>
                    <td>Completed</td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>2023-01234</td>
                    <td>2023-10-21</td>
                    <td>Salbutamol Inhaler</td>
                    <td>2 puffs</td>
                    <td>As needed</td>
                    <td>Ongoing</td>
                    <td>Dr. Patel</td>
                    <td>Active</td>
                </tr>
            </tbody>
        </table>
    </div>

</section>

</main>

</div>

</body>
</html>
