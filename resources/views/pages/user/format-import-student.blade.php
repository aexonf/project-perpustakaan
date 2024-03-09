<table>
    <thead>
        <tr>
            <th>Nama</th>
            <th>Username</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($items as $value)
            <tr>
                <td>{{ $value->name }}</td>
                <td>{{ $value->username }}</td>
                <td>{{ $value->status }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
