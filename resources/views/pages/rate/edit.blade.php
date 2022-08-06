@extends('layouts.app')

@section('title')
    Tarif
@endsection

@section('content')
    <h1>Tarif</h1>

    <div class="user-container" style="background-color: #fff; padding : 2rem; border-radius : 10px">
        <form action="{{ route('rate.update', $rate->id) }}" method="POST">
            @csrf
            <input type="hidden" name="_method" value="PUT">
            <div class="input-group" style="width: 40%">
                <label for="">Nama <span>*</span></label>
                <div class="input-field @error('name') error @enderror">
                    <input type="text" placeholder="Nama Tarif" name="name" value="{{ $rate->name }}">
                    <div class="error-mark @error('name') error-mark-show @enderror">
                        <i class="bx bx-x"></i>
                    </div>
                </div>
                @error('name')
                    <div class="error-message">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="input-group" style="width: 40%">
                <label for="">Tarif <span>*</span></label>
                <div class="input-field @error('price') error @enderror">
                    <input type="text" placeholder="Tarif Parkir" name="price"
                        data-type="currency">
                    <div class="error-mark @error('price') error-mark-show @enderror">
                        <i class="bx bx-x"></i>
                    </div>
                </div>
                @error('price')
                    <div class="error-message">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="">
                <button type="submit" class="btn btn-main" style="padding : 0.8rem 2rem">Simpan</button>
            </div>
        </form>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $("input[name='price']").val(formatRupiah('{!! json_encode($rate->price) !!}', 'Rp.'))
        })
    </script>
@endsection
