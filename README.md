# ✈️ Trip Management System

A simple web-based trip planning and management system that allows users to select flights and hotels for various destinations, estimate budgets, and save their selections. An admin panel is also available to view and manage user submissions.

---

## 📁 Project Structure
* index.php # Homepage – destination and selection interface
* app.js # Frontend JavaScript – handles user interaction 
* data.php # Backend – fetches flight and hotel data
* save_selection.php # Backend – saves user selection to database
* admin.php # Admin dashboard – displays saved user data
* admin.css # Styling for admin panel
* trip_db.sql # Database schema (if applicable)
* README.md # This file


---

## 🚀 Features

### 🌍 User Side (index.php)
- Choose a destination to view available **flights** and **hotels**
- Filter hotels by:
  - Budget range
  - Star rating
  - Room type
- Select a flight and a hotel to view:
  - A **side-by-side comparison**
  - A **Estimated total budget**
- Enter a **username** to enable the selection
- Save your trip to the database

### 🛠 Admin Side (admin.php)
- View up to 40 most recent trip selections
- Display includes:
  - Username
  - Destination
  - Airline & Hotel details
  - Flight & Hotel price
  - Timestamp
- Dark mode toggle theme
- "Home" button fixed in the top-left for quick return to user screen

---

## 🗃 Database Management

Make sure to create a MySQL database named `trip_db` with the following table:

```sql
CREATE TABLE user_selection (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100),
    destination VARCHAR(100),
    airline VARCHAR(100),
    flight_price DECIMAL(10,2),
    hotel VARCHAR(100),
    hotel_price DECIMAL(10,2),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

# ⚙️ Setup Instructions
1. Clone or download the project files into your local server directory (e.g., htdocs/ for XAMPP)

2. Create the MySQL database: trip_db 

3. Import or create the user_selection table as shown above

4. Save images in img/destination file

5. Start your local server and visit:

6. localhost/travel_Management_System/index.php for user page

7. localhost/travel_Management_System/admin.php for admin panel

8. Make sure to enable JavaScript and allow pop-ups for best results

