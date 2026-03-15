<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Monitor Health - MHR System</title>
<link rel="stylesheet" href="dashboard.css"> <!-- Assuming a similar dashboard.css exists for dean -->
<link rel="stylesheet" href="monitor_health.css">
</head>

<body>

<div class="dashboard">

<?php include 'sidebar.php'; ?>

<!-- MAIN CONTENT -->
<main class="main">

<header class="topbar">
<h1>Health Monitoring Dashboard</h1>

<div class="dean-profile"> <!-- Changed from admin to dean-profile for clarity -->
<img src="https://i.pravatar.cc/40?u=dean">
<span>College Dean</span>
</div>
</header>

<!-- MONITORING CONTENT -->
<section class="monitor-health-container">

    <!-- Summary Cards -->
    <div class="summary-grid">
        <div class="summary-card">
            <h4>Clinic Visits Today</h4>
            <p class="value">12</p>
            <p class="trend up">▲ 2 from yesterday</p>
        </div>
        <div class="summary-card" style="border-left-color: #f1c40f;">
            <h4>Students with Fever</h4>
            <p class="value">3</p>
            <p class="status-text">Currently under observation</p>
        </div>
        <div class="summary-card" style="border-left-color: #e74c3c;">
            <h4>Communicable Disease Alert</h4>
            <p class="value">1</p>
            <p class="status-text">Case of Influenza reported</p>
        </div>
        <div class="summary-card" style="border-left-color: #3498db;">
            <h4>Students with Chronic Conditions</h4>
            <p class="value">45</p>
            <p class="status-text">Monitored regularly</p>
        </div>
    </div>

    <!-- Recent Health Incidents Table -->
    <div class="incident-panel">
        <div class="incident-header">
            <h3>Recent Health Incidents</h3>
            <a href="student_records.php" class="btn-view-all">View All Records</a>
        </div>
        <div class="table-responsive">
            <table class="incidents-table">
                <thead>
                    <tr>
                        <th>Student Name</th>
                        <th>Course & Year</th>
                        <th>Reported Symptom</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>John Doe</td>
                        <td>BSIT 3-1</td>
                        <td>High Fever, Cough</td>
                        <td>2026-03-14</td>
                        <td class="status-observation">Observation</td>
                        <td><button class="btn-view">View Details</button></td>
                    </tr>
                    <tr>
                        <td>Jane Smith</td>
                        <td>BSCS 2-2</td>
                        <td>Sprained Ankle</td>
                        <td>2026-03-14</td>
                        <td class="status-cleared">Cleared</td>
                        <td><button class="btn-view">View Details</button></td>
                    </tr>
                    <tr>
                        <td>Peter Jones</td>
                        <td>BSCE 4-1</td>
                        <td>Allergic Reaction</td>
                        <td>2026-03-13</td>
                        <td class="status-cleared">Cleared</td>
                        <td><button class="btn-view">View Details</button></td>
                    </tr>
                     <tr>
                        <td>Mary Williams</td>
                        <td>BSECE 1-1</td>
                        <td>Stomachache</td>
                        <td>2026-03-13</td>
                        <td class="status-observation">Observation</td>
                        <td><button class="btn-view">View Details</button></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</section>

</main>

</div>

</body>
</html>