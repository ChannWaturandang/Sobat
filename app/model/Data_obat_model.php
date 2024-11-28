<?php
class Data_obat_model
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;

        if ($this->db == false) {
            //echo "<script>console.log('Connection Failed.');</script>";
        } else {
            //echo "<script>console.log('Connection Success.');</script>";
        }
    }

    // OBAT

    public function getAllDataModel()
    {
        $result = $this->db->query("SELECT * FROM data_obat;");
        $this->db->db_close();

        if ($result->num_rows > 0) {
            return mysqli_fetch_all($result, MYSQLI_ASSOC);
        } else {
            return [];
        }
    }

    public function insertDataModel($data)
    {
        // Extract data from the input array
        $kode = $data['obt_kode'];
        $nama_obat = $data['obt_nama'];
        $harga = $data['obt_harga'];
        $stok = $data['obt_stok'];
        $satuan = $data['obt_satuan'];
        $kategori = $data['obt_ketegori'];
        $indikasi = $data['indikasi'];
        

        // Check if the category exists in the data_kategori table
        $cek_kategori = $this->db->query("SELECT kategori FROM data_kategori WHERE kategori = '$kategori';");
        $cek_satuan = $this->db->query("SELECT satuan FROM data_satuan WHERE satuan = '$satuan';");

        // If the category exists, insert the data into the data_obat table
        if (mysqli_num_rows($cek_satuan) > 0 && mysqli_num_rows($cek_kategori) > 0) {
            $sql = "INSERT INTO data_obat (kode_obat, nama_obat, harga, stok, satuan, kategori, indikasi)
                VALUES ('$kode', '$nama_obat', '$harga', '$stok', '$satuan', '$kategori', '$indikasi')";

            return $this->db->query($sql) === TRUE;
        } else {
            return false;  // Category doesn't exist
        }
    }


    public function deleteDataModel($kode)
    {
        $sql = "DELETE FROM data_obat WHERE kode_obat = '$kode'";
        return $this->db->query($sql) === TRUE;
    }

    public function updateDataModel($data)
    {
        // Extract data from the input array
        $kode_obat = $data['obt_kode_update'];
        $nama_obat = $data['obt_nama_update'];
        $harga = $data['obt_harga_update'];
        $stok = $data['obt_stok_update'];
        $satuan = $data['obt_satuan_update'];
        $kategori = $data['obt_kategori_update'];
        $indikasi = $data['indikasi_update'];

        // Check if the category exists in the data_kategori table
        $result = $this->db->query("SELECT kategori FROM data_kategori WHERE kategori = '$kategori';");
        $result = $this->db->query("SELECT satuan FROM data_satuan WHERE satuan = '$satuan';");

        // If the category exists, update the data_obat table
        if (mysqli_num_rows($result) > 0) {
            $sql = "UPDATE data_obat SET
                    kode_obat = '$kode_obat',
                    nama_obat = '$nama_obat',
                    harga = '$harga',
                    stok = '$stok',
                    satuan = '$satuan',
                    kategori = '$kategori',
                    indikasi = '$indikasi'
                WHERE kode_obat = '$kode_obat'";

            return $this->db->query($sql) === TRUE;
        } else {
            return;  // Category doesn't exist
        }
    }


    // KATEGORI
    public function kategori_obat()
    {
        $result = $this->db->query("SELECT * FROM data_kategori;");
        $this->db->db_close();

        if ($result->num_rows > 0) {
            return mysqli_fetch_all($result, MYSQLI_ASSOC);
        } else {
            return [];
        }
    }

    public function insert_kategori($data)
    {
        // $id = $data['obt_id'];
        $kategori = $data['kategori'];

        $sql = "INSERT INTO data_kategori (kategori)
                VALUES ('$kategori')";

        return $this->db->query($sql) === TRUE;
    }

    public function delete_kategori($id)
    {
        $sql = "DELETE FROM data_kategori WHERE kategori_id = $id";
        return $this->db->query($sql) === TRUE;
    }

    public function update_kategori($data)
    {
        $id = $data['kategori_id'];
        $kategori = $data['kategori'];
        // $sisa_hari = $data['obt_sisa_hari_update'];

        $sql = "UPDATE data_kategori SET
                kategori = '$kategori'
                
                WHERE kategori_id = '$id'";

        return $this->db->query($sql) === TRUE;
    }


    // SATUAN

    public function satuan_obat()
    {
        $result = $this->db->query("SELECT * FROM data_satuan;");
        $this->db->db_close();

        if ($result->num_rows > 0) {
            return mysqli_fetch_all($result, MYSQLI_ASSOC);
        } else {
            return [];
        }
    }

    public function insert_satuan($data)
    {
        // $id = $data['obt_id'];
        $satuan = $data['satuan'];

        $sql = "INSERT INTO data_satuan (satuan)
                VALUES ('$satuan')";

        return $this->db->query($sql) === TRUE;
    }

    public function delete_satuan($id)
    {
        $sql = "DELETE FROM data_satuan WHERE satuan_id = $id";
        return $this->db->query($sql) === TRUE;
    }

    public function update_satuan($data)
    {
        $id = $data['satuan_id'];
        $satuan = $data['satuan'];
        // $sisa_hari = $data['obt_sisa_hari_update'];

        $sql = "UPDATE data_satuan SET
                satuan = '$satuan'
                
                WHERE satuan_id = '$id'";

        return $this->db->query($sql) === TRUE;
    }
}
