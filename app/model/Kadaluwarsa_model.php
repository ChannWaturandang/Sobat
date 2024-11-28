<?php
class Kadaluwarsa_model
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

    public function kurang_30()
    {
        $result = $this->db->query("SELECT kode_obat, tgl_expired, nama_obat, SUM(obat_masuk) AS total_obat_masuk, sisa_hari
        FROM transaksi_beli
        WHERE sisa_hari BETWEEN 11 AND 29
        GROUP BY kode_obat, tgl_expired");

        if ($result->num_rows > 0) {
            $rows = [];
            while ($row = $result->fetch_assoc()) {
                $rows[] = $row;
            }
            return $rows;
        } else {
            return [];
        }
    }
    public function kurang_10()
    {
        $result = $this->db->query("SELECT kode_obat, tgl_expired, nama_obat, SUM(obat_masuk) AS total_obat_masuk, sisa_hari
        FROM transaksi_beli
        WHERE sisa_hari BETWEEN 1 AND 9
        GROUP BY kode_obat, tgl_expired");

        if ($result->num_rows > 0) {
            $rows = [];
            while ($row = $result->fetch_assoc()) {
                $rows[] = $row;
            }
            return $rows;
        } else {
            return [];
        }
    }
    public function telah_kadaluwarsa()
    {
        $result = $this->db->query("SELECT kode_obat, tgl_expired, nama_obat, SUM(obat_masuk) AS total_obat_masuk, sisa_hari
        FROM transaksi_beli
        WHERE sisa_hari < 0
        GROUP BY kode_obat, tgl_expired");

        if ($result->num_rows > 0) {
            $rows = [];
            while ($row = $result->fetch_assoc()) {
                $rows[] = $row;
            }
            return $rows;
        } else {
            return [];
        }
    }

    public function totalKadaluwarsa()
    {
        $result = $this->db->query("SELECT SUM(obat_masuk) AS total_kadaluwarsa
        FROM transaksi_beli
        WHERE sisa_hari < 31 
        GROUP BY tgl_expired");

        if ($result->num_rows > 0) {
            // Mengambil hasil penjumlahan stok
            $row = $result->fetch_assoc();
            return $row['total_kadaluwarsa'];
        } else {
            return 0; // Jika tidak ada stok, kembalikan 0
        }
    }

public function refill()
    {
        // Query untuk menghitung jumlah obat yang membutuhkan refill
        $query = "SELECT COUNT(DISTINCT kode_obat) AS total_refill
                FROM transaksi_beli
                WHERE obat_masuk <= 0.2 * obat_masuk";

        $result = $this->db->query($query);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return (int)$row['total_refill']; // Kembalikan total jumlah obat yang membutuhkan refill
        } else {
            return 0; // Jika tidak ada data
        }
    }

    public function insertDataModelS($data)
    {
        $nama_supplier = $this->db->escape_string($data['sup_nama']);
        $alamat = $this->db->escape_string($data['sup_alamat']);
        $nama_petugas = $this->db->escape_string($data['sup_nama_petugas']);
        $kontak_petugas = $this->db->escape_string($data['sup_kontak_petugas']);

        $sql = "INSERT INTO data_pasokan (nama_supplier, alamat_supplier, nama_petugas, kontak_petugas)
                VALUES ('$nama_supplier', '$alamat', '$nama_petugas', '$kontak_petugas')";

        return $this->db->query($sql) === TRUE;
    }

    public function deleteDataModelS($id)
    {
        $id = $this->db->escape_string($id);
        $sql = "DELETE FROM data_pasokan WHERE supplier_id = $id";
        return $this->db->query($sql) === TRUE;
    }

    public function updateDataModelS($data)
    {
        $id = $this->db->escape_string($data['sup_id_update']);
        $nama_supplier = $this->db->escape_string($data['sup_nama_update']);
        $alamat = $this->db->escape_string($data['sup_alamat_update']);
        $nama_petugas = $this->db->escape_string($data['sup_nama_petugas_update']);
        $kontak_petugas = $this->db->escape_string($data['sup_kontak_petugas_update']);

        $sql = "UPDATE data_pasokan SET
                nama_supplier = '$nama_supplier',
                alamat_supplier = '$alamat',
                nama_petugas = '$nama_petugas',
                kontak_petugas = '$kontak_petugas'
                WHERE supplier_id = '$id'";

        return $this->db->query($sql) === TRUE;
    }
}
