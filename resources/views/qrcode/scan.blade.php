@extends('layouts.app')

@section('content')
<div class="container text-center">
    <h1 class="mb-4">Scan QR Code</h1>
    <div class="card p-4 shadow-lg mx-auto" style="max-width: 500px;">
        <video id="preview" class="w-100 rounded"></video>
    </div>
    <p class="mt-3 text-muted">Arahkan kamera ke QR Code</p>
</div>

<!-- Input hidden untuk menyimpan data QR sementara -->
<input type="hidden" id="qr_data">
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/@zxing/library@0.18.6/umd/index.min.js"></script>
<audio id="beep" src="{{ asset('sounds/beep.mp3') }}"></audio>

<!-- Notifikasi -->
<div id="notification" class="notif hidden"></div>

<video id="preview" style="width: 100%; max-width: 400px;"></video>

<style>
    .notif {
        position: fixed;
        top: 20px;
        left: 50%;
        transform: translateX(-50%);
        background: #333;
        color: white;
        padding: 12px 18px;
        border-radius: 8px;
        font-size: 14px;
        font-weight: bold;
        text-align: center;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
        opacity: 0;
        transition: opacity 0.3s ease-in-out;
        z-index: 9999;
    }
    .notif.success {
        background: #28a745; /* Hijau */
    }
    .notif.error {
        background: #dc3545; /* Merah */
    }
    .notif.show {
        opacity: 1;
    }
</style>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const beepSound = document.getElementById('beep');
        const codeReader = new ZXing.BrowserQRCodeReader();
        const videoElement = document.getElementById('preview');
        const notification = document.getElementById("notification");

        function showNotification(message, type) {
            notification.textContent = message;
            notification.classList.remove("hidden", "success", "error");
            notification.classList.add("show", type);

            setTimeout(() => {
                notification.classList.remove("show");
            }, 2000); // Notifikasi hilang dalam 2 detik
        }

        async function processQRCode(qrText) {
            beepSound.play();
            
            let formData = new FormData();
            formData.append('qr_data', qrText);
            formData.append('_token', "{{ csrf_token() }}");

            try {
                let response = await fetch("{{ route('qrcode.process') }}", {
                    method: "POST",
                    body: formData
                });

                let data = await response.json();
                
                if (data.success) {
                    showNotification('✅ Berhasil!', 'success');
                } else {
                    showNotification('❌ Gagal!', 'error');
                }

                // Tunggu 2 detik sebelum scanner bisa digunakan kembali
                setTimeout(() => {
                    startScanner();
                }, 2000);

            } catch (err) {
                console.error('Error:', err);
                showNotification("❌ Terjadi Kesalahan", "error");
            }
        }

        function startScanner() {
            codeReader.decodeFromVideoDevice(null, videoElement, (result, error) => {
                if (result) {
                    codeReader.reset();
                    processQRCode(result.text);
                }
            }).catch(err => console.error('Error starting scanner:', err));
        }

        startScanner();
    });
</script>


@endpush
