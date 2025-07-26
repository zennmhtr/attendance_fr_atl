@extends('templates.dashboard')
@section('isi')
    <div class="row">
        <div class="col-md-12 m project-list">
            <div class="card">
                <div class="row">
                    <div class="col-md-6 p-0 d-flex mt-2">
                        <h4>{{ $title }}</h4>
                    </div>
                    <div class="col-md-6 p-0">
                        <a href="{{ url('/kategori') }}" class="btn btn-danger btn-sm ms-2">Back</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <form method="post" class="p-4" action="{{ url('/kategori/store') }}">
                    @csrf
                        <div class="form-group">
                            <label for="name" class="float-left">Nama</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" autofocus value="{{ old('name') }}">
                            @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input name="active" class="form-check-input active" type="checkbox" value="{{ old('active') }}" id="active">
                            <label class="form-check-label" for="active">
                                Active
                            </label>
                        </div>
                    <button type="submit" class="btn btn-primary float-right">Submit</button>
                </form>
            </div>
        </div>
    </div>

    @push('script')
        <script>
            $(document).ready(function(){
                var active = $('#active').val();
                $('#active').prop('checked', active == "1");

                $('body').on('change', '#active', function (event) {
                    if (this.checked) {
                        $('#active').val(1);
                    } else {
                        $('#active').val(null);
                    }
                });
            });
        </script>
    @endpush
@endsection
