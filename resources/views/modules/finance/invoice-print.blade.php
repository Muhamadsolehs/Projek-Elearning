<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kuitansi Pembayaran — {{ $bill['id'] }}</title>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">
    <style>
        body { 
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            background-color: #f1f5f9;
        }
        .receipt-card {
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            border: 1px solid #cbd5e1;
        }
        @media print {
            .no-print { display: none !important; }
            body { padding: 0 !important; background: #fff !important; }
            .receipt-card { box-shadow: none !important; border: 1px solid #000 !important; }
            @page { size: A5 landscape; margin: 8mm; }
        }
    </style>
</head>
<body class="p-4 p-md-5 d-flex flex-column align-items-center">

    <div class="no-print mb-4 d-flex gap-2">
        <button onclick="window.print()" class="btn btn-success btn-sm fw-bold">
            Cetak Kuitansi (Ctrl+P)
        </button>
        <button onclick="window.close()" class="btn btn-outline-secondary btn-sm">
            Tutup
        </button>
    </div>

    <!-- KUITANSI RESMI CONTAINER (FORMAT A5 LANDSCAPE) -->
    <div class="receipt-card w-100 p-4" style="max-width: 720px; color: #1e293b;">
        
        <!-- KOP KUITANSI -->
        <div class="d-flex align-items-center justify-content-between pb-3 border-bottom border-2 border-dark">
            <div class="d-flex align-items-center gap-3">
                <img src="{{ asset('assets/images/logo.svg') }}" height="44" alt="Logo">
                <div>
                    <h5 class="fw-bold text-uppercase mb-0 text-dark">PONDOK PESANTREN DARUL ILMI TERPADU</h5>
                    <small class="text-muted" style="font-size: 11px;">Jl. Pesantren Terpadu No. 01, Jawa Timur • Telp: (031) 8901234 • Email: bendahara@darulilmi.sch.id</small>
                </div>
            </div>
            <div class="text-end">
                <span class="d-block fw-bold text-dark text-uppercase" style="font-size: 13px;">KUITANSI RESMI</span>
                <span class="badge bg-light-success text-success font-monospace fw-bold">{{ $bill['id'] }}</span>
            </div>
        </div>

        <!-- ISI KUITANSI -->
        <div class="py-4" style="font-size: 13px;">
            <div class="row mb-2">
                <div class="col-4 text-muted">Telah Diterima Dari</div>
                <div class="col-8 fw-bold">: Orang Tua / Wali dari {{ $bill['student_name'] }}</div>
            </div>
            <div class="row mb-2">
                <div class="col-4 text-muted">Nomor Induk Santri</div>
                <div class="col-8 font-monospace fw-bold">: {{ $bill['student_nis'] }} ({{ $bill['student_class'] }})</div>
            </div>
            <div class="row mb-2">
                <div class="col-4 text-muted">Uang Sejumlah</div>
                <div class="col-8">
                    <span class="badge bg-light-primary text-primary fs-6 px-3 py-1 fw-bold">: {{ $bill['formatted_amount'] }}</span>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-4 text-muted">Untuk Pembayaran</div>
                <div class="col-8 fw-semibold">: {{ $bill['title'] }}</div>
            </div>
            <div class="row mb-2">
                <div class="col-4 text-muted">Kanal Pembayaran</div>
                <div class="col-8 text-secondary">: {{ $bill['payment_method'] ?? 'Tunai di Loket Bendahara' }}</div>
            </div>
        </div>

        <!-- TANDA TANGAN & STEMPEL -->
        <div class="pt-3 border-top d-flex align-items-center justify-content-between" style="font-size: 12px;">
            <div class="p-2 border border-success rounded text-center bg-light-success">
                <small class="fw-bold text-success d-block" style="font-size: 10px;">STATUS TRANSAKSI:</small>
                <span class="fw-bold text-success">LUNAS - TERVERIFIKASI</span>
            </div>

            <div class="text-center" style="width: 200px;">
                <span class="text-muted d-block" style="font-size: 11px;">Surabaya, 02 November 2026</span>
                <span class="text-dark d-block mt-1">Bendahara Pesantren,</span>
                <div class="py-3 text-muted fst-italic" style="font-size: 11px;">
                    ( Tanda Tangan & Stempel )
                </div>
                <span class="fw-bold text-dark text-decoration-underline d-block">Hj. Wahyuni Rahayu, S.E.</span>
                <small class="text-muted font-monospace" style="font-size: 10px;">NIP. 198402152010012001</small>
            </div>
        </div>

    </div>

</body>
</html>
