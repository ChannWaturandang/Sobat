<?php

class Notifikasi_sistem
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

    public function getNotificationSistem ()
    {
        $sql = "SELECT tgl_expired FROM transaksi_beli WHERE tgl_expired BETWEEN 11 AND 29";

        return $this->db->query($sql);
    }
}
