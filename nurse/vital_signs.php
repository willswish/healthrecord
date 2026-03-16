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

    <div class="vitals-controls">
        <div class="search-box">
            <input type="text" placeholder="Search by student ID, date, or abnormal vitals...">
        </div>
        <button class="btn-add-record">
            <span>+ New Vital Signs Record</span>
        </button>
    </div>

    <div class="table-responsive">
        <table class="vitals-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Student ID</th>
                    <th>Date</th>
                    <th>BP</th>
                    <th>Temperature (°F)</th>
                    <th>Pulse (bpm)</th>
                    <th>Respiration (rpm)</th>
                    <th>Weight (kg)</th>
                    <th>Height (cm)</th>
                    <th>BMI</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>2021-00123</td>
                    <td>2023-10-24</td>
                    <td>120/80</td>
                    <td>98.6</td>
                    <td>72</td>
                    <td>16</td>
                    <td>65.2</td>
                    <td>170</td>
                    <td>22.6</td>
                    <td>Normal</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>2022-00456</td>
                    <td>2023-10-23</td>
                    <td>140/90</td>
                    <td>100.4</td>
                    <td>88</td>
                    <td>20</td>
                    <td>78.5</td>
                    <td>165</td>
                    <td>28.8</td>
                    <td>Monitor</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>2020-00789</td>
                    <td>2023-10-22</td>
                    <td>110/70</td>
                    <td>98.2</td>
                    <td>68</td>
                    <td>14</td>
                    <td>55.0</td>
                    <td>162</td>
                    <td>21.0</td>
                    <td>Normal</td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>2023-01234</td>
                    <td>2023-10-21</td>
                    <td>130/85</td>
                    <td>99.1</td>
                    <td>76</td>
                    <td>18</td>
                    <td>70.1</td>
                    <td>175</td>
                    <td>22.9</td>
                    <td>Normal</td>
                </tr>
            </tbody>
        </table>
    </div>

</section>

</main>

</div>

</body>
</html>
