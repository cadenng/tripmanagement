<?php
// admin.php

// Database connection
$host = 'localhost';
$dbname = 'trip_db';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("<p style='color:red;'>Database connection failed: " . htmlspecialchars($e->getMessage()) . "</p>");
}

// Only show data when button is clicked
$showData = isset($_POST['show_data']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="admin.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }
        .admin-container {
            max-width: 1000px;
            margin: auto;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
        }
        th {
            background: #f5f5f5;
        }
        .no-data {
            margin-top: 15px;
            color: #888;
        }
        button {
            padding: 10px 20px;
            font-size: 16px;
        }
    </style>
</head>
<body>
<div class="admin-container">
    <h1>Admin - User Selections</h1>
    <form method="post">
        <button type="submit" name="show_data">Show User Records</button>
    </form>

    <?php if ($showData): ?>
        <?php
        try {
            $stmt = $pdo->query("SELECT id, username, destination, airline, flight_price, hotel, hotel_price, created_at FROM user_selection ORDER BY id DESC LIMIT 50");
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (count($rows) === 0) {
                echo "<p class='no-data'>No user records found.</p>";
            } else {
                echo "<table>
                        <thead>
                            <tr>
                                <th>Username</th>
                                <th>Destination</th>
                                <th>Airline</th>
                                <th>Flight Price ($)</th>
                                <th>Hotel</th>
                                <th>Hotel Price ($)</th>
                                <th>Timestamp</th>
                            </tr>
                        </thead>
                        <tbody>";

                foreach ($rows as $row) {
                    $budget = floatval($row['flight_price']) + floatval($row['hotel_price']);
                    echo "<tr>
                            <td>" . htmlspecialchars($row['username']) . "</td>
                            <td>" . htmlspecialchars($row['destination']) . "</td>
                            <td>" . htmlspecialchars($row['airline']) . "</td>
                            <td>" . htmlspecialchars($row['flight_price']) . "</td>
                            <td>" . htmlspecialchars($row['hotel']) . "</td>
                            <td>" . htmlspecialchars($row['hotel_price']) . "</td>
                            <td>" . htmlspecialchars($row['created_at']) . "</td>
                          </tr>";
                }

                echo "</tbody></table>";
            }
        } catch (PDOException $e) {
            echo "<p style='color:red;'>Error fetching records: " . htmlspecialchars($e->getMessage()) . "</p>";
        }
        ?>
    <?php endif; ?>
</div>
</body>
</html>
