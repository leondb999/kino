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


    <?php include ('./database_config.php') ?>

    <?php

        $name = $_POST['name_entered'] ?? "";
        $submitbutton= $_POST['submitbutton'] ??"";

        if ($submitbutton){
            if (!empty($name)) {
                echo '<br> The name you entered is ' . $name;
            }
            else {
                echo 'You did not enter a name. Please enter a name into this form field.';
            }
        }
?>
        <?php
            $op = $_POST['op'];
            $Firstname = $_POST['Firstname'] ?? "";


            if ($op == "safe"){
                echo "<br> Button submitted";
            }
        ?>



<form action="" method="POST">
    <label>Enter Your Name Please:</label>
    <input type="text"name="name_entered"/>

    <input type="submit" name="submitbutton" value="Submit"/>
</form>

<!-- Copied form-->
<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">

    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="op" value="Save data" />
    </div>
    <input type="hidden" name="op" value="save" />
</form>



    </body>
</html>
