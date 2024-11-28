<?php

class Gptbot_model
{
    private $api_key;
    private $api_endpoint = "https://api.openai.com/v1/chat/completions";
    private $db;

    public function __construct()
    {
        $this->db = new Database;
        $this->api_key = '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'; // Mendapatkan API key dari environment variable
    }

    public function dataobat()
    {
        $result = $this->db->query("SELECT * FROM data_obat;");
        $this->db->db_close();

        if ($result->num_rows > 0) {
            return mysqli_fetch_all($result, MYSQLI_ASSOC);
        } else {
            return [];
        }
    }

    public function getResponse($userprompt)
    {
        $prompt = $userprompt."? \nData diri sudah ada di context dan data obat di bawah ini, Data:";
        // $prompt = $promptt;

        $data_obat = $this->dataobat();

        $content = "Saya adalah apoteker. Nama saya adalah Medbot. Jenis kelamin tidak ada. 
                    Saya bisa membantu untuk menampilkan daftar obat-obatan dan stok yang tersedia di apotek kami. 
                    Setiap pertanyaan di jawab dengan singkat saja, tanpa penjelasan mendetail.

                    saya mampu memberikan jadwal penggunaan obat dengan baik.
                    saya mampu menjelaskan dengan struktur yang baik terkait pertanyaan yang di sampaikan.
                    ";

        foreach ($data_obat as $obat) {
            $prompt .= "Kode Obat: " . $obat['kode_obat'] . "\n";
            $prompt .= "Nama Obat: " . $obat['nama_obat'] . "\n";
            $prompt .= "Harga: " . $obat['harga'] . "\n";
            $prompt .= "Stok: " . $obat['stok'] . "\n";
            $prompt .= "Satuan: " . $obat['satuan'] . "\n";
            $prompt .= "Kategori: " . $obat['kategori'] . "\n";
            $prompt .= "Indikasi: " . $obat['indikasi'] . "\n";
            
            $prompt .= "Jumlah Stok Tersedia: " . $obat['stok'] . "\n\n";
        }


        $data = array(
            "model" => "gpt-4o-mini",
            "messages" => array(
                array(
                    "role" => "system",
                    "content" => $content
                ),
                array(
                    "role" => "user",
                    "content" => $prompt
                )
            )
        );

        //var_dump($content);
        // echo "Data prompt: ";
        // var_dump($prompt);

        $headers = array(
            "Content-Type: application/json",
            "Authorization: Bearer " . $this->api_key
        );

        // Initialize cURL
        $ch = curl_init($this->api_endpoint);

        // Set cURL options
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        // Execute request
        $response = curl_exec($ch);

        // Check for errors
        if ($response === false) {
            curl_close($ch);
            return ['message' => 'cURL Error: ' . curl_error($ch)];
        }

        // Close cURL session
        curl_close($ch);

        // Decode the response
        $decoded_response = json_decode($response, true);

        // Check if the response contains content
        if (isset($decoded_response['choices'][0]['message']['content'])) {
            return $decoded_response['choices'][0]['message']['content'];
        } else {
            return 'No content returned from API.';
        }
    }

}
