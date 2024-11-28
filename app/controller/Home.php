<?php

class Home extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    // DASHBOARDx
    public function index()
    {
        $this->start_session();


        if (!isset($_POST['tgl_dipilih'])) {
            $date_sended = date('Y-m-d');

            $arr_data['title'] = "Dashboard";
            $arr_data['total_obat'] = $this->logic("Dashboard_model")->getTotalObat();

            $arr_data['nama_obat_dibeli'] = $this->logic("Dashboard_model")->getDataPembelian($date_sended);
            $arr_data['nama_obat_dijual'] = $this->logic("Dashboard_model")->getDataPenjualan($date_sended);


            //var_dump($arr_data['nama_obat_dibeli']['nama_obat']);
            //echo "<hr>";
            //var_dump($arr_data['nama_obat_dibeli']['total_harga']);

            $arr_data['refill'] = $this->logic("Kadaluwarsa_model")->refill();
            $arr_data['total_kadaluwarsa'] = $this->logic("Kadaluwarsa_model")->totalKadaluwarsa();
            $arr_data['total_jual'] = $this->logic("Dashboard_model")->getTotalPenjualan();
            $arr_data['total_beli'] = $this->logic("Dashboard_model")->getTotalPembelian();
            $arr_data['pembelian_per_bulan'] = $this->logic("Dashboard_model")->getPembelianPerBulan();
            $arr_data['penjualan_per_bulan'] = $this->logic("Dashboard_model")->getPenjualanPerBulan();
            // $arr_data['keuntungan_bulanan'] = $this->logic("Dashboard_model")->getKeuntunganBulanan();


            $this->display('template/header', $arr_data);
            $this->display('template/navbar', $arr_data);
            $this->display('home/dashboard', $arr_data);
            $this->display('template/footer', $arr_data);
        } else {
            $date_sended = $_POST['tgl_dipilih'];

            $arr_data['title'] = "Dashboard";
            $arr_nama_obat = $this->logic("Dashboard_model")->gettotalobat();
            $arr_harga = $this->logic("Dashboard_model")->getdatapenjualan($date_sended);

            // Mendapatkan data dari model

            $arr_harga = $this->logic("Dashboard_model")->getdatapenjualan($date_sended);

            // Mengonversi ke format JSON
            $json_data = json_encode([
                'nama_obat' => $arr_nama_obat,
                'harga' => $arr_harga
            ]);

            // Menampilkan hasil
            echo $json_data;
        }

        //var_dump($date_sended);
        //echo "<hr>";
    }

    public function totalObat()
    {
        $this->start_session();
        $arr_data['total_obat'] = $this->logic("Dashboard_model")->getTotalObat();
        var_dump($arr_data['total_obat']);
        return $arr_data['total_obat'];
    }

    ///////////////
    public function penjualan()
    {
        $this->start_session();
        $arr_data['title'] = "Data Penjualan";
        $arr_data['obat'] = $this->logic("Data_obat_model")->getAllDataModel();
        $this->display('template/header', $arr_data);
        $this->display('template/navbar', $arr_data);
        $this->display('data_transaksi/penjualan', $arr_data);
        $this->display('template/footer');
    }



    public function kadaluwarsa()
    {
        $this->start_session();
        $arr_data['informasi_obat'] = $this->logic("Data_obat_model")->getAllDataModel();
        $arr_data['30'] = $this->logic("Kadaluwarsa_model")->kurang_30();
        $arr_data['10'] = $this->logic("Kadaluwarsa_model")->kurang_10();
        $arr_data['expired'] = $this->logic("Kadaluwarsa_model")->telah_kadaluwarsa();
        $arr_data['title'] = "Informasi Kadaluwarsa";
        $this->display('template/header', $arr_data);
        $this->display('template/navbar', $arr_data);
        $this->display('master/kadaluwarsa', $arr_data);
        $this->display('template/footer');
    }

    public function data_pembelian()
    {
        $this->start_session();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $tgl_masuk = $_POST['tgl_masuk'];
            $no_faktur = $_POST['no_faktur'];
            $nama_supplier = $_POST['nama_supplier'];
            $drug_details = $this->logic("Transaksi_beli_model")->getDrugsByPurchaseDetails($tgl_masuk, $no_faktur, $nama_supplier);

            $price_and_satuan = [];
            foreach ($drug_details as $drug) {
                $nama_obat = $drug['nama_obat'];
                $price_and_satuan[$nama_obat] = $this->logic("Transaksi_beli_model")->getPriceAndSatuan($nama_obat);
            }

            echo json_encode(['drug_details' => $drug_details, 'price_and_satuan' => $price_and_satuan]);
        } else {
            $arr_data['informasi_lunas'] = $this->logic("Transaksi_beli_model")->data_pembelian_bayar_langsung();
            $arr_data['informasi_utang'] = $this->logic("Transaksi_beli_model")->data_pembelian_utang();
            $arr_data['title'] = "Data Pembelian";
            $this->display('template/header', $arr_data);
            $this->display('template/navbar', $arr_data);
            $this->display('transaksi/data_pembelian', $arr_data);
            $this->display('template/footer');
        }
    }

    public function kategori()
    {
        $this->start_session();
        $arr_data['kategori'] = $this->logic("Data_obat_model")->kategori_obat();
        $arr_data['title'] = "Data kategori";
        $this->display('template/header', $arr_data);
        $this->display('template/navbar', $arr_data);
        $this->display('master/kategori', $arr_data);
        $this->display('template/footer');
    }

    public function satuan()
    {
        $this->start_session();
        $arr_data['satuan'] = $this->logic("Data_obat_model")->satuan_obat();
        $arr_data['title'] = "Data Satuan";
        $this->display('template/header', $arr_data);
        $this->display('template/navbar', $arr_data);
        $this->display('master/satuan', $arr_data);
        $this->display('template/footer');
    }

    public function data_obat()
    {
        $this->start_session();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Ambil kode obat dari POST
            $kode_obat = $_POST['kode_obat'];

            // Ambil data obat terkait kode_obat
            $data_obat = $this->logic("Transaksi_beli_model")->info_obat($kode_obat);
            $arr_data['informasi_obat'] = $this->logic("Data_obat_model")->getAllDataModel();


            // Cek jika data ditemukan, kirimkan respon dalam format JSON
            if (!empty($data_obat)) {
                echo json_encode($data_obat);
            } else {
                echo json_encode(['error' => 'Data tidak ditemukan']);
            }
        } else {
            // Jika bukan request POST, render halaman biasa
            $arr_data['informasi_obat'] = $this->logic("Data_obat_model")->getAllDataModel();
            $arr_data['kategori'] = $this->logic("Data_obat_model")->kategori_obat();
            $arr_data['satuan'] = $this->logic("Data_obat_model")->satuan_obat();
            $arr_data['title'] = "Data Obat";
            $this->display('template/header', $arr_data);
            $this->display('template/navbar', $arr_data);
            $this->display('master/data_obat', $arr_data);
            $this->display('template/footer');
        }
    }


    public function data_pegawai()
    {
        $this->start_session();
        $arr_data['pegawai'] = $this->logic("Data_pegawai_model")->getAllDataModelP();
        $arr_data['title'] = "Data pegawai";
        $this->display('template/header', $arr_data);
        $this->display('template/navbar', $arr_data);
        $this->display('master/data_pegawai', $arr_data);
        $this->display('template/footer');
    }

    public function data_supplier()
    {
        $this->start_session();
        $arr_data['supplier'] = $this->logic("Data_supplier_model")->getAllDataModelS();
        $arr_data['title'] = "Data supplier";
        $this->display('template/header', $arr_data);
        $this->display('template/navbar', $arr_data);
        $this->display('master/data_supplier', $arr_data);
        $this->display('template/footer');
    }

    public function chatbot()
    {
        $this->start_session();
        $arr_data['title'] = "Data chatbot";
        $this->display('template/header', $arr_data);
        $this->display('template/navbar', $arr_data);
        $this->display('master/chatbot', $arr_data);
        $this->display('template/footer');
    }

    public function transaksi_jual()
    {
        $this->start_session();
        $arr_data['obat'] = $this->logic("Data_obat_model")->getAllDataModel();
        $arr_data['title'] = "Transaksi Jual";
        $this->display('template/header', $arr_data);
        $this->display('template/navbar', $arr_data);
        $this->display('transaksi/transaksi_jual', $arr_data);
        $this->display('template/footer');
    }

    public function transaksi_beli()
    {
        $this->start_session();
        $arr_data['obat'] = $this->logic("Data_obat_model")->getAllDataModel();
        $arr_data['supplier'] = $this->logic("Data_supplier_model")->getAllDataModels();
        $arr_data['title'] = "Transaksi Beli";
        $this->display('template/header', $arr_data);
        $this->display('template/navbar', $arr_data);
        $this->display('transaksi/transaksi_beli', $arr_data);
        $this->display('template/footer');
    }

    // LAPORAN

    public function laporan()
    {
        $this->start_session();
        $arr_data['obat'] = $this->logic("Data_obat_model")->getAllDataModel();
        $arr_data['kategori'] = $this->logic("Data_obat_model")->kategori_obat();
        $arr_data['satuan'] = $this->logic("Data_obat_model")->satuan_obat();
        $arr_data['supplier'] = $this->logic("Data_supplier_model")->getAllDataModels();
        $arr_data['pegawai'] = $this->logic("Data_pegawai_model")->getAllDataModelP();

        $arr_data['title'] = "Laporan Penjualan";
        $this->display('template/header', $arr_data);
        $this->display('template/navbar', $arr_data);
        $this->display('transaksi/laporan', $arr_data);
        $this->display('template/footer');
    }

    // **********************************************************************



    public function pengaturan()
    {
        $this->start_session();
        // $arr_data['obat'] = $this->logic("Data_obat_model")->getAllDataModel();
        $arr_data['title'] = "Pengaturan";
        $this->display('template/header', $arr_data);
        $this->display('template/navbar', $arr_data);
        $this->display('pengaturan/pengaturan', $arr_data);
        $this->display('template/footer');
    }
    public function cetakpenjualan()
    {
        $this->start_session();
        // $arr_data['obat'] = $this->logic("Data_obat_model")->getAllDataModel();
        $arr_data['title'] = "Nota Penjualan";

        $this->display('data_transaksi/data_penjualan', $arr_data);
    }

    public function chatbot_settings()
    {
        $this->start_session();
        // $arr_data['obat'] = $this->logic("Data_obat_model")->getAllDataModel();
        $arr_data['title'] = "Pengaturan ChatBot";
        $this->display('template/header', $arr_data);
        $this->display('template/navbar', $arr_data);
        $this->display('pengaturan/chatbot_settings', $arr_data);
        $this->display('template/footer');
    }
    // ============================================================================================
    // public function page($current_page = 2, $next_page = 3, $prev_page = 1) {
    //     $this->start_session();
    //     $arr_data['current'] = $current_page;
    //     $arr_data['next'] = $next_page;
    //     $arr_data['previous'] = $prev_page;
    //     $arr_data['title'] = "Personal Page";
    //     $this->display('template/header', $arr_data);
    //     $this->display('template/footer');
    // }
    // ============================================================================================

    // INFORMASI OBAT CRUD

    public function sendDate()
    {
        $this->start_session();
        $tgl_dipilih = $_POST['tgl_dipilih'];

        // Ambil data pembelian berdasarkan tanggal yang dipilih dari model
        $arr_data['nama_obat_dibeli'] = $this->logic("Dashboard_model")->getDataPembelian($tgl_dipilih);
    }

    public function insert()
    {
        $this->start_session();
        if ($this->logic("Data_obat_model")->insertDataModel($_POST)) {
            header('Location: ' . APP_PATH . '/master/data_obat');
            exit;
        }
    }

    public function delete($kode)
    {
        $this->start_session();
        if ($this->logic("Data_obat_model")->deleteDataModel($kode)) {
            header('Location: ' . APP_PATH . '/master/data_obat');
            exit;
        }
    }

    public function update()
    {
        $this->start_session();
        if ($this->logic("Data_obat_model")->updateDataModel($_POST)) {
            header('Location: ' . APP_PATH . '/master/data_obat');
            exit;
        }
    }

    // DATA KARYAWAN CRUD

    public function insertPegawai()
    {
        $this->start_session();
        if ($this->logic("Data_pegawai_model")->insertDataModelP($_POST)) {
            header('Location: ' . APP_PATH . '/master/data_pegawai');
            exit;
        }
    }

    public function deletePegawai($id)
    {
        $this->start_session();
        if ($this->logic("Data_pegawai_model")->deleteDataModelP($id)) {
            header('Location: ' . APP_PATH . '/master/data_pegawai');
            exit;
        }
    }

    public function updatePegawai()
    {
        $this->start_session();
        if ($this->logic("Data_pegawai_model")->updateDataModelP($_POST)) {
            header('Location: ' . APP_PATH . '/master/data_pegawai');
            exit;
        }
    }

    // DATA SUPPLIER CRUD

    public function insertSupplier()
    {
        $this->start_session();
        if ($this->logic("Data_supplier_model")->insertDataModelS($_POST)) {
            header('Location: ' . APP_PATH . '/master/data_supplier');
            exit;
        }
    }

    public function deleteSupplier($id)
    {
        $this->start_session();
        if ($this->logic("Data_supplier_model")->deleteDataModelS($id)) {
            header('Location: ' . APP_PATH . '/master/data_supplier');
            exit;
        }
    }

    public function updateSupplier()
    {
        $this->start_Session();
        if ($this->logic("Data_supplier_model")->updateDataModelS($_POST)) {
            header('Location: ' . APP_PATH . '/master/data_supplier');
            exit;
        }
    }

    // TRANSAKSI JUAL

    public function pilih_obat()
    {
        $this->start_session();

        $cek = $_POST['no_penjualan'];
        var_dump($cek);
        if ($this->logic("Transaksi_jual_model")->dataObat($_POST)) {
            header('Location: ' . APP_PATH . '/transaksi/transaksi_jual');
            exit;
        }
    }

    public function kurang_stok_obat()
    {
        $this->start_session();
        if ($this->logic("Transaksi_jual_model")->updateStok($_POST)) {
            header('Location: ' . APP_PATH . '/transaksi/transaksi_jual');
            exit;
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
            if (!$this->logic("Transaksi_jual_model")->saveHistoriJual($transaksi)) {
                // Jika ada error, tampilkan pesan error
                header('Location: ' . APP_PATH . '/transaksi/transaksi_jual?error=1');
                exit;
            }
        }

        // Jika semua transaksi berhasil disimpan
        header('Location: ' . APP_PATH . '/transaksi/transaksi_jual');
        exit;
    }


    // TRANSAKSI BELI
    public function tambah_stok_obat()
    {
        $this->start_session();
        if ($this->logic("Transaksi_beli_model")->updateStok($_POST)) {
            header('Location: ' . APP_PATH . '/transaksi/transaksi_beli');
            exit;
        }
    }

    public function save_histori_beli()
    {
        $this->start_session();
        $data = $_POST; // Ambil data dari POST



        $this->logic("Transaksi_beli_model")->insertHistoriBeliManual($data);
        header('Location: ' . APP_PATH . '/transaksi/transaksi_beli');
        exit;
    }





    // CHATBOT

    public function sendPrompt()
    {
        $this->start_session();

        $prompt = $_POST['prompt'];

        // echo $prompt;

        $content = "Betadin obat untuk luka, paracetamol obat untuk demam ";

        if ($prompt) {
            $gpt_model = $this->logic('Gptbot_model');
            $response = $gpt_model->getResponse($prompt);

            // Send response back as JSON
            header('Content-Type: application/json'); // Set content type to JSON
            echo json_encode(['choices' => [['message' => ['content' => $response]]]]);
        } else {
            header('Content-Type: application/json'); // Set content type to JSON
            echo json_encode(['message' => 'Invalid input']);
        }
    }


    // KATEGORI CRUD
    public function insert_kategori()
    {
        $this->start_session();
        if ($this->logic("Data_obat_model")->insert_kategori($_POST)) {
            header('Location: ' . APP_PATH . '/master/kategori');
            exit;
        }
    }
    public function update_kategori($id)
    {
        $this->start_session();
        if ($this->logic("Data_obat_model")->update_kategori($id)) {
            header('Location: ' . APP_PATH . '/master/kategori');
            exit;
        }
    }
    public function delete_kategori($id)
    {
        $this->start_session();
        if ($this->logic("Data_obat_model")->delete_kategori($id)) {
            header('Location: ' . APP_PATH . '/master/kategori');
            exit;
        }
    }

    // SATUAN CRUD
    public function insert_satuan()
    {
        $this->start_session();
        if ($this->logic("Data_obat_model")->insert_satuan($_POST)) {
            header('Location: ' . APP_PATH . '/master/satuan');
            exit;
        }
    }
    public function update_satuan()
    {
        $this->start_session();
        if ($this->logic("Data_obat_model")->update_satuan($_POST)) {
            header('Location: ' . APP_PATH . '/master/satuan');
            exit;
        }
    }
    public function delete_satuan($id)
    {
        $this->start_session();
        if ($this->logic("Data_obat_model")->delete_satuan($id)) {
            header('Location: ' . APP_PATH . '/master/satuan');
            exit;
        }
    }

    // DATA PEMBELIAN
    public function pelunasan_cek($faktur)
    {
        $this->start_session();
        if ($this->logic("Transaksi_beli_model")->pelunasan($faktur)) {
            header('Location: ' . APP_PATH . '/transaksi/data_pembelian');
            exit;
        }
    }

    // NOTIFIKASI WHATSAPP

    public function sendNotification()
    {
        // Load model
        $whatsappModel = $this->logic('Whatsapp_notification');

        // Fetch phone numbers and notification data from the database
        $users = $whatsappModel->getUserPhoneNumbers();
        $expiringNotifications = $whatsappModel->getExpiringAndExpiredDrugs();
        $returnNotifications = $whatsappModel->getReturnNotifications();
        $refillNotifications = $whatsappModel->getRefillNotifications();

        // Loop through each user and create combined messages
        foreach ($users as $user) {
            // Check if the last notification was sent more than 24 hours ago
            $lastSent = strtotime($user['last_notification_sent']);
            if ($lastSent && (time() - $lastSent) < 86400) {
                // Skip sending notification if within 24 hours
                continue;
            }

            $messages = [];

            // Add expiring drugs messages
            if (!empty($expiringNotifications)) {
                $messages[] = "*LIST OBAT YANG AKAN SEGERA KADALUWARSA:*";
                foreach ($expiringNotifications as $notification) {
                    $messages[] = "- {$notification['nama_obat']} dengan sisa {$notification['sisa_hari']} hari, stok: {$notification['stok']}.";
                }
            }

            // Add expired drugs messages
            $expiredDrugs = array_filter($expiringNotifications, function ($notification) {
                return $notification['sisa_hari'] < 0; // Filter for expired drugs
            });

            if (!empty($expiredDrugs)) {
                $messages[] = "";
                $messages[] = "*LIST OBAT YANG TELAH KADALUWARSA*:";
                foreach ($expiredDrugs as $expired) {
                    $messages[] = "- {$expired['nama_obat']} sudah kadaluarsa, stok: {$expired['stok']}.";
                }
            }

            // Add return messages
            if (!empty($returnNotifications)) {
                $messages[] = "";
                $messages[] = "*LIST OBAT YANG SUDAH PERLU DI KEMBALIKAN*:";
                foreach ($returnNotifications as $return) {
                    $messages[] = "- {$return['nama_obat']} dengan sisa {$return['sisa_bulan']} bulan, stok: {$return['stok']}.";
                }
            }

            // Add return messages
            if (!empty($refillNotifications)) {
                $messages[] = "";
                $messages[] = "*LIST OBAT YANG SUDAH PERLU DI KEMBALIKAN*:";
                foreach ($returnNotifications as $refill) {
                    $messages[] = "- {$refill['nama_obat']} dengan sisa {$refill['sisa_bulan']} bulan, stok: {$refill['stok']}.";
                }
            }

            // Combine messages into a single paragraph
            $finalMessage = implode("\n", $messages);

            // Send the combined message if there are any notifications
            if (!empty($messages)) {
                $whatsappModel->sendWhatsAppNotification($user['phone_number'], trim($finalMessage)); // Trim to remove trailing newlines
                // Update last notification sent timestamp
                $whatsappModel->updateLastNotificationSent($user['user_id']); // Pastikan Anda memiliki id pengguna
            }
        }
    }

    // LAPORAN

    public function printPenjualan()
    {
        $range = $_POST['tgl_penjualan'];
        $pegawai = $_POST['pegawai'];
        $startDate = $_POST['custom_start_date'] ?? null;
        $endDate = $_POST['custom_end_date'] ?? null;
        $bulan = $_POST['bulan_penjualan'] ?? null;
        $tahun = $_POST['tahun_penjualan'] ?? null;

        $laporanModel = $this->logic('Laporan_model');
        $data['data_penjualan'] = $laporanModel->getPenjualan($range, $pegawai, $startDate, $endDate, $bulan, $tahun);
        $this->display('data_print/printPenjualan', $data);
    }


    public function printPembelian()
    {
        $range = $_POST['tgl_pembelian'];
        $supplier = $_POST['supplier'];
        $startDate = $_POST['custom_start_date'] ?? null;
        $endDate = $_POST['custom_end_date'] ?? null;
        $bulan = $_POST['bulan_pembelian'] ?? null;
        $tahun = $_POST['tahun_pembelian'] ?? null;

        $laporanModel = $this->logic('Laporan_model');
        $data['data_pembelian'] = $laporanModel->getPembelian($range, $supplier, $startDate, $endDate, $bulan, $tahun);
        $this->display('data_print/printPembelian', $data);
    }


    public function printKadaluwarsa()
    {
        $range = $_POST['expired_range'];
        $laporanModel = $this->logic('Laporan_model');
        $data['kadaluwarsa'] = $laporanModel->getKadaluwarsa($range);

        if ($range === 'less_than_30') {
            $data['title'] = 'Informasi Obat kurang dari 30 hari ';
        }
        // Proses data dan kirim ke tampilan cetak
        $this->display('data_print/printKadaluwarsa', $data);
    }

    public function printObat()
    {
        $kategori = $_POST['kategori_value'] ?? null;
        $satuan = $_POST['satuan_value'] ?? null;
        $laporanModel = $this->logic('Laporan_model');

        // Tentukan opsi dan ambil data berdasarkan kategori atau satuan
        if ($kategori != null) {
            $opsi = 'kategori';
            $data['info_obat'] = $laporanModel->getObat($opsi, $kategori);
        } elseif ($satuan != null) {
            $opsi = 'satuan';
            $data['info_obat'] = $laporanModel->getObat($opsi, $satuan);
        } else {
            // Jika keduanya kosong, ambil semua data
            $opsi = 'all';
            $data['info_obat'] = $laporanModel->getObat($opsi, null);
        }

        // Kirim variabel opsi ke tampilan untuk menentukan kolom yang ditampilkan
        $data['opsi'] = $opsi;

        // Proses data dan kirim ke tampilan cetak
        $this->display('data_print/printObat', $data);
    }

    // USER
    public function changePicture(): void
    {
        // Cek apakah file di-upload dan tidak ada error
        if (isset($_FILES['new_image']) && $_FILES['new_image']['error'] === UPLOAD_ERR_OK) {
            $fileTmpPath = $_FILES['new_image']['tmp_name'];
            $fileName = $_FILES['new_image']['name'];
            $fileSize = $_FILES['new_image']['size'];
            $fileType = $_FILES['new_image']['type'];

            // Tentukan path tujuan lokal untuk menyimpan file
            $destinationPath = APP_PATH . '/public/img/' . basename($fileName);

            // Pindahkan file dari temporary path ke destination path
            if (move_uploaded_file($fileTmpPath, $destinationPath)) {
                // Update path gambar di database
                $this->logic('Login_model')->change_picture($fileName);
                echo "Gambar berhasil diunggah.";
            } else {
                echo "Gagal mengunggah gambar. Pastikan direktori tujuan dapat ditulisi.";
            }
        } else {
            echo "Tidak ada file yang diunggah atau terjadi kesalahan.";
        }

        // Tampilkan halaman
        $arr_data['title'] = 'User profile';
        $this->display('template/header');
        $this->display('template/navbar', $arr_data);
        $this->display('pengaturan/pengaturan');
        $this->display('template/footer');
    }

    public function cari() {
        $this->start_session();
        $keyword = $_POST['keyword'];
    
        $results = $this->logic("Search_model.php")->search($keyword);
    
        // Mengatur header agar mengembalikan JSON
        header('Content-Type: application/json');
        echo json_encode($results->fetch_all(MYSQLI_ASSOC));
        $this->display('template/navbar');
    }
    
    








    // TRANSAKSI PEMBELIAN
    // public function info_obat($kode_obat){
    //     $this->start_session();
    //     $arr_data['kadaluwarsa'] = $this->logic("Transaksi_beli_model")->info_obat($kode_obat);
    //     var_dump($arr_data);
    //     $this->display('template/header', $arr_data);
    //     $this->display('template/navbar', $arr_data);
    //     $this->display('master/data_obat', $arr_data);
    //     $this->display('template/footer');
    // }
}
