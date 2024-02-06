<table>
    <thead>
        <tr>
            <th>Id</th>
            <th>No Inventory</th>
            <th>Judul</th>
            <th>Penulis</th>
            <th>Genre</th>
            <th>Tahun</th>
            <th>Jumlah</th>
            <th>Stock</th>
            <th>Location</th>
            <th>Status</th>
            <th>QR Code</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $index =>  $item)
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
            </tr>
        @endforeach
    </tbody>
</table>