<?php
$message = '';
$servername = "localhost";
$db_username = "root";
$db_password = "";
$dbname = "mhr";

$conn = new mysqli($servername, $db_username, $db_password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle Delete Request
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_vitals'])) {
    $id = $_POST['vital_id'];
    $stmt = $conn->prepare("DELETE FROM vitals WHERE id = ?");
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        $message = "Record deleted successfully!";
    } else {
        $message = "Error deleting record: " . $stmt->error;
    }
    $stmt->close();
}

// Handle Edit Request
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_vitals'])) {
    $id = $_POST['vital_id'];
    $student_id = $_POST['student_id'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $temperature = $_POST['temperature'];
    $pulse = $_POST['pulse_rate'];
    $bp = $_POST['blood_pressure'];
    $oxygen = !empty($_POST['oxygen_level']) ? $_POST['oxygen_level'] : NULL;
    $weight = !empty($_POST['weight']) ? $_POST['weight'] : NULL;
    $height = !empty($_POST['height']) ? $_POST['height'] : NULL;

    $sql = "UPDATE vitals SET student_id=?, date=?, time=?, temperature=?, pulse_rate=?, blood_pressure=?, oxygen_level=?, weight=?, height=? WHERE id=?";
    
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("sssddssddi", $student_id, $date, $time, $temperature, $pulse, $bp, $oxygen, $weight, $height, $id);
        if ($stmt->execute()) {
            $message = "Vital signs updated successfully!";
        } else {
            $message = "Error updating record: " . $stmt->error;
        }
        $stmt->close();
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_vitals'])) {
    // Prepare data
    $student_id = $_POST['student_id'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $temperature = $_POST['temperature'];
    $pulse = $_POST['pulse_rate'];
    $bp = $_POST['blood_pressure'];
    $oxygen = !empty($_POST['oxygen_level']) ? $_POST['oxygen_level'] : NULL;
    $weight = !empty($_POST['weight']) ? $_POST['weight'] : NULL;
    $height = !empty($_POST['height']) ? $_POST['height'] : NULL;

    // Prepare SQL
    $sql = "INSERT INTO vitals (student_id, date, time, temperature, pulse_rate, blood_pressure, oxygen_level, weight, height) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("sssddssdd", $student_id, $date, $time, $temperature, $pulse, $bp, $oxygen, $weight, $height);
        if ($stmt->execute()) {
            $message = "Vital signs recorded successfully!";
        } else {
            $message = "Error: " . $stmt->error;
        }
        $stmt->close();
    } else {
        $message = "Error preparing statement: " . $conn->error;
    }
}

// Get search term
$search = $_GET['search'] ?? '';

// Fetch all vital signs to display in the table
$vitals_records = [];
$sql_fetch = "SELECT id, student_id, date, time, temperature, pulse_rate, blood_pressure, oxygen_level, weight, height FROM vitals";

if (!empty($search)) {
    // Search by student ID or date
    $sql_fetch .= " WHERE student_id LIKE ? OR date LIKE ?";
}

$sql_fetch .= " ORDER BY date DESC, time DESC";

$stmt_fetch = $conn->prepare($sql_fetch);

if (!empty($search)) {
    $searchTerm = "%" . $search . "%";
    $stmt_fetch->bind_param("ss", $searchTerm, $searchTerm);
}

$stmt_fetch->execute();
$result = $stmt_fetch->get_result();

if ($result) {
    $vitals_records = $result->fetch_all(MYSQLI_ASSOC);
} else {
    // You might want to show an error message if the query fails
    $message = "Error fetching records: " . $conn->error;
}

$stmt_fetch->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Vital Signs - MHR System</title>
<link rel="stylesheet" href="vital_signs.css">
    <link rel="stylesheet" href="dashboard.css">
</head>

<body>

<div class="dashboard">

<?php include 'sidebar.php'; ?>

<!-- MAIN CONTENT -->
<main class="main">

<header class="topbar">
<h1>Vital Signs</h1>

<div class="admin">
<img src="https://i.pravatar.cc/40">
<span>Nurse</span>
</div>
</header>

<!-- RECORDS CONTENT -->
<section class="vitals-container">

    <?php if (!empty($message)): ?>
        <div style="padding: 15px; margin-bottom: 20px; border-radius: 5px; background-color: <?php echo strpos($message, 'Error') !== false ? '#f8d7da' : '#d4edda'; ?>; color: <?php echo strpos($message, 'Error') !== false ? '#721c24' : '#155724'; ?>; border: 1px solid <?php echo strpos($message, 'Error') !== false ? '#f5c6cb' : '#c3e6cb'; ?>;">
            <?php echo htmlspecialchars($message); ?>
        </div>
    <?php endif; ?>

    <div class="vitals-controls">
        <form class="search-box" method="GET" action="vital_signs.php">
            <input type="text" name="search" value="<?php echo htmlspecialchars($search); ?>" placeholder="Search by Student ID or Date...">
        </form>
        <button class="btn-add-record">
            <span>+ New Vital Signs Record</span>
        </button>
    </div>

    <div class="table-responsive">
        <table class="vitals-table">
            <thead>
                <tr>
                    <th>Student ID</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Temperature</th>
                    <th>Pulse Rate</th>
                    <th>Blood Pressure</th>
                    <th>Oxygen Level</th>
                    <th>Weight</th>
                    <th>Height</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($vitals_records)): ?>
                    <?php foreach ($vitals_records as $record): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($record['student_id']); ?></td>
                            <td><?php echo htmlspecialchars(date('Y-m-d', strtotime($record['date']))); ?></td>
                            <td><?php echo htmlspecialchars(date('h:i A', strtotime($record['time']))); ?></td>
                            <td><?php echo htmlspecialchars($record['temperature']); ?> °F</td>
                            <td><?php echo htmlspecialchars($record['pulse_rate']); ?> bpm</td>
                            <td><?php echo htmlspecialchars($record['blood_pressure']); ?> mmHg</td>
                            <td><?php echo htmlspecialchars($record['oxygen_level'] ?? 'N/A'); ?><?php if (!empty($record['oxygen_level'])) echo '%'; ?></td>
                            <td><?php echo htmlspecialchars($record['weight'] ?? 'N/A'); ?><?php if (!empty($record['weight'])) echo ' kg'; ?></td>
                            <td><?php echo htmlspecialchars($record['height'] ?? 'N/A'); ?><?php if (!empty($record['height'])) echo ' cm'; ?></td>
                            <td>
                                <button class="btn-action edit" 
                                    data-id="<?php echo $record['id']; ?>"
                                    data-student="<?php echo htmlspecialchars($record['student_id']); ?>"
                                    data-date="<?php echo htmlspecialchars($record['date']); ?>"
                                    data-time="<?php echo htmlspecialchars($record['time']); ?>"
                                    data-temp="<?php echo htmlspecialchars($record['temperature']); ?>"
                                    data-pulse="<?php echo htmlspecialchars($record['pulse_rate']); ?>"
                                    data-bp="<?php echo htmlspecialchars($record['blood_pressure']); ?>"
                                    data-oxy="<?php echo htmlspecialchars($record['oxygen_level'] ?? ''); ?>"
                                    data-weight="<?php echo htmlspecialchars($record['weight'] ?? ''); ?>"
                                    data-height="<?php echo htmlspecialchars($record['height'] ?? ''); ?>"
                                    onclick="openEditModal(this)">
                                    Edit
                                </button>
                                <form method="POST" action="vital_signs.php" style="display:inline-block;" onsubmit="return confirm('Are you sure you want to delete this record?');">
                                    <input type="hidden" name="vital_id" value="<?php echo $record['id']; ?>">
                                    <button type="submit" name="delete_vitals" class="btn-action delete">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="10" style="text-align: center;"><?php echo !empty($search) ? 'No records found matching your search.' : 'No vital signs recorded yet.'; ?></td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

</section>

</main>

<!-- Add Vital Signs Modal -->
<div id="vitalSignsModal" class="modal">
    <div class="modal-content">
        <span class="close-button">&times;</span>
        <h2>Add Vital Signs Record</h2>
        <form method="POST" action="vital_signs.php">
            <div class="form-group">
                <label>Student ID</label>
                <input type="text" name="student_id" required placeholder="Enter Student ID (e.g., 2023-00123)">
            </div>
            
            <div class="form-row">
                <div class="form-group">
                    <label>Date</label>
                    <input type="date" name="date" required value="<?php echo date('Y-m-d'); ?>">
                </div>
                <div class="form-group">
                    <label>Time</label>
                    <input type="time" name="time" required value="<?php echo date('H:i'); ?>">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>Temperature (°F)</label>
                    <input type="number" step="0.1" name="temperature" placeholder="98.6" required>
                </div>
                <div class="form-group">
                    <label>Pulse Rate (bpm)</label>
                    <input type="number" name="pulse_rate" placeholder="72" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>Blood Pressure (mmHg)</label>
                    <input type="text" name="blood_pressure" placeholder="120/80" required>
                </div>
                <div class="form-group">
                    <label>Oxygen Level (%)</label>
                    <input type="number" name="oxygen_level" placeholder="98">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>Weight (kg)</label>
                    <input type="number" step="0.1" name="weight" placeholder="65.0">
                </div>
                <div class="form-group">
                    <label>Height (cm)</label>
                    <input type="number" name="height" placeholder="170">
                </div>
            </div>

            <button type="submit" name="add_vitals" class="btn-submit">Save Record</button>
        </form>
    </div>
</div>

<!-- Edit Vital Signs Modal -->
<div id="editVitalSignsModal" class="modal">
    <div class="modal-content">
        <span class="close-button close-edit">&times;</span>
        <h2>Edit Vital Signs Record</h2>
        <form method="POST" action="vital_signs.php">
            <input type="hidden" name="vital_id" id="edit_vital_id">
            <div class="form-group">
                <label>Student ID</label>
                <input type="text" name="student_id" id="edit_student_id" required>
            </div>
            
            <div class="form-row">
                <div class="form-group">
                    <label>Date</label>
                    <input type="date" name="date" id="edit_date" required>
                </div>
                <div class="form-group">
                    <label>Time</label>
                    <input type="time" name="time" id="edit_time" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>Temperature (°F)</label>
                    <input type="number" step="0.1" name="temperature" id="edit_temperature" required>
                </div>
                <div class="form-group">
                    <label>Pulse Rate (bpm)</label>
                    <input type="number" name="pulse_rate" id="edit_pulse_rate" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>Blood Pressure (mmHg)</label>
                    <input type="text" name="blood_pressure" id="edit_blood_pressure" required>
                </div>
                <div class="form-group">
                    <label>Oxygen Level (%)</label>
                    <input type="number" name="oxygen_level" id="edit_oxygen_level">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>Weight (kg)</label>
                    <input type="number" step="0.1" name="weight" id="edit_weight">
                </div>
                <div class="form-group">
                    <label>Height (cm)</label>
                    <input type="number" name="height" id="edit_height">
                </div>
            </div>

            <button type="submit" name="edit_vitals" class="btn-submit">Update Record</button>
        </form>
    </div>
</div>

<script>
    // Add Modal Logic
    const modal = document.getElementById("vitalSignsModal");
    const btn = document.querySelector(".btn-add-record");
    const span = document.querySelector(".close-button");

    btn.onclick = function() { modal.style.display = "block"; }
    span.onclick = function() { modal.style.display = "none"; }
    
    // Edit Modal Logic
    const editModal = document.getElementById("editVitalSignsModal");
    const editSpan = document.querySelector(".close-edit");

    editSpan.onclick = function() { editModal.style.display = "none"; }

    function openEditModal(button) {
        document.getElementById('edit_vital_id').value = button.getAttribute('data-id');
        document.getElementById('edit_student_id').value = button.getAttribute('data-student');
        document.getElementById('edit_date').value = button.getAttribute('data-date');
        document.getElementById('edit_time').value = button.getAttribute('data-time');
        document.getElementById('edit_temperature').value = button.getAttribute('data-temp');
        document.getElementById('edit_pulse_rate').value = button.getAttribute('data-pulse');
        document.getElementById('edit_blood_pressure').value = button.getAttribute('data-bp');
        document.getElementById('edit_oxygen_level').value = button.getAttribute('data-oxy');
        document.getElementById('edit_weight').value = button.getAttribute('data-weight');
        document.getElementById('edit_height').value = button.getAttribute('data-height');

        editModal.style.display = "block";
    }

    window.onclick = function(event) {
        if (event.target == modal) { modal.style.display = "none"; }
        if (event.target == editModal) { editModal.style.display = "none"; }
    }
</script>

</body>
</html>
