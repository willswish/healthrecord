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
                    <form action="" method="POST">
                        <div class="form-row">
                            <div class="form-group">
                                <label>Employee ID</label>
                                <input type="text" name="employee_id" value="CLK-2023-001" readonly style="background-color: #f8fafc; cursor: not-allowed;">
                            </div>
                            <div class="form-group">
                                <label>Role</label>
                                <input type="text" value="Clerk" readonly style="background-color: #f8fafc; cursor: not-allowed;">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label>First Name</label>
                                <input type="text" name="first_name" value="Juan" required>
                            </div>
                            <div class="form-group">
                                <label>Last Name</label>
                                <input type="text" name="last_name" value="Dela Cruz" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Email Address</label>
                            <input type="email" name="email" value="juan.clerk@hospital.edu.ph" required>
                        </div>

                        <div class="form-group">
                            <label>Contact Number</label>
                            <input type="text" name="contact" value="09123456789">
                        </div>

                        <div class="form-group">
                            <label>Address</label>
                            <textarea name="address" rows="2">123 Health Blvd, Medical City</textarea>
                        </div>

                        <hr style="border: 0; border-top: 1px solid #eee; margin: 20px 0;">

                        <div class="form-group">
                            <label>New Password <small>(Leave blank to keep current)</small></label>
                            <input type="password" name="password" placeholder="********">
                        </div>

                        <button type="submit" class="btn-save">Update Profile</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>