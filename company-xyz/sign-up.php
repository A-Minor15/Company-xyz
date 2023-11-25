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
    <div class="container">
        <?php
            if(isset($_POST["btn_signup"])) {
                //INPUT
                $username = $_POST["username"];
                $password = $_POST["password"];
                $confirm_password = $_POST["confirm_password"];

                //PROCESS
                if($password == $confirm_password) {
                    //insert the data to the database
                    addUser($username, $password);
                }
                else {
                    //display an error message
                    echo "<div class='alert alert-danger w-50 mx-auto mb-3 text-center'>Passwords do not much. Kindly try again.</div>";
                }
            }
         ?>
        <div class="card mx-auto w-50 border-black mt-5">
            <div class="card-header bg-dark text-white text-center">
                <h1>Sign up</h1>
            </div>
            <div class="card-main">
                <form action="" method="post" class="form">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" name="username" class="form-control" max="20" required>
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" class='form-control' max="255" required>
                    <label for="confirm_password" class="form-label">Comfirm Password</label>
                    <input type="password" name="confirm_password" class='form-control' max="255" required>

            </div>
            <div class="card-footer mx-auto">
                    <input type="submit" name="btn_signup" value="Sign up" class="btn btn-dark">
                </form>
            </div>
        </div>
    </div>
</body>
</html>

<?php
    function addUser($username, $password) {
        $conn = dbConnect();
        $encrypted_password = password_hash($password, PASSWORD_DEFAULT); //encrypt the password
        $sql = "INSERT INTO users(username, password) VALUES ('$username', '$encrypted_password')";
        $result = $conn->query($sql);

        //check if the sql statement runs successfully
        if($result) {
            header("Location: sign-in.php"); //redirect to login page
        }
        else {
            //display an error message
            echo "<div class='alert alert-danger w-50 mx-auto mb-3 text-center'>Failed to insert data. Kindly try again. <br><small>".$conn->error."</small></div>";
        }
    }
?>