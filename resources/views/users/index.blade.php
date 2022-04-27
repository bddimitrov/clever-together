@extends('master')

@section('content')
    <a href="{{ route('users.create') }}" class="btn btn-success mb-5" id="add-user">Add user</a>
    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">
                @if(request()->get('name') === 'desc')
                    <a href="{{ route('users') }}">
                        Name
                    </a>
                @elseif(request()->get('name') === 'asc')
                    <a href="{{ route('users') }}?name=desc">
                        Name
                    </a>
                @else
                    <a href="{{ route('users') }}?name=asc">
                        Name
                    </a>
                @endif

                @if(request()->get('name'))
                    @if(request()->get('name') === 'asc')
                        <i class="bi bi-arrow-up"></i>
                    @else
                        <i class="bi bi-arrow-down"></i>
                    @endif
                @endif
            </th>
            <th scope="col">
                @if(request()->get('email') === 'desc')
                    <a href="{{ route('users') }}">
                        Email
                    </a>
                @elseif(request()->get('email') === 'asc')
                    <a href="{{ route('users') }}?email=desc">
                        Email
                    </a>
                @else
                    <a href="{{ route('users') }}?email=asc">
                        Email
                    </a>
                @endif

                @if(request()->get('email'))
                    @if(request()->get('email') === 'asc')
                        <i class="bi bi-arrow-up"></i>
                    @else
                        <i class="bi bi-arrow-down"></i>
                    @endif
                @endif
            </th>
            <th scope="col">
                Roles
            </th>
        </tr>
        </thead>
        <tbody>

        @foreach($users as $user)
            <tr>
                <th scope="row">{{ $user->id }}</th>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->getRolesForDisplay()  }}</td>
            </tr>
        @endforeach


        </tbody>
    </table>
@endsection
