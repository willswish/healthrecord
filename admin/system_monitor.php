<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>System Monitor - MHR System</title>
<link rel="stylesheet" href="dashboard.css">
<link rel="stylesheet" href="system_monitor.css">
</head>

<body>

<div class="dashboard">

<?php include 'sidebar.php'; ?>

<!-- MAIN CONTENT -->
<main class="main">

<header class="topbar">
<h1>System Monitor</h1>

<div class="admin">
<img src="https://i.pravatar.cc/40">
<span>Administrator</span>
</div>
</header>

<section class="monitor-container">
    
    <!-- Real-time Metrics -->
    <div class="monitor-grid">
        <div class="metric-card">
            <div class="metric-header">
                <span>CPU Usage</span>
                <span>8 cores</span>
            </div>
            <div class="metric-value">24%</div>
            <div class="progress-track">
                <div class="progress-fill fill-green" style="width: 24%"></div>
            </div>
        </div>

        <div class="metric-card">
            <div class="metric-header">
                <span>Memory (RAM)</span>
                <span>16GB Total</span>
            </div>
            <div class="metric-value">6.2 GB</div>
            <div class="progress-track">
                <div class="progress-fill fill-orange" style="width: 42%"></div>
            </div>
        </div>

        <div class="metric-card">
            <div class="metric-header">
                <span>Disk Space</span>
                <span>SSD /var</span>
            </div>
            <div class="metric-value">78%</div>
            <div class="progress-track">
                <div class="progress-fill fill-red" style="width: 78%"></div>
            </div>
        </div>

        <div class="metric-card">
            <div class="metric-header">
                <span>Network I/O</span>
                <span>eth0</span>
            </div>
            <div class="metric-value">45 Mbps</div>
            <!-- Simple visualization for activity -->
            <div style="display: flex; gap: 2px; align-items: flex-end; height: 8px; margin-top:5px;">
                <div style="width: 20%; background: #4a90e2; height: 40%"></div>
                <div style="width: 20%; background: #4a90e2; height: 70%"></div>
                <div style="width: 20%; background: #4a90e2; height: 30%"></div>
                <div style="width: 20%; background: #4a90e2; height: 90%"></div>
                <div style="width: 20%; background: #4a90e2; height: 50%"></div>
            </div>
        </div>
    </div>

    <div class="server-details">
        
        <!-- System Logs -->
        <div class="log-panel">
            <div class="log-header">
                <h3 style="font-size: 1.1rem; color:#333; margin:0;">System Event Logs</h3>
                <button style="padding: 5px 10px; border:1px solid #ddd; background:#fff; cursor:pointer; border-radius:4px;">Clear Logs</button>
            </div>
            <div class="log-console">
                <div class="log-line info"><span class="log-time">[10:42:01]</span> System backup completed successfully.</div>
                <div class="log-line info"><span class="log-time">[10:45:12]</span> User #1005 logged in from 192.168.1.45.</div>
                <div class="log-line warn"><span class="log-time">[10:50:05]</span> High memory usage detected on worker process #3.</div>
                <div class="log-line info"><span class="log-time">[11:01:22]</span> Database cache refreshed.</div>
                <div class="log-line error"><span class="log-time">[11:15:00]</span> Failed to connect to external SMTP server (timeout).</div>
                <div class="log-line info"><span class="log-time">[11:20:10]</span> Cron job 'generate_reports' executed.</div>
                <div class="log-line info"><span class="log-time">[11:22:45]</span> New medical record added by Dr. Santos.</div>
                <div class="log-line info"><span class="log-time">[11:30:00]</span> System health check: OK.</div>
            </div>
        </div>

        <!-- Server Info -->
        <div class="info-panel">
            <h3 style="margin-bottom:15px; color:#333; font-size: 1.1rem; margin-top:0;">Server Information</h3>
            <ul class="info-list">
                <li><span>Hostname</span> <span>mhr-admin-srv01</span></li>
                <li><span>OS</span> <span>Ubuntu 22.04 LTS</span></li>
                <li><span>PHP Version</span> <span>8.2.14</span></li>
                <li><span>Database</span> <span>MySQL 8.0</span></li>
                <li><span>Web Server</span> <span>Apache/2.4.52</span></li>
                <li><span>Uptime</span> <span>14d 03h 22m</span></li>
                <li><span>Last Reboot</span> <span>Oct 10, 2023</span></li>
            </ul>
        </div>

    </div>

</section>

</main>

</div>

</body>
</html>