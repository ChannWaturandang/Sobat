<?php
class Login extends controller
{
    public function index()
    {
        $data['title'] = "Login page";
        $this->display('login/index', $data);
    }

    public function register()
    {
        $this->start_session();
        session_destroy();
        session_unset();
        $_SESSION['user_id'] = [];
        $data['title'] = "Register";
        $this->display('login/register', $data);
    }

    public function process()
    {
        try {
            $this->start_session();
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $username = $_POST['username'];
                $password = $_POST['password'];
                $gabung = [$username, $password];

                $user = $this->logic("Login_model")->check_all_role($gabung);

                if ($user != null) {
                    $role = $user['role'];
                    $result = null;
                    if ($role == 'admin') {
                        $result = $this->logic("Login_model")->check_login_regular_admin($user);
                    } elseif ($role == 'user') {
                        $result = $this->logic("Login_model")->check_login_regular($user);
                    }
                    var_dump($result['user_id']);
                    if ($result != null) {
                        $_SESSION['user_id'] = $result["user_id"];
                        $_SESSION['name'] = $result["name"];
                        $_SESSION['surname'] = $result["surname"];
                        $_SESSION['username'] = $result["username"];
                        $_SESSION['email'] = $result["email"];
                        $_SESSION['password'] = $result["password"];
                        $_SESSION['phone_number'] = $result["phone_number"];
                        $_SESSION['role'] = $result["role"];
                        $image = $result["image"];
                        $_SESSION['image'] = APP_PATH . "/img/" . $image;
                        $_SESSION['home-index'] = 1;

                        if ($role == 'admin') {
                            header('Location: ' . APP_PATH . '/home/index');
                        } elseif ($role == 'user') {
                            header('Location: ' . APP_PATH . '/user/index');
                        }
                        exit();
                    } else {
                        $_SESSION['error'] = 1;
                        header('Location: ' . APP_PATH . '/Error');
                        exit();
                    }
                } else {
                    $_SESSION['error'] = 1;
                    header("Location: " . APP_PATH . "/login/index");
                    exit();
                }
            }
        } catch (Exception $e) {
            header('Location: ' . APP_PATH . '/home/index');
            exit();
        }
    }

    public function regist_reguler_process()
    {
        try {
            $this->start_session();
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                if (empty($_POST['name']) || empty($_POST['surname']) || empty($_POST['username']) || empty($_POST['email']) || empty($_POST['password']) || empty($_POST['phone_number']) || empty($_POST['role']) || empty($_POST['gender'])) {
                    header('Location: ' . APP_PATH . '/login/register');
                    exit();
                }
                var_dump($_POST['gender']);

                $status = $this->logic("Login_model")->insert_data_reguler($_POST);
                if ($status) {
                    header('Location: ' . APP_PATH . '/login/index');
                    exit();
                } else {
                    header('Location: ' . APP_PATH . '/login/register');
                    exit();
                }
            }
        } catch (Exception $e) {
            echo "Maaf terjadi kesalahan: " . $e->getMessage();
        }
    }

    public function logout()
    {
        $this->start_session();
        session_destroy();
        header('Location: ' . APP_PATH . '/login/index');
        exit();
    }
}
