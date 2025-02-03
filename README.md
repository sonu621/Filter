# Library Filter System
## A simple web app to filter books by issue date and category.

### Features:
Filter by Date: Choose a date range to view issued books.
Category Filter: Select categories to view books from specific categories.
Search: View books and authors based on selected filters.
Setup:
1. Database Setup
Create a MySQL database called libary_project2 with two tables:

sql
Copy
CREATE TABLE books (
    book_id INT AUTO_INCREMENT PRIMARY KEY,
    book_title VARCHAR(255),
    author VARCHAR(255),
    category VARCHAR(100),
    isbn VARCHAR(50)
);

CREATE TABLE issued_status (
    issued_id INT AUTO_INCREMENT PRIMARY KEY,
    issued_member_id INT,
    issued_book_name VARCHAR(255),
    issued_date DATE,
    issued_book_isbn VARCHAR(50),
    issued_emp_id INT
);
2. Database Connection
Update connection.php with your MySQL database credentials:

php
Copy
$host = "localhost";  // Your host
$username = "root";   // Your MySQL username
$password = "";       // Your MySQL password
$dbname = "libary_project2"; // Your database name
3. Running the App
Place your PHP files (index.php, connection.php, _header.php, _footer.php) in a folder.
Open the app in your browser at http://localhost/Filter/index.php.
Use the date filters and category checkboxes to search and view books.
Code Overview:
index.php: Filters books by issue date and category. Displays books and authors based on the filters.
connection.php: Connects to the MySQL database.
_header.php & _footer.php: Contains HTML layout for header and footer.
Troubleshooting:
"No Categories Found!": Add books with categories in the database.
Date Format Issue: Ensure the date is in YYYY-MM-DD format.

