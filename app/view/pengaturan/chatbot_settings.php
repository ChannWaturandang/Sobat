<html>

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            background-color: #f7fafc;
            font-family: sans-serif;
        }

        .container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            padding: 16px;
        }

        .main-content {
            width: 100%;
            max-width: 66%;
            background-color: white;
            padding: 24px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 16px;
        }

        h2 {
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 16px;
        }

        .form-group {
            display: flex;
            align-items: center;
            margin-bottom: 16px;
        }

        .form-group label {
            width: 33%;
            color: #4a5568;
            font-weight: 600;
        }

        .form-group .color-options,
        .form-group .text-color-options {
            display: flex;
            gap: 8px;
        }

        .color-option,
        .text-color-option {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            cursor: pointer;
        }

        .color-option {
            border: 1px solid #e2e8f0;
        }

        .form-group select,
        .form-group input[type="text"] {
            width: 66%;
            padding: 8px;
            border: 1px solid #cbd5e0;
            border-radius: 4px;
        }

        .chat-preview {
            width: 100%;
            max-width: 33%;
            padding: 16px;
        }

        .chat-header {
            background: linear-gradient(to right, #ed64a6, #e53e3e);
            padding: 16px;
            border-radius: 8px 8px 0 0;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .chat-body {
            background-color: white;
            padding: 16px;
            border-radius: 0 0 8px 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            height: 384px;
            overflow-y: auto;
        }

        .chat-bubble {
            background-color: #f7fafc;
            padding: 8px;
            border-radius: 8px;
            margin-bottom: 8px;
            color: #4a5568;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .chat-bubble.bot {
            background-color: #fef2f2;
            color: #e53e3e;
        }

        table {
            width: 100%;
            margin-top: 8px;
            border-collapse: collapse;
        }

        table th,
        table td {
            border: 1px solid #e2e8f0;
            padding: 8px;
            text-align: left;
        }

        .input-section {
            display: flex;
            align-items: center;
            gap: 8px;
            padding-top: 16px;
        }

        .input-section input[type="text"] {
            flex-grow: 1;
            padding: 8px;
            border: 1px solid #cbd5e0;
            border-radius: 4px;
        }

        .input-section button {
            background-color: #3182ce;
            color: white;
            padding: 8px 16px;
            border: none;
            border-radius: 50px;
            cursor: pointer;
        }

        .chat-notification {
            position: fixed;
            bottom: 16px;
            right: 16px;
            background-color: #3182ce;
            color: white;
            padding: 16px;
            border-radius: 50%;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
            cursor: pointer;
        }

        .chat-notification .badge {
            position: absolute;
            top: 0;
            right: 0;
            background-color: #e53e3e;
            color: white;
            font-size: 12px;
            width: 20px;
            height: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 50%;
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Konten Utama -->
        <div class="main-content">
            <h2>Pengaturan Widget</h2>
            <div class="form-group">
                <label>Warna Latar Belakang:</label>
                <div class="color-options">
                    <div class="color-option" style="background-color: #3182ce;"></div>
                    <div class="color-option" style="background-color: #805ad5;"></div>
                    <div class="color-option" style="background-color: #d53f8c;"></div>
                    <div class="color-option" style="background-color: #e53e3e;"></div>
                    <div class="color-option" style="background-color: #4a5568;"></div>
                    <div class="color-option" style="background-color: #e2e8f0;"></div>
                </div>
            </div>
            <div class="form-group">
                <label>Posisi ChatBot:</label>
                <input type="range" min="0" max="100" value="50">
            </div>
            <div class="form-group">
                <label>Visibilitas Chat:</label>
                <select>
                    <option>Baik di desktop maupun perangkat seluler</option>
                </select>
            </div>
            <div class="form-group">
                <label>Label Tombol</label>
                <input type="checkbox">
            </div>
            <div class="form-group">
                <label>Ukuran Font:</label>
                <select name="font-size">
                    <option value="12px">Kecil</option>
                    <option value="16px">Sedang</option>
                    <option value="20px">Besar</option>
                </select>
            </div>
            <div class="form-group">
                <label>Gaya Font:</label>
                <select name="font-style">
                    <option value="Normal">Normal</option>
                    <option value="Italic">Italic</option>
                    <option value="Bold">Bold</option>
                </select>
            </div>
            <div class="form-group">
                <label>Warna Teks:</label>
                <div class="text-color-options">
                    <div class="text-color-option" style="background-color: black;"></div>
                    <div class="text-color-option" style="background-color: #4a5568;"></div>
                    <div class="text-color-option" style="background-color: #c53030;"></div>
                    <div class="text-color-option" style="background-color: #38a169;"></div>
                    <div class="text-color-option" style="background-color: #2b6cb0;"></div>
                </div>
            </div>
        </div>

        <!-- Pratinjau Widget Chat -->
        <div class="chat-preview">
            <div class="chat-header">
                <h2>MEDBOT</h2>
                <button class="close-btn">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="chat-body">
                <div class="chat-bubble user">
                    <p>Apakah ada stok obat untuk sakit kepala saat ini?</p>
                </div>
                <div class="chat-bubble bot">
                    <p>Berikut adalah daftar stok obat sakit kepala saat ini:</p>
                    <table>
                        <thead>
                            <tr>
                                <th>Nama Obat</th>
                                <th>Stok Saat Ini</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Paracetamol</td>
                                <td>20</td>
                            </tr>
                            <tr>
                                <td>Ibuprofen</td>
                                <td>15</td>
                            </tr>
                            <tr>
                                <td>Aspirin</td>
                                <td>10</td>
                            </tr>
                            <tr>
                                <td>Panadol</td>
                                <td>25</td>
                            </tr>
                            <tr>
                                <td>Bodrex</td>
                                <td>30</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="input-section">
                <input type="text" placeholder="Masukkan pesan Anda...">
                <button>Kirim</button>
            </div>
        </div>
        <div class="chat-notification">
            <
