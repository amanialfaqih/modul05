<!DOCTYPE html>
<html>
<head>
    <title>Invoice Amani</title>

    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            padding: 30px;
            color: #333;
        }

        .container {
            border: 1px solid #eee;
            padding: 25px;
            border-radius: 12px;
        }

        /* HEADER (FIX CENTER) */
        .header {
            text-align: center;
        }

        .brand {
            font-size: 28px;
            font-weight: bold;
            color: #8B5E3C;
        }

        .invoice-info {
            margin-top: 8px;
            font-size: 13px;
            color: #666;
        }

        .divider {
            height: 2px;
            background: #e6d3c3;
            margin: 15px auto;
            width: 60%;
        }

        /* CUSTOMER */
        .customer {
            font-size: 14px;
            margin-bottom: 15px;
        }

        /* TABLE */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th {
            background: #f5ede6;
            color: #5c4033;
            padding: 10px;
            font-size: 14px;
        }

        td {
            padding: 10px;
            border-bottom: 1px solid #eee;
            font-size: 14px;
            text-align: center;
        }

        tr:nth-child(even) {
            background: #faf7f3;
        }

        td.left {
            text-align: left;
        }

        /* SUMMARY */
        .summary {
            margin-top: 20px;
            text-align: right;
        }

        .total {
            font-size: 20px;
            font-weight: bold;
            color: #5c4033;
        }

        /* FOOTER */
        .footer {
            margin-top: 40px;
            text-align: center;
            font-size: 12px;
            color: #999;
        }

    </style>
</head>

<body>

<div class="container">

    {{-- HEADER --}}
    <div class="header">
        <div class="brand">Amani Bookstore</div>

        <div class="invoice-info">
            <strong>{{ $invoiceNumber }}</strong><br>
            {{ $date }}
        </div>
    </div>

    <div class="divider"></div>

    {{-- CUSTOMER --}}
    <div class="customer">
        <strong>Customer:</strong><br>
        {{ $customer['name'] }} <br>
        {{ $customer['email'] }}
    </div>

    {{-- TABLE --}}
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Judul</th>
                <th>Harga</th>
                <th>Qty</th>
                <th>Subtotal</th>
            </tr>
        </thead>

        <tbody>
            @foreach($cart as $index => $item)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td class="left">{{ $item['judul'] }}</td>
                <td>Rp {{ number_format($item['harga'],0,',','.') }}</td>
                <td>{{ $item['qty'] }}</td>
                <td>
                    Rp {{ number_format($item['harga'] * $item['qty'],0,',','.') }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{-- TOTAL --}}
    <div class="summary">
        <div class="total">
            Total: Rp {{ number_format($total,0,',','.') }}
        </div>
    </div>

</div>

{{-- FOOTER --}}
<div class="footer">
    Terima kasih telah berbelanja di Amani Bookstore 
</div>

</body>
</html>