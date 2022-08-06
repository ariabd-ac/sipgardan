@extends('layouts.app')

@section('title')
    User
@endsection

@section('content')
    <div class="card-box">
        <div class="card-box-header">
            <span class="card-box-title">User</span>
            <a href="{{ route('user.create') }}" class="btn btn-main">
                Tambah
            </a>
        </div>
        <div class="card-box-body">
            <table id="user-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Roles</th>
                        <th>Status</th>
                        <th style="text-align: right">Action</th>

                    </tr>
                </thead>
                <tbody>
                    @php
                        $no = 1;
                    @endphp
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->is_admin == '1' ? 'ADMIN' : 'OPERATOR' }}</td>
                            <td>{{ $user->status == '1' ? 'Aktif' : 'Tidak Aktif' }}</td>

                            <td
                                style="display: flex; gap : 1rem; justify-content:flex-end; align-items : center; text-align: right">
                                <form action="{{ route('user.status', $user->id) }}" method="POST">
                                    @csrf

                                    <input type="hidden" name="_method" value="PUT">
                                    <button style="display: none" type="submit"
                                        id="form-status-user-{{ $user->id }}"></button>

                                </form>
                                <form action="{{ route('user.destroy', $user->id) }}" method="POST">
                                    @csrf

                                    <input type="hidden" name="_method" value="DELETE">
                                    <button style="display: none" type="submit"
                                        id="form-delete-user-{{ $user->id }}"></button>
                                </form>
                                {{-- <button class="btn btn-primary"
                                    onclick="showAlertConfirmation('form-status-user-{{ $user->id }}', 'Peringatan', 'Apakah anda yakin ingin mengubah status user ini?')">Ubah
                                    Status</button> --}}

                                <button class="btn btn-edit"
                                    onclick="return window.location.href='{{ route('user.edit', $user->id) }}'">Edit</button>
                                <button class="btn btn-trash"
                                    onclick="showAlertConfirmation('form-delete-user-{{ $user->id }}', 'Peringatan', 'Data akan dihapus secara permanen')">Hapus</button>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('#user-table').DataTable();
        });
    </script>
@endsection
