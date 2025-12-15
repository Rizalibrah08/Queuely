@extends('backend.umkm.layout')

@section('title', 'QR Code Toko')

@section('content')
    <div class="row align-items-center mb-4">
        <div class="col-md-6">
            <h2 class="fw-bold text-dark mb-0">QR Code Toko</h2>
            <p class="text-muted mb-0">Kode unik untuk pelanggan melakukan pemesanan</p>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow border-0 text-center">
                <div class="card-body p-5">
                    <h4 class="fw-bold text-dark mb-3">{{ $umkm->nama_umkm }}</h4>
                    <p class="text-muted mb-4">Scan QR Code ini untuk melihat menu dan memesan</p>

                    <div class="mb-4 d-flex justify-content-center">
                        <!-- QR Code Container -->
                        <div id="qrcode" class="p-3 bg-white border rounded shadow-sm"></div>
                    </div>

                    <div class="mb-4">
                        <h5 class="text-secondary small text-uppercase mb-2">Kode Toko Unik</h5>
                        <div class="bg-light rounded py-2 px-4 d-inline-block border border-secondary border-opacity-25">
                            <h2 class="fw-bold text-dark font-monospace mb-0" style="letter-spacing: 2px;">
                                {{ $umkm->shop_code }}</h2>
                        </div>
                        <p class="small text-muted mt-2">Gunakan kode ini jika pelanggan tidak bisa scan QR</p>
                    </div>

                    <div class="d-grid gap-2 col-md-8 mx-auto">
                        <button onclick="window.print()" class="btn btn-primary">
                            <i class="fas fa-print me-2"></i> Cetak QR Code
                        </button>
                        <a href="{{ route('umkm.dashboard') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left me-2"></i> Kembali ke Dashboard
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <!-- QR Code JS Library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Generate QR Code
            // URL format: http://your-domain.com/order/{shop_code}
            // For now we use a dummy URL structure or the direct link to customer view logic later
            var url = "{{ url('/order') }}/{{ $umkm->shop_code }}";

            var qrcode = new QRCode(document.getElementById("qrcode"), {
                text: url,
                width: 200,
                height: 200,
                colorDark: "#493628", // Brown color to match theme
                colorLight: "#ffffff",
                correctLevel: QRCode.CorrectLevel.H
            });
        });
    </script>
@endsection