// app.js
//linked with index.php
document.addEventListener("DOMContentLoaded", function () {
    const destinations = document.querySelectorAll(".destination");
    const noHotelsMessage = document.getElementById("no-hotels-message");
    const tripDetails = document.getElementById("trip-details");
    const selectedDestination = document.getElementById("selected-destination");
    const airlineTableBody = document.querySelector("#airline-table tbody");
    const hotelTableBody = document.querySelector("#hotel-table tbody");
    const estimatedBudget = document.getElementById("estimated-budget");
    const compareFlightsContainer = document.getElementById("compare-flights");
    const compareHotelsContainer = document.getElementById("compare-hotels");
    const usernameInput = document.getElementById("username");
    const filterButton = document.getElementById("apply-filters");
    const saveMessage = document.getElementById("save-message");
    const saveButton = document.getElementById("save-selection");
    
    let hotels = [];
    let flights = [];
    let selectedFlight = null;
    let selectedHotel = null;

    // Enable or disable selection buttons based on username input
    usernameInput.addEventListener("input", function () {
        const usernameFilled = usernameInput.value.trim().length > 0; //user must put username
        toggleSelectButtons(usernameFilled);
    });

    //button Select enabled only when user select flight and hotel
    function toggleSelectButtons(enabled) {
        document.querySelectorAll(".select-flight, .select-hotel").forEach(btn => {
            btn.disabled = !enabled;
            btn.classList.toggle("disabled", !enabled);
        });
    }

    //When Select button was clicked
    destinations.forEach(button => {
        button.addEventListener("click", () => {
            const destination = button.dataset.destination; //store destination selected
            selectedDestination.textContent = destination;
            tripDetails.style.display = "block";
            fetchData(destination);
        });
    });

    //Function to link data of flights and hotel from data.php
    function fetchData(destination) {
        fetch(`data.php?destination=${encodeURIComponent(destination)}`) //linked with data.php
            .then(response => response.json())
            .then(data => {
                flights = data.flights;
                hotels = data.hotels;
                displayFlights(flights);
                displayHotels(hotels);
                estimatedBudget.textContent = "Select a flight and hotel to estimate budget.";
                selectedFlight = null;
                selectedHotel = null;
                toggleSelectButtons(usernameInput.value.trim().length > 0);
            });
    }

    //function to display flights data from data.php
    function displayFlights(flights) {
        airlineTableBody.innerHTML = "";
        compareFlightsContainer.innerHTML = "";

        //loops through flights array from fetchData()
        flights.forEach((flight, index) => {
            const row = document.createElement("tr"); //Create a table
            row.innerHTML = `
                <td>${flight.airline}</td>
                <td>$${flight.price}</td>
                <td>${flight.duration}</td>
                <td><button class="select-flight" onclick="selectFlight(${index})" disabled>Select
                </button></td>
            `; //button that calls back selectFlight(index) when clicked
            airlineTableBody.appendChild(row);
        });
    }

    //function to display hotel data
    function displayHotels(hotels) {
        hotelTableBody.innerHTML = "";
        compareHotelsContainer.innerHTML = "";

        if (hotels.length === 0) { //if no hotels matched
            noHotelsMessage.style.display = "block";
            return;
        } else {
            noHotelsMessage.style.display = "none";
        }

        hotels.forEach((hotel, index) => {
            const row = document.createElement("tr"); //table for hotel data
            row.innerHTML = `
                <td>${hotel.name}</td>
                <td>${hotel.rating} stars</td>
                <td>$${hotel.price}</td>
                <td>${hotel.attractions.join(", ")}</td>
                <td><button class="select-hotel" onclick="selectHotel(${index})" disabled>Select</button></td>
            `;
            hotelTableBody.appendChild(row);
        });
    }

    //When user select flight, update the budget calculation
    window.selectFlight = function (index) {
        selectedFlight = flights[index];
        updateCompareSection();
        updateBudget();
    };

    window.selectHotel = function (index) {
        selectedHotel = hotels[index];
        updateCompareSection();
        updateBudget();
    };

    //Function to update compare section
    //After user select options
    function updateCompareSection() {
        const compareSection = document.getElementById("compare-section");
        
        //Only clear when user not choose both flights and hotels
        compareSection.style.display = (selectedFlight || selectedHotel) ? "block" : "none";

        //After select flight, comparison part shows it
        if (selectedFlight) {
        compareFlightsContainer.innerHTML = "";
        const flightCard = document.createElement("div");
        flightCard.className = "compare-card";
        flightCard.innerHTML = `
            <strong>${selectedFlight.airline}</strong><br>
            Price: $${selectedFlight.price}<br>
            Duration: ${selectedFlight.duration}<br><br>
        `;
        compareFlightsContainer.appendChild(flightCard);
    }

        //After select hotel, comparison part shows it
        if (selectedHotel) {
        compareHotelsContainer.innerHTML = "";
        const hotelCard = document.createElement("div");
        hotelCard.className = "compare-card";
        hotelCard.innerHTML = `
            <strong>${selectedHotel.name}</strong><br>
            Rating: ${selectedHotel.rating}★<br>
            Price: $${selectedHotel.price}<br>
            Attractions: ${selectedHotel.attractions.join(", ")}<br><br>
        `;
        compareHotelsContainer.appendChild(hotelCard);
    }
}
    //function to update the calculation of budget after choose flight and hotel
    function updateBudget() {
        if (selectedFlight && selectedHotel) {
            const total = selectedFlight.price + selectedHotel.price;
            estimatedBudget.textContent = `Estimated Total: $${total}`;
        }
    }

    //Function to post data selected that is linked to save_selection.php
    function saveSelection(username, destination, airline, flightPrice, hotel, hotelPrice) {
        fetch('save_selection.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: new URLSearchParams({
                username,
                destination,
                airline,
                flight_price: flightPrice,
                hotel,
                hotel_price: hotelPrice
            })
        })
        .then(response => response.text())
        .then(data => { //if no error and saved sucessfully
            console.log("Server Response:", data);
            saveMessage.textContent = "Your options are successfully saved!";
            saveMessage.style.color = "green";
        })
        .catch(err => { //if there are errors
            console.error("Save failed:", err);
            saveMessage.textContent = "Failed to save selection.";
            saveMessage.style.color = "red";
        ;
            saveSelection( //Data that are saved
                username,
                selectedDestination.textContent,
                selectedFlight.airline,
                selectedFlight.price,
                selectedHotel.name,
                selectedHotel.price
            );
        });
    }

    //filter for hotel
    window.filterHotels = function () {
        const minBudget = parseFloat(document.getElementById("filter-budget-min").value);
        const maxBudget = parseFloat(document.getElementById("filter-budget-max").value);
        const star = document.getElementById("filter-star").value;
        const room = document.getElementById("filter-room").value;

        let filtered = hotels;

        //Let user can input a range of min and max value
        if (!isNaN(minBudget)) {
            filtered = filtered.filter(hotel => hotel.price >= minBudget);
        }

        if (!isNaN(maxBudget)) {
            filtered = filtered.filter(hotel => hotel.price <= maxBudget);
        }

        if (star) {
            filtered = filtered.filter(hotel => hotel.rating == star);
        }

        if (room) {
            filtered = filtered.filter(hotel => hotel.room_type === room);
        }

        displayHotels(filtered); //Display hotel data based on user filter input
        toggleSelectButtons(usernameInput.value.trim().length > 0); //Make sure user has input username
    };

    //After click on filter button,apply filter
    if (filterButton) {
        filterButton.addEventListener("click", () => filterHotels());
    }

    //After click on save selection button
    if (saveButton) {
    saveButton.addEventListener("click", function () {
        const username = usernameInput.value.trim();

        if (!username || !selectedFlight || !selectedHotel) { //If only choose one or choose nothing
            saveMessage.textContent = "Please enter your username and select both a flight and hotel before saving.";
            saveMessage.style.color = "red";
            return;
        }

        saveSelection( //call back function to save data choosen
            username,
            selectedDestination.textContent,
            selectedFlight.airline,
            selectedFlight.price,
            selectedHotel.name,
            selectedHotel.price
        );
    });
}
});

