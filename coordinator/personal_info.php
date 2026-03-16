<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personal Information - Coordinator</title>

    <!-- Coordinator specific styles -->
    <link rel="stylesheet" href="dashboard.css">
    <link rel="stylesheet" href="medical_records.css"> <!-- Assuming this contains table styles -->
</head>
<body>

    <div class="dashboard">
        <?php include 'sidebar.php'; ?>

        <div class="main">
            <!-- Topbar -->
            <div class="topbar">
                <div class="page-title">
                    <h2>Student Personal Information</h2>
                </div>
                <div class="admin">
                    <span>Coordinator</span>
                    <!-- Placeholder for profile image if needed -->
                </div>
            </div>

            <!-- Main Content -->
            <div class="records-container">
                <div class="records-controls">
                    <div class="search-box">
                        <input type="text" placeholder="Search student name or ID...">
                    </div>

                    <a href="register_student.php" class="btn-add-record">
                        + Add Student
                    </a>
                </div>

                <div class="table-responsive">
                    <table class="records-table">
                        <thead>
                            <tr>
                                <th>Student ID</th>
                                <th>Full Name</th>
                                <th>Course & Year</th>
                                <th>Sex</th>
                                <th>Contact No.</th>
                                <th>Emergency Contact</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Sample Static Data -->
                            <tr>
                                <td>2024-00156</td>
                                <td>Maria Clara</td>
                                <td>BSCS - 3</td>
                                <td>Female</td>
                                <td>09123456789</td>
                                <td>Jose Rizal / 09987654321</td>
                                <td>
                                    <button class="btn-view">View</button>
                                    <button class="btn-edit">Edit</button>
                                </td>
                            </tr>
                            <tr>
                                <td>2024-00892</td>
                                <td>Juan Dela Cruz</td>
                                <td>BSIT - 2</td>
                                <td>Male</td>
                                <td>09112233445</td>
                                <td>John Doe / 09556677889</td>
                                <td>
                                    <button class="btn-view">View</button>
                                    <button class="btn-edit">Edit</button>
                                </td>
                            </tr>
                            <!-- End Sample Data -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</body>
</html>