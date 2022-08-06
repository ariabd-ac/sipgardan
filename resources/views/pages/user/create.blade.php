@extends('layouts.app')

@section('title')
    Tambah User
@endsection

@section('content')
    <h1>User</h1>

    <div class="user-container" style="background-color: #fff; padding : 2rem; border-radius : 10px">
        <form action="{{route('user.store')}}" method="POST">
            @csrf
            <div class="input-group">
                <label for="">Nama <span>*</span></label>
                <div class="input-field @error('name') error @enderror">
                    <input type="text" placeholder="Nama lengkap" name="name" value="{{old('name')}}">
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

            <div class="input-group">
                <label for="">Email <span>*</span></label>
                <div class="input-field @error('email') error @enderror">
                    <input type="email" placeholder="Alamat Email" name="email" value="{{old('email')}}">
                    <div class="error-mark @error('email') error-mark-show @enderror">
                        <i class="bx bx-x"></i>
                    </div>
                </div>
                @error('email')
                    <div class="error-message">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="input-group">
                <label for="">Password <span>*</span></label>
                <div class="input-field @error('password') error @enderror">
                    <input type="password" placeholder="Kata Sandi" name="password" id="password-field">
                    <div class="error-mark @error('password') error-mark-show @enderror">
                        <i class="bx bx-x"></i>
                    </div>

                    <div class="icon icon-show-password @error('password') error-mark @enderror" id="show-password">
                        <i class="bx bx-show"></i>
                        <i class="bx bx-low-vision" style="display:none"></i>
                    </div>

                </div>
                @error('password')
                    <div class="error-message">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="input-group">
                <label for="">Konfirmasi Password <span>*</span></label>
                <div class="input-field @error('password_confirmation') error @enderror">
                    <input type="password" placeholder="Kata Sandi" name="password_confirmation"
                        id="password_confirmation-field">
                    <div class="error-mark @error('password_confirmation') error-mark-show @enderror">
                        <i class="bx bx-x"></i>
                    </div>

                    <div class="icon icon-show-password @error('password_confirmation') error-mark @enderror"
                        id="show-password_confirmation">
                        <i class="bx bx-show"></i>
                        <i class="bx bx-low-vision" style="display:none"></i>
                    </div>

                </div>
                @error('password_confirmation')
                    <div class="error-message">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="input-group">
                <label for="">Role <span>*</span></label>
                <div class="input-field @error('is_admin') error @enderror">
                    <select name="is_admin" id="is_admin">
                        <option value="" disabled selected>Pilih Role</option>
                        <option value="is_admin" @if(old("is_admin") == "is_admin") selected @endif>Admin</option>
                        <option value="is_operator" @if(old("is_admin") == "is_operator") selected @endif>Operator</option>
                    </select>

                </div>
                @error('is_admin')
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
            $('#user-table').DataTable();
        });

        let passwordIcon = document.querySelector('#show-password');
        let passwordField = document.querySelector('#password-field');

        let passwordConfirmationIcon = document.querySelector('#show-password_confirmation');
        let passwordConfirmationField = document.querySelector('#password_confirmation-field')

        passwordIcon.addEventListener('click', () => {
            if (passwordField.getAttribute('type') == 'password') {
                passwordField.setAttribute('type', "text")
                passwordIcon.children[0].style.display = 'none';
                passwordIcon.children[1].style.display = 'block';

            } else {
                passwordField.setAttribute('type', "password")
                passwordIcon.children[0].style.display = 'block';
                passwordIcon.children[1].style.display = 'none';
            }
        })

        passwordConfirmationIcon.addEventListener('click', () => {
            if (passwordConfirmationField.getAttribute('type') == 'password') {
                passwordConfirmationField.setAttribute('type', "text")
                passwordConfirmationIcon.children[0].style.display = 'none';
                passwordConfirmationIcon.children[1].style.display = 'block';

            } else {
                passwordConfirmationField.setAttribute('type', "password")
                passwordConfirmationIcon.children[0].style.display = 'block';
                passwordConfirmationIcon.children[1].style.display = 'none';
            }
        })
    </script>
@endsection
