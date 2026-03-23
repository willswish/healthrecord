<?php
$servername = "localhost";
$db_username = "root";
$db_password = "";
$dbname = "mhr";

$conn = new mysqli($servername, $db_username, $db_password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = '';

// --- ADD RECORD LOGIC ---
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_record'])) {
    $student_id = $_POST['student_id'];
    $date = $_POST['date'];
    $diagnosis = $_POST['diagnosis'];
    $treatment = $_POST['treatment'];
    $severity = $_POST['severity'];

    $stmt = $conn->prepare("INSERT INTO medical_records (student_id, date, diagnosis, treatment, severity) VALUES (?, ?, ?, ?, ?)");
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

// --- FETCH RECORDS ---
$records = [];
$search = isset($_GET['search']) ? $_GET['search'] : '';

$sql = "SELECT * FROM medical_records";
if (!empty($search)) {
    $sql .= " WHERE student_id LIKE ? OR diagnosis LIKE ? OR severity LIKE ?";
}
$sql .= " ORDER BY date DESC";

$stmt = $conn->prepare($sql);
if (!empty($search)) {
    $searchTerm = "%" . $search . "%";
    $stmt->bind_param("sss", $searchTerm, $searchTerm, $searchTerm);
}

$stmt->execute();
$result = $stmt->get_result();
if ($result) {
    $records = $result->fetch_all(MYSQLI_ASSOC);
}
$stmt->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Medical Records - MHR System</title>
<link rel="stylesheet" href="dashboard.css">
<link rel="stylesheet" href="medical_records.css">
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
}
.close-button {
    color: #aaa;
    position: absolute;
    top: 10px;
    right: 20px;
    font-size: 28px;
    font-weight: bold;
    cursor: pointer;
}
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
    background-color: #28a745; color: white; padding: 10px 15px; border: none; border-radius: 4px; cursor: pointer; width: 100%;
}
.btn-submit:hover { background-color: #218838; }
</style>
</head>

<body>

<div class="dashboard">

<?php include 'sidebar.php'; ?>

<!-- MAIN CONTENT -->
<main class="main">

<header class="topbar">
<h1>Medical Records</h1>

<div class="admin">
<img src="https://i.pravatar.cc/40">
<span>Administrator</span>
</div>
</header>


<!-- RECORDS CONTENT -->
<section class="records-container">

    <?php if (!empty($message)): ?>
        <div style="padding: 15px; margin-bottom: 20px; border-radius: 5px; background-color: <?php echo strpos($message, 'Error') !== false ? '#f8d7da' : '#d4edda'; ?>; color: <?php echo strpos($message, 'Error') !== false ? '#721c24' : '#155724'; ?>;">
            <?php echo htmlspecialchars($message); ?>
        </div>
    <?php endif; ?>

    <div class="records-controls">
        <form class="search-box" method="GET" action="medical_records.php">
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
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($records)): ?>
                    <?php foreach ($records as $row): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['id']); ?></td>
                        <td><?php echo htmlspecialchars($row['student_id']); ?></td>
                        <td><?php echo htmlspecialchars($row['date']); ?></td>
                        <td><?php echo htmlspecialchars($row['diagnosis']); ?></td>
                        <td><?php echo htmlspecialchars($row['treatment']); ?></td>
                        <td><?php echo htmlspecialchars($row['severity']); ?></td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="6">No records found.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

</section>

<!-- Add Record Modal -->
<div id="addRecordModal" class="modal">
    <div class="modal-content">
        <span class="close-button">&times;</span>
        <h2>Add Medical Record</h2>
        <form method="POST">
            <div class="form-group">
                <label>Student ID</label>
                <input type="text" name="student_id" required>
            </div>
            <div class="form-group">
                <label>Date</label>
                <input type="date" name="date" required value="<?php echo date('Y-m-d'); ?>">
            </div>
            <div class="form-group">
                <label>Diagnosis</label>
                <input type="text" name="diagnosis" required>
            </div>
            <div class="form-group">
                <label>Treatment</label>
                <textarea name="treatment" rows="3" required></textarea>
            </div>
            <div class="form-group">
                <label>Severity</label>
                <select name="severity">
                    <option value="mild">Mild</option>
                    <option value="moderate">Moderate</option>
                    <option value="severe">Severe</option>
                </select>
            </div>
            <button type="submit" name="add_record" class="btn-submit">Save Record</button>
        </form>
    </div>
</div>

</main>

</div>

<script>
const modal = document.getElementById("addRecordModal");
const btn = document.querySelector(".btn-add-record");
const span = document.querySelector(".close-button");

btn.onclick = function() {
  modal.style.display = "block";
}

span.onclick = function() {
  modal.style.display = "none";
}

window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>

<?php $conn->close(); ?>

</body>
</html>