<?php
class Search_model {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function search($keyword) {
        $query = "
            SELECT 'data_obat' AS source, 
                   kode_obat, 
                   nama_obat AS name, 
                   harga, 
                   stok, 
                   satuan, 
                   kategori, 
                   indikasi 
            FROM data_obat 
            WHERE nama_obat LIKE '%$keyword%' 
               OR kode_obat LIKE '%$keyword%'
            UNION ALL
            SELECT 'data_kategori' AS source, 
                   kategori_id AS kode, 
                   kategori AS name, 
                   NULL AS harga, 
                   NULL AS stok, 
                   NULL AS satuan, 
                   NULL AS kategori, 
                   NULL AS indikasi 
            FROM data_kategori 
            WHERE kategori LIKE '%$keyword%'
            UNION ALL
            SELECT 'data_pasokan' AS source, 
                   supplier_id AS kode, 
                   nama_supplier AS name, 
                   NULL AS harga, 
                   NULL AS stok, 
                   NULL AS satuan, 
                   NULL AS kategori, 
                   NULL AS indikasi 
            FROM data_pasokan 
            WHERE nama_supplier LIKE '%$keyword%'
               OR alamat_supplier LIKE '%$keyword%'
            UNION ALL
            SELECT 'data_pegawai' AS source, 
                   pegawai_id AS kode, 
                   nama_pegawai AS name, 
                   NULL AS harga, 
                   NULL AS stok, 
                   NULL AS satuan, 
                   NULL AS kategori, 
                   NULL AS indikasi 
            FROM data_pegawai 
            WHERE nama_pegawai LIKE '%$keyword%'
               OR alamat_pegawai LIKE '%$keyword%'
            UNION ALL
            SELECT 'data_satuan' AS source, 
                   satuan_id AS kode, 
                   satuan AS name, 
                   NULL AS harga, 
                   NULL AS stok, 
                   NULL AS satuan, 
                   NULL AS kategori, 
                   NULL AS indikasi 
            FROM data_satuan 
            WHERE satuan LIKE '%$keyword%'
            UNION ALL
            SELECT 'transaksi_jual' AS source, 
                   id_penjualan AS kode, 
                   no_penjualan AS name, 
                   harga, 
                   jumlah AS stok, 
                   satuan, 
                   NULL AS kategori, 
                   NULL AS indikasi 
            FROM transaksi_jual 
            WHERE no_penjualan LIKE '%$keyword%'
            UNION ALL
            SELECT 'transaksi_beli' AS source, 
                   id_pembelian AS kode, 
                   no_faktur AS name, 
                   total_harga AS harga, 
                   obat_masuk AS stok, 
                   satuan, 
                   NULL AS kategori, 
                   NULL AS indikasi 
            FROM transaksi_beli 
            WHERE no_faktur LIKE '%$keyword%'
        ";

        return $this->db->query($query);
    }
}





