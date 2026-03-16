<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medical Info - Coordinator</title>

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
                    <h2>Medical Information</h2>
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
                    <!-- specific controls for medical info can go here -->
                </div>

                <div class="table-responsive">
                    <table class="records-table">
                        <thead>
                            <tr>
                                <th>Student ID</th>
                                <th>Full Name</th>
                                <th>Blood Type</th>
                                <th>Allergies</th>
                                <th>Chronic Conditions</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- PHP Code to fetch and display medical info will go here -->
                            <tr>
                                <td colspan="6" style="text-align:center; padding: 20px; color: #777;">No medical information found.</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</body>
</html>