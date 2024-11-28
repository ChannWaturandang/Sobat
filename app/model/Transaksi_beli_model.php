<?php

class Transaksi_beli_model
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;

        if ($this->db == false) {
            // echo "<script>console.log('Connection Failed.');</script>";
        } else {
            // echo "<script>console.log('Connection Success.');</script>";
        }
    }

    public function getPriceAndSatuan($nama_obat)
    {
        $result = $this->db->query("SELECT harga, satuan FROM data_obat WHERE nama_obat = '$nama_obat' ;");

        $this->db->db_close();

        if ($result->num_rows > 0) {
            return mysqli_fetch_all($result, MYSQLI_ASSOC);
        } else {
            return [];
        }
    }

    public function getDrugsByPurchaseDetails($tgl_masuk, $no_faktur, $nama_supplier)
    {
        $query = "
            SELECT nama_obat, obat_masuk AS stok
            FROM transaksi_beli 
            WHERE tgl_masuk = '$tgl_masuk' 
              AND no_faktur = '$no_faktur' 
              AND nama_supplier = '$nama_supplier';
        ";

        $result = $this->db->query($query);
        $this->db->db_close();

        if ($result->num_rows > 0) {
            return mysqli_fetch_all($result, MYSQLI_ASSOC);
        } else {
            return [];
        }
    }


    public function dataObat()
    {
        $result = $this->db->query("SELECT obat_id, kode_obat, nama_obat, harga, stok, satuan, kategori, tgl_kadaluarsa  FROM data_obat;");
        $this->db->db_close();

        if ($result->num_rows > 0) {
            return mysqli_fetch_all($result, MYSQLI_ASSOC);
        } else {
            return [];
        }
    }

    public function data_pembelian_bayar_langsung()
    {
        // Query untuk cara_bayar = "bayar langsung"
        $query = "
        SELECT no_faktur, tgl_masuk, nama_supplier,
            SUM(obat_masuk) AS total,
            cara_bayar AS status,
            nama_obat,
            total_harga,
            obat_masuk AS stok
        FROM transaksi_beli
        WHERE cara_bayar = 'bayar langsung'
        GROUP BY no_faktur, nama_supplier, cara_bayar;
    ";

        $result = $this->db->query($query);
        $this->db->db_close();

        if ($result->num_rows > 0) {
            return mysqli_fetch_all($result, MYSQLI_ASSOC);
        } else {
            return [];
        }
    }

    public function data_pembelian_utang()
    {
        // Query untuk cara_bayar = "utang"
        $query = "
        SELECT no_faktur, tgl_masuk, nama_supplier,
            SUM(obat_masuk) AS total,
            cara_bayar AS status
        FROM transaksi_beli
        WHERE cara_bayar = 'utang'
        GROUP BY no_faktur, nama_supplier, cara_bayar;
    ";

        $result = $this->db->query($query);
        $this->db->db_close();

        if ($result->num_rows > 0) {
            return mysqli_fetch_all($result, MYSQLI_ASSOC);
        } else {
            return [];
        }
    }
    public function pelunasan($faktur)
    {
        // Query untuk cara_bayar = "utang"
        $query = "UPDATE transaksi_beli set cara_bayar = 'bayar_langsung' WHERE no_faktur = '$faktur'";

        return $this->db->query($query) === TRUE;
    }


    public function info_obat($kode_obat)
    {
        // Query untuk mendapatkan tgl_expired dan jumlah obat_masuk berdasarkan kode_obat
        $result = $this->db->query("
        SELECT tgl_expired, SUM(obat_masuk) AS total_obat_masuk 
        FROM transaksi_beli 
        WHERE kode_obat = '$kode_obat' 
        GROUP BY tgl_expired
    ");

        // Tutup koneksi database
        $this->db->db_close();

        // Periksa hasil query dan kembalikan hasilnya
        if ($result->num_rows > 0) {
            return mysqli_fetch_all($result, MYSQLI_ASSOC);
        } else {
            return [];
        }
    }


    public function updateStok($data) {}

    public function insertHistoriBeliManual($data)
    {
        // Ambil data dari input
        $supplier_name = $data['supplier_name'];
        // $pegawai_id = $data['pegawai_id'];
        $tgl_pembelian = $data['tgl_pembelian'];
        $total_harga = $data['total_harga'];
        $cara_bayar = $data['payment_method'];
        $no_faktur = $data['no_faktur'];
        $tableData = json_decode($data['tableData'], true);
        $stokMap = json_decode($data['stokMap'], true);

        // Cek apakah no_faktur sudah ada di tabel faktur
        $cek_existing_faktur = "SELECT no_faktur FROM faktur WHERE no_faktur = '$no_faktur'";
        $result = $this->db->query($cek_existing_faktur);

        if ($result->num_rows === 0) {
            // Jika no_faktur tidak ada, insert ke tabel faktur
            $insert_new_faktur = "INSERT INTO faktur (no_faktur) VALUES ('$no_faktur')";
            $this->db->query($insert_new_faktur);
        }

        // Proses data dari tableData
        if (is_array($tableData)) {
            foreach ($tableData as $row) {
                $kode_obat = $row['kode_obat'];
                $nama_obat = $row['nama_obat'];
                $tgl_expired = $row['tgl_expired'];
                $harga = $row['harga'];
                $total_harga_per_row = $row['total_harga'];
                $unit = $row['unit'];

                // Cek apakah data sudah ada di transaksi_beli
                $cek_transaksi_beli_row = "SELECT obat_masuk FROM transaksi_beli 
                WHERE kode_obat = '$kode_obat' 
                AND tgl_expired = '$tgl_expired' 
                AND no_faktur = '$no_faktur'";
                $result = $this->db->query($cek_transaksi_beli_row);

                if ($result->num_rows > 0) {
                    // Jika data ada, update stok
                    $existing_data = $result->fetch_assoc();
                    $new_stock = $existing_data['obat_masuk'] + $unit;

                    $update_query = "UPDATE transaksi_beli 
                    SET obat_masuk = $new_stock, total_harga = total_harga + $total_harga_per_row 
                    WHERE kode_obat = '$kode_obat' AND tgl_expired = '$tgl_expired' AND no_faktur = '$no_faktur'";
                    $this->db->query($update_query);
                } else {
                    // Jika data tidak ada, lakukan insert
                    $insert_query = "INSERT INTO transaksi_beli 
                    (nama_supplier, tgl_masuk, total_harga, kode_obat, nama_obat, tgl_expired, no_faktur, cara_bayar, obat_masuk) 
                    VALUES 
                    ('$supplier_name', '$tgl_pembelian', '$total_harga_per_row', '$kode_obat', '$nama_obat', '$tgl_expired', '$no_faktur', '$cara_bayar', '$unit')";
                    $this->db->query($insert_query);
                }

                // Update stok di tabel data_obat
                $update_data_obat = "UPDATE data_obat SET stok = stok + $unit WHERE kode_obat = '$kode_obat'";
                $this->db->query($update_data_obat);
            }

            return ['status' => 'success', 'message' => 'Data successfully processed and stock updated.'];
        } else {
            return ['status' => 'error', 'message' => 'Invalid table data format.'];
        }
    }
}
