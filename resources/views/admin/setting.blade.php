@extends('admin.index')
@section('title', 'setting')
@section('content')
    <div class="card mb-3 ms-3 me-3 mt-5 justify-content-center shadow p-3">
        <h2 class="card-title text-center">Update Settings</h2>
        @if (@session('success'))

        <div class="sufee-alert alert with-close alert-success mx-5 mt-5 alert-dismissible animate__animated animate__fadeInDown">
            <span class="badge badge-pill badge-success">seccess</span>
            setting updated successfully
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>

        @endif
        <form class="card-body" action="{{ route('settings_update') }}" method="POST" enctype="multipart/form-data"
            class="animate__animated animate__zoomIn">
            @csrf

            <label for="colFormLabel" class="col-sm-2 col-form-label">Site Title</label>
            <div class="col-sm-4">
                <input type="text" name="title" class="form-control" value="{{ $settings['title'] ?? '' }}"
                    id="colFormLabel" placeholder="title">
                @error('title')
                    <span class="alert alert-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="logo" class="col-sm-2 col-form-label">Logo</label>
                <div class="col-sm-4">
                    <input type="file" name="logo" class="form-control" value="" id="logo">
                    @foreach ($settings as $key => $value)

                        @if ($key === 'logo')

                            <img src="{{ asset('storage/' . $value) }}" alt="no Logo" class=" mt-2 ms-5" style="max-width: 100px;">
                        @endif
                    @endforeach
                    @error('logo')
                        <span class="alert alert-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <label for="colFormLabel" class="col-sm-2 col-form-label">Footer</label>
            <div class="col-sm-4">
                <input type="text" name='footer' class="form-control" id="colFormLabel"
                    value="{{ isset($settings['footer']) ? $settings['footer'] : '' }}" placeholder="footer">
                @error('footer')
                    <p class="alert alert-danger">{{ $message }}</p>
                @enderror

            </div>

            {{--
            <label for="colFormLabel" class="col-sm-2 col-form-label">Location API</label>
            <div class="col-sm-4">
                <input type="text" name='location' class="form-control" id="colFormLabel" placeholder="">
            </div> --}}

            <div class="text-center mt-5">
                <i class="fa-solid fa-plus"></i> <input class="orange-outline-button" type="submit" value="Update">
            </div>
        </form>

    </div>

@endsection
