<?php
    include "connection.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <title>Company-xyz</title>
</head>
<body>
    <?php include "navbar.php" ?>
    <div class="container">
        <table class="table text-center mt-3">
            <div class="text-end mt-5">
                <a href="add-item.php" class="btn btn-dark">Add Product</a>
            </div>
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Item Name</th>
                    <th>Item Price</th>
                    <th>Quantity</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <!-- display the products from the database -->
                    <?php
                        $items = getAllItem();

                        if($items && $items->num_rows > 0) {
                            while($row = $items->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>".$row["id"]."</td>";
                                echo "<td>".$row["item_name"]."</td>";
                                echo "<td>".$row["item_price"]."</td>";
                                echo "<td>".$row["quantity"]."</td>";
                                echo "<td><a class='btn btn-outline-warning btn-sm' href='edit-item.php?item_id=".$row["id"]."'><i class='fas fa-edit'></i></a></td>";
                                echo "<td><a class='btn btn-outline-danger btn-sm' href='delete-item.php?item_id=".$row["id"]."'><i class='fas fa-trash'></i></a></td>";
                                echo "</tr>";
                            }
                        }
                        else {
                            echo "<tr><td colspan='6' class='fst-italic text-muted text-center'>No records to display.</td></tr>";
                        }
                    ?>
                </tr>
            </tbody>
        </table>
    </div>
</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</html>
<?php
    function getAllItem() {
        $conn = dbConnect();
        $sql = "SELECT id, item_name, item_price, quantity FROM items";
        $result = $conn->query($sql);

        return $result;
    }
?>