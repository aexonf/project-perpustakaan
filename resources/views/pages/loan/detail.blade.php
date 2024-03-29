@extends('components.elements.app')

@section('title', 'Detail Peminjaman')

@push('style')
    <link rel="stylesheet" href="{{ asset('library/datatables/media/css/dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/select2/dist/css/select2.min.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    @section('main')
        <div class="main-content">
            <section class="section">
                <div class="section-header">
                    <h1>Detail Siswa</h1>
                </div>

                @if (session('success') || session('error'))
                    <div class="alert {{ session('success') ? 'alert-success' : 'alert-danger' }} alert-dismissible show fade">
                        <div class="alert-body">
                            <button class="close" data-dismiss="alert">
                                <span>×</span>
                            </button>
                            {{ session('success') }}
                            {{ session('error') }}
                        </div>
                    </div>
                @endif

                <div class="section-body">
                    <div class="card">
                        <div class="card-header">
                            <h2>Informasi Peminjam</h2>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="student-id">ID Number</label>
                                        <input type="text" class="form-control" id="student-id"
                                            value="{{ $user->id_number }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="student-class">Nama</label>
                                        <input type="text" class="form-control" id="student-class"
                                            value="{{ $user->name }}" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="student-id">No Telepon</label>
                                        <input type="text" class="form-control" id="student-id"
                                            value="{{ $user->phone_number }}" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h2>Aktifitas Peminjaman</h2>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <button type="button" class="btn btn-icon icon-left btn-primary mr-2 mb-2" data-toggle="modal"
                                    data-target="#modal-create"><i class="fas fa-plus"></i>
                                    Tambah Pinjaman</button>
                                <form action="{{ route('loan.returned.all', $user->id) }}" method="post">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-icon icon-left btn-primary mr-2 mb-2"><i
                                            class="fas fa-download"></i>
                                        Mengembalikan semua</button>
                                </form>
                            </div>
                            <div>
                                <table class="table table-striped table-bordered" id="datatable">
                                    <thead>
                                        <tr>
                                            <th class="text-center" style="width: 80px;">#</th>
                                            <th>Tanggal</th>
                                            <th>Judul</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($loan as $index => $value)
                                            <tr>
                                                <td class="text-center">{{ $index + 1 }}</td>
                                                <td>{{ $value->created_at }}</td>
                                                <td>{{ $value->book->series_title }}</td>
                                                <td
                                                    class="{{ $value->status === 'pending' ? 'text-warning' : 'text-success' }}">
                                                    @if ($value->status === 'pending')
                                                        Meminjam
                                                    @else
                                                        Dikembalikan
                                                    @endif
                                                </td>
                                                <td>
                                                    <!-- Tombol Modal Detail -->
                                                    <button type="button" class="btn btn-icon btn-info mr-2 mb-2"
                                                        data-toggle="modal" data-target="#modal-detail"
                                                        data-value="{{ $value->id }}"
                                                        onclick="
                                                    $('#modal-detail #form-detail').attr('action', '{{ route('loan.returned', $value->id) }}');
                                                    $('#modal-detail #form-detail #loan_end_date').attr('value', '{{ $value->loan_end_date }}');
                                                    $('#modal-detail #form-detail #loan_date').attr('value', '{{ $value->loan_date }}');
                                                    $('#modal-detail #form-detail #title').attr('value', '{{ $value->book->series_title }}');
                                                    $('#modal-detail #form-detail #librarian').attr('value', '{{ $value->librarian_id != null ? $value->librarian->name : 'admin' }}');
                                                    $('#modal-detail #form-detail #return_date').attr('value', '{{ $value->return_date != null ? $value->return_date : 'Masih di pinjam' }}');
                                                    $('#modal-detail #form-detail #status').attr('value', '{{ $value->status == 'pending' ? 'Meminjam' : 'Di Kembalikan' }}');
                                                    $('#modal-detail #form-detail #button_return #dikembalikan').prop('disabled', '{{ $value->status == 'returned' }}');
                                                    ">
                                                        <i class="fas fa-info-circle"></i>
                                                    </button>

                                                </td>


                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
            </section>
        </div>



        <!-- Modal Detail -->
        <div class="modal fade" id="modal-detail" data-backdrop="static">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Detail Pinjaman</h5>
                        <button type="button" class="close" data-dismiss="modal">
                            <span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="form-detail" class="needs-validation" novalidate="" method="POST" action=""
                            enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="form-group mb-2">
                                <label for="loan_date">Tanggal Peminjaman<span class="text-danger">*</span></label>
                                <input type="text" id="loan_date" class="form-control" name="loan_date" readonly>
                            </div>
                            <div class="form-group mb-2">
                                <label for="title">Judul Buku<span class="text-danger">*</span></label>
                                <input type="text" id="title" class="form-control" name="title" readonly>
                            </div>
                            <div class="form-group mb-2">
                                <label for="librarian">Pustakawan</label>
                                <input type="text" id="librarian" class="form-control" name="librarian" readonly>
                            </div>
                            <div class="form-group mb-2">
                                <label for="return_date">Tanggal Pengembalian</label>
                                <input type="text" id="return_date" class="form-control" name="return_date" readonly>
                            </div>
                            <div class="form-group mb-2">
                                <label for="status">Status</label>
                                <input type="text" id="status" class="form-control" name="status" readonly>
                            </div>
                            <div class="form-group mb-2">
                                <label for="loan_end_date">Batas Pinjaman</label>
                                <input type="text" id="loan_end_date" class="form-control" name="loan_end_date" readonly>
                            </div>
                            <div class="form-group mb-2">
                                <label for="bill">Denda</label>
                                <input type="text" id="bill" class="form-control" name="bill" readonly>
                            </div>
                            <div class="mt-5 d-flex justify-content-end" id="button_return">
                                <button type="button" class="btn btn-secondary ml-2" data-dismiss="modal">Kembali</button>
                                <button type="submit" class="btn btn-primary ml-2" id="dikembalikan">Di Kembalikan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        {{-- Modal Tambah --}}
        <div class="modal fade" id="modal-create" data-backdrop="static">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Pinjaman</h5>
                        <button type="button" class="close" data-dismiss="modal">
                            <span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="needs-validation" novalidate="" method="POST"
                            action="{{ route('loan.book', $user->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            <div class="form-group mb-2">
                                <label for="buku">Buku<span class="text-danger">*</span></label>
                                <select class="form-control select2" name="book[]" id="buku" multiple="multiple"
                                    required>
                                    @foreach ($book as $value)
                                        <option value="{{ $value->id }}">
                                            {{ $value->series_title }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mb-2">
                                <label class="form-label">Tanggal Awal<span class="text-danger">*</span></label>
                                <div class="custom-file">
                                    <input type="date" name="loan_date" class="form-control">
                                </div>
                            </div>
                            <div class="form-group mb-2">
                                <label class="form-label">Tanggal Akhir<span class="text-danger">*</span></label>
                                <div class="custom-file">
                                    <input type="date" name="loan_end_date" class="form-control">
                                </div>
                            </div>
                            <div class="mt-5 d-flex justify-content-end">
                                <button type="button" class="btn btn-secondary ml-2" data-dismiss="modal">Kembali</button>
                                <button type="submit" class="btn btn-primary ml-2">Pinjam</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endsection

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script src="{{ asset('library/datatables/media/js/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('library/datatables/media/js/dataTables.min.js') }}"></script>

        <script>
            $(document).ready(function() {
                $('.select2').select2();
            });



            const currentDate = new Date();
            const year = currentDate.getFullYear();
            const month = String(currentDate.getMonth() + 1).padStart(2, '0');
            const day = String(currentDate.getDate()).padStart(2, '0');
            const formattedDate = `${year}-${month}-${day}`;
            console.log(formattedDate)

            let batasPinjaman = new Date(document.getElementById('loan_end_date').value);
            console.log(document.getElementById('loan_end_date').value);

            // Mengecek jika batas pinjaman melebihi waktu saat ini
            if (batasPinjaman > currentDate) {
                document.getElementById('bill').removeAttribute('readonly');
            } else {
                document.getElementById('bill').setAttribute('readonly', 'readonly');
            }

            let dendaInput = document.getElementById('bill');
        </script>
    @endpush
    `
