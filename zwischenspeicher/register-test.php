<!DOCTYPE HTML>

<html>

    <head>
        <title>Registration</title>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
        <!-- nicolas navbar-->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

        <link rel ="stylesheet"type="text/css" href="style.css">
    </head>

    <body> 
        <?php include ('./functions/database_config.php') ?>
        <?php
            $op = $_POST['op'] ?? "";
            $firstname = $_POST['Firstname']  ?? "";
            $email = $_POST['email']  ?? "";
            $phone = $_POST['phone']  ?? "";
            $pass = $_POST['pass1']  ?? "";

            if ($op=="save")
            {
                // echo "$name - $email - $phone - $pass";

                $sql = "Insert INTO kinoticketing.users (Firstname) VALUES ('$firstname')";
                mysqli_query($con,$sql);

                if (mysqli_error($con))  echo "ySQL Error: " . mysqli_error($con);
                else  {
                    ?>
                        <div class="container p-2">
                                    <div class="panel panel-primary">
                                        <div class="panel-heading">Success!</div>
                                        <div class="panel-body">Your registration was successful.</div>
                                    </div>
                        </div>
                    <?php
                    //echo "Success!";
                }
                //exit;
            }
        ?>
        <!--
    <header>
        <?php include('./functions/navbar.php') ?>
    </header> -->
        <main>
            <div class="container p-3">
                <div class="panel panel-default">
                <div class="panel-heading">Registration form</div>
                    <div class="panel-body">

                        <form method=POST action=register.php>

                            <div class="form-group">
                                <label>Firstname:</label>
                                <input type="text" class="form-control" name="Firstname" required/>
                            </div>
                            <div class="form-group">
                                <label>Confirm</label>
                                <input type="submit" class="btn btn-primary" value="Save data" />
                            </div>
                            <input type="hidden" name="op" value="save" />
                        </form>
                    </div>
                </div>
            </div>
            <div class="container p-2"></div>
        </main>
    </body>
</html>
