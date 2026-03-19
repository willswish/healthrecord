<?php
$servername = "localhost";
$db_username = "root";
$db_password = "";
$dbname = "mhr";

$conn = new mysqli($servername, $db_username, $db_password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$search = $_GET['search'] ?? '';

$sql = "SELECT first_name, last_name, age, email, contact, course, college, blood_type, sex, religion, civil_status, allergies FROM students";

if (!empty($search)) {
    $sql .= " WHERE first_name LIKE ? OR last_name LIKE ?";
}

$sql .= " ORDER BY last_name ASC, first_name ASC";

$stmt = $conn->prepare($sql);

if (!empty($search)) {
    $searchTerm = "%" . $search . "%";
    $stmt->bind_param("ss", $searchTerm, $searchTerm);
}

$stmt->execute();
$result = $stmt->get_result();

$students = [];
if ($result && $result->num_rows > 0) {
    $students = $result->fetch_all(MYSQLI_ASSOC);
}
$stmt->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Records - MHR System</title>
    <link rel="stylesheet" href="dashboard.css">
    <link rel="stylesheet" href="student_records.css">
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
                    <form class="search-box" method="GET">
                        <!-- Auto-submit or Enter key works naturally with forms -->
                        <input type="text" name="search" value="<?= htmlspecialchars($search) ?>" placeholder="Search by Name...">
                    </form>
                </div>

                <!-- Records Table -->
                <div class="table-panel">
                    <div class="table-responsive">
                        <table class="students-table">
                            <thead>
                                <tr>
                                    <th>First name</th>
                                    <th>Last name</th>
                                    <th>Age</th>
                                    <th>Email</th>
                                    <th>Contact</th>
                                    <th>Course</th>
                                    <th>College</th>
                                    <th>Blood type</th>
                                    <th>Sex</th>
                                    <th>Religion</th>
                                    <th>Civil Status</th>
                                    <th>Allergies</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($students)): ?>
                                    <?php foreach ($students as $student): ?>
                                        <tr>
                                            <td><?= htmlspecialchars($student['first_name']) ?></td>
                                            <td><?= htmlspecialchars($student['last_name']) ?></td>
                                            <td><?= htmlspecialchars($student['age']) ?></td>
                                            <td><?= htmlspecialchars($student['email']) ?></td>
                                            <td><?= htmlspecialchars($student['contact']) ?></td>
                                            <td><?= htmlspecialchars($student['course']) ?></td>
                                            <td><?= htmlspecialchars($student['college']) ?></td>
                                            <td><?= htmlspecialchars($student['blood_type'] ?? 'N/A') ?></td>
                                            <td><?= htmlspecialchars($student['sex']) ?></td>
                                            <td><?= htmlspecialchars($student['religion'] ?? 'N/A') ?></td>
                                            <td><?= htmlspecialchars($student['civil_status']) ?></td>
                                            <td><?= htmlspecialchars($student['allergies'] ?? 'N/A') ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr><td colspan="12" style="text-align: center;">No student records found.</td></tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
</body>
</html>