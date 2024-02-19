<!DOCTYPE html>
<html>

<head>
</head>

<body>
    <table style="width: 100%">
        <tbody>
            @foreach ($data as $index => $item)
                @if ($index % 2 == 0)
                    @if ($index != 0)
                        </tr>
                    @endif
                    <tr style="margin: 20px; gap: 20px;">
                @endif
                <td style="width: 50%; margin: 20px; padding: 20px; border: 1px solid black;">
                    <table style="width: 100%;">
                        <tbody>
                            <tr>
                                <td>
                                    <div>
                                        <img src="data:image/png;base64,{!! base64_encode(QrCode::size(30)->generate($item->no_inventory)) !!}" width="100"
                                            height="100" alt="QR Code">
                                    </div>
                                </td>
                                <td>
                                    <div style='padding: 8px;'>
                                        <div>
                                            <p style='margin: 0;'>ID: <b>{{ $item->no_inventory }}</b></p>
                                        </div>
                                        <div>
                                            <p style='margin: 0;'>Judul: <b>{{ $item->title }}</b></p>
                                        </div>
                                        <div>
                                            <p style='margin: 0;'>Penulis: <b>{{ $item->writer }}</b></p>
                                        </div>
                                        <div>
                                            <p style='margin: 0;'>Genre: <b>{{ $item->genre }}</b></p>
                                        </div>
                                        <div>
                                            <p style='margin: 0;'>Tahun: <b>{{ $item->year }}</b></p>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
                @if ($loop->last && $loop->iteration % 2 != 0)
                    <td style="width: 50%;"></td>
                    </tr>
                @elseif ($loop->last)
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>
</body>

</html>