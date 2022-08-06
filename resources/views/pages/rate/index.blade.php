@extends('layouts.app')

@section('title')
    Tarif
@endsection

@section('content')
    <div class="card-box">
        <div class="card-box-header">
            <span class="card-box-title">Tarif</span>
            <a href="{{ route('rate.create') }}" class="btn btn-main">
                Tambah
            </a>
        </div>
        <div class="card-box-body">
            <table id="rate-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Harga</th>
                        <th>Status</th>
                        <th style="text-align: right">Action</th>

                    </tr>
                </thead>
                <tbody>
                    @php
                        $no = 1;
                    @endphp
                    @foreach ($rates as $rate)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $rate->name }}</td>
                            <td>Rp. {{ number_format($rate->price, 0, '', '.') }}</td>
                            <td>{{ $rate->status == '1' ? 'Aktif' : 'Tidak Aktif' }}</td>

                            <td
                                style="display: flex; gap : 1rem; justify-content:flex-end; align-items : center; text-align: right">
                                <form action="{{ route('rate.status', $rate->id) }}" method="POST">
                                    @csrf

                                    <input type="hidden" name="_method" value="PUT">
                                    <button style="display: none" type="submit"
                                        id="form-status-rate-{{ $rate->id }}"></button>

                                </form>
                                <form action="{{ route('rate.destroy', $rate->id) }}" method="POST">
                                    @csrf

                                    <input type="hidden" name="_method" value="DELETE">
                                    <button style="display: none" type="submit"
                                        id="form-delete-rate-{{ $rate->id }}"></button>
                                </form>
                                <button class="btn btn-primary"
                                    onclick="showAlertConfirmation('form-status-rate-{{ $rate->id }}', 'Peringatan', 'Apakah anda yakin ingin mengubah status rate ini?')">Ubah
                                    Status</button>

                                <button class="btn btn-edit"
                                    onclick="return window.location.href='{{ route('rate.edit', $rate->id) }}'">Edit</button>
                                <button class="btn btn-trash"
                                    onclick="showAlertConfirmation('form-delete-rate-{{ $rate->id }}', 'Peringatan', 'Data akan dihapus secara permanen')">Hapus</button>

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
            $('#rate-table').DataTable();
        });
    </script>
@endsection
