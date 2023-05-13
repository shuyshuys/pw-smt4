<?php
include "auth.php";
$error_message = "";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Formulir Pendaftaran</title>
    <style>
    .bg-mine {
        background-color: #ae86ff;
    }

    a {
        text-decoration: none;
    }

    .login-page {
        width: 100%;
        height: 100vh;
        display: inline-block;
        display: flex;
        align-items: center;
    }

    .form-right i {
        font-size: 100px;
    }

    .warning {
        color: #FF0000;
    }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css">

</head>

<body>
    <div class="login-page bg-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    <div class="bg-white shadow rounded">
                        <div class="row">
                            <div class="col-md-7 pe-0">
                                <ul class="nav nav-tabs">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#login"
                                            id="login-tab">Login</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#register"
                                            id="register-tab">Register</a>
                                    </li>
                                </ul>
                                <div class="form-left h-100 py-5 px-5">
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="login">
                                            <h3 class="mb-3">Login Now</h3>

                                            <?php if (isset($error_message)) : ?>
                                            <div class="warning mt-2"><?php echo $error_message ?></div>
                                            <?php endif; ?>

                                            <form action="sigin.php" class="row g-4" method="POST">
                                                <div class="col-12">
                                                    <label>Username<span class="text-danger">*</span></label>
                                                    <div class="input-group">
                                                        <div class="input-group-text"><i class="bi bi-person-fill"></i>
                                                        </div>
                                                        <input type="text" class="form-control" name="username"
                                                            id="username" placeholder="Enter Username">
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <label>Password<span class="text-danger">*</span></label>
                                                    <div class="input-group">
                                                        <div class="input-group-text"><i class="bi bi-lock-fill"></i>
                                                        </div>
                                                        <input type="password" class="form-control" name="password"
                                                            id="username" placeholder="Enter Password">
                                                    </div>
                                                </div>

                                                <div class="col-sm-6">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            id="inlineFormCheck">
                                                        <label class="form-check-label" for="inlineFormCheck">Remember
                                                            me</label>
                                                    </div>
                                                </div>

                                                <div class="col-sm-6">
                                                    <a href="#" class="float-end text-primary">Forgot Password?</a>
                                                </div>

                                                <div class="col-12">
                                                    <!-- <div class="h-captcha col-6" data-sitekey="8fdfe029-4326-4074-b690-aebeda9c46a9"></div> -->
                                                    <button type="submit" name="submit-login" id="submit-login"
                                                        class="btn btn-primary px-4 float-end mt-4">login</button>
                                                    <!-- <button type="submit" class="btn btn-primary" id="submit" name="submit">Login</button> -->

                                                </div>
                                            </form>
                                        </div>
                                        <div class="tab-pane" id="register">
                                            <?php
                                            date_default_timezone_set('Asia/Jakarta');
                                            $id_register = date('dmyHis');
                                            ?>
                                            <h3 class="mb-3">Register Now</h3>

                                            <?php if (isset($error_message)) : ?>
                                            <div class="warning mt-2"><?php echo $error_message ?></div>
                                            <?php endif; ?>

                                            <div class="tab-pane active">
                                                <form action="signup.php" class="row g-4" method="POST">
                                                    <!-- id -->
                                                    <div class="col-12">
                                                        <label>ID Register<span class="text-danger">*</span></label>
                                                        <div class="input-group">
                                                            <div class="input-group-text"><i
                                                                    class="bi bi-card-list"></i>
                                                            </div>
                                                            <input type="text" class="form-control"
                                                                placeholder="Enter ID" name="id" id="id"
                                                                value="<?php echo $id_register; ?>" readonly>
                                                        </div>
                                                    </div>

                                                    <div class="col-12">
                                                        <label>Username<span class="text-danger">*</span></label>
                                                        <div class="input-group">
                                                            <div class="input-group-text"><i
                                                                    class="bi bi-person-fill"></i>
                                                            </div>
                                                            <input type="text" class="form-control" name="username"
                                                                id="username" placeholder="Enter Username">
                                                        </div>
                                                    </div>

                                                    <div class="col-12">
                                                        <label>Password<span class="text-danger">*</span></label>
                                                        <div class="input-group">
                                                            <div class="input-group-text"><i
                                                                    class="bi bi-lock-fill"></i>
                                                            </div>
                                                            <input type="password" class="form-control" name="password"
                                                                id="password" placeholder="Enter Password">
                                                        </div>
                                                    </div>

                                                    <div class="col-12">
                                                        <button type="submit" id="submit-register"
                                                            name="submit-register"
                                                            class="btn btn-primary px-4 float-end mt-4">Register</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5 ps-0 d-none d-md-block">
                                <div class="form-right h-100 bg-mine text-white text-center pt-5">
                                    <i class="bi bi-building"></i>
                                    <hr>
                                    <h2 class="fs-1" id="welcome"></h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<footer>
    <reserved-by></reserved-by>
</footer>

<script src="../js/default.js"></script>
<!-- <script src='https://www.hCaptcha.com/1/api.js' async defer></script> -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
$(document).ready(function() {
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
        var activeTab = $(e.target).text();
        if (activeTab === 'Register') {
            $('title').text('Register - Formulir Pendaftaran');
        } else {
            $('title').text('Login - Formulir Pendaftaran');
        }
    });
});
$(document).ready(function() {
    // Set the initial welcome message
    $("#welcome").html("Silakan login untuk melanjutkan");

    // Change the welcome message when login tab is clicked
    $("#login-tab").click(function() {
        $("#welcome").html("Silakan login untuk melanjutkan");
    });

    // Change the welcome message when register tab is clicked
    $("#register-tab").click(function() {
        $("#welcome").html("Silakan register untuk mendaftar");
    });
});
</script>

</html>