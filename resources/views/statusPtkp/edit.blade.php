@extends('layouts.dashboard')
@section('isi')
    <center>
        <div class="container-fluid">
            <div class="card col-lg-4">
                <div class="p-4">
                    <form method="post" action="{{ url('/status-ptkp/'.$data->id.'/update') }}">
                        @method('PUT')
                        @csrf
                            <div class="form-group">
                                <label for="name" class="float-left">Status</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" autofocus value="{{ old('name', $data->name) }}">
                                @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="ptkp_2016" class="float-left">Nilai PKTP 2016 DST</label>
                                <input type="text" class="form-control money @error('ptkp_2016') is-invalid @enderror" id="ptkp_2016" name="ptkp_2016" autofocus value="{{ old('ptkp_2016', $data->ptkp_2016) }}">
                                @error('ptkp_2016')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="ptkp_2015" class="float-left">Nilai PKTP 2015</label>
                                <input type="text" class="form-control money @error('ptkp_2015') is-invalid @enderror" id="ptkp_2015" name="ptkp_2015" autofocus value="{{ old('ptkp_2015', $data->ptkp_2015) }}">
                                @error('ptkp_2015')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="ptkp_2009_2012" class="float-left">Nilai PKTP 2009 - 2012</label>
                                <input type="text" class="form-control money @error('ptkp_2009_2012') is-invalid @enderror" id="ptkp_2009_2012" name="ptkp_2009_2012" autofocus value="{{ old('ptkp_2009_2012', $data->ptkp_2009_2012) }}">
                                @error('ptkp_2009_2012')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        <button type="submit" class="btn btn-primary float-right">Submit</button>
                      </form>
                      <br>
                </div>
            </div>
        </div>
    </center>
    <br>
    @push('script')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
        <script>
            $(document).ready(function(){
                $('.money').mask('000,000,000,000,000.00', {
                    reverse: true
                });
            });
        </script>
    @endpush
@endsection
