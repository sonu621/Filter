# Library Filter System

A simple web application to filter books by issue date and category.

## Features
- **Filter by Date**: Choose a date range to view issued books.
- **Category Filter**: Select categories to view books from specific categories.
- **Search**: View books and authors based on selected filters.

## Requirements
- **PHP**: For server-side scripting.
- **MySQL**: For database storage.
- **Apache/XAMPP**: For running PHP locally.

## Setup

### 1. Database Setup
Create a MySQL database called `libary_project2` and use the following SQL queries to create the necessary tables:

```sql
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
