<?php
    include "connection.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

    <title>Company-xyz</title>
</head>
<body>
    <?php include"navbar.php" ?>
    <div class="container">
        <?php
            if(isset($_POST["btn_additem"])) {
                //INPUT
                $item_name = $_POST["item_name"];
                $item_price = $_POST["item_price"];
                $quantity = $_POST["quantity"];

                //PROCESS
                addItem($item_name, $item_price, $quantity);
            }
        ?>
        <div class="card mx-auto w-50 border-black mt-5">
            <div class="card-header bg-dark text-white text-center">
                <h1>Add Item</h1>
            </div>
            <div class="card-body">
                <form action="" method="post" class="form">
                    <!-- Input item name -->
                    <label for="item_name" class="form-label">Item Name</label>
                    <input type="text" name="item_name" class="form-control" max="50" required>
                    <!-- Input item price -->
                    <label for="item_price" class="form-label">Item Price</label>
                    <input type="number" name="item_price" class='form-control' min="1" required>
                    <!-- Input quantity -->
                    <label for="quantity" class="form-label">Quantity</label>
                    <input type="number" name="quantity" class='form-control' min="1" required>
            </div>
            <div class="card-footer mx-auto">
                    <input type="submit" name="btn_additem" value="Add" class="btn btn-dark">
                </form>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>
</html>

<?php
    function addItem($item_name, $item_price, $quantity) {
        $conn = dbConnect();
        $sql = "INSERT INTO items (item_name, item_price, quantity) VALUES ('$item_name', '$item_price', '$quantity')";
        $result = $conn->query($sql);

        //check if the sql statement runs successfully
        if($result) {
            header("Location: view-items.php");
        }
        else {
            //display an error message
            echo "<div class='alert alert-danger w-50 mx-auto mb-3 text-center'>Failed to insert data. Kindly try again. <br><small>".$conn->error."</small></div>";
        }
    }
?>