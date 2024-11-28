<?php

class Transaksi_jual_model
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

    public function getAllDataJualModel()
    {
        $result = $this->db->query("SELECT * FROM transaksi_jual;");
        $this->db->db_close();

        if ($result->num_rows) {
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

    public function saveHistoriJual($data)
    {
        // Ambil data dari request
        $no_penjualan = $data['no_penjualan'];
        $tgl_penjualan = $data['tgl_penjualan'];
        $pegawai = $data['pegawai'];
        $total_penjualan = $data['total_penjualan'];
        $nama_obat = $data['nama_obat'];
        $harga = $data['harga'];
        $jumlah = $data['jumlah'];
        $satuan = $data['satuan'];
        $subtotal = $data['subtotal'];
        $kembalian = $data['kembalian'];
        $tgl_expired = $data['tgl_expired'];

        // Update stok obat berdasarkan stokMap
        $stokMap = $data['stokMap'];
        foreach ($stokMap as $id_obat => $stok_jumlah) {
            $sqlUpdateStock = "UPDATE data_obat SET stok = stok - $stok_jumlah WHERE kode_obat = '$id_obat'";
            if (!$this->db->query($sqlUpdateStock)) {
                // Jika gagal update stok, return false 
                return false;
            }
            $modify_beli = "UPDATE transaksi_beli SET obat_masuk = obat_masuk - $stok_jumlah WHERE kode_obat = '$id_obat' AND tgl_expired = '$tgl_expired'";
            if (!$this->db->query($modify_beli)) {
                // Jika gagal update stok, return false
                return false;
            }
        }

        // Insert transaksi ke dalam database
        $sqlInsertTransaction = "INSERT INTO transaksi_jual (nama_obat, no_penjualan, tgl_penjualan, total_penjualan, harga, jumlah, satuan, total_bayar, kembalian, pegawai_id) 
                             VALUES ('$nama_obat', '$no_penjualan', '$tgl_penjualan', '$total_penjualan', '$harga', '$jumlah', '$satuan', '$subtotal', '$kembalian', $pegawai)";
        if (!$this->db->query($sqlInsertTransaction)) {
            // Jika gagal insert transaksi, return false
            return false;
        }

        // Jika semua berhasil, return true
        return true;
    }
}
