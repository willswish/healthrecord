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
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_record'])) {
    $student_id = $_POST['student_id'];
    $date = $_POST['date'];
    $diagnosis = $_POST['diagnosis'];
    $treatment = $_POST['treatment'];
    $severity = $_POST['severity'];

    $sql = "INSERT INTO medical_records (student_id, date, diagnosis, treatment, severity) VALUES (?, ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("sssss", $student_id, $date, $diagnosis, $treatment, $severity);
        if ($stmt->execute()) {
            $message = "Medical record added successfully!";
        } else {
            $message = "Error adding record: " . $stmt->error;
        }
        $stmt->close();
    } else {
        $message = "Error preparing statement: " . $conn->error;
    }
}

// Handle Delete Request
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_record'])) {
    $id = $_POST['record_id'];
    $stmt = $conn->prepare("DELETE FROM medical_records WHERE id = ?");
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        $message = "Record deleted successfully!";
    } else {
        $message = "Error deleting record: " . $stmt->error;
    }
    $stmt->close();
}

// Handle Edit Request
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_record'])) {
    $id = $_POST['record_id'];
    $student_id = $_POST['student_id'];
    $date = $_POST['date'];
    $diagnosis = $_POST['diagnosis'];
    $treatment = $_POST['treatment'];
    $severity = $_POST['severity'];

    $sql = "UPDATE medical_records SET student_id=?, date=?, diagnosis=?, treatment=?, severity=? WHERE id=?";
    
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("sssssi", $student_id, $date, $diagnosis, $treatment, $severity, $id);
        if ($stmt->execute()) {
            $message = "Record updated successfully!";
        } else {
            $message = "Error updating record: " . $stmt->error;
        }
        $stmt->close();
    }
}

// Get search term
$search = $_GET['search'] ?? '';

// Fetch all medical records to display in the table
$records = [];
$sql_fetch = "SELECT id, student_id, date, diagnosis, treatment, severity FROM medical_records";

if (!empty($search)) {
    // Search by student ID, diagnosis, or severity
    $sql_fetch .= " WHERE student_id LIKE ? OR diagnosis LIKE ? OR severity LIKE ?";
}

$sql_fetch .= " ORDER BY date DESC";

$stmt_fetch = $conn->prepare($sql_fetch);

if ($stmt_fetch) {
    if (!empty($search)) {
        $searchTerm = "%" . $search . "%";
        $stmt_fetch->bind_param("sss", $searchTerm, $searchTerm, $searchTerm);
    }

    $stmt_fetch->execute();
    $result = $stmt_fetch->get_result();

    if ($result) {
        $records = $result->fetch_all(MYSQLI_ASSOC);
    } else {
        $message = "Error fetching records: " . $conn->error;
    }
    $stmt_fetch->close();
} else {
    // This will catch errors like table not existing during fetch
    $message = "Error preparing statement: " . $conn->error;
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Health Records - Coordinator</title>
<link rel="stylesheet" href="medical_records.css">
<link rel="stylesheet" href="dashboard.css">
<style>
/* Modal Styles */
.modal {
    display: none; 
    position: fixed; 
    z-index: 1000; 
    left: 0;
    top: 0;
    width: 100%; 
    height: 100%; 
    overflow: auto; 
    background-color: rgba(0,0,0,0.4);
}
.modal-content {
    background-color: #fefefe;
    margin: 10% auto;
    padding: 20px;
    border: 1px solid #888;
    width: 80%;
    max-width: 500px;
    border-radius: 8px;
    position: relative;
    box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
}
.close-button {
    color: #aaa;
    position: absolute;
    top: 10px;
    right: 20px;
    font-size: 28px;
    font-weight: bold;
}
.close-button:hover,
.close-button:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
}
.modal h2 { margin-top: 0; margin-bottom: 20px; }
.form-group { margin-bottom: 15px; }
.form-group label { display: block; margin-bottom: 5px; }
.form-group input, .form-group select, .form-group textarea {
    width: 100%;
    padding: 10px;
    box-sizing: border-box;
    border: 1px solid #ccc;
    border-radius: 4px;
}
.btn-submit {
    background-color: #4a90e2;
    color: white;
    padding: 10px 15px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    width: 100%;
    font-size: 1rem;
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
<h1>Health Records</h1>

<div class="admin">
<img src="https://i.pravatar.cc/40">
<span>Coordinator</span>
</div>
</header>

<!-- RECORDS CONTENT -->
<section class="records-container">

    <?php if (!empty($message)): ?>
        <div style="padding: 15px; margin-bottom: 20px; border-radius: 5px; background-color: <?php echo strpos($message, 'Error') !== false ? '#f8d7da' : '#d4edda'; ?>; color: <?php echo strpos($message, 'Error') !== false ? '#721c24' : '#155724'; ?>; border: 1px solid <?php echo strpos($message, 'Error') !== false ? '#f5c6cb' : '#c3e6cb'; ?>;">
            <?php echo htmlspecialchars($message); ?>
        </div>
    <?php endif; ?>

    <div class="records-controls">
        <form class="search-box" method="GET" action="health_records.php">
            <input type="text" name="search" value="<?php echo htmlspecialchars($search); ?>" placeholder="Search by student ID, diagnosis, or severity...">
        </form>
        <button class="btn-add-record">
            <span>+ New Record</span>
        </button>
    </div>

    <div class="table-responsive">
        <table class="records-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Student ID</th>
                    <th>Date</th>
                    <th>Diagnosis</th>
                    <th>Treatment</th>
                    <th>Severity</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($records)): ?>
                    <?php foreach ($records as $record): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($record['id']); ?></td>
                            <td><?php echo htmlspecialchars($record['student_id']); ?></td>
                            <td><?php echo htmlspecialchars(date('Y-m-d', strtotime($record['date']))); ?></td>
                            <td><?php echo htmlspecialchars($record['diagnosis']); ?></td>
                            <td><?php echo htmlspecialchars($record['treatment']); ?></td>
                            <td><?php echo htmlspecialchars($record['severity']); ?></td>
                            <td>
                                <button class="btn-action edit"
                                    data-id="<?php echo $record['id']; ?>"
                                    data-student="<?php echo htmlspecialchars($record['student_id']); ?>"
                                    data-date="<?php echo htmlspecialchars($record['date']); ?>"
                                    data-diagnosis="<?php echo htmlspecialchars($record['diagnosis']); ?>"
                                    data-treatment="<?php echo htmlspecialchars($record['treatment']); ?>"
                                    data-severity="<?php echo htmlspecialchars($record['severity']); ?>"
                                    onclick="openEditModal(this)">
                                    Edit
                                </button>
                                <form method="POST" action="health_records.php" style="display:inline-block;" onsubmit="return confirm('Are you sure you want to delete this record?');">
                                    <input type="hidden" name="record_id" value="<?php echo $record['id']; ?>">
                                    <button type="submit" name="delete_record" class="btn-action delete">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" style="text-align: center;"><?php echo !empty($search) ? 'No records found matching your search.' : 'No medical records found.'; ?></td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

</section>

<!-- Add Medical Record Modal -->
<div id="addRecordModal" class="modal">
    <div class="modal-content">
        <span class="close-button">&times;</span>
        <h2>Add Medical Record</h2>
        <form method="POST" action="health_records.php">
            <div class="form-group">
                <label>Student ID</label>
                <input type="text" name="student_id" required placeholder="Enter Student ID (e.g., 2023-00123)">
            </div>
            
            <div class="form-group">
                <label>Date</label>
                <input type="date" name="date" required value="<?php echo date('Y-m-d'); ?>">
            </div>

            <div class="form-group">
                <label>Diagnosis</label>
                <input type="text" name="diagnosis" placeholder="e.g., Common Cold" required>
            </div>

            <div class="form-group">
                <label>Treatment</label>
                <textarea name="treatment" rows="3" placeholder="e.g., Rest and fluids" required></textarea>
            </div>

            <div class="form-group">
                <label>Severity</label>
                <select name="severity" required>
                    <option value="mild">Mild</option>
                    <option value="moderate">Moderate</option>
                    <option value="sever">Severe</option>
                </select>
            </div>

            <button type="submit" name="add_record" class="btn-submit">Save Record</button>
        </form>
    </div>
</div>

<!-- Edit Medical Record Modal -->
<div id="editRecordModal" class="modal">
    <div class="modal-content">
        <span class="close-button close-edit">&times;</span>
        <h2>Edit Medical Record</h2>
        <form method="POST" action="health_records.php">
            <input type="hidden" name="record_id" id="edit_record_id">
            <div class="form-group">
                <label>Student ID</label>
                <input type="text" name="student_id" id="edit_student_id" required>
            </div>
            
            <div class="form-group">
                <label>Date</label>
                <input type="date" name="date" id="edit_date" required>
            </div>

            <div class="form-group">
                <label>Diagnosis</label>
                <input type="text" name="diagnosis" id="edit_diagnosis" required>
            </div>

            <div class="form-group">
                <label>Treatment</label>
                <textarea name="treatment" id="edit_treatment" rows="3" required></textarea>
            </div>

            <div class="form-group">
                <label>Severity</label>
                <select name="severity" id="edit_severity" required>
                    <option value="mild">Mild</option>
                    <option value="moderate">Moderate</option>
                    <option value="sever">Severe</option>
                </select>
            </div>

            <button type="submit" name="edit_record" class="btn-submit">Update Record</button>
        </form>
    </div>
</div>

</main>

</div>

<script>
    // Add Modal Logic
    const modal = document.getElementById("addRecordModal");
    const btn = document.querySelector(".btn-add-record");
    const span = document.querySelector(".close-button");

    // Edit Modal Logic
    const editModal = document.getElementById("editRecordModal");
    const closeEditSpan = document.querySelector(".close-edit");

    btn.onclick = function() { modal.style.display = "block"; }
    span.onclick = function() { modal.style.display = "none"; }
    closeEditSpan.onclick = function() { editModal.style.display = "none"; }

    window.openEditModal = function(button) {
        document.getElementById('edit_record_id').value = button.getAttribute('data-id');
        document.getElementById('edit_student_id').value = button.getAttribute('data-student');
        document.getElementById('edit_date').value = button.getAttribute('data-date');
        document.getElementById('edit_diagnosis').value = button.getAttribute('data-diagnosis');
        document.getElementById('edit_treatment').value = button.getAttribute('data-treatment');
        document.getElementById('edit_severity').value = button.getAttribute('data-severity');
        
        editModal.style.display = "block";
    }

    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
        if (event.target == editModal) {
            editModal.style.display = "none";
        }
    }
</script>

</body>
</html>