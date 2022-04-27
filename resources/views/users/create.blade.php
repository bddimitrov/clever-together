@extends('master')

@section('style')
    <style>
        .select2-selection  {
            display: block;
            width: 100%;
            height: calc(1.5em + 0.75rem + 2px);
            padding: 0.375rem 0.75rem;
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            color: #495057;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
            transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
        }
    </style>

@endsection

@section('content')
    <div class="col-6 offset-md-3">
        <form action="{{ route('users.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control  @error('name') is-invalid @elseif(old('name'))) is-valid @enderror" id="name" name="name" aria-describedby="emailHelp" value="{{ old('name') }}">
                <div class="invalid-feedback">
                    @error('name')
                        {{ $message }}
                    @enderror
                </div>
                <div class="valid-feedback">
                    Looks good!
                </div>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control @error('email') is-invalid @elseif(old('email'))) is-valid @enderror" id="email" name="email" aria-describedby="emailHelp" value="{{ old('email') }}">
                <div class="invalid-feedback">
                    @error('email')
                        {{ $message }}
                    @enderror
                </div>
                <div class="valid-feedback">
                    Looks good!
                </div>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Roles</label>
                <select id="roles" name="roles[]" class="form-control @error('roles') is-invalid @elseif(old('roles'))) is-valid @enderror" multiple="multiple">
                    @foreach($roles as $key => $role)
                        <option value="{{ $key }}" @if(in_array($key, old('roles') ?: [])) selected="selected" @endif >{{ $role }}</option>
                    @endforeach
                </select>
                <div class="invalid-feedback">
                    @error('roles')
                        {{ $message }}
                    @enderror
                </div>
                <div class="valid-feedback">
                    Looks good!
                </div>
            </div>
            <div class="col text-center">
                <button type="submit" class="btn btn-primary btn-lg">Submit</button>
            </div>
        </form>
    </div>
@endsection

@section('javascript')
    <script>
        $(document).ready(function() {
            $('#roles').select2({
                multiple: true
            });
        });
    </script>
@endsection
