<?php
$servername = "localhost";
$db_username = "root";
$db_password = "";
$dbname = "mhr";

// Create connection
$conn = new mysqli($servername, $db_username, $db_password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch records
$records = [];
$search = $_GET['search'] ?? '';
$sql = "SELECT * FROM medical_info WHERE student_id LIKE ? ORDER BY date_recorded DESC";
$stmt = $conn->prepare($sql);
$searchTerm = "%$search%";
$stmt->bind_param("s", $searchTerm);
$stmt->execute();
$records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
$stmt->close();
?>
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
                    <form class="search-box" method="GET">
                        <input type="text" name="search" value="<?php echo htmlspecialchars($search); ?>" placeholder="Search student ID...">
                    </form>
                    <!-- specific controls for medical info can go here -->
                </div>

                <div class="table-responsive">
                    <table class="records-table">
                        <thead>
                            <tr>
                                <th>Student ID</th>
                                <th>Fever</th>
                                <th>Cough</th>
                                <th>Sore Throat</th>
                                <th>Runny Nose</th>
                                <th>Fatigue</th>
                                <th>Headache</th>
                                <th>Difficulty Breathing</th>
                                <th>Diarrhea</th>
                                <th>Date Recorded</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($records)): ?>
                                <?php foreach ($records as $row): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($row['student_id']); ?></td>
                                        <td><?php echo htmlspecialchars($row['fever']); ?></td>
                                        <td><?php echo htmlspecialchars($row['cough']); ?></td>
                                        <td><?php echo htmlspecialchars($row['sore_throat']); ?></td>
                                        <td><?php echo htmlspecialchars($row['runny_nose']); ?></td>
                                        <td><?php echo htmlspecialchars($row['fatigue']); ?></td>
                                        <td><?php echo htmlspecialchars($row['headache']); ?></td>
                                        <td><?php echo htmlspecialchars($row['difficulty_breathing']); ?></td>
                                        <td><?php echo htmlspecialchars($row['diarrhea']); ?></td>
                                        <td><?php echo htmlspecialchars($row['date_recorded']); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="10" style="text-align:center; padding: 20px; color: #777;">No medical information found.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</body>
</html>