@extends('layouts.app')

@section('title', 'Manajemen User')
@section('page-title', 'Manajemen User')

@section('content')
<div class="card shadow-sm">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="thead-light">
                    <tr>
                        <th>No.</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th style="min-width: 260px">Role</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $users->firstItem() + $loop->index }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @if($user->id === auth()->id())
                                    <span class="badge badge-primary">{{ ucfirst($user->role) }}</span>
                                    <small class="text-muted">(akun Anda)</small>
                                @else
                                    <form method="POST" action="{{ route('users.update', $user) }}"
                                          class="form-inline">
                                        @csrf
                                        @method('PUT')
                                        <select name="role" class="form-control form-control-sm mr-2">
                                            @foreach($roles as $role)
                                                <option value="{{ $role }}" @selected($user->role === $role)>
                                                    {{ ucfirst($role) }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <button class="btn btn-sm btn-primary">Simpan</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $users->links('pagination::bootstrap-4') }}
    </div>
</div>
@endsection
