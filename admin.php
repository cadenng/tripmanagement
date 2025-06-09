<?php
// admin.php

// Database connection
$host = 'localhost';
$dbname = 'trip_db';
$username = 'root';
$password = '';

try { //if error occur, jump to catch()
    //Create new database connection
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password); //data source name
    //throw exception if have error
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) { //If database connection is failed, catch the error
    die("<p style='color:red;'>Database connection failed: " . htmlspecialchars($e->getMessage()) . "</p>");
}

// Only show data when button is clicked
//post the data from id
$showData = isset($_POST['show_data']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
    <!--Linked with admin.css-->
    <link rel="stylesheet" href="admin.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }
    </style>

</head>
<body>

<!--Post data from id show_data to this id-->
<div class="admin-container">
    <h1>Admin - User Selections</h1>
    <form method="post">
        <button type="submit" name="show_data">Show User Records</button>
    </form>

    <?php if ($showData): ?> 
    <!--When value of showData is true-->
        <?php
        try { // retrieves specific columns from the user_selection table
            $stmt = $pdo->query("SELECT id, username, destination, airline, 
            flight_price, hotel, hotel_price, created_at FROM user_selection 
            ORDER BY id DESC LIMIT 40"); 
            //only show latest 40 entries
            //show the most recent records first

            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (count($rows) === 0) { //if no records were save into admin panel
                echo "<p class='no-data'>No user records found.</p>";
            } else { //if get records
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
                        //Create table and table header names

                //Loops through each row from the query results from user_selection
                foreach ($rows as $row) { 
                    //calculate budget
                    //floatval() ensures both values are treated as numbers
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
                } //protects from HTML injection/XSS attacks using htmlspecialchars()

                echo "</tbody></table>";
            }
        } catch (PDOException $e) { //catch if errors occur
            echo "<p style='color:red;'>Error fetching records: " . htmlspecialchars($e->getMessage()) . "</p>";
        }
        ?>
    <?php endif; ?>
</div>

    <!--Make a button to change theme to dark mode-->
    <button class="theme-toggle" onclick="document.body.classList.toggle('dark-mode')">
        Theme
    </button>

    <!-- Home button -->
    <button class="home-button" onclick="window.location.href='index.php'">
        Home
    </button>

    <script>
        //theme preference in local storage
        const toggle = document.querySelector('.theme-toggle');
        if (localStorage.getItem('theme') === 'dark') {
            document.body.classList.add('dark-mode');
        } //check if previously chosen "dark" mode.

        toggle.addEventListener('click', () => {
            const isDark = document.body.classList.toggle('dark-mode');
            //if is dark mode, isDark value is true
            localStorage.setItem('theme', isDark ? 'dark' : 'light');
        });
    </script>
    <script>

        document.addEventListener("DOMContentLoaded", function () {
        //Waits for the entire HTML document to finish loading before running the code inside.
        const toggleButton = document.querySelector(".theme-toggle");
        toggleButton.addEventListener("click", function () { //button clicked then change to dark mode
        document.body.classList.toggle("dark-mode");
        });
    });
  </script>
</body>
</html>
