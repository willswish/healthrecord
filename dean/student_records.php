<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Records - MHR System</title>
    <link rel="stylesheet" href="dashboard.css">
    <link rel="stylesheet" href="student_records.css">
    <!-- Simple font link if needed, assuming Inter from dashboard.css -->
</head>
<body>
    
    <div class="dashboard">
        <?php include 'sidebar.php'; ?>

        <div class="main">
            <!-- Topbar -->
            <header class="topbar">
                <h1>Student Records</h1>
                <div class="dean-profile">
                    <img src="https://i.pravatar.cc/40?u=dean">
                    <span>College Dean</span>
                </div>
            </header>

            <!-- Main Content -->
            <div class="records-container">
                
                <!-- Search and Filter Controls -->
                <div class="records-controls">
                    <div class="search-box">
                        <input type="text" placeholder="Search by Student ID or Name...">
                    </div>
                    <div class="filter-group">
                        <select class="filter-select">
                            <option value="">All Courses</option>
                            <option value="BSCS">BS Computer Science</option>
                            <option value="BSIT">BS Info Tech</option>
                            <option value="BSN">BS Nursing</option>
                        </select>
                    </div>
                    <div class="filter-group">
                        <select class="filter-select">
                            <option value="">All Statuses</option>
                            <option value="Healthy">Healthy</option>
                            <option value="Monitor">Under Monitoring</option>
                            <option value="Critical">Critical</option>
                        </select>
                    </div>
                </div>

                <!-- Records Table -->
                <div class="table-panel">
                    <div class="table-responsive">
                        <table class="students-table">
                            <thead>
                                <tr>
                                    <th>Student ID</th>
                                    <th>Student Name</th>
                                    <th>Course & Year</th>
                                    <th>Age</th>
                                    <th>Last Checkup</th>
                                    <th>Health Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Sample Static Data -->
                                <tr>
                                    <td>2024-00156</td>
                                    <td>Maria Clara</td>
                                    <td>BSCS - 3</td>
                                    <td>21</td>
                                    <td>Oct 12, 2025</td>
                                    <td><span class="badge healthy">Healthy</span></td>
                                    <td><a href="#" class="btn-view-record">View Details</a></td>
                                </tr>
                                <tr>
                                    <td>2024-00892</td>
                                    <td>Juan Dela Cruz</td>
                                    <td>BSIT - 2</td>
                                    <td>20</td>
                                    <td>Nov 05, 2025</td>
                                    <td><span class="badge monitor">Under Monitoring</span></td>
                                    <td><a href="#" class="btn-view-record">View Details</a></td>
                                </tr>
                                <!-- End Sample Data -->
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
</body>
</html>