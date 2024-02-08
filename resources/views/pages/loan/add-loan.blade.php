@extends('components.elements.app')

@section('title', 'Pinjaman - SMK N 1 Kasreman')

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
                    <form id="form-edit" class="needs-validation" method="POST" action="{{route("tambah.book.loan")}}"
                        enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                        <div class="form-group row mb-2 mb-md-3">
                            <label class="col-sm-4 col-form-label">Tahun Pelajaran<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <select class="form-control select2" name="school_year" required
                                    onchange="handleChangeFilter(this)">
                                    <option value=""></option>
                                    @php
                                    $schoolYears = $school_years ?? [];
                                    $setting = $setting ?? null;
                                    @endphp
                                    @foreach ($schoolYears as $school_year)
                                    @if ($request->school_year === $school_year || optional($setting)->school_years ===
                                    $school_year)
                                    <option value="{{ $school_year }}" selected>{{ $school_year }}</option>
                                    @else
                                    <option value="{{ $school_year }}">{{ $school_year }}</option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>




                        <div class="form-group row mb-2 mb-md-3">
                            <label class="col-sm-4 col-form-label">Tingkat<span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <select class="form-control select2" name="generation" required
                                    onchange="handleChangeFilter(this)">
                                    <option value=""></option>
                                    @foreach ($angkatan as $generation)
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
                        <div class="form-group row mb-2 mb-md-3">
                            <label class="col-sm-4 col-form-label">Kelas</label>
                            <div class="col-sm-8">
                                <div class="custom-file">
                                    <select class="form-control select2" name="class" required
                                        onchange="handleChangeFilter(this)">
                                        <option value=""></option>
                                        @foreach ($kelas as $class)
                                        @if ($request->class === $class)
                                        <option value="{{ $class }}" selected>
                                            {{ $class }}</option>
                                        @else
                                        <option value="{{ $class }}">{{ $class }}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mb-2 mb-md-3">
                            <label class="col-sm-4 col-form-label">Siswa</label>
                            <div class="col-sm-8">
                                <div class="custom-file">
                                    <select class="form-control select2" name="student" required>
                                        <option value=""></option>
                                        @foreach ($students as $siswa)
                                        <option value="{{ $siswa->student_id }}">{{ $siswa->student->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mb-2 mb-md-3">
                            <label class="col-sm-4 col-form-label">Buku</label>
                            <div class="col-sm-8">
                                <div class="custom-file">
                                    <select class="select2" name="book[]" required multiple="multiple">
                                        @foreach ($books as $book)
                                        <option value="{{ $book->id }}">{{ $book->title }}</option>
                                        @endforeach
                                    </select>

                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-2 mb-md-3">
                            <label class="col-sm-4 col-form-label">Tanggal Awal</label>
                            <div class="col-sm-8">
                                <div class="custom-file">
                                    <input type="date" name="loan_date" class="form-control">
                                </div>
                                <small class="form-text text-danger">Optional</small>
                            </div>
                        </div>

                        <div class="form-group row mb-2 mb-md-3">
                            <label class="col-sm-4 col-form-label">Tanggal Akhir</label>
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

    $(document).ready(function () {
        $('.select2').select2();
    });
</script>
@endpush