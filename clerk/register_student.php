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
                    <form action="" method="POST">
                        <div class="form-row">
                            <div class="form-group">
                                <label>Student ID</label>
                                <input type="text" name="student_id" placeholder="Enter Student ID" required>
                            </div>
                            <div class="form-group">
                                <label>Full Name</label>
                                <input type="text" name="full_name" placeholder="Last Name, First Name M.I." required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label>Date of Birth</label>
                                <input type="date" name="dob" required>
                            </div>
                            <div class="form-group">
                                <label>Gender</label>
                                <select name="gender" required>
                                    <option value="">Select Gender</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label>Course</label>
                                <input type="text" name="course" placeholder="e.g. BSIT" required>
                            </div>
                            <div class="form-group">
                                <label>Year Level</label>
                                <select name="year_level" required>
                                    <option value="">Select Year</option>
                                    <option value="1">1st Year</option>
                                    <option value="2">2nd Year</option>
                                    <option value="3">3rd Year</option>
                                    <option value="4">4th Year</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Address</label>
                            <textarea name="address" rows="2" placeholder="Complete Home Address" required></textarea>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label>Contact Number</label>
                                <input type="text" name="contact" placeholder="09123456789">
                            </div>
                            <div class="form-group">
                                <label>Emergency Contact</label>
                                <input type="text" name="emergency_contact" placeholder="Parent/Guardian Name">
                            </div>
                        </div>

                        <button type="submit" class="btn-register">Register Student</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>