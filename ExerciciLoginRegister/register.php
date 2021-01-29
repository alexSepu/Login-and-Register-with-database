<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once 'lib/connexiopersistent.php';
    require_once 'lib/session.php';
    if ($_POST["password"] === $_POST["verifyPassword"]) {
        $select1 = verifyEmail($_POST["email"], $db);
        if ($select1->rowCount() != 0) echo '<script type="text/javascript"> alert("There is a user with the same email"); </script>';
        else {
            $select = verifyUsername($_POST["username"], $db);
            if ($select->rowCount() != 0) echo '<script type="text/javascript"> alert("There is a user with this username"); </script>';
            else {
                date_default_timezone_set('UTC');
                $sql = "INSERT INTO users (mail,username,passHash,userFirstName,userLastName,creationDate,active) VALUES (?,?,?,?,?,?,?)";
                $insert = $db->prepare($sql);
                $insert->execute(array($_POST["email"], $_POST["username"], password_hash($_POST["password"], PASSWORD_DEFAULT), $_POST["firstName"], $_POST["lastName"], date("Y/m/d H:i:s"), 1));
                header("Location:index.php");
                } 
            }
        }else echo '<script type="text/javascript"> alert("Error"); </script>';
    }
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login Imaginest</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="css/loginRegister.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body id="body">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4 col-sm-2 col-1">
            </div>
            <div class="col-md-4 col-sm-8 col-10 text-center" id="log">
                <div class="row">
                    <div class="col-12 mb-2">
                        <img style="width:50%" src="img/logo3.png" />
                    </div>
                    <div class="col-1"></div>
                    <div class="col-10 text-center" id="regist">
                        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" onsubmit="return controlPassword()">
                            <div class="loginRegister">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="username" id="username" aria-describedby="emailHelp" placeholder="Username" required>
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control" name="email" id="email" placeholder="Email" required>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="firstName" id="firstName" placeholder="First Name">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="lastName" id="lastName2" placeholder="Last Name">
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" name="verifyPassword" id="verifyPassword" placeholder="Verify Password" required>
                                    <p class="error"></p>
                                </div>
                            </div>
                            <input type="submit" value="Sign up" class="btn btn-primary col-12 reg"/>
                        </form>
                    </div>
                    <div class="col-1"></div>
                </div>
            </div>
            <div class="col-md-4 col-sm-2 col-1"></div>
        </div>
    </div>
</body>
<script>
    $(document).ready(function(){
        $("#exampleModalCenter").modal('show');
    });
    function on(){
        window.location.replace('index.php');
    }
</script>
<script src="js/comprobarContrasenya.js"></script>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</html>