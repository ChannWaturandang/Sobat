<?php

class Whatsapp_notification
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    // Fetch phone numbers
    public function getUserPhoneNumbers()
    {
        $result = $this->db->query("SELECT phone_number, user_id, last_notification_sent FROM user;");
        if ($result->num_rows > 0) {
            return mysqli_fetch_all($result, MYSQLI_ASSOC);
        } else {
            return [];
        }
    }

    // Fetch expiring and expired drugs
    public function getExpiringAndExpiredDrugs()
    {
        $result = $this->db->query("SELECT nama_obat, sisa_hari, obat_masuk as stok FROM transaksi_beli WHERE sisa_hari < 30 OR sisa_hari < 10 OR sisa_hari < 0;");
        if ($result->num_rows > 0) {
            return mysqli_fetch_all($result, MYSQLI_ASSOC);
        } else {
            return [];
        }
    }

    public function getReturnNotifications()
    {
        $result = $this->db->query("SELECT nama_obat, sisa_bulan, obat_masuk as stok FROM transaksi_beli WHERE sisa_bulan = 3;");
        if ($result->num_rows > 0) {
            return mysqli_fetch_all($result, MYSQLI_ASSOC);
        } else {
            return [];
        }
    }

    public function getRefillNotifications()
    {
        // Contoh: Anggap 'stok_awal' adalah kolom yang menyimpan jumlah stok awal
        $result = $this->db->query("SELECT nama_obat, sisa_bulan, obat_masuk AS stok FROM transaksi_beli WHERE obat_masuk <= 0.2 * obat_masuk;");

        if ($result->num_rows > 0) {
            return mysqli_fetch_all($result, MYSQLI_ASSOC);
        } else {
            return [];
        }
    }


    public function updateLastNotificationSent($userId)
    {
        $this->db->query("UPDATE user SET last_notification_sent = NOW() WHERE user_id = {$userId};");
    }



    // Send WhatsApp notification
    public function sendWhatsAppNotification($phoneNumber, $message)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.fonnte.com/send',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array(
                'target' => $phoneNumber,
                'message' => $message,
                'countryCode' => '62',
            ),
            CURLOPT_HTTPHEADER => array(
                'Authorization: p8FEJvrSF2aZcekkAnTh' // Ganti dengan token Anda
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        return $response;
    }
}
