<?php
session_start();
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $servername = "localhost";
    $db_username = "root";
    $db_password = "";
    $dbname = "mhr";

    $conn = new mysqli($servername, $db_username, $db_password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $student_id = $_POST['student_id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $age = $_POST['age'];
    $sex = $_POST['sex'];
    $civil_status = $_POST['civil_status'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $college = $_POST['college'];
    $course = $_POST['course'];
    $religion = !empty($_POST['religion']) ? $_POST['religion'] : NULL;
    $blood_type = !empty($_POST['blood_type']) ? $_POST['blood_type'] : NULL;
    $allergies = !empty($_POST['allergies']) ? $_POST['allergies'] : NULL;

    $stmt_check = $conn->prepare("SELECT id FROM students WHERE student_id = ?");
    $stmt_check->bind_param("s", $student_id);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();

    if ($result_check->num_rows > 0) {
        $message = "Error: A student with ID '{$student_id}' already exists.";
    } else {
        $stmt = $conn->prepare("INSERT INTO students (student_id, first_name, last_name, age, sex, civil_status, email, contact, college, course, religion, blood_type, allergies) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssisssssssss", $student_id, $first_name, $last_name, $age, $sex, $civil_status, $email, $contact, $college, $course, $religion, $blood_type, $allergies);

        if ($stmt->execute()) {
            $message = "Student '{$first_name} {$last_name}' registered successfully!";
        } else {
            $message = "Error registering student: " . $stmt->error;
        }
        $stmt->close();
    }
    $stmt_check->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Student - Clerk</title>
    <link rel="stylesheet" href="register_student.css">
</head>
<body>
    <div class="dashboard">
        <?php include 'sidebar.php'; ?>

        <div class="main">
            <div class="topbar">
                <div class="page-title">
                    <h2>Register New Student</h2>
                </div>
                <div class="admin">
                    <span>Clerk</span>
                </div>
            </div>

            <div class="content-container">
                <div class="form-card">
                    <?php if (!empty($message)): ?>
                        <div class="message" style="padding: 1rem; margin-bottom: 1rem; border-radius: 5px; <?php echo (strpos($message, 'Error') !== false) ? 'color: #721c24; background-color: #f8d7da; border-color: #f5c6cb;' : 'color: #155724; background-color: #d4edda; border: 1px solid #c3e6cb;'; ?>">
                            <?php echo htmlspecialchars($message); ?>
                        </div>
                    <?php endif; ?>
                    <form action="register_student.php" method="POST">
                        <div class="form-group">
                            <label>Student ID</label>
                            <input type="text" name="student_id" placeholder="Enter Student ID" required>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label>First Name</label>
                                <input type="text" name="first_name" required>
                            </div>
                            <div class="form-group">
                                <label>Last Name</label>
                                <input type="text" name="last_name" required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label>Age</label>
                                <input type="number" name="age" required>
                            </div>
                            <div class="form-group">
                                <label>Sex</label>
                                <select name="sex" required>
                                    <option value="">Select Sex</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Civil Status</label>
                                <select name="civil_status" required>
                                    <option value="">Select Status</option>
                                    <option value="Single">Single</option>
                                    <option value="Married">Married</option>
                                    <option value="Widowed">Widowed</option>
                                    <option value="Separated">Separated</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" name="email" required>
                            </div>
                            <div class="form-group">
                                <label>Contact Number</label>
                                <input type="text" name="contact" required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label>College</label>
                                <input type="text" name="college" placeholder="e.g. College of Science" required>
                            </div>
                            <div class="form-group">
                                <label>Course</label>
                                <input type="text" name="course" placeholder="e.g. BSIT" required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label>Religion</label>
                                <input type="text" name="religion">
                            </div>
                            <div class="form-group">
                                <label>Blood Type</label>
                                <select name="blood_type">
                                    <option value="">Select Blood Type</option>
                                    <option value="A+">A+</option>
                                    <option value="A-">A-</option>
                                    <option value="B+">B+</option>
                                    <option value="B-">B-</option>
                                    <option value="AB+">AB+</option>
                                    <option value="AB-">AB-</option>
                                    <option value="O+">O+</option>
                                    <option value="O-">O-</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Allergies</label>
                            <textarea name="allergies" rows="2" placeholder="List any allergies..."></textarea>
                        </div>

                        <button type="submit" class="btn-register">Register Student</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>