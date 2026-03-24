<?php
session_start();
$servername = "localhost";
$db_username = "root";
$db_password = "";
$dbname = "mhr";

$conn = new mysqli($servername, $db_username, $db_password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = '';
$msg_type = '';

// Determine current user ID (Default to sample ID if no session)
$current_id = isset($_SESSION['username']) ? $_SESSION['username'] : 'CLK-2023-001';

// Handle Form Submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $student_id = $_POST['student_id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $address = $_POST['address'];

    // Check if record exists in personal_info
    $check = $conn->prepare("SELECT student_id FROM personal_info WHERE student_id = ?");
    $check->bind_param("s", $student_id);
    $check->execute();
    $result = $check->get_result();

    if ($result->num_rows > 0) {
        // Update existing record
        $stmt = $conn->prepare("UPDATE personal_info SET first_name=?, last_name=?, email=?, contact=?, address=? WHERE student_id=?");
        $stmt->bind_param("ssssss", $first_name, $last_name, $email, $contact, $address, $student_id);
    } else {
        // Create new record
        $stmt = $conn->prepare("INSERT INTO personal_info (student_id, first_name, last_name, email, contact, address) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $student_id, $first_name, $last_name, $email, $contact, $address);
    }

    if ($stmt->execute()) {
        $message = "Profile updated successfully.";
        $msg_type = "success";
    } else {
        $message = "Error updating profile: " . $stmt->error;
        $msg_type = "error";
    }
    $stmt->close();
    $check->close();
}

// Fetch Current Data
$data = [
    'first_name' => '', 'last_name' => '', 'email' => '', 
    'contact' => '', 'address' => '', 'role' => 'Clerk'
];

// Fetch from personal_info
$stmt = $conn->prepare("SELECT * FROM personal_info WHERE student_id = ?");
$stmt->bind_param("s", $current_id);
$stmt->execute();
$res = $stmt->get_result();
if ($row = $res->fetch_assoc()) {
    $data = array_merge($data, $row);
}
$stmt->close();

// Fetch role from users
$stmt = $conn->prepare("SELECT role FROM users WHERE username = ?");
$stmt->bind_param("s", $current_id);
$stmt->execute();
$res = $stmt->get_result();
if ($row = $res->fetch_assoc()) {
    $data['role'] = ucfirst($row['role']);
}
$stmt->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personal Info - Clerk</title>
    <link rel="stylesheet" href="personal_info.css">
</head>
<body>
    <div class="dashboard">
        <?php include 'sidebar.php'; ?>

        <div class="main">
            <div class="topbar">
                <div class="page-title">
                    <h2>Personal Information</h2>
                </div>
                <div class="admin">
                    <span>Clerk</span>
                </div>
            </div>

            <div class="content-container">
                <div class="form-card">
                    <?php if (!empty($message)): ?>
                        <div style="padding: 10px; margin-bottom: 20px; border-radius: 5px; 
                                    background-color: <?php echo $msg_type == 'success' ? '#d4edda' : '#f8d7da'; ?>; 
                                    color: <?php echo $msg_type == 'success' ? '#155724' : '#721c24'; ?>;">
                            <?php echo htmlspecialchars($message); ?>
                        </div>
                    <?php endif; ?>
                    <form action="" method="POST" id="profileForm">
                        <div class="form-row">
                            <div class="form-group">
                                <label>Student ID</label>
                                <input type="text" name="student_id" value="<?php echo htmlspecialchars($current_id); ?>">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label>First Name</label>
                                <input type="text" name="first_name" value="<?php echo htmlspecialchars($data['first_name']); ?>" required>
                            </div>
                            <div class="form-group">
                                <label>Last Name</label>
                                <input type="text" name="last_name" value="<?php echo htmlspecialchars($data['last_name']); ?>" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Email Address</label>
                            <input type="email" name="email" value="<?php echo htmlspecialchars($data['email']); ?>" required>
                        </div>

                        <div class="form-group">
                            <label>Contact Number</label>
                            <input type="text" name="contact" value="<?php echo htmlspecialchars($data['contact']); ?>">
                        </div>

                        <div class="form-group">
                            <label>Address</label>
                            <textarea name="address" rows="2"><?php echo htmlspecialchars($data['address']); ?></textarea>
                        </div>

                        <button type="submit" class="btn-save">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('profileForm').addEventListener('submit', function(e) {
            e.preventDefault();
            var form = e.target;
            var studentId = form.querySelector('[name="student_id"]').value;
            var firstName = form.querySelector('[name="first_name"]').value;
            var lastName = form.querySelector('[name="last_name"]').value;
            var email = form.querySelector('[name="email"]').value;
            var contact = form.querySelector('[name="contact"]').value;
            var address = form.querySelector('[name="address"]').value;

            var msg = "Please confirm the following details:\n\n" +
                      "Student ID: " + studentId + "\n" +
                      "First Name: " + firstName + "\n" +
                      "Last Name: " + lastName + "\n" +
                      "Email: " + email + "\n" +
                      "Contact: " + contact + "\n" +
                      "Address: " + address + "\n\n" +
                      "Are all filled up details correct?";
            
            if (confirm(msg)) {
                form.submit();
            }
        });
    </script>
</body>
</html>