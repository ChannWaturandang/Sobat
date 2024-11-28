<?php
class Data_pegawai_model
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

    public function getAllDataModelP()
    {
        $result = $this->db->query("SELECT * FROM data_pegawai;");

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

    public function insertDataModelP($data)
    {
        $nama = $data['pgw_nama'];
        $posisi = $data['pgw_posisi'];
        $alamat = $data['pgw_alamat'];
        $jenis_kelamin = $data['pgw_jenis_kelamin'];
        $tanggal_lahir = $data['pgw_tanggal_lahir'];
        $nomor_hp = $data['pgw_nomor_hp'];
        $email = $data['pgw_email'];

        // Check if the employee already exists
        $checkSql = "SELECT * FROM data_pegawai WHERE email_pegawai = '$email' OR telepon_pegawai = '$nomor_hp'";
        $result = $this->db->query($checkSql);

        if ($result->num_rows > 0) {
            // Data already exists
            return "Data already exists";
        } else {
            // Insert new employee data
            $sql = "INSERT INTO data_pegawai (nama_pegawai, posisi, alamat_pegawai, jenis_kelamin, tanggal_lahir, telepon_pegawai, email_pegawai)
                    VALUES ('$nama', '$posisi', '$alamat', '$jenis_kelamin', '$tanggal_lahir', '$nomor_hp', '$email')";

            if ($this->db->query($sql) === TRUE) {
                return "Data inserted successfully";
            } else {
                echo "Data already exixt";
            }
        }
    }


    public function deleteDataModelP($id)
    {
        $id = $this->db->escape_string($id);
        $sql = "DELETE FROM data_pegawai WHERE pegawai_id = $id";
        return $this->db->query($sql) === TRUE;
    }

    public function updateDataModelP($data)
    {
        $id = $data['pgw_id_update'];
        $nama = $data['pgw_nama_update'];
        $posisi = $data['pgw_posisi_update'];
        $alamat = $data['pgw_alamat_update'];
        $jenis_kelamin = $data['pgw_jenis_kelamin_update'];
        $tanggal_lahir = $data['pgw_tanggal_lahir_update'];
        $nomor_hp = $data['pgw_nomor_hp_update'];
        $email = $data['pgw_email_update'];

        $sql = "UPDATE data_pegawai SET
                nama_pegawai = '$nama',
                posisi = '$posisi',
                alamat_pegawai = '$alamat',
                Jenis_kelamin = '$jenis_kelamin',
                Tanggal_lahir = '$tanggal_lahir',
                telepon_pegawai = '$nomor_hp',
                email_pegawai = '$email'
                WHERE pegawai_id = '$id'";

        return $this->db->query($sql) === TRUE;
    }
}
