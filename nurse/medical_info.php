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
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_medical_info'])) {
    $student_id = $_POST['student_id'];
    
    // Helper to get Yes/No from checkbox
    $get_symptom = function($name) {
        return isset($_POST[$name]) ? 'Yes' : 'No';
    };

    $fever = $get_symptom('fever');
    $cough = $get_symptom('cough');
    $sore_throat = $get_symptom('sore_throat');
    $runny_nose = $get_symptom('runny_nose');
    $fatigue = $get_symptom('fatigue');
    $headache = $get_symptom('headache');
    $difficulty_breathing = $get_symptom('difficulty_breathing');
    $diarrhea = $get_symptom('diarrhea');

    $sql = "INSERT INTO medical_info (student_id, fever, cough, sore_throat, runny_nose, fatigue, headache, difficulty_breathing, diarrhea) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("sssssssss", $student_id, $fever, $cough, $sore_throat, $runny_nose, $fatigue, $headache, $difficulty_breathing, $diarrhea);
        if ($stmt->execute()) {
            $message = "Medical info added successfully!";
        } else {
            $message = "Error adding info: " . $stmt->error;
        }
        $stmt->close();
    } else {
        $message = "Error preparing statement: " . $conn->error;
    }
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
    <title>Medical Info - Nurse</title>

    <!-- Nurse specific styles -->
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
            max-width: 600px;
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
        .close-button:hover { color: black; }
        .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-top: 15px; }
        .checkbox-group { display: flex; align-items: center; gap: 10px; }
        .btn-submit { background-color: #4a90e2; color: white; padding: 10px 15px; border: none; border-radius: 4px; cursor: pointer; width: 100%; margin-top: 20px; }
    </style>
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
                    <span>Nurse</span>
                    <!-- Placeholder for profile image if needed -->
                </div>
            </div>

            <!-- Main Content -->
            <div class="records-container">
                <?php if (!empty($message)): ?>
                    <div style="padding: 15px; margin-bottom: 20px; border-radius: 5px; background-color: <?php echo strpos($message, 'Error') !== false ? '#f8d7da' : '#d4edda'; ?>; color: <?php echo strpos($message, 'Error') !== false ? '#721c24' : '#155724'; ?>; border: 1px solid <?php echo strpos($message, 'Error') !== false ? '#f5c6cb' : '#c3e6cb'; ?>;">
                        <?php echo htmlspecialchars($message); ?>
                    </div>
                <?php endif; ?>

                <div class="records-controls">
                    <form class="search-box" method="GET">
                        <input type="text" name="search" value="<?php echo htmlspecialchars($search); ?>" placeholder="Search student ID...">
                    </form>
                    
                    <button class="btn-add-record" onclick="document.getElementById('addInfoModal').style.display='block'">
                        <span>+ New Info</span>
                    </button>
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

    <!-- Add Medical Info Modal -->
    <div id="addInfoModal" class="modal">
        <div class="modal-content">
            <span class="close-button" onclick="document.getElementById('addInfoModal').style.display='none'">&times;</span>
            <h2>Add Medical Information</h2>
            <form method="POST">
                <div style="margin-bottom: 15px;">
                    <label style="display:block; margin-bottom:5px;">Student ID</label>
                    <input type="text" name="student_id" required placeholder="Enter Student ID" style="width:100%; padding:8px;">
                </div>

                <p style="margin-bottom: 10px; font-weight: bold;">Symptoms (Check all that apply):</p>
                <div class="form-grid">
                    <label class="checkbox-group">
                        <input type="checkbox" name="fever" value="Yes"> Fever
                    </label>
                    <label class="checkbox-group">
                        <input type="checkbox" name="cough" value="Yes"> Cough
                    </label>
                    <label class="checkbox-group">
                        <input type="checkbox" name="sore_throat" value="Yes"> Sore Throat
                    </label>
                    <label class="checkbox-group">
                        <input type="checkbox" name="runny_nose" value="Yes"> Runny Nose
                    </label>
                    <label class="checkbox-group">
                        <input type="checkbox" name="fatigue" value="Yes"> Fatigue
                    </label>
                    <label class="checkbox-group">
                        <input type="checkbox" name="headache" value="Yes"> Headache
                    </label>
                    <label class="checkbox-group">
                        <input type="checkbox" name="difficulty_breathing" value="Yes"> Diff. Breathing
                    </label>
                    <label class="checkbox-group">
                        <input type="checkbox" name="diarrhea" value="Yes"> Diarrhea
                    </label>
                </div>

                <button type="submit" name="add_medical_info" class="btn-submit">Save Information</button>
            </form>
        </div>
    </div>

    <script>
        window.onclick = function(event) {
            var modal = document.getElementById("addInfoModal");
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>

</body>
</html>