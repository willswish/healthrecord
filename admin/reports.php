<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Reports & Analytics - MHR System</title>
<link rel="stylesheet" href="dashboard.css">
<link rel="stylesheet" href="reports.css">
</head>

<body>

<div class="dashboard">

<?php include 'sidebar.php'; ?>

<!-- MAIN CONTENT -->
<main class="main">

<header class="topbar">
<h1>Reports & Analytics</h1>

<div class="admin">
<img src="https://i.pravatar.cc/40">
<span>Administrator</span>
</div>
</header>

<!-- REPORTS CONTENT -->
<section class="reports-container">

    <!-- Filters Control Bar -->
    <div class="reports-controls">
        <div class="date-filters">
            <select>
                <option>Last 7 Days</option>
                <option>Last 30 Days</option>
                <option>This Month</option>
                <option>Last Quarter</option>
            </select>
            <span>from</span>
            <input type="date" value="<?php echo date('Y-m-01'); ?>">
            <span>to</span>
            <input type="date" value="<?php echo date('Y-m-d'); ?>">
            <button class="btn-generate">Update</button>
        </div>
        <button class="btn-export">
            <span>Export PDF</span>
        </button>
    </div>

    <!-- Summary Cards -->
    <div class="report-summary">
        <div class="summary-card">
            <h4>Total Appointments</h4>
            <p class="value">1,245</p>
            <p class="trend up">▲ 12% vs last month</p>
        </div>
        <div class="summary-card" style="border-left-color: #2ecc71;">
            <h4>Patients Admitted</h4>
            <p class="value">328</p>
            <p class="trend up">▲ 5% vs last month</p>
        </div>
        <div class="summary-card" style="border-left-color: #f1c40f;">
            <h4>Avg. Wait Time</h4>
            <p class="value">18m</p>
            <p class="trend down">▼ 2m improvement</p>
        </div>
        <div class="summary-card" style="border-left-color: #e74c3c;">
            <h4>Revenue Estimate</h4>
            <p class="value">$45,200</p>
            <p class="trend up">▲ 8% vs last month</p>
        </div>
    </div>

    <!-- Charts Grid -->
    <div class="charts-grid">
        <div class="chart-panel">
            <h3>Patient Admissions Over Time</h3>
            <div class="chart-placeholder">
                <!-- Placeholder for Chart.js or similar -->
                [Line Chart Visualization]
            </div>
        </div>
        <div class="chart-panel">
            <h3>Diagnosis Distribution</h3>
            <div class="chart-placeholder">
                <!-- Placeholder for Pie chart -->
                [Pie Chart Visualization]
            </div>
        </div>
    </div>

    <!-- Detailed Table -->
    <div class="report-table-section">
        <h3>Medication Report</h3>
        <table class="report-table">
            <thead>
                <tr>
                    <th>id</th>
                    <th>student_id</th>
                    <th>current_medication</th>
                    <th>medication_specify</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>2021-00123</td>
                    <td>Yes</td>
                    <td>Paracetamol</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>2022-00456</td>
                    <td>No</td>
                    <td>N/A</td>
                </tr>
            </tbody>
        </table>
    </div>

</section>

</main>

</div>

</body>
</html>