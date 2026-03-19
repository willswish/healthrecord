<?php
$message = '';
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

// Handle Add Request
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_medication'])) {
    $student_id = $_POST['student_id'];
    $current_medication = $_POST['current_medication'];
    $medication_specify = $_POST['medication_specify'];

    // Prepare SQL based on provided schema
    $sql = "INSERT INTO current_medication (student_id, current_medication, medication_specify) VALUES (?, ?, ?)";
    
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("sss", $student_id, $current_medication, $medication_specify);
        if ($stmt->execute()) {
            $message = "Medication record added successfully!";
        } else {
            $message = "Error adding record: " . $stmt->error;
        }
        $stmt->close();
    } else {
        $message = "Error preparing statement: " . $conn->error;
    }
}

// Handle Delete Request
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_medication'])) {
    $id = $_POST['record_id'];
    $stmt = $conn->prepare("DELETE FROM current_medication WHERE id = ?");
    if ($stmt) {
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            $message = "Record deleted successfully!";
        } else {
            $message = "Error deleting record: " . $stmt->error;
        }
        $stmt->close();
    }
}

// Fetch records
$search = $_GET['search'] ?? '';
$records = [];
$sql_fetch = "SELECT * FROM current_medication";

if (!empty($search)) {
    $sql_fetch .= " WHERE student_id LIKE ? OR medication_specify LIKE ?";
}
$sql_fetch .= " ORDER BY id DESC";

$stmt_fetch = $conn->prepare($sql_fetch);

if ($stmt_fetch) {
    if (!empty($search)) {
        $searchTerm = "%" . $search . "%";
        $stmt_fetch->bind_param("ss", $searchTerm, $searchTerm);
    }
    $stmt_fetch->execute();
    $result = $stmt_fetch->get_result();
    if ($result) {
        $records = $result->fetch_all(MYSQLI_ASSOC);
    }
    $stmt_fetch->close();
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Nurse Medications - MHR System</title>
<link rel="stylesheet" href="medications.css">
<link rel="stylesheet" href="dashboard.css">
<style>
.modal {
    display: none; position: fixed; z-index: 1000; left: 0; top: 0; width: 100%; height: 100%; overflow: auto; background-color: rgba(0,0,0,0.4);
}
.modal-content {
    background-color: #fefefe; margin: 10% auto; padding: 20px; border: 1px solid #888; width: 80%; max-width: 500px; border-radius: 8px; position: relative;
}
.close-button {
    color: #aaa; position: absolute; top: 10px; right: 20px; font-size: 28px; font-weight: bold; cursor: pointer;
}
.form-group { margin-bottom: 15px; }
.form-group label { display: block; margin-bottom: 5px; }
.form-group input, .form-group select, .form-group textarea {
    width: 100%; padding: 10px; box-sizing: border-box; border: 1px solid #ccc; border-radius: 4px;
}
.btn-submit {
    background-color: #4a90e2; color: white; padding: 10px 15px; border: none; border-radius: 4px; cursor: pointer; width: 100%; font-size: 1rem;
}
.btn-submit:hover { background-color: #357abd; }
.btn-action { padding: 5px 10px; border: none; border-radius: 4px; cursor: pointer; font-size: 0.9rem; margin-right: 5px; }
.btn-action.edit { background-color: #ffc107; color: #212529; }
.btn-action.edit:hover { background-color: #e0a800; }
.btn-action.delete { background-color: #dc3545; color: white; }
.btn-action.delete:hover { background-color: #c82333; }
</style>
</head>

<body>

<div class="dashboard">

<?php include 'sidebar.php'; ?>

<!-- MAIN CONTENT -->
<main class="main">

<header class="topbar">
<h1>Medications</h1>

<div class="admin">
<img src="https://i.pravatar.cc/40">
<span>Nurse</span>
</div>
</header>

<!-- RECORDS CONTENT -->
<section class="medications-container">

    <?php if (!empty($message)): ?>
        <div style="padding: 15px; margin-bottom: 20px; border-radius: 5px; background-color: <?php echo strpos($message, 'Error') !== false ? '#f8d7da' : '#d4edda'; ?>; color: <?php echo strpos($message, 'Error') !== false ? '#721c24' : '#155724'; ?>; border: 1px solid <?php echo strpos($message, 'Error') !== false ? '#f5c6cb' : '#c3e6cb'; ?>;">
            <?php echo htmlspecialchars($message); ?>
        </div>
    <?php endif; ?>

    <div class="medications-controls">
        <form class="search-box" method="GET" action="medications.php">
            <input type="text" name="search" value="<?php echo htmlspecialchars($search); ?>" placeholder="Search by student ID, medication...">
        </form>
        <button class="btn-add-record">
            <span>+ New Medication Record</span>
        </button>
    </div>

    <div class="table-responsive">
        <table class="medications-table">
            <thead>
                <tr>
                    <th>Student ID</th>
                    <th>Current Medication</th>
                    <th>Medication Specification</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($records)): ?>
                    <?php foreach ($records as $record): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($record['student_id']); ?></td>
                            <td><?php echo htmlspecialchars($record['current_medication']); ?></td>
                            <td><?php echo htmlspecialchars($record['medication_specify']); ?></td>
                            <td>
                                <form method="POST" action="medications.php" style="display:inline-block;" onsubmit="return confirm('Are you sure you want to delete this record?');">
                                    <input type="hidden" name="record_id" value="<?php echo $record['id']; ?>">
                                    <button type="submit" name="delete_medication" class="btn-action delete">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" style="text-align: center;">No medication records found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

</section>

<!-- Add Medication Modal -->
<div id="addMedicationModal" class="modal">
    <div class="modal-content">
        <span class="close-button">&times;</span>
        <h2>Add Medication Record</h2>
        <form method="POST" action="medications.php">
            <div class="form-group">
                <label>Student ID</label>
                <input type="text" name="student_id" required placeholder="Enter Student ID">
            </div>
            <div class="form-group">
                <label>Current Medication?</label>
                <select name="current_medication" required>
                    <option value="No">No</option>
                    <option value="Yes">Yes</option>
                </select>
            </div>
            <div class="form-group">
                <label>Medication Specification</label>
                <textarea name="medication_specify" rows="3" placeholder="Enter medication details if applicable"></textarea>
            </div>
            <button type="submit" name="add_medication" class="btn-submit">Save Record</button>
        </form>
    </div>
</div>

</main>

</div>

<script>
    const modal = document.getElementById("addMedicationModal");
    const btn = document.querySelector(".btn-add-record");
    const span = document.querySelector(".close-button");
    btn.onclick = function() { modal.style.display = "block"; }
    span.onclick = function() { modal.style.display = "none"; }
    window.onclick = function(event) {
        if (event.target == modal) { modal.style.display = "none"; }
    }
</script>

</body>
</html>
