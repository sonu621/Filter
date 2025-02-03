<?php
require("connection.php");
?>

<?php include('_header.php'); ?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card mt-5">
                <div class="card-header">
                    <h4>Filter or Find or Get data (record) between two dates</h4>
                </div>
                <div class="card-body">
                    <form action="" method="GET">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="fdate">From Date</label>
                                    <input type="date" name="from_date" class="form-control" value="<?php if (isset($_GET['from_date'])) {
                                        echo $_GET['from_date'];
                                    } ?>">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="tdate">To Date</label>
                                    <input type="date" name="to_date" class="form-control" value="<?php if (isset($_GET['to_date'])) {
                                        echo $_GET['to_date'];
                                    } ?>">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="filter">Click to Filter</label><br>
                                    <button type="submit" class="btn btn-primary">Filter</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card mt-4">
                <div class="card-body">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Issued Id</th>
                                <th>Member Id</th>
                                <th>Book Name</th>
                                <th>Date</th>
                                <th>Book Isbn</th>
                                <th>Employee Id</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (isset($_GET['from_date']) && isset($_GET['to_date'])) {
                                $from_date = $_GET['from_date'];
                                $to_date = $_GET['to_date'];
                                $query = "SELECT * FROM `issued_status` WHERE issued_date BETWEEN '$from_date' AND '$to_date'";
                                $query_run = mysqli_query($conn, $query);
                                if (mysqli_num_rows($query_run) > 0) {
                                    foreach ($query_run as $row) {
                                        echo "<tr>
                                            <td>" . $row['issued_id'] . "</td>
                                            <td>" . $row['issued_member_id'] . "</td>
                                            <td>" . $row['issued_book_name'] . "</td>
                                            <td>" . $row['issued_date'] . "</td>
                                            <td>" . $row['issued_book_isbn'] . "</td>
                                            <td>" . $row['issued_emp_id'] . "</td>
                                          </tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='6'>No Records Found</td></tr>";
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card mt-3">
                <div class="card-header">
                    <h4>Find the data using Search and Multiple Checkbox</h4>
                </div>
            </div>
        </div>
        <!-- Categories List -->
        <div class="col-md-3">
            <form action="" method="GET">
                <div class="card shadow mt-3">
                    <div class="card-header">
                        <h5>Filter
                            <button type="submit" class="btn btn-primary btn-sm float-end">Search</button>
                        </h5>
                    </div>
                    <div class="card-body">
                        <h6>
                            Category List
                        </h6>
                        <hr>
                        <?php
                        $category_query = "SELECT DISTINCT `category` FROM `books`";
                        $category_result = mysqli_query($conn, $category_query);

                        if (mysqli_num_rows($category_result) > 0) {
                            // Check if categories are selected in the GET request
                            $checked = isset($_GET['category']) ? $_GET['category'] : [];

                            // Loop through the query result
                            while ($row = mysqli_fetch_assoc($category_result)) {
                                ?>
                                <div>
                                    <input type="checkbox" name="category[]" value="<?php echo $row['category']; ?>" <?php
                                       // Check if the category is in the selected categories array
                                       if (in_array($row['category'], $checked)) {
                                           echo 'checked'; // Add the 'checked' attribute if the category is selected
                                       }
                                       ?> />
                                    <?php echo $row['category']; ?>
                                </div>
                                <?php
                            }
                        } else {
                            echo "No Categories Found!";
                        }
                        ?>


                    </div>
                </div>
            </form>
        </div>

        <!-- Categories Items  -->
        <div class="col-md-9 mt-3">
            <div class="card">
                <div class="card-body row">
                    <?php
                    // Assuming $_GET['category'] is an array, sanitize the array values
                    if (isset($_GET['category']) && is_array($_GET['category'])) {
                        // Sanitize the array of selected categories
                        $categories = array_map(function ($category) use ($conn) {
                            return "'" . mysqli_real_escape_string($conn, $category) . "'";
                        }, $_GET['category']);  // Apply sanitization to each category
                    
                        // Join the sanitized categories into a string for the SQL query
                        $categories_string = implode(",", $categories);

                        // Query to get books from the selected categories
                        $author_query = "SELECT * FROM `books` WHERE `category` IN ($categories_string)";
                        $author_run = mysqli_query($conn, $author_query);

                        // Check if there are any books in the selected categories
                        if (mysqli_num_rows($author_run) > 0) {
                            while ($row = mysqli_fetch_assoc($author_run)) {
                                echo "<div class='col-md-4 mt-3'>";
                                echo "<div class='border p-2'>";
                                echo "<h6>" . $row['author'] . "</h6>";
                                echo "</div></div>";
                            }
                        } else {
                            echo "No Author Names Found!";
                        }
                    } else {
                        // If no categories selected, show all books
                        $author_query = "SELECT * FROM `books`";
                        $author_run = mysqli_query($conn, $author_query);

                        if (mysqli_num_rows($author_run) > 0) {
                            while ($row = mysqli_fetch_assoc($author_run)) {
                                echo "<div class='col-md-4 mt-3'>";
                                echo "<div class='border p-2'>";
                                echo "<h6>" . $row['author'] . "</h6>";
                                echo "</div></div>";
                            }
                        } else {
                            echo "No Author Names Found!";
                        }
                    }
                    ?>

                </div>
            </div>
        </div>
    </div>
</div>
</div>

<?php include('_footer.php'); ?>