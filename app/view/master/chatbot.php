<div id="chatContainer">
    <div id="header" class="h4">
        Med-Bot
    </div>
    <div id="messages"></div>
    <div class="input-container">
        <input type="text" id="promptInput" class="form-control" placeholder="Ask your question here..." oninput="toggleButton()" />
        <button class="btn btn-primary" id="sendPromptBtn" onclick="sendPrompt()" disabled>Send</button>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script>
    function toggleButton() {
        const input = document.getElementById('promptInput').value;
        const button = document.getElementById('sendPromptBtn');
        button.disabled = !input.trim(); // Disable button if input is empty or whitespace
    }

    function sendPrompt() {
        const sendPromptBtn = document.getElementById('sendPromptBtn');
        sendPromptBtn.innerHTML = `Sending <div class="spinner-border spinner-border-sm" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>`;
        const promptValue = $("#promptInput").val();
        const messages = document.getElementById('messages');

        // Tampilkan prompt pengguna terlebih dahulu di bagian messages
        messages.innerHTML += `<div class="message message-you">
            <small class="message-header">You</small>
            <p>${promptValue}</p>
        </div>`;

        // Gunakan jQuery AJAX untuk mengirim permintaan POST
        $.ajax({
            url: '<?= APP_PATH ?>/Home/sendPrompt',
            type: 'POST', // Menggunakan metode POST untuk mengirim data
            data: {
                'prompt': promptValue // Pastikan data di-encode dengan benar
            },
            success: function(data) {
                console.log(data); // Log respons dari server

                // Pastikan response memiliki data yang benar sebelum mengaksesnya
                if (data && data.choices && data.choices[0] && data.choices[0].message) {
                    const msg = data.choices[0].message.content;

                    // Tambahkan pesan yang diterima dari server ke elemen 'messages'
                    const responseId = `response-${Date.now()}`; // Membuat ID unik untuk setiap respons
                    messages.innerHTML += `<div class="message">
                        <small class="message-header">MedBot</small>
                        <p id="${responseId}"></p>
                    </div>`;

                    // Kosongkan input setelah mengirim
                    $("#promptInput").val("");

                    // Nonaktifkan tombol setelah pengiriman
                    toggleButton();

                    // Ubah kembali teks tombol menjadi "Send"
                    sendPromptBtn.innerHTML = "Send";

                    // Scroll otomatis ke bagian bawah
                    messages.scrollTop = messages.scrollHeight;

                    // Panggil fungsi untuk animasi penulisan
                    typeText(msg, responseId);
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX error:', error);

                // Tampilkan informasi error lebih lengkap
                console.error('Status:', status);
                console.error('Response:', xhr.responseText);

                // Kembalikan tombol pada error
                sendPromptBtn.innerHTML = "Send";
            }
        });
    }

    function typeText(text, elementId) {
        const element = document.getElementById(elementId);
        let index = 0;
        const speed = 20; // Kecepatan penulisan dalam milidetik

        function typeWriter() {
            if (index < text.length) {
                element.innerHTML += text.charAt(index);
                index++;
                setTimeout(typeWriter, speed);
            }
        }

        typeWriter();
    }
</script>