<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Sertifikat</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600&family=Open+Sans&display=swap"
        rel="stylesheet">

    <style>
        /* ---- Atur halaman untuk DOMPDF ---- */
        @page {
            size: A4 landscape;
            /* A4 tapi orientasi landscape */
            margin: 0;
        }

        body {
            margin: 0;
            padding: 0;
            font-family: 'Open Sans', sans-serif;
            color: #222;
        }

        /* ---- Container utama ---- */
        .certificate {
            width: 297mm;
            /* A4 landscape */
            height: 210mm;
            position: relative;
            box-sizing: border-box;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* ---- Border emas ---- */
        .certificate-border {
            border: 6px solid #d4af37;
            border-radius: 12px;
            width: 277mm;
            /* biar ada margin dalam */
            height: 190mm;
            padding: 20mm;
            box-sizing: border-box;
            margin: auto;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        /* ---- Konten tengah ---- */
        .certificate-content {
            text-align: center;
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .title {
            font-family: 'Playfair Display', serif;
            font-size: 28pt;
            font-weight: 600;
            color: #002060;
            letter-spacing: 2px;
            margin: 0;
        }

        .subtitle {
            font-size: 12pt;
            margin-top: 4pt;
            margin-bottom: 24pt;
            color: #444;
        }

        .name {
            font-size: 22pt;
            font-weight: bold;
            margin: 0;
        }

        .university {
            font-size: 11pt;
            font-style: italic;
            margin-bottom: 16pt;
        }

        .role {
            font-size: 13pt;
            font-weight: bold;
            color: #004080;
            margin-bottom: 18pt;
        }

        .desc {
            font-size: 11pt;
            line-height: 1.6;
            margin: 0 auto;
            max-width: 80%;
        }

        /* ---- Bagian tanda tangan ---- */
        .certificate-bottom {
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            /* rata kanan */
            margin-top: auto;
            font-size: 11pt;
        }

        .date {
            margin-bottom: 60px;
            /* ruang untuk tanda tangan */
            font-style: italic;
        }

        .signature {
            text-align: center;
            border-top: 1px solid #000;
            padding-top: 4px;
            width: 220px;
        }
    </style>
</head>

<body>
    <div class="certificate">
        <div class="certificate-border">
            <div class="certificate-content">
                <h1 class="title">SERTIFIKAT</h1>
                <p class="subtitle">MAGANG BATCH 1 - JANUARI 2026</p>

                <h2 class="name">Budi Santoso</h2>
                <p class="university">Universitas Nganjuk - Fakultas Teknologi Informasi</p>

                <p class="role">Peserta Backend Developer</p>

                <p class="desc">
                    Telah berhasil menyelesaikan tugasnya di <b>PT Sejahtera Indonesia</b> dalam Program
                    Magang dengan posisi sebagai <b>Backend Developer</b> yang diselenggarakan pada
                    tanggal <b>12 Januari 2026 - 12 Juni 2026</b>.
                </p>
            </div>

            <div class="certificate-bottom">
                <p class="date">Jakarta, 12 Juni 2026</p>
                <p class="signature">
                    Ir. Yahya Burhanudin S.Kom., M.Kom.<br>
                    Direktur Utama<br>
                    PT Sejahtera Indonesia
                </p>
            </div>
        </div>
    </div>
</body>

</html>
