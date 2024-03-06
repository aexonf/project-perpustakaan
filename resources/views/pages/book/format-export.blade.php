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
                    <tr style="margin: 16px; gap: 16px;">
                @endif
                <td style="width: 50%; margin: 8px; padding: 8px; border: 1px solid black;">
                    <table style="width: 100%;">
                        <tbody>
                            <tr>
                                <td>
                                    <div>
                                        <img src="data:image/png;base64,{!! base64_encode(QrCode::size(30)->generate($item->id)) !!}" width="80"
                                            height="80" alt="QR Code">
                                    </div>
                                </td>
                                <td>
                                    <div>
                                        <div>
                                            <p style='margin: 0;font-size: 12px;'>No:
                                                <b>{{ $item->call_no ?? '-' }}</b>
                                            </p>
                                        </div>
                                        <div>
                                            <p style='margin: 0;font-size: 12px;'>Judul:
                                                <b>{{ $item->series_title ?? '-' }}</b>
                                            </p>
                                        </div>
                                        <div>
                                            <p style='margin: 0;font-size: 12px;'>Penerbit:
                                                <b>{{ $item->publisher ?? '-' }}</b>
                                            </p>
                                        </div>
                                        <div>
                                            <p style='margin: 0;font-size: 12px;'>Bahasa:
                                                <b>{{ $item->language ?? '-' }}</b>
                                            </p>
                                        </div>
                                        <div style="padding-top: 16px;">
                                            <p style='margin: 0;font-size: 12px;'>PERPUSTAKAAN SMK N JATIPURO</b></p>
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
