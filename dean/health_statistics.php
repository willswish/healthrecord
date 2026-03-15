<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Health Statistics - MHR System</title>
<link rel="stylesheet" href="dashboard.css"> <!-- Assuming this exists -->
<link rel="stylesheet" href="health_statistics.css">
</head>
<body>

<div class="dashboard">
    <?php include 'sidebar.php'; ?>

    <main class="main">
        <!-- Topbar -->
        <header class="topbar">
            <h1>Health Statistics & Trends</h1>
            <div class="dean-profile">
                <img src="https://i.pravatar.cc/40?u=dean">
                <span>College Dean</span>
            </div>
        </header>

        <!-- Main Content -->
        <section class="stats-container">
            
            <!-- Filter Controls -->
            <div class="stats-controls">
                <div class="filter-group">
                    <label for="date-range">Date Range:</label>
                    <select id="date-range">
                        <option>Last 30 Days</option>
                        <option>This Semester</option>
                        <option>This School Year</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label for="course-filter">Course:</label>
                    <select id="course-filter">
                        <option>All Courses</option>
                        <option>BSCS</option>
                        <option>BSIT</option>
                        <option>BSN</option>
                    </select>
                </div>
                <button class="btn-apply-filters">Apply</button>
            </div>

            <!-- Charts Grid -->
            <div class="charts-grid">
                
                <!-- Common Ailments Chart -->
                <div class="chart-panel">
                    <h3>Most Common Ailments</h3>
                    <div class="chart-placeholder">
                        <!-- Placeholder for a bar chart -->
                        <p>[Bar Chart: Fever, Cough, Headache, etc.]</p>
                    </div>
                </div>

                <!-- Clinic Visits Trend -->
                <div class="chart-panel">
                    <h3>Clinic Visits Trend (Last 30 Days)</h3>
                    <div class="chart-placeholder">
                        <!-- Placeholder for a line chart -->
                        <p>[Line Chart: Daily/Weekly Visits]</p>
                    </div>
                </div>

                <!-- Health Status Distribution -->
                <div class="chart-panel">
                    <h3>Student Health Status</h3>
                    <div class="chart-placeholder">
                        <!-- Placeholder for a pie or donut chart -->
                        <p>[Pie Chart: Healthy, Monitored, With Chronic Conditions]</p>
                    </div>
                </div>

                <!-- Visits by College Department -->
                <div class="chart-panel">
                    <h3>Visits by Course</h3>
                     <div class="chart-placeholder">
                        <!-- Placeholder for a pie or donut chart -->
                        <p>[Donut Chart: BSIT, BSCS, BSN, etc.]</p>
                    </div>
                </div>
            </div>

            <!-- Data Table Section -->
            <div class="data-table-panel">
                <h3>Detailed Report: Communicable Diseases</h3>
                <div class="table-responsive">
                    <table class="stats-table">
                        <thead>
                            <tr>
                                <th>Disease/Symptom</th>
                                <th>Total Cases (Last 30 Days)</th>
                                <th>Affected Courses</th>
                                <th>Current Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Influenza</td>
                                <td>5</td>
                                <td>BSIT, BSCS</td>
                                <td><span class="status-tag warning">Monitoring</span></td>
                            </tr>
                            <tr>
                                <td>Dengue Fever</td>
                                <td>1</td>
                                <td>BSN</td>
                                <td><span class="status-tag critical">Critical</span></td>
                            </tr>
                             <tr>
                                <td>Conjunctivitis (Sore Eyes)</td>
                                <td>8</td>
                                <td>BSCS, BSN</td>
                                <td><span class="status-tag controlled">Controlled</span></td>
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