<?php if (isset($_SESSION['error_message'])): ?>
    <div class="alert alert-danger">
        <?php echo $_SESSION['error_message'];
        unset($_SESSION['error_message']); ?>
    </div>
<?php endif; ?>

<?php if (isset($_SESSION['success_message'])): ?>
    <div class="alert alert-success">
        <?php echo $_SESSION['success_message'];
        unset($_SESSION['success_message']); ?>
    </div>
<?php endif; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-image: url('https://i.ibb.co.com/hfdLPLr/v870-tang-36.jpg');
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: transparent;
            gap: 20px;

        }

        .col-md-6,
        .col-apotek {
            max-width: 100%;
            background-color: #ffffff;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
            opacity: 0;
            transform: translateY(20px);
            animation: fadeIn 1s forwards;
        }

        .col-md-6 {
            width: 90%;
        }

        .col-apotek {
            width: 30%;
        }

        .logo {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
            opacity: 0;
            transform: translateY(20px);
            animation: fadeIn 1s forwards;
            animation-delay: 0.2s;
        }

        .logo img {
            max-width: 150px;
        }

        h2 {
            color: #333;
            font-family: 'Roboto', sans-serif;
            font-weight: 500;
            text-align: center;
            margin-bottom: 20px;
            opacity: 0;
            transform: translateY(20px);
            animation: fadeIn 1s forwards;
            animation-delay: 0.4s;
        }

        @keyframes fadeIn {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group input,
        .form-group select {
            border-radius: 5px;
        }

        .btn-primary {
            width: 100%;
            border-radius: 5px;
        }

        .link {
            text-align: center;
            margin-top: 15px;
        }

        .link a {
            color: #007bff;
            text-decoration: none;
        }

        .link a:hover {
            text-decoration: underline;
        }

        .input-group {
            position: relative;
        }

        .input-group-text {
            background-color: transparent;
            border: 1px solid #ced4da;
            border-radius: 5px 0 0 5px;
            color: #495057;
            padding: 10px 12px;
            font-size: 1.5rem;
            transition: background-color 0.3s, border-color 0.3s;
            box-shadow: none;
        }

        .input-group-text i {
            font-size: 1.2rem;
            line-height: 1;
        }

        .form-control {
            border-radius: 0 5px 5px 0;
        }

        .input-group:hover .input-group-text {
            background-color: #e9ecef;
            border-color: #adb5bd;
        }

        .input-group input::placeholder {
            text-align: left;
            color: #495057;
        }

        .scroll {
            max-height: 35vh;
            /* Set maximum height for the form container */
            overflow-y: auto;
            /* Enable vertical scroll */
        }
    </style>
</head>

<body>
    <div class="container">
        <form action="<?php echo APP_PATH; ?>/Login/regist_reguler_process" method="POST">
            <div class="row justify-content-center">
                <div class="logo">
                    <img src="<?= APP_PATH . '/img/logo.png' ?>" alt="Logo">
                </div>
                <div class="col-md-6">
                    <h2>Register</h2>
                    <div class="scroll">
                        <!-- Name Input -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-user-circle"></i></span>
                                <input type="text" name="name" id="name" class="form-control" placeholder="Nama" required>
                            </div>
                        </div>

                        <!-- Surname Input -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-user-edit"></i></span>
                                <input type="text" name="surname" id="surname" class="form-control" placeholder="Nama Belakang" required>
                            </div>
                        </div>

                        <!-- Username Input -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                                <input type="text" name="username" id="username" class="form-control" placeholder="Username" required>
                            </div>
                        </div>

                        <!-- Email Input -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                <input type="email" name="email" id="email" class="form-control" placeholder="Email" required>
                            </div>
                        </div>

                        <!-- Password Input -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
                                <span class="input-group-text">
                                    <i class="fas fa-eye" id="togglePassword" style="cursor: pointer;"></i>
                                </span>
                            </div>
                        </div>

                        <!-- Confirm Password Input -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                                <input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="Konfirmasi Password" required>
                                <span class="input-group-text">
                                    <i class="fas fa-eye" id="toggleConfirmPassword" style="cursor: pointer;"></i>
                                </span>
                            </div>
                        </div>


                        <!-- Phone Number Input -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                <input type="text" name="phone_number" id="phone_number" class="form-control" placeholder="Nomor Telepon" required>
                            </div>
                        </div>

                        <!-- Gender Input -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-venus-mars"></i></span>
                                <select name="gender" id="gender" class="form-control text-primary" required>
                                    <option value="">Jenis Kelamin</option>
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Register</button>
                    <div class="link">
                        <p>Sudah punya akun? <a href="<?php echo APP_PATH; ?>/login/index">Masuk disini</a></p>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMF1RXn/tYtv17yy6A8eAoibY6tfsE2E57juuWtMyy7rNDK/bz+Y6k2pXr2" crossorigin="anonymous"></script>
    <script>
        // Toggle Password visibility
        document.getElementById('togglePassword').addEventListener('click', function() {
            const passwordInput = document.getElementById('password');
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            this.classList.toggle('fa-eye-slash'); // Change icon
        });

        // Toggle Confirm Password visibility
        document.getElementById('toggleConfirmPassword').addEventListener('click', function() {
            const confirmPasswordInput = document.getElementById('confirm_password');
            const type = confirmPasswordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            confirmPasswordInput.setAttribute('type', type);
            this.classList.toggle('fa-eye-slash'); // Change icon
        });
    </script>
</body>

</html>