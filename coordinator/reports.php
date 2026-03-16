<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reports - Coordinator</title>

    <!-- Coordinator specific styles -->
    <link rel="stylesheet" href="dashboard.css">
    <link rel="stylesheet" href="reports.css">
</head>
<body>

    <div class="dashboard">
        <?php include 'sidebar.php'; ?>

        <div class="main">
            <!-- Topbar -->
            <div class="topbar">
                <div class="page-title">
                    <h2>Reports & Analytics</h2>
                </div>
                <div class="admin">
                    <span>Coordinator</span>
                    <!-- Placeholder for profile image if needed -->
                </div>
            </div>

            <!-- Main Content -->
            <div class="reports-container">
                
                <div class="reports-controls">
                    <div class="date-filters">
                        <label>Date Range:</label>
                        <input type="date" value="<?= date('Y-m-01'); ?>">
                        <span>to</span>
                        <input type="date" value="<?= date('Y-m-d'); ?>">
                        <button class="btn-generate">Generate</button>
                    </div>
                    <button class="btn-export">Export PDF</button>
                </div>

                <!-- KPI Summary -->
                <div class="report-summary">
                    <div class="summary-card">
                        <h4>Total Checkups (Month)</h4>
                        <p class="value">124</p>
                        <p class="trend up">↑ 12% vs last month</p>
                    </div>
                    <div class="summary-card">
                        <h4>New Health Records</h4>
                        <p class="value">45</p>
                        <p class="trend up">↑ 5% vs last month</p>
                    </div>
                    <div class="summary-card">
                        <h4>Pending Reviews</h4>
                        <p class="value">8</p>
                        <p class="trend down">↓ 2% vs last month</p>
                    </div>
                </div>

                <!-- Charts Area -->
                <div class="charts-grid">
                    <div class="chart-panel">
                        <h3>Monthly Health Trends</h3>
                        <div class="chart-placeholder">
                            [Bar Chart Placeholder]
                        </div>
                    </div>
                    <div class="chart-panel">
                        <h3>Common Conditions</h3>
                        <div class="chart-placeholder">
                            [Pie Chart Placeholder]
                        </div>
                    </div>
                </div>

                <!-- Recent Activity Table -->
                <div class="report-table-section">
                    <h3>Recent Activity Log</h3>
                    <table class="report-table">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Student</th>
                                <th>Activity</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="4" style="text-align:center; padding: 20px; color: #777;">No recent activity found for this period.</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

</body>
</html>