    
        </div>
    </div>
</div>


    <!-- Tambahkan SweetAlert CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="<?= APP_PATH; ?>/js/bootstrap.bundle.min.js"></script>
<script src="<?= APP_PATH; ?>/sb-admin/vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="<?= APP_PATH; ?>/js/bootstrap.min.js"></script>
<script src="<?= APP_PATH; ?>/js/jquery-3.3.1.slim.min.js"></script>
<script src="<?= APP_PATH; ?>/sb-admin/vendor/jquery/jquery.min.js"></script>
<script src="<?= APP_PATH; ?>/sb-admin/js/sb-admin-2.min.js"></script>
<script src="<?= APP_PATH; ?>/sb-admin/js/sb-admin-2.js"></script>
<script src="<?= APP_PATH; ?>/sb-admin/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="<?= APP_PATH; ?>/sb-admin/vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script src="<?= APP_PATH;?>/js/dropdown.js"></script> 


<script src="<?= APP_PATH; ?>/sb-admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-beta1/js/bootstrap.bundle.min.js"></script>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-eMNCOe7tC1doHpGoWe/6oMVemdAVTMs2xqW4mwXrXsW0L84Iytr2wi5v2QjrP/xp" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

<!-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.min.js" integrity="sha512-L0Shl7nXXzIlBSUUPpxrokqq4ojqgZFQczTYlGjzONGTDAcLremjwaWv5A+EDLnxhQzY5xUZPWLOLqYRkY0Cbw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

<!-- <script src="<?= APP_PATH; ?>/js/dashboard.js"></script> -->

<!-- Robot -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
    // Inisialisasi Popover
    var robotPopover = new bootstrap.Popover(document.getElementById('robotPopover'), {
        trigger: 'manual'
    });

    // Simpan ID interval untuk dapat dihentikan saat hover
    var popoverInterval;

    // Fungsi untuk menampilkan popover
    function showPopover() {
        robotPopover.show();
        
        // Sembunyikan popover setelah 5 detik
        setTimeout(function() {
            robotPopover.hide();
        }, 5000); // 5000 ms = 5 detik
    }

    // Mulai interval untuk menampilkan popover setiap 10 detik
    function startPopoverInterval() {
        popoverInterval = setInterval(showPopover, 5000); // 10000 ms = 10 detik
    }

    // Hentikan interval
    function stopPopoverInterval() {
        clearInterval(popoverInterval);
    }

    // Jalankan interval pertama kali
    startPopoverInterval();

    // Event ketika mouse di hover pada gambar
    document.getElementById('robotPopover').addEventListener('mouseenter', function() {
        // Tampilkan popover saat hover
        robotPopover.show();

        // Hentikan interval popover
        stopPopoverInterval();
    });

    // Event ketika mouse keluar dari gambar
    document.getElementById('robotPopover').addEventListener('mouseleave', function() {
        // Sembunyikan popover setelah mouse keluar
        robotPopover.hide();

        // Mulai lagi interval popover setiap 10 detik
        startPopoverInterval();
    });
});
</script>

<!-- Chatbot -->
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
            <div class="d-flex">
                <div class="profile-image-container d-flex">
                    <img src="<?=APP_PATH;?>/img/chan.jpg" alt="User Profile" class="profile-image">
                </div>
                <small class="message-header">You</small>
            </div>
            <div class="message-content">
                <p>${formatText(promptValue)}</p>
            </div>
        </div>`;

        // Gunakan jQuery AJAX untuk mengirim permintaan POST
        $.ajax({
            url: '<?= APP_PATH ?>/Home/sendPrompt',
            type: 'POST',
            data: {
                'prompt': promptValue
            },
            success: function(data) {
                console.log(data);

                // Pastikan response memiliki data yang benar sebelum mengaksesnya
                if (data && data.choices && data.choices[0] && data.choices[0].message) {
                    const msg = data.choices[0].message.content;

                    // Tambahkan pesan yang diterima dari server ke elemen 'messages'
                    const responseId = `response-${Date.now()}`;
                    messages.innerHTML += `<div class="message">
                    <div class="d-flex">
                        <div class="profile-image-container d-flex">
                            <img src="<?=APP_PATH;?>/img/sobat.png" alt="MedBot Profile" class="profile-image">
                        </div>
                        <small class="message-header">MedBot</small>
                    </div>
                        <div class="message-content">
                            <p id="${responseId}">${formatText(msg)}</p>
                        </div>
                    </div>`;

                    // Kosongkan input setelah mengirim
                    $("#promptInput").val("");

                    // Nonaktifkan tombol setelah pengiriman
                    toggleButton();

                    // Ubah kembali teks tombol menjadi "Send"
                    sendPromptBtn.innerHTML = "Send";

                    // Scroll otomatis ke bagian bawah
                    messages.scrollTop = messages.scrollHeight;
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX error:', error);
                console.error('Status:', status);
                console.error('Response:', xhr.responseText);
                sendPromptBtn.innerHTML = "Send";
            }
        });
    }

    function formatText(text) {
        // Mengubah tanda ** menjadi elemen <strong> untuk bold
        text = text.replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>');

        // Deteksi format list
        if (text.includes("list")) {
            const items = text.match(/- (.*?)(?=\n|$)/g);
            if (items) {
                const listItems = items.map(item => `<li>${item.replace(/- /, '')}</li>`).join('');
                return `<ul>${listItems}</ul>`;
            }
        }

        // Deteksi format tabel berdasarkan input yang dinamis
        const lines = text.split('\n');
        if (lines.length > 1) {
            const header = lines[0].split(':').map(item => item.trim());
            const rows = lines.slice(1).map(line => {
                const cells = line.split(':').map(item => item.trim());
                return `<tr>${cells.map(cell => `<td>${cell}</td>`).join('')}</tr>`;
            }).join('');

            return `<table>
                <thead>
                    <tr>${header.map(item => `<th>${item}</th>`).join('')}</tr>
                </thead>
                <tbody class="table-striped">${rows}</tbody>
            </table>`;
        }

        return text; // Kembalikan teks yang tidak diformat
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

<script>
  $(document).ready(function() {
      $('#dataTable').DataTable({
          "pagingType": "full_numbers"
      });
  });
</script>

<script>
    function updateDateTime() {
        const now = new Date();
        const optionsDate = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
        const optionsTime = { hour: '2-digit', minute: '2-digit', second: '2-digit' };
        
        document.getElementById('date').textContent = now.toLocaleDateString('id-ID', optionsDate);
        document.getElementById('time').textContent = now.toLocaleTimeString('id-ID', optionsTime);
    }

    setInterval(updateDateTime, 1000); // Update every second
    updateDateTime(); // Initial call
</script>

<script>
    $(document).ready(function() {
        // Toggle sidebar visibility
        $('#sidebarToggleTop').on('click', function() {
            $('#accordionSidebar').toggleClass('d-none'); // Show or hide the sidebar
        });
    });
</script>

<script>
    $(document).ready(function() {
        // Inisialisasi DataTables untuk tabel utama (jika ada)
        

        // Inisialisasi DataTables untuk tabel dalam modal
        $('#dataTableInformasiObat').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": false,
            "autoWidth": true,
            "pageLength": 10
        });

        $('#dataTablePegawai').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": false,
            "autoWidth": true,
            "pageLength": 10
        });

        $('#dataTableSupplier').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": false,
            "autoWidth": true,
            "pageLength": 10
        });

        $('#dataTableObat').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": false,
            "autoWidth": true,
            "pageLength": 10
        });

        $('#dataTableSatuan').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": false,
            "autoWidth": true,
            "pageLength": 10
        });

        $('#dataTableKategori').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": false,
            "autoWidth": true,
            "pageLength": 10
        });

        $('#dataTableObatJual').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": false,
            "autoWidth": true,
            "pageLength": 8
        });

        $('#dataTableBeliObat').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": false,
            "autoWidth": true,
            "pageLength": 10
        });

        $('#dataTableBeliSupplier').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": false,
            "autoWidth": true,
            "pageLength": 5
        });

        $('#ed30').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": false,
            "autoWidth": true,
            "pageLength": 10
        });
        $('#ed10').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": false,
            "autoWidth": true,
            "pageLength": 10
        });
        $('#kadaluwarsaObat').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": false,
            "autoWidth": true,
            "pageLength": 10
        });
        $('#status_lunas').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": false,
            "autoWidth": true,
            "pageLength": 10
        });
        $('#status_utang').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": false,
            "autoWidth": true,
            "pageLength": 10
        });
    });
</script>


</body>
</html>