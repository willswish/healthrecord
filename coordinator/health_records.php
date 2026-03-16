<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Health Records - Coordinator</title>

    <!-- Coordinator specific styles -->
    <link rel="stylesheet" href="dashboard.css">
    <link rel="stylesheet" href="medical_records.css">
</head>
<body>

    <div class="dashboard">
        <?php include 'sidebar.php'; ?>

        <div class="main">
            <!-- Topbar -->
            <div class="topbar">
                <div class="page-title">
                    <h2>Health Records</h2>
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

                    <button class="btn-add-record">
                        + Add Record
                    </button>
                </div>

                <div class="table-responsive">
                    <table class="records-table">
                        <thead>
                            <tr>
                                <th>Student ID</th>
                                <th>Full Name</th>
                                <th>Course & Year</th>
                                <th>Last Checkup</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- PHP Code to fetch and display records will go here -->
                            <tr>
                                <td colspan="6" style="text-align:center; padding: 20px; color: #777;">No records found.</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</body>
</html>