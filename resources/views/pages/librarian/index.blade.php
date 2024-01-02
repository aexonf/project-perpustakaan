@extends('components.elements.app')

@section('title', 'Penjaga - SMK N 1 Kasreman')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/datatables/media/css/dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/select2/dist/css/select2.min.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Daftar Penjaga</h1>
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
                            <form class="needs-validation" novalidate="" method="GET" action="{{ route('penjaga') }}"
                                enctype="multipart/form-data">
                                <div class="row">

                                    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                                        <div class="form-group mb-2">
                                            <label class="mb-2">Status</label>
                                            <select class="form-control select2" name="status" required
                                                onchange="handleChangeFilter(this)">
                                                <option value="active"
                                                    {{ request('status') == 'active' ? 'selected' : '' }}>
                                                    Aktif</option>
                                                <option value="inactive"
                                                    {{ request('status') == 'inactive' ? 'selected' : '' }}>Tidak Aktif
                                                </option>
                                            </select>
                                        </div>
                                    </div>


                                </div>
                                <div class="d-flex justify-content-end">
                                    <a href="{{ route('penjaga') }}" class="btn btn-danger ml-2">Reset</a>
                                    <button type="submit" class="btn btn-primary ml-2">Kirim</button>
                                </div>
                            </form>
                        </div>
                        <div>
                            <table class="table table-striped table-bordered" id="datatable">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width: 80px;">#</th>
                                        <th style="min-width: 240px;">Name</th>
                                        <th style="min-width: 160px;">Username</th>
                                        <th style="min-width: 160px;">Status</th>
                                        <th style="min-width: 160px;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($librarians as $index => $librarian)
                                        <tr>
                                            <td class="text-center">{{ $index + 1 }}</td>
                                            <td>{{ $librarian->name }}</td>
                                            <td>{{ $librarian->user->username }}</td>
                                            <td>
                                                @if ($librarian->status === 'active')
                                                    <span class="badge badge-success">Aktif</span>
                                                @else
                                                    <span class="badge badge-warning">Tidak Aktif</span>
                                                @endif
                                            </td>

                                            <td>
                                                <div class="d-flex items-center">
                                                    <button type="button" class="btn btn-icon btn-primary mr-2 mb-2"
                                                        data-toggle="modal" data-target="#modal-edit"
                                                        onclick="
                                                    $('#modal-edit #form-edit');
                                                    $('#modal-edit #form-edit #name').attr('value', '{{ $librarian->name }}');
                                                    $('#modal-edit #form-edit #status').attr('value', '{{ $librarian->status }}');
                                                    $('#modal-edit #form-edit #user_id #coba').val('{{ $librarian->user->id }}');
                                                    $('#modal-edit #form-edit #user_id #coba').text('{{ $librarian->user->username }}');
                                                    $('#modal-edit #form-edit').attr('action', '{{ route('penjaga.update', $librarian->id) }}');
                                                        "><i
                                                            class="fas fa-edit"></i></button>
                                                    <button type="button" class="btn btn-icon btn-danger mr-2 mb-2"
                                                        data-toggle="modal" data-target="#modal-delete"
                                                        onclick="$('#modal-delete #form-delete').attr('action', '{{ route('penjaga.delete', $librarian->id) }}')"><i
                                                            class="fas fa-trash"></i></button>
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
                    <h5 class="modal-title">Tambah Penjaga</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="needs-validation" novalidate="" method="POST" action="{{ route('penjaga.create') }}"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-2">
                            <label>User<span class="text-danger">*</span></label>
                            <select class="form-control" name="user_id" id="user_id" required>
                                <option value="" selected></option>
                                @foreach ($users as $item)
                                    <option value="{{ $item->id }}">{{ $item->username }}</option>
                                @endforeach
                            </select>
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
    {{-- <div class="modal fade" id="modal-import" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Import Buku</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="needs-validation" novalidate="" method="POST" action="{{ route('book.import') }}"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="form-group mb-2">
                        <label>File </label>
                        <input type="file" class="form-control" name="book" required>
                    </div>
                    <div>
                        <a href="{{ route('book.download.template') }}"
                            class="btn btn-icon icon-left btn-info mr-2 mb-2"><i class="fas fa-download"></i>
                            Unduh Template</a>
                    </div>
                    <div class="mt-5 d-flex justify-content-end">
                        <button type="button" class="btn btn-secondary ml-2" data-dismiss="modal">Kembali</button>
                        <button type="submit" class="btn btn-primary ml-2">Kirim</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div> --}}
    {{-- modal edit --}}
    <div class="modal fade" id="modal-edit" data-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Ubah Penjaga</h5>
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
                            <label>User<span class="text-danger">*</span></label>
                            <select class="form-control" name="user_id" id="user_id">
                                <option value="" selected id="coba"></option>
                                @foreach ($users as $item)
                                    <option value="{{ $item->id }}">
                                        {{ $item->username }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mb-2">
                            <label>Status<span class="text-danger">*</span></label>
                            <select class="form-control" name="status" id="status">
                                <option value="active">Aktif</option>
                                <option value="inactive">Tidak Aktif</option>
                            </select>
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
                    <h5 class="modal-title">Hapus Penjaga</h5>
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
