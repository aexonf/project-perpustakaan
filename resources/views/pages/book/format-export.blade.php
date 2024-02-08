<!DOCTYPE html>
<html>
<head>
    <style>
        table {
            width: 80%;
            border-collapse: collapse;
            margin: auto;
        }
        th, td {
            border: 1px solid black;
            padding: 6px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .qr-code {
            width: 50px;
            height: 50px;
        }
    </style>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>No Inventory</th>
                <th>Judul</th>
                <th>Penulis</th>
                <th>Genre</th>
                <th>Tahun</th>
                <th>Stock</th>
                <th>Location</th>
                <th>Status</th>
                <th>QR Code</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->no_inventory }}</td>
                    <td>{{ $item->title }}</td>
                    <td>{{ $item->writer }}</td>
                    <td>{{ $item->genre }}</td>
                    <td>{{ $item->year }}</td>
                    <td>{{ $item->stock }}</td>
                    <td>{{ $item->location }}</td>
                    <td>{{ $item->status }}</td>
                    <td>
                        <img src="data:image/png;base64, {!! base64_encode(QrCode::size(30)->generate($item->no_inventory)) !!} ">
                </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
