<!DOCTYPE html>
<html>
<head>
    <title>Data Buku</title>

    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
        }

        .header {
            text-align: center;
            margin-bottom: 10px;
        }

        .header h2 {
            margin: 0;
        }

        .sub {
            font-size: 12px;
            color: #555;
        }

        .tanggal {
            text-align: right;
            margin-bottom: 10px;
            font-size: 11px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        table, th, td {
            border: 1px solid #333;
        }

        th {
            background: #f2f2f2;
            padding: 8px;
        }

        td {
            padding: 7px;
            text-align: center;
        }

        tr:nth-child(even) {
            background-color: #fafafa;
        }

        .footer {
            margin-top: 30px;
            text-align: right;
            font-size: 11px;
        }
    </style>
</head>

<body>

{{-- HEADER --}}
<div class="header">
    <h2> Laporan Data Buku</h2>
    <div class="sub">Amani Bookstore</div>
</div>

{{-- TANGGAL --}}
<div class="tanggal">
    Dicetak pada: {{ date('d-m-Y') }}
</div>

{{-- TABLE --}}
<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Judul</th>
            <th>Kategori</th>
            <th>Penulis</th>
            <th>Tahun</th>
            <th>Stok</th>
        </tr>
    </thead>

    <tbody>
        @foreach($books as $i => $book)
        <tr>
            <td>{{ $i+1 }}</td>
            <td>{{ $book->judul }}</td>
            <td>{{ $book->category->nama_kategori ?? '-' }}</td>
            <td>{{ $book->penulis }}</td>
            <td>{{ $book->tahun_terbit }}</td>
            <td>{{ $book->stok }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

{{-- FOOTER --}}
<div class="footer">
    <p>© {{ date('Y') }} Amani Bookstore</p>
</div>

</body>
</html>