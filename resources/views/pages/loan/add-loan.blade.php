@extends('components.elements.app')

@section('title', 'Pinjaman - SMK N Jatipuro')

@push('style')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('library/select2/dist/css/select2.min.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Pinjam Buku</h1>
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
                        <h4>Pinjam Buku</h4>
                    </div>
                    <div class="card-body">
                        <form id="form-edit" class="needs-validation" method="POST"
                            action="{{ route('tambah.book.loan') }}" enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            <div class="form-group row mb-2 mb-md-3">
                                <label class="col-sm-4 col-form-label">Peminjam<span class="text-danger">*</span></label>
                                <div class="col-sm-8">
                                    <div class="custom-file">
                                        <select class="form-control select2" name="user_id" required>
                                            <option value=""></option>
                                            @foreach ($user as $data)
                                                <option value="{{ $data->id }}">(
                                                    {{ ($data->role === 'student' ? 'Siswa' : $data->role === 'teacher') ? 'Guru' : 'Librarian' }}
                                                    ) {{ $data->id_number }} -
                                                    {{ $data->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row mb-2 mb-md-3">
                                <label class="col-sm-4 col-form-label">Buku<span class="text-danger">*</span></label>
                                <div class="col-sm-8">
                                    <div class="custom-file">
                                        <select class="select2" name="book[]" required multiple="multiple">
                                            @foreach ($books as $book)
                                                <option value="{{ $book->id }}">{{ $book->series_title }}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>
                            </div>

                            <div class="form-group row mb-2 mb-md-3">
                                <label class="col-sm-4 col-form-label">Tanggal Awal<span
                                        class="text-danger">*</span></label>
                                <div class="col-sm-8">
                                    <div class="custom-file">
                                        <input type="date" name="loan_date" class="form-control">
                                    </div>

                                </div>
                            </div>

                            <div class="form-group row mb-2 mb-md-3">
                                <label class="col-sm-4 col-form-label">Tanggal Akhir<span
                                        class="text-danger">*</span></label>
                                <div class="col-sm-8">
                                    <div class="custom-file">
                                        <input type="date" name="loan_end_date" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="mt-5 d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary ml-2">Kirim</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{{ asset('library/select2/dist/js/select2.full.min.js') }}"></script>
    <script>
        const handleChangeFilter = (e) => {
            const currentURL = new URL(window.location.href);
            currentURL.searchParams.set(e.name, e.value);
            window.history.pushState({}, '', currentURL);
            location.reload();
        }

        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>
@endpush
