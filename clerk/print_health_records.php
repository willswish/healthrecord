<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Health Records - Clerk</title>
    <link rel="stylesheet" href="print_health_records.css">
</head>
<body>
    <div class="dashboard">
        <?php include 'sidebar.php'; ?>

        <div class="main">
            <div class="topbar">
                <div class="page-title">
                    <h2>Print Student Health Records</h2>
                </div>
                <div class="admin">
                    <span>Clerk</span>
                </div>
            </div>

            <div class="content-container">
                
                <div class="controls">
                    <div class="search-box">
                        <input type="text" placeholder="Search by Student ID or Name...">
                    </div>
                    <div class="filter-box">
                        <select>
                            <option value="">All Courses</option>
                            <option value="BSIT">BSIT</option>
                            <option value="BSN">BSN</option>
                            <option value="BSHM">BSHM</option>
                        </select>
                        <select>
                            <option value="">All Year Levels</option>
                            <option value="1">1st Year</option>
                            <option value="2">2nd Year</option>
                            <option value="3">3rd Year</option>
                            <option value="4">4th Year</option>
                        </select>
                    </div>
                </div>

                <div class="table-card">
                    <table class="records-table">
                        <thead>
                            <tr>
                                <th>Student ID</th>
                                <th>Full Name</th>
                                <th>Course & Year</th>
                                <th>Last Checkup</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Sample Data Row 1 -->
                            <tr>
                                <td>2023-0001</td>
                                <td>Dela Cruz, Juan</td>
                                <td>BSIT - 3</td>
                                <td>Oct 15, 2023</td>
                                <td><button class="btn-print" onclick="window.print()">Print Record</button></td>
                            </tr>
                            <!-- Sample Data Row 2 -->
                            <tr>
                                <td>2023-0045</td>
                                <td>Santos, Maria</td>
                                <td>BSN - 2</td>
                                <td>Sep 20, 2023</td>
                                <td><button class="btn-print" onclick="window.print()">Print Record</button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</body>
</html>