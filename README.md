# Drive & Loc - Car Rental Management System

## Project Overview
**Drive & Loc** is a car rental agency seeking to enhance its website with a **Car Rental Management System**. The primary goal is to deliver a creative and functional platform for customers to browse and book vehicles based on their preferences. This system is built using **PHP OOP (Object-Oriented Programming)** and **SQL**.

---

## Features

### Customer Features
- **Login and Access**: Customers must log in to access the rental platform.
- **Explore Vehicles**: Browse through various categories of available vehicles.
- **Vehicle Details**: View detailed information about vehicles, including model, price, and availability.
- **Booking System**: Reserve vehicles by specifying pick-up dates and locations.
- **Search Functionality**: Search for vehicles by model or characteristics.
- **Filtering Options**: Filter available vehicles by category without refreshing the page.
- **Reviews and Ratings**: Add, edit, or delete reviews and ratings for rented vehicles (Soft Delete supported).
- **Pagination**: View vehicle listings through pagination.
  - **Version 1**: Basic pagination using PHP.
  - **Version 2**: Interactive pagination with DataTable.

### Administrator Features
- **Mass Insert**: Add multiple vehicles or categories simultaneously.
- **Dashboard Management**: Manage reservations, vehicles, reviews, and categories with statistical insights.

### Extra Features
- **SQL View**: Predefined SQL view combining vehicle details, ratings, and availability.
- **Stored Procedure**: "AddReservation" stored procedure for simplified reservation handling.

---

## Bonus Features
- **Email Notifications**: Approve or decline bookings with email updates sent to customers.
- **Additional Booking Options**: Include extras such as GPS, child seats, etc., when making reservations.
- **Review Reactions**: Customers can like or dislike reviews.
- **Favorite Vehicles**: Mark vehicles as favorites for future bookings.
- **Usage Statistics**: Access reports on the most reserved and top-rated vehicles.
- **Database Validation**: Enforce field validations at the database level using SQL Triggers.
- **Customer Management**: Dedicated admin page for managing customer details.
