<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Roles & Permissions - MHR System</title>
<link rel="stylesheet" href="dashboard.css">
<link rel="stylesheet" href="roles_permissions.css">
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

    <!-- Left Side: Roles List -->
    <div class="roles-sidebar">
        <div class="roles-header">
            <h3>Roles</h3>
            <button class="btn-add-role">+ New</button>
        </div>
        <ul class="role-list">
            <li class="active">Administrator</li>
            <li>Health Nurse</li>
            <li>Health Clerk</li>
            <li>Health Coordinator</li>
        </ul>
    </div>

    <!-- Right Side: Permissions Matrix -->
    <div class="permissions-content">
        <div class="perm-header">
            <h3>Permissions for: <span class="highlight">Administrator</span></h3>
            <button class="btn-save">Save Changes</button>
        </div>

        <div class="perm-group">
            <h4>User Management</h4>
            <label class="toggle-row">
                <span>View Users</span>
                <input type="checkbox" checked>
            </label>
            <label class="toggle-row">
                <span>Create Users</span>
                <input type="checkbox" checked>
            </label>
            <label class="toggle-row">
                <span>Edit Users</span>
                <input type="checkbox" checked>
            </label>
            <label class="toggle-row">
                <span>Delete Users</span>
                <input type="checkbox" checked>
            </label>
        </div>

        <div class="perm-group">
            <h4>Medical Records</h4>
            <label class="toggle-row">
                <span>View Records</span>
                <input type="checkbox" checked>
            </label>
            <label class="toggle-row">
                <span>Add Entries</span>
                <input type="checkbox" checked>
            </label>
            <label class="toggle-row">
                <span>Modify Entries</span>
                <input type="checkbox" checked>
            </label>
        </div>

        <div class="perm-group">
            <h4>System Settings</h4>
            <label class="toggle-row">
                <span>Access Settings</span>
                <input type="checkbox" checked>
            </label>
        </div>

    </div>

</section>

</main>

</div>

</body>
</html>