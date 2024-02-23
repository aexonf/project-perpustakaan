<table>
    <thead>
        <tr>
            <th><b>Judul Seri</b></th>
            <th><b>No Panggil</b></th>
            <th><b>Description</b></th>
            <th><b>Penerbit</b></th>
            <th><b>Deskripsi Fisik</b></th>
            <th><b>Bahasa</b></th>
            <th><b>ISBN/ISSN</b></th>
            <th><b>Klasifikasi</b></th>
            <th><b>Jenis konten</b></th>
            <th><b>Tipe Media</b></th>
            <th><b>Tipe Pembawa</b></th>
            <th><b>Stock</b></th>
            <th><b>Edition</b></th>
            <th><b>Subject</b></th>
            <th><b>Info Detail Spesifik</b></th>
            <th><b>Pernyataan</b></th>
            <th><b>Tanggung Jawab</b></th>
            <th><b>Status</b></th>
            <th><b>Category</b></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($items as $item)
        <tr>
            <td>{{ $item->series_title }}</td>
            <td>{{ $item->call_no }}</td>
            <td>{{ $item->description }}</td>
            <td>{{ $item->publisher }}</td>
            <td>{{ $item->physical_description }}</td>
            <td>{{ $item->language }}</td>
            <td>{{ $item->isbn_issn }}</td>
            <td>{{ $item->classification }}</td>
            <td>{{ $item->content_type }}</td>
            <td>{{ $item->media_type }}</td>
            <td>{{ $item->carrier_type }}</td>
            <td>{{ $item->stock }}</td>
            <td>{{ $item->edition }}</td>
            <td>{{ $item->subject }}</td>
            <td>{{ $item->specific_details_info }}</td>
            <td>{{ $item->statement }}</td>
            <td>{{ $item->responsibility }}</td>
            <td>{{ $item->status }}</td>
            <td>{{ $item->category }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
