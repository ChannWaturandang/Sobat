<?php
class Data_supplier_model {
    private $db;

    public function __construct() {
        $this->db = new Database;

        if ($this->db == false) {
            // echo "<script>console.log('Connection Failed.');</script>";
        } else {
            // echo "<script>console.log('Connection Success.');</script>";
        }
    }

    public function getAllDataModelS() {
        $result = $this->db->query("SELECT * FROM data_pasokan;");
        
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

    public function insertDataModelS($data) {
        $nama_supplier = $this->db->escape_string($data['sup_nama']);
        $alamat = $this->db->escape_string($data['sup_alamat']);
        $nama_petugas = $this->db->escape_string($data['sup_nama_petugas']);
        $kontak_petugas = $this->db->escape_string($data['sup_kontak_petugas']);

        $sql = "INSERT INTO data_pasokan (nama_supplier, alamat_supplier, nama_petugas, kontak_petugas)
                VALUES ('$nama_supplier', '$alamat', '$nama_petugas', '$kontak_petugas')";

        return $this->db->query($sql) === TRUE;
    }

    public function deleteDataModelS($id) {
        $id = $this->db->escape_string($id);
        $sql = "DELETE FROM data_pasokan WHERE supplier_id = $id";
        return $this->db->query($sql) === TRUE;
    }

    public function updateDataModelS($data) {
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
