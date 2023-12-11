@extends('layouts.app')
@section('content')
    <div class="card">
        <div class="card-header">{{ __('Phone Login') }}</div>

        <div class="card-body">
            <form method="POST" action="{{ route('phone.login') }}">
                @csrf

                <div class="form-group row">
                    <label for="phone_number" class="col-md-4 col-form-label text-md-right">{{ __('Phone Number') }}</label>

                    <div class="col-md-6">
                        <input id="phone_number" type="text" class="form-control @error('phone_number') is-invalid @enderror" name="phone_number" value="{{ old('phone_number') }}" required autocomplete="phone_number" autofocus>

                        @error('phone_number')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-8 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Send Verification Code') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
