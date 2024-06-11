<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Login</title>
    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body style="background-color: #015aaa;">
    <div class="container-fluid">
        <!-- Outer Row -->
        <div class="row justify-content-center col-md-10 m-auto">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row justify-content-center" style="background-color: #fbf324;">
                            <div class="col-lg-6 text-center">
                                <div class="p-5">
                                    <img class="img-fluid" src="logo.png" alt="Logo">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Payroll System with Leave Credits and Offset Monitoring</h1>
                                    </div>
                                    <form method="POST" action="login_action.php" class="user needs-validation" novalidate>
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" id="exampleInputEmail" name="Employee_ID" aria-describedby="emailHelp" placeholder="Employee ID" required>
                                            <div class="invalid-feedback">
                                                Please enter employee id.
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" id="exampleInputPassword" name="Password" placeholder="Password" required>
                                            <div class="invalid-feedback">
                                                Please enter password.
                                            </div>
                                        </div>

                                        <div style="font-size: 11px; color: #cc0000; margin-top: 10px"><?php echo isset($error) ? $error : ''; ?></div>

                                        <button type="submit" value="Submit" class="btn btn-primary btn-user btn-block" name="Login">
                                            Login
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>
    <script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function() {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.querySelectorAll('.needs-validation')

        // Loop over them and prevent submission
        Array.prototype.slice.call(forms)
            .forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }

                    form.classList.add('was-validated')
                }, false)
            })
    })()
</script>
</body>

</html>