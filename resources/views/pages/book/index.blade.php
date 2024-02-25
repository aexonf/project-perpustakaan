@extends('components.elements.app')

@section('title', 'Buku - - SMK N 1 Kasreman')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/datatables/media/css/dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/select2/dist/css/select2.min.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Daftar Buku</h1>
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
                                <form action="{{ route('book.export') }}" method="get">
                                    @csrf
                                    @method('GET')
                                    <button type="submit" class="btn btn-icon icon-left btn-primary mr-2 mb-2"><i
                                            class="fas fa-upload"></i>
                                        Export</ button>
                                </form>
                            </div>
                            <div class="d-flex align-items-center flex-wrap">
                                <button type    ="button" class="btn btn-icon icon-left btn-info mr-2 mb-2"
                                    data-toggle="collapse" data-target="#section-filter"><i class="fas fa-filter"></i>
                                    Filter</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="collapse mb-3 pb-3 border-bottom show" id="section-filter">
                            <form class="needs-validation" novalidate="" method="GET" action="{{ route('book') }}"
                                enctype="multipart/form-data">
                                <div class="row">

                                    {{-- <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                                        <div class="form-group mb-2">
                                            <label class="mb-2">Genre</label>
                                            <select class="form-control select2" id="classSelect" name="genre" required
                                                onchange="handleChangeFilter(this)">
                                                @foreach ($genre as $g)
                                                    <option value="{{ $g }}">{{ $g }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div> --}}
                                    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                                        <div class="form-group mb-2">
                                            <label class="mb-2">Status</label>
                                            <select class="form-control select2" name="status" required
                                                onchange="handleChangeFilter(this)">
                                                <option value="available"
                                                    {{ request('status') == 'available' ? 'selected' : '' }}>Tersedia
                                                </option>
                                                <option value="blank" {{ request('status') == 'blank' ? 'selected' : '' }}>
                                                    Tidak Tersedia
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <a href="{{ route('book') }}" class="btn btn-danger ml-2">Reset</a>
                                    <button type="submit" class="btn btn-primary ml-2">Kirim</button>
                                </div>
                            </form>
                        </div>
                        <div>
                            <table class="table table-striped table-bordered" id="datatable">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width: 80px;">#</th>
                                        <th style="min-width: 240px;">Judul</th>
                                        <th style="min-width: 240px;">Penerbit</th>
                                        <th style="min-width: 160px;">Stock</th>
                                        <th style="min-width: 160px;">Status</th>
                                        <th style="min-width: 160px;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($books as $index => $book)
                                        <tr>
                                            <td class="text-center">{{ $index + 1 }}</td>
                                            <td>
                                                <div class="media">
                                                    @if ($book->image)
                                                        <img alt="image" class="mr-3 rounded-circle" width="48"
                                                            src="{{ asset('storage/upload/book/' . $book->image) }}">
                                                    @else
                                                        <img alt="image" class="mr-3 rounded-circle" width="48"
                                                            src="/img/book-dummy.png">
                                                    @endif
                                                    <div class="media-body">
                                                        <div class="media-title">
                                                            {{ $book->title }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ $book->publisher }}</td>
                                            <td>{{ $book->stock }}</td>
                                            <td>
                                                @if ($book->status === 'blank')
                                                    <span class="badge badge-warning">Tidak Tersedia</span>
                                                @else
                                                    <span class="badge badge-success">Tersedia</span>
                                                @endif
                                            </td>

                                            <td>
                                                <div class="d-flex items-center">
                                                    <button type="button" class="btn btn-icon btn-primary mr-2 mb-2"
                                                        data-toggle="modal" data-target="#modal-edit"
                                                        onclick="
                                                    $('#modal-edit #series_title').val('{{ $book->series_title }}');
                                                    $('#modal-edit #call_no').val('{{ $book->call_no }}');
                                                    $('#modal-edit #description').val('{{ $book->description }}');
                                                    $('#modal-edit #publisher').val('{{ $book->publisher }}');
                                                    $('#modal-edit #physical_description').val('{{ $book->physical_description }}');
                                                    $('#modal-edit #language').val('{{ $book->language }}');
                                                    $('#modal-edit #isbn_issn').val('{{ $book->isbn_issn }}');
                                                    $('#modal-edit #classification').val('{{ $book->classification }}');
                                                    $('#modal-edit #content_type').val('{{ $book->content_type }}');
                                                    $('#modal-edit #media_type').val('{{ $book->media_type }}');
                                                    $('#modal-edit #carrier_type').val('{{ $book->carrier_type }}');
                                                    $('#modal-edit #edition').val('{{ $book->edition }}');
                                                    $('#modal-edit #subject').val('{{ $book->subject }}');
                                                    $('#modal-edit #specific_details_info').val('{{ $book->specific_details_info }}');
                                                    $('#modal-edit #statement').val('{{ $book->statement }}');
                                                    $('#modal-edit #responsibility').val('{{ $book->responsibility }}');
                                                    $('#modal-edit #status').val('{{ $book->status }}');
                                                    $('#modal-edit #stock').val('{{ $book->stock }}');


                                                    $('#modal-edit #image').attr('src', '{{ asset('storage/upload/book/' . $book->image) }}');
                                                    $('#modal-edit #form-edit').attr('action', '{{ route('book.update', $book->id) }}');
                                                        "><i
                                                            class="fas fa-edit"></i></button>
                                                    <button type="button" class="btn btn-icon btn-danger mr-2 mb-2"
                                                        data-toggle="modal" data-target="#modal-delete"
                                                        onclick="$('#modal-delete #form-delete').attr('action', '{{ route('book.delete', $book->id) }}')"><i
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
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Buku</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
<<<<<<< HEAD
                    <form class="needs-validation" novalidate="" method="POST" action="{{ route('book.create') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-2">
                            <label for="title">Judul Buku</label>
                            <input type="text" class="form-control" name="title" id="title">
                        </div>
                        <div class="form-group mb-2">
                            <label for="series_title">Series Title</label>
                            <input type="text" class="form-control" name="series_title" id="series_title">
                        </div>
                        <div class="form-group mb-2">
                            <label for="call_no">Call No</label>
                            <input type="text" class="form-control" name="call_no" id="call_no">
                        </div>
                        <div class="form-group mb-2">
                            <label for="description">Description</label>
                            <input type="text" class="form-control" name="description" id="description">
                        </div>
                        <div class="form-group mb-2">
                            <label for="publisher">Publisher</label>
                            <input type="text" class="form-control" name="publisher" id="publisher">
                        </div>
                        <div class="form-group mb-2">
                            <label for="physical_description">Physical Description</label>
                            <input type="text" class="form-control" name="physical_description" id="physical_description">
                        </div>
                        <div class="form-group mb-2">
                            <label for="language">Language</label>
                            <input type="text" class="form-control" name="language" id="language">
                        </div>
                        <div class="form-group mb-2">
                            <label for="isbn_issn">ISBN/ISSN</label>
                            <input type="text" class="form-control" name="isbn_issn" id="isbn_issn">
                        </div>
                        <div class="form-group mb-2">
                            <label for="classification">Classification</label>
                            <input type="text" class="form-control" name="classification" id="classification">
                        </div>
                        <div class="form-group mb-2">
                            <label for="content_type">Content Type</label>
                            <input type="text" class="form-control" name="content_type" id="content_type">
                        </div>
                        <div class="form-group mb-2">
                            <label for="media_type">Media Type</label>
                            <input type="text" class="form-control" name="media_type" id="media_type">
                        </div>
                        <div class="form-group mb-2">
                            <label for="carrier_type">Carrier Type</label>
                            <input type="text" class="form-control" name="carrier_type" id="carrier_type">
                        </div>
                        <div class="form-group mb-2">
                            <label for="edition">Edition</label>
                            <input type="text" class="form-control" name="edition" id="edition">
                        </div>
                        <div class="form-group mb-2">
                            <label for="category">Category</label>
                            <input type="text" class="form-control" name="category" id="category">
                        </div>
                        <div class="form-group mb-2">
                            <label for="subject">Subject</label>
                            <input type="text" class="form-control" name="subject" id="subject">
                        </div>
                        <div class="form-group mb-2">
                            <label for="specific_details_info">Specific Details Info</label>
                            <input type="text" class="form-control" name="specific_details_info" id="specific_details_info">
                        </div>
                        <div class="form-group mb-2">
                            <label for="statement">Statement</label>
                            <input type="text" class="form-control" name="statement" id="statement">
                        </div>
                        <div class="form-group mb-2">
                            <label for="responsibility">Responsibility</label>
                            <input type="text" class="form-control" name="responsibility" id="responsibility">
                        </div>
                        <div class="form-group mb-2">
                            <label for="stock">Stock</label>
                            <input type="text" class="form-control" name="stock" id="stock">
                        </div>
                        <div class="form-group mb-2">
                            <label for="status">Status</label>
                            <select class="form-control" name="status" id="status">
                                <option value="available" selected>Tersedia</option>
                                <option value="blank">Tidak tersedia</option>
                            </select>
                        </div>
                        <div class="form-group mb-2">
                            <label for="image">Image</label>
                            <input type="file" class="form-control" name="image" id="image">
=======
                    <form class="needs-validation row" novalidate="" method="POST"
                        action="{{ route('book.create') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="col-12 col-md-6">
                            <div class="form-group mb-2">
                                <label>Judul Buku<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="title" required>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group mb-2">
                                <label>Series Title<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="series_title" required>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group mb-2">
                                <label>Call No<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="call_no" required>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group mb-2">
                                <label>Description<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="description" required>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group mb-2">
                                <label>Publisher<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="publisher" required>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group mb-2">
                                <label>Physical Description<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="physical_description" required>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group mb-2">
                                <label>Language<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="language" required>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group mb-2">
                                <label>ISBN/ISSN<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="isbn_issn" required>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group mb-2">
                                <label>Classification<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="classification" required>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group mb-2">
                                <label>Content Type<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="content_type" required>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group mb-2">
                                <label>Media Type<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="media_type" required>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group mb-2">
                                <label>Carrier Type<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="carrier_type" required>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group mb-2">
                                <label>Edition<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="edition" required>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group mb-2">
                                <label>Category<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="category" required>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group mb-2">
                                <label>Subject<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="subject" required>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group mb-2">
                                <label>Specific Details Info<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="specific_details_info" required>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group mb-2">
                                <label>Statement<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="statement" required>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group mb-2">
                                <label>Responsibility<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="responsibility" required>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group mb-2">
                                <label>Stock<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="stock" required>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group mb-2">
                                <label>Status<span class="text-danger">*</span></label>
                                <select class="form-control" name="status" required>
                                    <option value="available" selected>Tersedia</option>
                                    <option value="blank">Tidak tersedia</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group mb-2">
                                <label>Image</label>
                                <input type="file" class="form-control" name="image">
                            </div>
>>>>>>> ff3e052ff83c1941de6d2c9e0af6338dee31d246
                        </div>
                        <div class="mt-5 col-12 d-flex justify-content-end">
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
    </div>
    {{-- modal edit --}}
    <div class="modal fade" id="modal-edit" data-backdrop="static">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Ubah Buku</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
<<<<<<< HEAD
                    <form id="form-edit" class="needs-validation" novalidate="" method="POST" action="" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group mb-2">
                            <label for="series_title">Series Title<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="series_title" id="series_title">
                        </div>
                        <div class="form-group mb-2">
                            <label for="call_no">Call No<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="call_no" id="call_no">
                        </div>
                        <div class="form-group mb-2">
                            <label for="description">Description<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="description" id="description">
                        </div>
                        <div class="form-group mb-2">
                            <label for="publisher">Publisher<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="publisher" id="publisher">
                        </div>
                        <div class="form-group mb-2">
                            <label for="physical_description">Physical Description<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="physical_description" id="physical_description">
                        </div>
                        <div class="form-group mb-2">
                            <label for="language">Language<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="language" id="language">
                        </div>
                        <div class="form-group mb-2">
                            <label for="isbn_issn">ISBN/ISSN<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="isbn_issn" id="isbn_issn">
                        </div>
                        <div class="form-group mb-2">
                            <label for="classification">Classification<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="classification" id="classification">
                        </div>
                        <div class="form-group mb-2">
                            <label for="content_type">Content Type</label>
                            <input type="text" class="form-control" name="content_type" id="content_type">
                        </div>
                        <div class="form-group mb-2">
                            <label for="media_type">Media Type<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="media_type" id="media_type">
                        </div>
                        <div class="form-group mb-2">
                            <label for="carrier_type">Carrier Type<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="carrier_type" id="carrier_type">
                        </div>
                        <div class="form-group mb-2">
                            <label for="edition">Edition<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="edition" id="edition">
                        </div>
                        <div class="form-group mb-2">
                            <label for="subject">Subject<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="subject" id="subject">
                        </div>
                        <div class="form-group mb-2">
                            <label for="specific_details_info">Specific Details Info<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="specific_details_info" id="specific_details_info">
                        </div>
                        <div class="form-group mb-2">
                            <label for="statement">Statement<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="statement" id="statement">
                        </div>
                        <div class="form-group mb-2">
                            <label for="responsibility">Responsibility<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="responsibility" id="responsibility">
                        </div>
                        <div class="form-group mb-2">
                            <label for="stock">Stock<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="stock" id="stock">
                        </div>
                        <div class="form-group mb-2">
                            <label for="status">Status<span class="text-danger">*</span></label>
                            <select class="form-control" name="status" id="status">
                                <option value="available" selected>Tersedia</option>
                                <option value="blank">Tidak tersedia</option>
                            </select>
                        </div>
                        <div class="form-group mb-2">
                            <label for="image">Image</label>
                            <input type="file" class="form-control" name="image" id="image">
                        </div>
                        <div class="form-group mb-2">
                            <div class="d-flex align-items-center">
                                <img alt="image" class="mr-3" width="100" src="" id="image-preview">
=======
                    <form id="form-edit" class="needs-validation row" novalidate="" method="POST" action=""
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="col-12 col-md-6">
                            <div class="form-group mb-2">
                                <label>Judul Buku<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="title" required>
>>>>>>> ff3e052ff83c1941de6d2c9e0af6338dee31d246
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group mb-2">
                                <label>Series Title<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="series_title" required>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group mb-2">
                                <label>Call No<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="call_no" required>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group mb-2">
                                <label>Description<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="description" required>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group mb-2">
                                <label>Publisher<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="publisher" required>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group mb-2">
                                <label>Physical Description<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="physical_description" required>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group mb-2">
                                <label>Language<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="language" required>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group mb-2">
                                <label>ISBN/ISSN<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="isbn_issn" required>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group mb-2">
                                <label>Classification<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="classification" required>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group mb-2">
                                <label>Content Type<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="contetn_type" required>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group mb-2">
                                <label>Media Type<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="media_type" required>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group mb-2">
                                <label>Carrier Type<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="carrier_type" required>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group mb-2">
                                <label>Edition<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="edition" required>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group mb-2">
                                <label>Subject<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="subject" required>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group mb-2">
                                <label>Specific Details Info<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="specific_details_info" required>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group mb-2">
                                <label>Statement<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="statement" required>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group mb-2">
                                <label>Responsibility<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="responsibility" required>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group mb-2">
                                <label>Stock<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="stock" required>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group mb-2">
                                <label>Status<span class="text-danger">*</span></label>
                                <select class="form-control" name="status" required>
                                    <option value="available" selected>Tersedia</option>
                                    <option value="blank">Tidak tersedia</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group mb-2">
                                <label>Image</label>
                                <input type="file" class="form-control" name="image">
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group mb-2">
                                <div class="d-flex align-items-center">
                                    <img alt="image" class="mr-3" width="100" src="" id="image">
                                </div>
                            </div>
                        </div>
                        <div class="mt-5 col-12 d-flex justify-content-end">
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
                    <h5 class="modal-title">Hapus Buku</h5>
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
