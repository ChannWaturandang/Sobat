<?php
class Data_laporan_model {
    private $db;

    public function __construct() {
        $this->db = new Database;

        if ($this->db == false) {
            // echo "<script>console.log('Connection Failed.');</script>";
        } else {
            // echo "<script>console.log('Connection Success.');</script>";
        }
    }

    public function getAllDataModel() {
        $sql = "SELECT * FROM data_laporan;";
        return $this->db->query($sql);

    }

    

}