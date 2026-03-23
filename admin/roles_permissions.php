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

// --- DEFINITIONS ---
$all_permissions = [
    'User Management' => [
        'user_view' => 'View Users',
        'user_create' => 'Create Users',
        'user_edit' => 'Edit Users',
        'user_delete' => 'Delete Users'
    ],
    'Medical Records' => [
        'record_view' => 'View Records',
        'record_create' => 'Add Entries',
        'record_edit' => 'Modify Entries',
        'record_delete' => 'Delete Entries'
    ],
    'Reports & Analytics' => [
        'report_view' => 'View Reports',
        'report_export' => 'Export Data'
    ],
    'System Settings' => [
        'settings_access' => 'Access Settings'
    ]
];

// --- HANDLE ADD ROLE ---
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_role'])) {
    $role_name = trim($_POST['role_name']);
    // Create a slug (e.g., "Health Nurse" -> "health-nurse")
    $role_slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $role_name)));

    if (!empty($role_name)) {
        $stmt = $conn->prepare("INSERT INTO roles (slug, name) VALUES (?, ?)");
        $stmt->bind_param("ss", $role_slug, $role_name);
        if ($stmt->execute()) {
            $message = "Role '{$role_name}' created successfully.";
        } else {
            $message = "Error creating role: " . $conn->error;
        }
        $stmt->close();
    }
}

// --- HANDLE SAVE PERMISSIONS ---
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save_permissions'])) {
    $role_id = intval($_POST['role_id']);
    $submitted_permissions = isset($_POST['permissions']) ? $_POST['permissions'] : [];

    // First, clear existing permissions for this role
    $conn->query("DELETE FROM role_permissions WHERE role_id = $role_id");

    // Insert new permissions
    if (!empty($submitted_permissions)) {
        $stmt = $conn->prepare("INSERT INTO role_permissions (role_id, permission) VALUES (?, ?)");
        foreach ($submitted_permissions as $perm) {
            $stmt->bind_param("is", $role_id, $perm);
            $stmt->execute();
        }
        $stmt->close();
    }
    $message = "Permissions updated successfully.";
}

// --- FETCH DATA ---
// 1. Get all roles
$roles = $conn->query("SELECT * FROM roles ORDER BY name ASC")->fetch_all(MYSQLI_ASSOC);

// 2. Determine active role (from URL or default to first one)
$active_role_id = isset($_GET['role_id']) ? intval($_GET['role_id']) : ($roles[0]['id'] ?? 0);
$active_role_name = '';

// 3. Get permissions for the active role
$active_perms = [];
if ($active_role_id > 0) {
    // Find name
    foreach ($roles as $r) {
        if ($r['id'] == $active_role_id) {
            $active_role_name = $r['name'];
            break;
        }
    }
    // Fetch permissions
    $res = $conn->query("SELECT permission FROM role_permissions WHERE role_id = $active_role_id");
    while ($row = $res->fetch_assoc()) {
        $active_perms[] = $row['permission'];
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Roles & Permissions - MHR System</title>
<link rel="stylesheet" href="dashboard.css">
<link rel="stylesheet" href="roles_permissions.css">
<style>
/* Modal Styles (Reuse) */
.modal { display: none; position: fixed; z-index: 1000; left: 0; top: 0; width: 100%; height: 100%; overflow: auto; background-color: rgba(0,0,0,0.4); }
.modal-content { background-color: #fefefe; margin: 15% auto; padding: 20px; border: 1px solid #888; width: 80%; max-width: 400px; border-radius: 8px; position: relative; }
.close-button { color: #aaa; position: absolute; top: 10px; right: 20px; font-size: 28px; font-weight: bold; cursor: pointer; }
.close-button:hover { color: black; }
.form-group { margin-bottom: 15px; }
.form-group label { display: block; margin-bottom: 5px; }
.form-group input { width: 100%; padding: 10px; box-sizing: border-box; border: 1px solid #ccc; border-radius: 4px; }
.btn-submit { background-color: #4a90e2; color: white; padding: 10px; border: none; border-radius: 4px; cursor: pointer; width: 100%; }

/* Alert Style */
.alert { padding: 10px; margin-bottom: 20px; border-radius: 4px; }
.alert-success { background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
.alert-error { background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
</style>
</head>

<body>

<div class="dashboard">

<?php include 'sidebar.php'; ?>

<!-- MAIN CONTENT -->
<main class="main">

<header class="topbar">
<h1>Roles & Permissions</h1>

<div class="admin">
<img src="https://i.pravatar.cc/40">
<span>Administrator</span>
</div>
</header>


<!-- ROLES CONTENT -->
<section class="roles-container">

    <?php if (!empty($message)): ?>
        <div style="grid-column: 1 / -1;">
            <div class="alert <?php echo strpos($message, 'Error') !== false ? 'alert-error' : 'alert-success'; ?>">
                <?php echo htmlspecialchars($message); ?>
            </div>
        </div>
    <?php endif; ?>

    <!-- Left Side: Roles List -->
    <div class="roles-sidebar">
        <div class="roles-header">
            <h3>Roles</h3>
            <button class="btn-add-role" onclick="document.getElementById('addRoleModal').style.display='block'">+ New</button>
        </div>
        <ul class="role-list">
            <?php if (!empty($roles)): ?>
                <?php foreach ($roles as $role): ?>
                    <li class="<?php echo $role['id'] == $active_role_id ? 'active' : ''; ?>" 
                        onclick="window.location.href='?role_id=<?php echo $role['id']; ?>'">
                        <?php echo htmlspecialchars($role['name']); ?>
                    </li>
                <?php endforeach; ?>
            <?php else: ?>
                <li>No roles found.</li>
            <?php endif; ?>
        </ul>
    </div>

    <!-- Right Side: Permissions Matrix -->
    <form class="permissions-content" method="POST" action="roles_permissions.php?role_id=<?php echo $active_role_id; ?>">
        <input type="hidden" name="role_id" value="<?php echo $active_role_id; ?>">
        
        <div class="perm-header">
            <h3>Permissions for: <span class="highlight"><?php echo htmlspecialchars($active_role_name); ?></span></h3>
            <?php if ($active_role_id > 0): ?>
                <button type="submit" name="save_permissions" class="btn-save">Save Changes</button>
            <?php endif; ?>
        </div>

        <?php if ($active_role_id > 0): ?>
            <?php foreach ($all_permissions as $group_name => $perms): ?>
            <div class="perm-group">
                <h4><?php echo htmlspecialchars($group_name); ?></h4>
                <?php foreach ($perms as $perm_key => $perm_label): ?>
                    <label class="toggle-row">
                        <span><?php echo htmlspecialchars($perm_label); ?></span>
                        <input type="checkbox" name="permissions[]" value="<?php echo $perm_key; ?>" 
                            <?php echo in_array($perm_key, $active_perms) ? 'checked' : ''; ?>>
                    </label>
                <?php endforeach; ?>
            </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Please select a role to configure permissions.</p>
        <?php endif; ?>

    </form>

</section>

<!-- Add Role Modal -->
<div id="addRoleModal" class="modal">
    <div class="modal-content">
        <span class="close-button" onclick="document.getElementById('addRoleModal').style.display='none'">&times;</span>
        <h2>Add New Role</h2>
        <form method="POST">
            <div class="form-group">
                <label>Role Name</label>
                <input type="text" name="role_name" placeholder="e.g. Laboratory Head" required>
            </div>
            <button type="submit" name="add_role" class="btn-submit">Create Role</button>
        </form>
    </div>
</div>

</main>

</div>

<?php $conn->close(); ?>

<script>
window.onclick = function(event) {
    var modal = document.getElementById("addRoleModal");
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>

</body>
</html>