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

// --- DELETE USER LOGIC ---
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_user'])) {
    $user_id = intval($_POST['user_id']);
    
    $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
    $stmt->bind_param("i", $user_id);

    if ($stmt->execute()) {
        $message = "User deleted successfully!";
    } else {
        $message = "Error deleting user: " . $stmt->error;
    }
    $stmt->close();
}

// --- EDIT USER LOGIC ---
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_user'])) {
    $user_id = intval($_POST['user_id']);
    $username = $_POST['username'];
    $role = $_POST['role'];
    $password = $_POST['password'];

    if (!empty($password)) {
        // Update with new password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("UPDATE users SET username = ?, password = ?, role = ? WHERE id = ?");
        $stmt->bind_param("sssi", $username, $hashed_password, $role, $user_id);
    } else {
        // Update without changing password
        $stmt = $conn->prepare("UPDATE users SET username = ?, role = ? WHERE id = ?");
        $stmt->bind_param("ssi", $username, $role, $user_id);
    }

    if ($stmt->execute()) {
        $message = "User updated successfully!";
    } else {
        $message = "Error updating user: " . $stmt->error;
    }
    $stmt->close();
}

// --- ADD USER LOGIC ---
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_user'])) {
    $username = $_POST['username'];
    
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'];

    $stmt = $conn->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $password, $role);

    if ($stmt->execute()) {
        $message = "User '{$username}' created successfully!";
    } else {
       
        $message = "Error creating user: " . $stmt->error;
    }
    $stmt->close();
}

// --- FETCH USERS TO DISPLAY ---
$users = [];
$result = $conn->query("SELECT id, username, role, created_at FROM users ORDER BY created_at DESC");
if ($result) {
    $users = $result->fetch_all(MYSQLI_ASSOC);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Manage Users - MHR System</title>
<link rel="stylesheet" href="dashboard.css">
<link rel="stylesheet" href="manage_users.css">
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

.modal h2 {
    margin-top: 0;
    margin-bottom: 20px;
}

.form-group {
    margin-bottom: 15px;
}

.form-group label {
    display: block;
    margin-bottom: 5px;
}

.form-group input,
.form-group select {
    width: 100%;
    padding: 10px;
    box-sizing: border-box;
    border: 1px solid #ccc;
    border-radius: 4px;
}

.btn-submit {
    background-color: #28a745;
    color: white;
    padding: 10px 15px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    width: 100%;
    font-size: 1rem;
}

.btn-submit:hover {
    background-color: #218838;
}
</style>
</head>

<body>

<div class="dashboard">

<?php include 'sidebar.php'; ?>

<!-- MAIN CONTENT -->
<main class="main">

<header class="topbar">
<h1>Manage Users</h1>

<div class="admin">
<img src="https://i.pravatar.cc/40">
<span>Administrator</span>
</div>
</header>


<!-- USERS CONTENT -->
<section class="users-container">

<?php if (!empty($message)): ?>
    <div class="success-message" style="background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; padding: 1rem; border-radius: 5px; margin-bottom: 1rem;">
        <?php echo $message; ?>
    </div>
<?php endif; ?>

<div class="user-controls">
    <div class="search-box">
        <input type="text" id="searchInput" placeholder="Search by name or role...">
    </div>
    <button class="btn-add-user">+ Add New User</button>
</div>

<div class="table-responsive">
    <table class="users-table">
        <thead>
            <tr>
                <th>id</th>
                <th>username</th>
                <th>password</th>
                <th>role</th>
                <th>created at</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($users)): ?>
                <?php foreach ($users as $user): ?>
                <tr>
                    <td><?php echo htmlspecialchars($user['id']); ?></td>
                    <td><?php echo htmlspecialchars($user['username']); ?></td>
                    <td>********</td>
                    <td><?php echo htmlspecialchars($user['role']); ?></td>
                    <td><?php echo htmlspecialchars(date('Y-m-d H:i:s', strtotime($user['created_at']))); ?></td>
                    <td>
                        <button class="btn-action edit btn-edit-user" 
                            data-id="<?php echo $user['id']; ?>" 
                            data-username="<?php echo htmlspecialchars($user['username']); ?>" 
                            data-role="<?php echo htmlspecialchars($user['role']); ?>">
                            Edit
                        </button>
                        <form method="POST" action="manage_users.php" style="display:inline-block;" onsubmit="return confirm('Are you sure you want to delete this user?');">
                            <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
                            <button type="submit" name="delete_user" class="btn-action delete">Delete</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" style="text-align: center;">No users found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<!-- Add User Modal -->
<div id="addUserModal" class="modal">
    <div class="modal-content">
        <span class="close-button">&times;</span>
        <h2>Add New User</h2>
        <form method="POST" action="manage_users.php">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="role">Role</label>
                <select id="role" name="role" required>
                    <option value="admin">Administrator</option>
                    <option value="dean">Dean</option>
                    <option value="nurse">Health Nurse</option>
                    <option value="clerk">Health Clerk</option>
                    <option value="coordinator">Health Coordinator</option>
                    
                </select>
            </div>
            <button type="submit" name="add_user" class="btn-submit">Create User</button>
        </form>
    </div>
</div>

<!-- Edit User Modal -->
<div id="editUserModal" class="modal">
    <div class="modal-content">
        <span class="close-button">&times;</span>
        <h2>Edit User</h2>
        <form method="POST" action="manage_users.php">
            <input type="hidden" id="edit_user_id" name="user_id">
            <div class="form-group">
                <label for="edit_username">Username</label>
                <input type="text" id="edit_username" name="username" required>
            </div>
            <div class="form-group">
                <label for="edit_password">Password (Leave blank to keep current)</label>
                <input type="password" id="edit_password" name="password" placeholder="New Password">
            </div>
            <div class="form-group">
                <label for="edit_role">Role</label>
                <select id="edit_role" name="role" required>
                    <option value="admin">Administrator</option>
                    <option value="dean">Dean</option>
                    <option value="nurse">Health Nurse</option>
                    <option value="clerk">Health Clerk</option>
                    <option value="coordinator">Health Coordinator</option>
                </select>
            </div>
            <button type="submit" name="edit_user" class="btn-submit">Update User</button>
        </form>
    </div>
</div>

</section>

</main>

</div>

<?php
$conn->close();
?>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add User Modal
    const addUserModal = document.getElementById('addUserModal');
    const addUserBtn = document.querySelector('.btn-add-user');
    const addCloseButton = addUserModal.querySelector('.close-button');

    // Edit User Modal
    const editUserModal = document.getElementById('editUserModal');
    const editCloseButton = editUserModal.querySelector('.close-button');
    const editBtns = document.querySelectorAll('.btn-edit-user');
    
    // Search Functionality
    const searchInput = document.getElementById('searchInput');
    const tableRows = document.querySelectorAll('.users-table tbody tr');

    searchInput.addEventListener('keyup', function() {
        const searchTerm = this.value.toLowerCase();

        tableRows.forEach(row => {
            // Ensure we are checking a data row, not a "No users found" message
            if (row.cells.length > 1) {
                const username = row.cells[1].textContent.toLowerCase();
                const role = row.cells[3].textContent.toLowerCase();

                if (username.includes(searchTerm) || role.includes(searchTerm)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            }
        });
    });

    addUserBtn.addEventListener('click', () => {
        addUserModal.style.display = 'block';
    });

    addCloseButton.addEventListener('click', () => {
        addUserModal.style.display = 'none';
    });

    // Handle Edit Button Clicks
    editBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            const username = this.getAttribute('data-username');
            const role = this.getAttribute('data-role');

            document.getElementById('edit_user_id').value = id;
            document.getElementById('edit_username').value = username;
            document.getElementById('edit_role').value = role;

            editUserModal.style.display = 'block';
        });
    });

    editCloseButton.addEventListener('click', () => {
        editUserModal.style.display = 'none';
    });

    window.addEventListener('click', (event) => {
        if (event.target == addUserModal) {
            addUserModal.style.display = 'none';
        }
        if (event.target == editUserModal) {
            editUserModal.style.display = 'none';
        }
    });
});
</script>

</body>
</html>