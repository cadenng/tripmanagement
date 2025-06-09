<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trip Management System</title>
    <!--Linked with style.css-->
    <link rel="stylesheet" href="style.css">
    <style>
        button.disabled {
            background-color: #ccc; 
            cursor: not-allowed;
        }
    </style>
</head>
<body>

  <!--Header For Webpage-->
    <header>
        <h1>Choose Your Destination</h1>
    </header>

    <!--Create element for username input-->
    <section id="user-info">
        <input type="text" id="username" placeholder="Enter your name">
        <!--If username is empty-->
        <p id="username-warning" style="color:red; display:none;">Please enter your name to proceed.</p>
    </section>

    <!--Create id for destinations-->
    <div id="destination-selection">
        <div class="destination-container">
        <button class="destination" data-destination="China">China</button>
        <button class="destination" data-destination="Malaysia">Malaysia</button>
        <button class="destination" data-destination="England">England</button>
        <button class="destination" data-destination="America">America</button>
        </div>
    </div>

    <!--Id for trip details when destination is selected-->
    <section id="trip-details" style="display:none;">
        <h2>Trip Details for <span id="selected-destination"></span></h2>

        <!--Id for hotel filter-->
        <div id="filters">
            <h3>Hotel Filters</h3>
            <!--Id for filter to keep min and max range-->
            <label>Min Budget: <input type="number" id="filter-budget-min"></label>
            <label>Max Budget: <input type="number" id="filter-budget-max"></label>
            <label>Star Rating:
                <!--Id for star rating filter options-->
                <select id="filter-star">
                    <option value="">Any</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
            </label>
            <label>Room Type:
                <!--Id for room filter options-->
                <select id="filter-room">
                    <option value="">Any</option>
                    <option value="Single">Single</option>
                    <option value="Double">Double</option>
                    <option value="Suite">Suite</option>
                </select>
            </label>
            <!--Button id for Apply Filters-->
            <button id="apply-filters">Apply Filters</button>

        <!--Create airline table-->
        <div class="tables">
            <h3>Flights</h3>
            <table id="airline-table">
                <thead>
                    <tr>
                        <th>Airline</th>
                        <th>Price</th>
                        <th>Duration</th>
                        <th>Select</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>

            <!--Create Hotel table-->
            <h3>Hotels</h3>
            <table id="hotel-table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Rating</th>
                        <th>Price</th>
                        <th>Attractions</th>
                        <th>Select</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
            <!--If filter dont get matched hotel-->
            <p id="no-hotels-message" style="display: none; color: red;">No Hotels Matched.</p>
        </div>

        <!--Id for budget estimating-->
        <h3 id="estimated-budget">Select a flight and hotel to estimate budget.</h3>
        <p id="save-message"></p>

        <!--If for compare selection after user choose both flight and hotel-->
        <div id="compare-section" style="display: none;">
            <h3>Your Selections</h3>
            <!--Show user comparison for selection of both flight and hotel-->
            <div id="compare-flights"></div>
            <div id="compare-hotels"></div>
        </div>

        <!--Button for save selection-->
        <button id="save-selection">Save Selection</button>
    </section>
</div>

    <!--Button of Admin Panel to link with admin.php-->
    <button onclick="window.location.href='admin.php'">Admin Panel</button>
<!--Contact Us-->
<div class="ContactUs" style="display: flex; justify-content: center; margin: 20px;">
    <div class="ContactUsMenu" style="text-align: center;">
        <h1 class="ContactUsTitle">Contact Info</h1>
        <ul class="fList" style="list-style: none; padding: 0;">
            <li class="fListItem">📞 123-456-7890</li>
            <li class="fListItem">
                📧 <a href="mailto:HELLO@TRAVELMGMTSYS.COM">HELLO@TRAVELMGMTSYS.COM</a>
            </li>
            <li class="fListItem">📍 123 Anywhere St., Any City</li>
        </ul>
        <button onclick="window.location.href='mailto:HELLO@TRAVELMGMTSYS.COM'" 
                style="margin-top: 10px; padding: 10px 20px; background-color: #007BFF; color: white; border: none; border-radius: 5px; cursor: pointer;">
            Email Us
        </button>
    </div>
</div>





    <!--Check if user has input username or not-->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const usernameInput = document.getElementById('username');
            const warning = document.getElementById('username-warning');

            //If user input username, status changed to become filled in
            usernameInput.addEventListener('input', function () {
                const filled = usernameInput.value.trim().length > 0;
                toggleSelectButtons(filled);
                //If no input username, output warning for username
                warning.style.display = filled ? 'none' : 'block';
            });

            //Select Button
            //If both flights and hotel are chosen, enable save selection button
            function toggleSelectButtons(enabled) {
                document.querySelectorAll(".select-flight, .select-hotel").forEach(btn => {
                    //If not, disable save selection button
                    btn.disabled = !enabled;
                    btn.classList.toggle("disabled", !enabled);
                });
            }
        });
    </script>
    <!--Link with app.js-->
    <script src="app.js"></script> 
</body>
</html>
