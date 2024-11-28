<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start(); // Start the session if it's not already started
}

if (!isset($_SESSION['error'])) {
    $_SESSION['error'] = 0; // Initialize error to 0 if it's not set
}

if (isset($_SESSION['user_id'])) {
    header("Location:" . APP_PATH . "/home/index"); // Initialize username to empty string if it's not set
} else {
    //    echo "data belum masuk";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
    <title><?php echo $data['title']; ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-image: url('https://i.ibb.co.com/hfdLPLr/v870-tang-36.jpg');
        }

        .container {
            margin-top: 20px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: transparent;
        }

        .row.justify-content-center {
            width: 100%;
        }

        .col-md-6 {
            max-width: 400px;
            width: 100%;
            background-color: #ffffff;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
            opacity: 0;
            transform: translateY(20px);
            animation: fadeIn 1s forwards;
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
            font-weight: 700;
            opacity: 0;
            transform: translateY(20px);
            animation: fadeIn 1s forwards;
            animation-delay: 0.4s;
        }

        label {
            font-weight: 500;
            color: #333;
            opacity: 0;
            transform: translateY(20px);
            animation: fadeIn 1s forwards;
            animation-delay: 0.6s;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ced4da;
            border-radius: 5px;
            font-family: 'Roboto', sans-serif;
            opacity: 0;
            transform: translateY(20px);
            animation: fadeIn 1s forwards;
            animation-delay: 0.8s;
        }

        .button-group {
            display: flex;
            justify-content: space-between;
            opacity: 0;
            transform: translateY(20px);
            animation: fadeIn 1s forwards;
            animation-delay: 1s;
        }

        button[type="submit"] {
            width: 48%;
            padding: 10px;
            background-color: #007bff;
            color: #ffffff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            font-family: 'Roboto', sans-serif;
        }

        button[type="submit"]:hover {
            background-color: #0056b3;
        }

        .btn-register {
            width: 48%;
            padding: 10px;
            background-color: #28a745;
            color: #ffffff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            font-family: 'Roboto', sans-serif;
        }

        .btn-register:hover {
            background-color: #218838;
            color: #ffffff;
        }

        @keyframes fadeIn {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .error {
            color: red;
            font-weight: bold;
        }
        
        .input-group-text {
            background-color: transparent;
            border: 1px solid #ced4da;
            border-radius: 5px 0 0 5px;
            color: #495057;
            padding: 10px 12px;
            font-size: 1rem;
            transition: background-color 0.3s, border-color 0.3s;
            box-shadow: none;
            height: 48px;
        }

    </style>
</head>

<body>
    <div class="container">
        <div class="logo justify-content-center">
            <img src="<?= APP_PATH . '/img/logo.png' ?>" alt="Health Logo">
        </div>
        <div class="row justify-content-center">
            <div class="col-md-6 ukuran">
                <h2 class="text-center mb-4">Welcome Back!</h2>

                <?php
                if ($_SESSION['error'] == 1) {
                    echo "<b style='color: red;'><i>*Username atau Password anda salah!</i></b>";
                } else {
                    echo "<i style='color: grey;'>Please fill in the blank</i>";
                }
                ?>

                <form method="POST" action="<?= APP_PATH; ?>/Login/process">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username"
                            placeholder="Enter Username" autocomplete="username" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="password" name="password"
                                placeholder="Enter Password" autocomplete="new-password" required>
                            <span class="input-group-text">
                                <i class="fas fa-eye" id="togglePassword" style="cursor: pointer;"></i>
                            </span>
                        </div>
                    </div>
                    <div class="button-group">
                        <button type="submit" class="btn btn-primary">Sign In</button>
                        <a type="button" class="btn btn-register" href="<?php echo APP_PATH; ?>/login/register">Sign Up</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Toggle Password visibility
        document.getElementById('togglePassword').addEventListener('click', function() {
            const passwordInput = document.getElementById('password');
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            this.classList.toggle('fa-eye-slash'); // Change icon
        });
    </script>
</body>

</html>