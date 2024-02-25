@extends('components.elements.app')


@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/select2/dist/css/select2.min.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Setting</h1>
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
                        <h4>Informasi Perpustakaan</h4>
                    </div>
                    <div class="card-body">
                        <form id="form-edit" class="needs-validation" method="POST"
                            action="{{ route('admin.setting.store') }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="form-group row mb-2 mb-md-3">
                                <label class="col-sm-4 col-form-label">Nama Perpustakaan<span
                                        class="text-danger">*</span></label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="scholl_name" required
                                        value="{{ $setting->scholl_name ?? '' }}">
                                </div>
                            </div>

                            <div class="form-group row mb-2 mb-md-3">
                                <label class="col-sm-4 col-form-label">Alamat Perpustakaan<span
                                        class="text-danger">*</span></label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="address" required
                                        value="{{ $setting->address ?? '' }}">
                                </div>
                            </div>

                            <div class="form-group row mb-2 mb-md-3">
                                <label class="col-sm-4 col-form-label">Nomer Telepon<span
                                        class="text-danger">*</span></label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="phone_number" required
                                        value="{{ $setting->phone_number ?? '' }}">
                                </div>
                            </div>

                            <div class="form-group row mb-2 mb-md-3">
                                <label class="col-sm-4 col-form-label">Logo Perpustakaan</label>
                                <div class="col-sm-8">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="image" id="school_logo">
                                        <label class="custom-file-label" for="logo">Pilih File</label>
                                    </div>
                                    <div class="mt-2">
                                        <div>
                                            @if ($setting)
                                                @if ($setting->image)
                                                    <img src="{{ asset('storage/upload/setting/' . $setting->image) }}"
                                                        id="school_logo-preview"
                                                        style="width: 120px;height: 120px;object-fit: contain;">
                                                @endif
                                            @else
                                                <img src="" class="img-fluid" id="school_logo-preview"
                                                    style="width: 120px;height: 120px;display: none;object-fit: contain;">
                                            @endif
                                        </div>
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
    <script src="{{ asset('library/select2/dist/js/select2.full.min.js') }}"></script>
    <script>
        const imageInput = document.getElementById('school_logo');
        const imagePreview = document.getElementById('school_logo-preview');

        imageInput.addEventListener('change', function() {
            imagePreview.style.display = 'block';
            const file = imageInput.files[0];
            if (file) {
                imagePreview.src = URL.createObjectURL(file);
            } else {
                imagePreview.src = '#';
            }
        });
    </script>
@endpush
