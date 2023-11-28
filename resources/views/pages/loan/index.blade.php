@extends('components.elements.app')

@section('title', 'Simaku Admin - Buku')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/datatables/media/css/dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/select2/dist/css/select2.min.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>List Pinjaman</h1>
            </div>

            @if (session('success') || session('error'))
                <div
                    class="alert {{ session('success') ? 'alert-success' : '' }} {{ session('error') ? 'alert-danger' : '' }} alert-dismissible show fade">
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
                        <div class="w-100 d-flex justify-content-between flex-wrap">
                            <div class="d-flex align-items-center flex-wrap">
                                <button type="button" class="btn btn-icon icon-left btn-primary mr-2 mb-2"
                                    data-toggle="modal" data-target="#modal-create"><i class="fas fa-plus"></i>
                                    Tambah</button>
                                <button type="button" class="btn btn-icon icon-left btn-primary mr-2 mb-2"
                                    data-toggle="modal" data-target="#modal-import"><i class="fas fa-upload"></i>
                                    Import</button>
                            </div>
                            <div class="d-flex align-items-center flex-wrap">
                                <button type="button" class="btn btn-icon icon-left btn-info mr-2 mb-2"
                                    data-toggle="collapse" data-target="#section-filter"><i class="fas fa-filter"></i>
                                    Filter</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="collapse mb-3 pb-3 border-bottom show" id="section-filter">
                            <form class="needs-validation" novalidate="" method="GET" action=""
                                enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                                        <div class="form-group mb-2">
                                            <label class="mb-2">Tahun Pelajaran</label>
                                            <select class="form-control select2" name="school_year" required
                                                onchange="handleChangeFilter(this)">
                                                {{-- @foreach ($school_years as $school_year)
                                                    @if ($request->school_year === $school_year || $setting->school_years === $school_year)
                                                        <option value="{{ $school_year }}" id="schoolYearSelect" selected>
                                                            {{ $school_year }}</option>
                                                    @else
                                                        <option value="{{ $school_year }}">{{ $school_year }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                                        <div class="form-group mb-2">
                                            <label class="mb-2">Tingkat</label>
                                            <select class="form-control select2" id="generationSelect" name="generation"
                                                required onchange="handleChangeFilter(this)">
                                                @foreach ($generations as $generation)
                                                    @if ($request->generation === $generation)
                                                        <option value="{{ $generation }}" selected>
                                                            {{ $generation }}</option>
                                                    @else
                                                        <option value="{{ $generation }}">{{ $generation }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                                        <div class="form-group mb-2">
                                            <label class="mb-2">Kelas</label>
                                            <select class="form-control select2" id="classSelect" name="class" required
                                                onchange="handleChangeFilter(this)">
                                                @foreach ($classes as $class)
                                                    @foreach ($class as $item)
                                                        @if ($request->class === $item)
                                                            <option value="{{ $item }}" selected>
                                                                {{ $item }}
                                                            </option>
                                                        @else
                                                            <option value="{{ $item }}">{{ $item }}
                                                            </option>
                                                        @endif
                                                    @endforeach
                                                @endforeach --}}
                                            </select>
                                        </div>
                                    </div>
                                    {{-- <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                                        <div class="form-group mb-2">
                                            <label class="mb-2">Point</label>
                                            <select class="form-control select2" name="point" required
                                                onchange="handleChangeFilter(this)">
                                                <option value="terbanyak" selected>Terbanyak</option>
                                                <option value="sedikit">Sedikit</option>
                                            </select>
                                        </div>
                                    </div> --}}
                                </div>
                                <div class="d-flex justify-content-end">
                                    <a href="" class="btn btn-danger ml-2">Reset</a>
                                    <button type="submit" class="btn btn-primary ml-2">Kirim</button>
                                </div>
                            </form>
                        </div>
                        <div>
                            <table class="table table-striped table-bordered" id="datatable">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width: 80px;">#</th>
                                        <th style="min-width: 240px;">Peminjam</th>
                                        <th style="min-width: 160px;">Buku</th>
                                        <th style="min-width: 160px;">Status</th>
                                        <th style="min-width: 160px;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($loan as $index => $value)
                                        <tr>
                                            <td class="text-center">{{ $index + 1 }}</td>
                                            <td>
                                                {{$value->student->name}}
                                            </td>
                                            <td>{{ $value->book->title }}</td>
                                            <td class="{{ $value->status === 'pending' ? 'text-warning' : 'text-success' }}">
                                                @if ($value->status === 'pending')
                                                    Meminjam
                                                @else
                                                    Dikembalikan
                                                @endif
                                            </td>

                                            <td>
                                                <div class="d-flex items-center">
                                                    <a href="{{ route('loan.detail', $value->id) }}"
                                                        style="text-decoration: none;">
                                                        <button type="button" class="btn btn-icon btn-primary mr-2 mb-2"
                                                            data-toggle="modal">
                                                            <i class="fas fa-eye"></i>
                                                        </button>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>


    {{-- modal create --}}
    <div class="modal fade" id="modal-create" data-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Buku</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="needs-validation" novalidate="" method="POST" action="{{ route('book.create') }}"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-2">
                            <label>Judul Buku<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="title" required>
                        </div>
                        <div class="form-group mb-2">
                            <label>No Inventory<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="no_inventory" required>
                        </div>
                        <div class="form-group mb-2">
                            <label>Genre<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="genre" required>
                        </div>
                        <div class="form-group mb-2">
                            <label>Penulis<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="writer" required>
                        </div>
                        <div class="form-group mb-2">
                            <label>Status<span class="text-danger">*</span></label>
                            <select class="form-control" name="status" id="generation" required>
                                <option value="available" selected>Tersedia</option>
                                <option value="blank">Tidak tersedia</option>
                            </select>
                        </div>
                        <div class="form-group mb-2">
                            <label>Tahun<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="tahun" required>
                        </div>
                        <div class="form-group mb-2">
                            <label>Stock<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="stock" required>
                        </div>
                        <div class="form-group mb-2">
                            <label>Lokasi<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="location" required>
                        </div>
                        <div class="mt-5 d-flex justify-content-end">
                            <button type="button" class="btn btn-secondary ml-2" data-dismiss="modal">Kembali</button>
                            <button type="submit" class="btn btn-primary ml-2">Kirim</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- modal import --}}
    <div class="modal fade" id="modal-import" data-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Import Siswa Aktif</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{-- <form class="needs-validation" novalidate="" method="POST"
                        action="{{route("active-student.import")}}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-2">
                            <label>File </label>
                            <input type="file" class="form-control" name="books" required>
                        </div>
                        <div>
                            <a href="{{ route('active-student.export') }}"
                                class="btn btn-icon icon-left btn-info mr-2 mb-2"><i class="fas fa-download"></i>
                                Unduh Template</a>
                        </div> --}}
                    <div class="mt-5 d-flex justify-content-end">
                        <button type="button" class="btn btn-secondary ml-2" data-dismiss="modal">Kembali</button>
                        <button type="submit" class="btn btn-primary ml-2">Kirim</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- modal edit --}}
    <div class="modal fade" id="modal-edit" data-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Ubah Siswa Aktif</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form-edit" class="needs-validation" novalidate="" method="POST" action=""
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group mb-2">
                            <label for="title">Judul Buku<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="title" id="title" required>
                        </div>
                        <div class="form-group mb-2">
                            <label for="no_inventory">No Inventory<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="no_inventory" id="no_inventory" required>
                        </div>
                        <div class="form-group mb-2">
                            <label for="genre">Genre<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="genre" id="genre" required>
                        </div>
                        <div class="form-group mb-2">
                            <label for="writer">Penulis<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="writer" id="writer" required>
                        </div>
                        <div class="form-group mb-2">
                            <label for="status">Status<span class="text-danger">*</span></label>
                            <select class="form-control" name="status" id="status" required>
                                <option value="available">Tersedia</option>
                                <option value="blank">Tidak tersedia</option>
                            </select>
                        </div>
                        <div class="form-group mb-2">
                            <label for="tahun">Tahun<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="tahun" id="tahun" required>
                        </div>
                        <div class="form-group mb-2">
                            <label for="stock">Stock<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="stock" id="stock" required>
                        </div>
                        <div class="form-group mb-2">
                            <label for="location">Lokasi<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="location" id="location" required>
                        </div>
                        <div class="mt-5 d-flex justify-content-end">
                            <button type="button" class="btn btn-secondary ml-2" data-dismiss="modal">Kembali</button>
                            <button type="submit" class="btn btn-primary ml-2">Kirim</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- modal delete --}}
    <div class="modal fade" id="modal-delete" data-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Hapus Siswa Aktif</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form-delete" class="needs-validation" novalidate="" method="POST" action=""
                        enctype="multipart/form-data">
                        @csrf
                        @method('DELETE')
                        <div class="mt-5 d-flex justify-content-end">
                            <button type="button" class="btn btn-secondary ml-2" data-dismiss="modal">Kembali</button>
                            <button type="submit" class="btn btn-danger ml-2">Kirim</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraries -->
    <script src="{{ asset('library/datatables/media/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('library/datatables/media/js/dataTables.min.js') }}"></script>
    <script src="{{ asset('library/jquery-ui-dist/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('js/page/modules-datatables.js') }}"></script>
    <script src="{{ asset('library/select2/dist/js/select2.full.min.js') }}"></script>
    <script>
        const handleChangeFilter = (e) => {
            const currentURL = new URL(window.location.href);
            currentURL.searchParams.set(e.name, e.value);
            window.history.pushState({}, '', currentURL);
            location.reload();
        }
    </script>
@endpush