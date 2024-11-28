<?php
class User extends Controller
{

    public function __construct() {}

    public function transaksi_jual()
    {
        $this->start_session();
        $arr_data['obat'] = $this->logic("data_obat_model")->getalldatamodel();
        $arr_data['title'] = "transaksi Jual";
        $this->display('template/header', $arr_data);
        $this->display('template/unav', $arr_data);
        $this->display('user/transaksi_jual', $arr_data);
        $this->display('template/footer');
    }

    public function transaksi_beli()
    {
        $this->start_session();
        $arr_data['obat'] = $this->logic("data_obat_model")->getalldatamodel();
        $arr_data['supplier'] = $this->logic("data_supplier_model")->getalldatamodels();
        $arr_data['title'] = "transaksi beli";
        $this->display('template/header', $arr_data);
        $this->display('template/unav', $arr_data);
        $this->display('user/transaksi_beli', $arr_data);
        $this->display('template/footer');
    }

    public function kurang_stok_obat()
    {
        $this->start_session();
        if ($this->logic("transaksi_jual_model")->updatestok($_POST)) {
            header('Location: ' . APP_PATH . '/user/transaksi_jual');
            exit;
        }
    }

    public function sendnotification()
    {
        // Load model
        $whatsappmodel = $this->logic('whatsapp_notification');

        // Fetch phone numbers and notification data from the database
        $users = $whatsappmodel->getuserphonenumbers();
        $expiringnotifications = $whatsappmodel->getexpiringandexpireddrugs();
        $returnnotifications = $whatsappmodel->getreturnnotifications();
        $refillnotifications = $whatsappmodel->getrefillnotifications();

        // Loop through each user and create combined messages
        foreach ($users as $user) {


            $messages = [];

            // Add expiring drugs messages
            if (!empty($expiringnotifications)) {
                $messages[] = "*LIST oBAT YANG AKAN SEGERA kADALUWARSA:*";
                foreach ($expiringnotifications as $notification) {
                    $messages[] = "- {$notification['nama_obat']} dengan sisa {$notification['sisa_hari']} hari, stok: {$notification['stok']}.";
                }
            }

            // Add expired drugs messages
            $expiredDrugs = array_filter($expiringnotifications, function ($notification) {
                return $notification['sisa_hari'] < 0; // Filter for expired drugs
            });

            if (!empty($expiredDrugs)) {
                $messages[] = "";
                $messages[] = "*LIST oBAT YANG TELAH kADALUWARSA*:";
                foreach ($expiredDrugs as $expired) {
                    $messages[] = "- {$expired['nama_obat']} sudah kadaluarsa, stok: {$expired['stok']}.";
                }
            }

            // Add return messages
            if (!empty($returnnotifications)) {
                $messages[] = "";
                $messages[] = "*LIST oBAT YANG SUDAH PERLU DI KEMBALIKAN*:";
                foreach ($returnnotifications as $return) {
                    $messages[] = "- {$return['nama_obat']} dengan sisa {$return['sisa_bulan']} bulan, stok: {$return['stok']}.";
                }
            }

            // Add return messages
            if (!empty($refillnotifications)) {
                $messages[] = "";
                $messages[] = "*LIST oBAT YANG SUDAH PERLU DI KEMBALIKAN*:";
                foreach ($returnnotifications as $refill) {
                    $messages[] = "- {$refill['nama_obat']} dengan sisa {$refill['sisa_bulan']} bulan, stok: {$refill['stok']}.";
                }
            }

            // Combine messages into a single paragraph
            $finalMessage = implode("\n", $messages);

            // Send the combined message if there are any notifications
            if (!empty($messages)) {
                $whatsappmodel->sendwhatsappNotification($user['phone_number'], trim($finalMessage)); // Trim to remove trailing newlines
                // Update last notification sent timestamp
            }
        }
    }

    public function save_histori_jual()
    {
        $this->start_session();

        // Ambil data transaksi yang dikirim dari frontend
        $histori_jual = $_POST['transaksi'];
        var_dump($histori_jual);

        // Loop untuk menyimpan setiap transaksi
        foreach ($histori_jual as $transaksi) {
            if (!$this->logic("transaksi_jual_model")->savehistorijual($transaksi)) {
                // Jika ada error, tampilkan pesan error
                header('Location: ' . APP_PATH . '/user/transaksi_jual?error=1');
                exit;
            }
        }

        // Jika semua transaksi berhasil disimpan
        header('Location: ' . APP_PATH . '/user/transaksi_jual');
        exit;
    }

    public function pengaturan()
    {
        $this->start_session();
        // $arr_data['obat'] = $this->logic("data_obat_model")->getalldatamodel();
        $arr_data['title'] = "Pengaturan";
        $this->display('template/header', $arr_data);
        $this->display('template/unav', $arr_data);
        $this->display('user/pengaturan', $arr_data);
        $this->display('template/footer');
    }

    public function sendprompt()
    {
        $this->start_session();

        $prompt = $_POST['prompt'];

        // echo $prompt;

        $content = "Betadin obat untuk luka, paracetamol obat untuk demam ";

        if ($prompt) {
            $gpt_model = $this->logic('gptbot_model');
            $response = $gpt_model->getresponse($prompt);

            // Send response back as JSON
            header('Content-Type: application/json'); // Set content type to JSON
            echo json_encode(['choices' => [['message' => ['content' => $response]]]]);
        } else {
            header('Content-Type: application/json'); // Set content type to JSON
            echo json_encode(['message' => 'Invalid input']);
        }
    }

    // tRANSAKSI bELI
    public function tambah_stok_obat()
    {
        $this->start_session();
        if ($this->logic("transaksi_beli_model")->updatestok($_POST)) {
            header('Location: ' . APP_PATH . '/user/transaksi_beli');
            exit;
        }
    }

    public function save_histori_beli()
    {
        $this->start_session();
        $data = $_POST; // Ambil data dari POST



        $this->logic("transaksi_beli_model")->inserthistoribelimanual($data);
        header('Location: ' . APP_PATH . '/user/transaksi_beli');
        exit;
    }

    public function changepicture(): void
    {
        // Cek apakah file di-upload dan tidak ada error
        if (isset($_FILES['new_image']) && $_FILES['new_image']['error'] === UPLOAD_ERR_OK) {
            $fileTmpPath = $_FILES['new_image']['tmp_name'];
            $fileName = $_FILES['new_image']['name'];
            $fileSize = $_FILES['new_image']['size'];
            $fileType = $_FILES['new_image']['type'];
            $error = $_FILES['new_image']['error'];
            var_dump($_FILES['new_image']);

            $syaratgambar = ['jpg', 'jpeg', 'png'];
            $ekstensigambar = explode('.', $fileName);
            $ekstensigambar = strtolower(end($ekstensigambar));
            if (!in_array($ekstensigambar, $syaratgambar)) {
                echo "
                <script>yang anda upload bukan gambar yang valid!</script>
                ";
                return;
            }

            // cek ukuran gambar
            if ($fileSize > 1000000) {
                echo "
                <script>ukuran gambar terlalu besar!</script>
                ";
            }

            // lolos pengecekan
            move_uploaded_file($fileName, APP_PATH . '/img/upload/' . $fileName);

            // update ke database
            $this->logic('login_model')->change_picture($fileName);
        } else {
            echo "Tidak ada file yang diunggah atau terjadi kesalahan.";
        }

        // Tampilkan halaman
        $arr_data['title'] = 'user profile';
        $this->display('template/header');
        $this->display('template/navbar', $arr_data);
        $this->display('pengaturan/pengaturan');
        $this->display('template/footer');
    }

    public function cari()
    {
        $this->start_session();
        $keyword = $_POST['keyword'];

        // Retrieve search results
        $results = $this->logic("search_model")->search($keyword);

        if ($results === false) {
            // If there's an error, return an empty array or an error message
            header('Content-Type: application/json');
            echo json_encode(['error' => 'An error occurred while fetching search results']);
            exit;
        }

        // If results are empty, return an empty array
        if (empty($results)) {
            header('Content-Type: application/json');
            echo json_encode([]);
            exit;
        }

        // If results are found, return them as JSON
        header('Content-Type: application/json');
        echo json_encode($results->fetch_all(MYSQLI_ASSOC));
        exit;
    }




    // notifikasi sistem

    public function notifikasisistem($type)
    {
        $notification_model = $this->logic('notifikasi_sistem');

        switch ($type) {
            case 'expiring':
                $notifications = $notification_model->getexpiringdrugs();
                break;
            case 'refill':
                $notifications = $notification_model->getrefillnotifications();
                break;
            case 'expired':
                $notifications = $notification_model->getexpireddrugs();
                break;
            case 'return':
                $notifications = $notification_model->getreturnnotifications();
                break;
            default:
                $notifications = [];
        }

        header('Content-Type: application/json');
        echo json_encode($notifications);
    }
}
