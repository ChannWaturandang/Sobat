<?php
class Dashboard_model
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


    public function getTotalObat()
    {
        // Query untuk menjumlahkan semua stok di database
        $result = $this->db->query("SELECT SUM(stok) AS total_stok FROM data_obat;");
        $this->db->db_close();

        if ($result->num_rows > 0) {
            // Mengambil hasil penjumlahan stok
            $row = $result->fetch_assoc();
            return $row['total_stok'];
        } else {
            return 0; // Jika tidak ada stok, kembalikan 0
        }
    }
    public function getTotalPenjualan()
    {
        // Query untuk menjumlahkan semua total_bayar di database untuk penjualan hari ini
        $result = $this->db->query("SELECT SUM(total_bayar) AS total_jual FROM transaksi_jual WHERE tgl_penjualan = CURDATE();");
        $this->db->db_close();

        if ($result->num_rows > 0) {
            // Mengambil hasil penjumlahan total_bayar
            $row = $result->fetch_assoc();
            return $row['total_jual'];
        } else {
            return 0; // Jika tidak ada penjualan hari ini, kembalikan 0
        }
    }

    public function getTotalPembelian()
    {
        // Query untuk menjumlahkan semua total_bayar di database untuk penjualan hari ini
        $result = $this->db->query("SELECT SUM(total_harga) AS total_beli FROM transaksi_beli WHERE tgl_masuk = CURDATE();");
        $this->db->db_close();

        if ($result->num_rows > 0) {
            // Mengambil hasil penjumlahan total_bayar
            $row = $result->fetch_assoc();
            return $row['total_beli'];
        } else {
            return 0; // Jika tidak ada penjualan hari ini, kembalikan 0
        }
    }


    public function getDataPembelian($data)
    {
        // Gunakan tanggal sekarang jika tidak ada yang dipilih
        $tgl_dipilih = $data;

        // Query dengan WHERE untuk langsung memfilter berdasarkan tanggal yang dipilih
        $query = "SELECT nama_obat, total_harga FROM transaksi_beli WHERE tgl_masuk = '$tgl_dipilih'";
        $result = $this->db->query($query);
        $this->db->db_close();

        // Cek apakah ada hasil dari query
        if ($result->num_rows > 0) {
            $data_obat = [];

            // Ambil data per baris
            while ($row = $result->fetch_assoc()) {
                $nama_obat = $row['nama_obat'];
                $harga_obat = $row['total_harga'];

                // Jika nama obat sudah ada, tambahkan harga
                if (isset($data_obat[$nama_obat])) {
                    $data_obat[$nama_obat] += $harga_obat;  // Tambahkan harga jika nama obat sama
                } else {
                    // Jika belum ada, simpan nama obat dengan harga awalnya
                    $data_obat[$nama_obat] = $harga_obat;
                }
            }

            // Pisahkan nama_obat dan total_harga untuk dikembalikan
            return [
                'nama_obat' => array_keys($data_obat),
                'total_harga' => array_values($data_obat)
            ];
        } else {
            // Kembalikan array kosong jika tidak ada data
            return [
                'nama_obat' => [],
                'total_harga' => []
            ];
        }
    }
    public function getDataPenjualan($data)
    {
        // Gunakan tanggal sekarang jika tidak ada yang dipilih
        $tgl_dipilih = $data;

        // Query dengan WHERE untuk langsung memfilter berdasarkan tanggal yang dipilih
        $query = "SELECT nama_obat, total_penjualan FROM transaksi_jual WHERE tgl_penjualan = '$tgl_dipilih'";
        $result = $this->db->query($query);
        $this->db->db_close();

        // Cek apakah ada hasil dari query
        if ($result->num_rows > 0) {
            $data_obat = [];

            // Ambil data per baris
            while ($row = $result->fetch_assoc()) {
                $nama_obat = $row['nama_obat'];
                $harga_obat = $row['total_penjualan'];

                // Jika nama obat sudah ada, tambahkan harga
                if (isset($data_obat[$nama_obat])) {
                    $data_obat[$nama_obat] += $harga_obat;  // Tambahkan harga jika nama obat sama
                } else {
                    // Jika belum ada, simpan nama obat dengan harga awalnya
                    $data_obat[$nama_obat] = $harga_obat;
                }
            }

            // Pisahkan nama_obat dan total_harga untuk dikembalikan
            return [
                'nama_obat' => array_keys($data_obat),
                'total_penjualan' => array_values($data_obat)
            ];
        } else {
            // Kembalikan array kosong jika tidak ada data
            return [
                'nama_obat' => [],
                'total_penjualan' => []
            ];
        }
    }

    // /////////////////////////////
    public function getPembelianPerBulan()
    {
        $query = "SELECT MONTH(tgl_masuk) AS bulan, SUM(total_harga) AS total_pembelian
              FROM transaksi_beli
              WHERE YEAR(tgl_masuk) = YEAR(CURDATE())
              GROUP BY bulan
              ORDER BY bulan";
        $result = $this->db->query($query);
        $this->db->db_close();

        $pembelian_per_bulan = array_fill(0, 12, 0); // Isi default 0 untuk setiap bulan

        while ($row = $result->fetch_assoc()) {
            $bulan = (int)$row['bulan'] - 1; // Bulan dalam format index (0-11)
            $pembelian_per_bulan[$bulan] = $row['total_pembelian'];
        }

        return $pembelian_per_bulan;
    }

    public function getPenjualanPerBulan()
    {
        $query = "SELECT MONTH(tgl_penjualan) AS bulan, SUM(total_penjualan) AS total_penjualan
              FROM transaksi_jual
              WHERE YEAR(tgl_penjualan) = YEAR(CURDATE())
              GROUP BY bulan
              ORDER BY bulan";
        $result = $this->db->query($query);
        $this->db->db_close();

        $penjualan_per_bulan = array_fill(0, 12, 0); // Isi default 0 untuk setiap bulan

        while ($row = $result->fetch_assoc()) {
            $bulan = (int)$row['bulan'] - 1;
            $penjualan_per_bulan[$bulan] = $row['total_penjualan'];
        }

        return $penjualan_per_bulan;
    }

    // public function getKeuntunganBulanan()
    // {
    //     // Query untuk mendapatkan laba bersih bulanan
    //     $query = "
    //     SELECT 
    //         MONTH(tgl_penjualan) AS bulan, 
    //         (IFNULL(
    //             (SELECT SUM(transaksi_beli.total_harga) 
    //              FROM transaksi_beli 
    //              WHERE MONTH(tgl_masuk) = MONTH(tgl_penjualan)
    //             ), 0) 
    //         - SUM(transaksi_jual.total_bayar)) AS keuntungan_bulan
    //     FROM transaksi_jual
    //     GROUP BY bulan
    //     ORDER BY bulan ASC
    // ";

    //     $result = $this->db->query($query);
    //     $keuntungan = array_fill(0, 12, 0); // Inisiasi array untuk 12 bulan

    //     if ($result->num_rows > 0) {
    //         while ($row = $result->fetch_assoc()) {
    //             $bulan = $row['bulan'] - 1; // Index array dimulai dari 0
    //             $keuntungan[$bulan] = $row['keuntungan_bulan'];
    //         }
    //     }
    //     $this->db->db_close();
    //     return $keuntungan;
    // }
}
