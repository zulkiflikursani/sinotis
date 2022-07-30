<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">


    <!-- botstrap material -->
    <link href="bs/css/bootstrap.min.css" rel="stylesheet">
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css'>

    <title>Document</title>
    <style>
        body,
        html {
            height: 100%;
        }

        .bg {
            height: 100vh;
            background-image: url("img/bg-login.jpg");
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        .container {

            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            padding: 20px 25px;
            width: 500px;

            background-color: whitesmoke;
            box-shadow: 0 0 10px rgba(255, 255, 255, .3);
        }
    </style>
</head>

<body>
    <div class="bg">
        <div class="container">
            <div class="row col-12 ">
                <?php if(isset($error)){echo $error;}?>
                <h1>SINOTIS</h1>
                <form method="POST" action="<?php echo base_url("Main") ?>">
                    <label class='col-form-label col-md-12' >Email</label>
                    <input type="text" class='form-control col-md-12' name="email">
                    <label class='col-form-label col-md-12'>Password</label>
                    <input class='form-control col-md-12' type="password" name="password">
                    <div class='d-flex justify-content-center'>
                        <button class="mt-2 button btn btn-primary ">Log in</button>
                    </div>

                </form>
            </div>
        </div>
    </div>

</body>

<script src="jquery/dist/jquery-3.5.1.js"></script>
<script src="bs/js/bootstrap.min.js" integrity="" crossorigin="anonymous"></script>

</html>