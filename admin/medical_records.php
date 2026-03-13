<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Medical Records - MHR System</title>
<link rel="stylesheet" href="dashboard.css">
<link rel="stylesheet" href="medical_records.css">
</head>

<body>

<div class="dashboard">

<?php include 'sidebar.php'; ?>

<!-- MAIN CONTENT -->
<main class="main">

<header class="topbar">
<h1>Medical Records</h1>

<div class="admin">
<img src="https://i.pravatar.cc/40">
<span>Administrator</span>
</div>
</header>


<!-- RECORDS CONTENT -->
<section class="records-container">

    <div class="records-controls">
        <div class="search-box">
            <input type="text" placeholder="Search by student ID, diagnosis, or severity...">
        </div>
        <button class="btn-add-record">
            <span>+ New Record</span>
        </button>
    </div>

    <div class="table-responsive">
        <table class="records-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Student ID</th>
                    <th>Date</th>
                    <th>Diagnosis</th>
                    <th>Treatment</th>
                    <th>Severity</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>2021-00123</td>
                    <td>2023-10-24</td>
                    <td>Common Cold</td>
                    <td>Rest and fluids</td>
                    <td>Mild</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>2022-00456</td>
                    <td>2023-10-23</td>
                    <td>Sprained Ankle</td>
                    <td>RICE method</td>
                    <td>Moderate</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>2020-00789</td>
                    <td>2023-10-22</td>
                    <td>Influenza</td>
                    <td>Antiviral medication</td>
                    <td>Severe</td>
                </tr>
                <!-- Add more rows as needed -->
            </tbody>
        </table>
    </div>

</section>

</main>

</div>

</body>
</html>