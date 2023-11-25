<?php
    session_start();
    include "connection.php";

    $item_id = $_GET["item_id"];
    $item_details = getItem($item_id);
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
        <?php
            if(isset($_POST["btn_delete"])) {
                //INPUT
                $item_id = $_POST["item_id"];

                //PROCESS
                deleteItem($item_id);
            }
        ?>
        <div class="card mt-5 w-50 mx-auto">
            <div class="card-header bg-dark text-white text-center">
                <h1>Delete Item</h1>
            </div>
            <div class="card-body mx-auto">
                <p><i class="fa-solid fa-triangle-exclamation text-danger"></i>Are you sure you want to delete item <strong><?= $item_details['item_name'] ?></strong>?</p>
                <form action="" method="post">
                    <a href="view-items.php" class="btn btn-secondary">Cancel</a>
                    <input type="hidden" name="item_id" value="<?= $item_details["id"] ?>">
                    <input type="submit" value="Delete" name='btn_delete' class="btn btn-danger">
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>
</html>

<?php
    function getItem($item_id) {
        $conn = dbConnect();
        $sql = "SELECT * FROM items WHERE id = $item_id";

        return $conn->query($sql)->fetch_assoc();
    }

    function deleteItem($item_id) {
        $conn = dbConnect();

        $sql = "DELETE FROM items WHERE id = $item_id";

        // check if the sql statement runs successfully
        if($conn->query($sql)) {
            header("Location: view-items.php"); //redirect to product page
        }
        else {
            //display an error message
            echo "<div class='alert alert-danger w-50 mx-auto mb-3 text-center'>Failed to insert data. Kindly try again. <br><small>".$conn->error."</small></div>";
        }
    }
?>