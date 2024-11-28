<?php
class Laporan_model
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getPenjualan($range, $pegawai, $startDate = null, $endDate = null, $bulan = null, $tahun = null)
    {
        $sql = "SELECT * FROM transaksi_jual WHERE 1=1";

        // Filter berdasarkan rentang tanggal preset
        switch ($range) {
            case '1_week':
                $sql .= " AND tgl_penjualan >= DATE_SUB(CURDATE(), INTERVAL 7 DAY)";
                break;
            case '1_month':
                $sql .= " AND tgl_penjualan >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH)";
                break;
            case '1_year':
                $sql .= " AND tgl_penjualan >= DATE_SUB(CURDATE(), INTERVAL 1 YEAR)";
                break;
            case 'today':
                $sql .= " AND tgl_penjualan = CURDATE()";
                break;
            case 'custom':
                if ($startDate && $endDate && !$bulan && !$tahun) {
                    $sql .= " AND tgl_penjualan BETWEEN '{$this->db->escape_string($startDate)}' AND '{$this->db->escape_string($endDate)}'";
                } elseif ($startDate && !$endDate && !$bulan && !$tahun) {
                    $sql .= " AND tgl_penjualan = '{$this->db->escape_string($startDate)}'";
                } elseif ($startDate && !$endDate && $bulan && !$tahun) {
                    $sql .= " AND tgl_penjualan = '{$this->db->escape_string($startDate)}' AND MONTH(tgl_penjualan) = '{$this->db->escape_string($bulan)}'";
                } elseif ($startDate && !$endDate && !$bulan && $tahun) {
                    $sql .= " AND tgl_penjualan = '{$this->db->escape_string($startDate)}' AND YEAR(tgl_penjualan) = '{$this->db->escape_string($tahun)}'";
                } elseif ($startDate && !$endDate && $bulan && $tahun) {
                    $sql .= " AND tgl_penjualan = '{$this->db->escape_string($startDate)}' AND MONTH(tgl_penjualan) = '{$this->db->escape_string($bulan)}' AND YEAR(tgl_penjualan) = '{$this->db->escape_string($tahun)}'";
                }

                break;
        }

        // Filter berdasarkan bulan dan tahun jika dipilih
        if ($bulan && !$tahun) {
            // Jika hanya bulan yang dipilih, gunakan bulan ini pada semua tahun
            $sql .= " AND MONTH(tgl_penjualan) = '{$this->db->escape_string($bulan)}'";
        } elseif (!$bulan && $tahun) {
            // Jika hanya tahun yang dipilih
            $sql .= " AND YEAR(tgl_penjualan) = '{$this->db->escape_string($tahun)}'";
        } elseif ($bulan && $tahun) {
            // Jika bulan dan tahun dipilih
            $sql .= " AND MONTH(tgl_penjualan) = '{$this->db->escape_string($bulan)}' AND YEAR(tgl_penjualan) = '{$this->db->escape_string($tahun)}'";
        }

        // Filter berdasarkan pegawai
        if ($pegawai != 'all') {
            $sql .= " AND pegawai_id = '{$this->db->escape_string($pegawai)}'";
        }

        return $this->db->query($sql);
    }


    public function getPembelian($range, $supplier, $startDate = null, $endDate = null, $bulan = null, $tahun = null)
    {
        $sql = "SELECT * FROM transaksi_beli WHERE 1=1";

        switch ($range) {
            case '1_week':
                $sql .= " AND tgl_masuk >= DATE_SUB(CURDATE(), INTERVAL 7 DAY)";
                break;
            case '1_month':
                $sql .= " AND tgl_masuk >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH)";
                break;
            case '1_year':
                $sql .= " AND tgl_masuk >= DATE_SUB(CURDATE(), INTERVAL 1 YEAR)";
                break;
            case 'today':
                $sql .= " AND tgl_masuk = CURDATE()";
                break;
            case 'custom':
                if ($startDate && $endDate) {
                    $sql .= " AND tgl_masuk BETWEEN '{$this->db->escape_string($startDate)}' AND '{$this->db->escape_string($endDate)}'";
                } elseif ($startDate && !$endDate) {
                    $sql .= " AND tgl_masuk = '{$this->db->escape_string($startDate)}'";
                }
                break;
        }

        if ($bulan && !$tahun) {
            $sql .= " AND MONTH(tgl_masuk) = '{$this->db->escape_string($bulan)}'";
        } elseif (!$bulan && $tahun) {
            $sql .= " AND YEAR(tgl_masuk) = '{$this->db->escape_string($tahun)}'";
        } elseif ($bulan && $tahun) {
            $sql .= " AND MONTH(tgl_masuk) = '{$this->db->escape_string($bulan)}' AND YEAR(tgl_masuk) = '{$this->db->escape_string($tahun)}'";
        }

        if ($supplier != 'all') {
            $sql .= " AND nama_supplier = '{$this->db->escape_string($supplier)}'";
        }

        return $this->db->query($sql);
    }



    public function getKadaluwarsa($range)
    {
        $sql = "SELECT * FROM transaksi_beli WHERE 1=1";

        if ($range == 'less_than_30') {
            $sql .= " AND sisa_hari BETWEEN 11 AND 29";
        } elseif ($range == 'less_than_10') {
            $sql .= " AND sisa_hari BETWEEN 1 AND 9";
        } elseif ($range == 'expired') {
            $sql .= " AND sisa_hari <= 0 ";
        }

        return $this->db->query($sql);
    }

    public function getObat($opsi, $value)
    {
        $sql = "SELECT * FROM data_obat WHERE 1=1";

        if ($opsi === 'kategori' && $value !== null) {
            $sql .= " AND kategori = '{$this->db->escape_string($value)}'";
        } elseif ($opsi === 'satuan' && $value !== null) {
            $sql .= " AND satuan = '{$this->db->escape_string($value)}'";
        }

        return $this->db->query($sql);
    }


    // public function getObatBySatuan($satuan) {
    //     $sql = "SELECT * FROM data_obat WHERE 1=1";

    //     if ($satuan != 'all') {
    //         $sql .= " AND satuan = '{$satuan}'";
    //     }

    //     return $this->db->query($sql);
    // }
}
