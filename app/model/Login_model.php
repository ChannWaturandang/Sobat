<?php
class Login_model
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();

        if ($this->db == false) {
            //echo "<script>console.log('Connection Failed.');</script>";
        } else {
            //echo "<script>console.log('Connection Success.');</script>";
        }
    }

    public function check_login_regular_admin($data)
    {
        session_start();
        $username = $data['username'];
        $password = $data['password'];
        $sql = "SELECT * FROM user WHERE role='admin' AND username='$username' AND password='$password'";
        $result = $this->db->query($sql);
        $result = mysqli_fetch_assoc($result);
        return $result;
    }

    public function check_login_regular($data)
    {
        $username = $data['username'];
        $password = $data['password'];
        $sql = "SELECT * FROM user WHERE role='user' AND username='$username' AND password='$password'";
        $result = $this->db->query($sql);
        $result = mysqli_fetch_assoc($result);
        return $result;
    }

    public function insert_data_reguler($data)
    {
        $name = $data['name'];
        $surname = $data['surname'];
        $username = $data['username'];
        $email = $data['email'];
        $password = password_hash($data['password'], PASSWORD_DEFAULT);
        $phone_number = $data['phone_number'];
        $gender = $data['gender'];
        $role = $data['role'];

        // First INSERT into the user table
        $sql1 = "INSERT INTO user (name, surname, username, email, password, phone_number, role, gender)
             VALUES ('$name', '$surname', '$username', '$email', '$password', '$phone_number', '$role', '$gender')";

        // Second INSERT into the data_pegawai table
        $fullName = $name . ' ' . $surname; // Correct concatenation of name and surname
        $sql2 = "INSERT INTO data_pegawai (nama_pegawai, username, password, telepon_pegawai, email_pegawai, jenis_kelamin, posisi)
             VALUES ('$fullName', '$username', '$password', '$phone_number', '$email', '$gender', '$role')";

        // Execute both queries
        $result1 = $this->db->query($sql1);
        $result2 = $this->db->query($sql2);

        return $result1 && $result2; // Return true if both queries were successful
    }


    public function check_all_role($data)
    {
        $username = $data[0];
        $password = $data[1];

        // Print username and password for debugging
        // echo 'ini adalah userusername'.var_dump($username); echo '<br>';
        // echo 'ini adalah password'.var_dump($password); echo '<br>';

        // Build the SQL query
        $sql = "SELECT user_id, role, username, email, password FROM user WHERE username = '$username'";
        $result = $this->db->query($sql);

        // echo 'ini adalah result'.var_dump($result); echo '<br>';

        // Check if the query was successful
        if ($result) {
            // Fetch the user record
            $user = mysqli_fetch_assoc($result);
            // echo 'ini adalah user => '. var_dump($user) . '<br>';
            // $aa = $user['username'];
            echo 'napa diaaaa <br>' . var_dump($user['password']);

            if (isset($user)) {
                // Verify the password
                if (password_verify($password, $user['password'])) {
                    // Password is correct, return user data
                    echo "Success Password";
                    return $user;
                } else {
                    // Password is incorrect
                    echo "Invalid password --------> ";
                    return null;
                    // echo 'ini dari data $password => '. var_dump($password).'<br>' ;
                }
            } else {
                // No user found with that username
                echo "User not found";
                return null;
            }
        } else {
            // Query failed
            echo "Query failed: ";
        }
    }

    public function change_picture($image)
    {
        // Pastikan $_SESSION['user_id'] ada
        if (!isset($_SESSION['user_id'])) {
            return false; // atau kirim pesan error
        }

        $id = $_SESSION['user_id'];

        // Update path gambar di database
        $sql = "UPDATE user SET image = '$image' WHERE user_id = $id";
        $result = $this->db->query($sql);

        // Cek apakah query berhasil
        if (!$result) {
            // Menangani kesalahan jika query gagal
            return false; // atau bisa kirim pesan error
        }

        return true; // Mengindikasikan bahwa pembaruan berhasil
    }
}
