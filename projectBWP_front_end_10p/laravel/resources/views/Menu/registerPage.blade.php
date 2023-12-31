@extends('template.main')
@section('register')
    <div class="containerBox"
        style="background-color: rgba(7, 7, 58, 0.904); width: 100vw; height: 60vw; display: flex; flex-direction: row">
        <div class="logoContainer" style="width: 40vw; text-align: center; padding-top: 14vw;">
            <img src="{{ asset('assets/ka_store2.png') }}" alt="" style="width: 10vw; height: 12vw;">
        </div>
        <div class="loginContainer" style="width: 60vw; color: aliceblue; display: flex; flex-direction: column;">
            <div class="titleBox" style="height: 7vw; color: aliceblue; text-align: center; padding-top: 4vw;">
                <h1>Register</h1>
            </div>
            <div class="loginBox" style="height: 33vw; display: flex; flex-direction: row; justify-content: center;">
                <div class="loginCard"
                    style="width: 50vw; background-color: #fff; height: 47vw; margin-top: 3vw; border-radius: 4vw; border: 3px solid; border-color: black">
                    @if ($errors->any())
                        <div class="alert alert-danger">{{ $errors->first() }}</div>
                        {{-- @foreach ($errors->all() as $pesanError)
                        @endforeach --}}
                    @elseif (Session::has('success'))
                        <div class="alert alert-success">{{ Session::get('success') }}</div>
                    @elseif (Session::has('error'))
                        <div class="alert alert-danger">{{ Session::get('error') }}</div>
                    @endif
                    <form action="{{ url('/register') }}" method="post">
                        @csrf
                        <label style="margin-top: 2vw; margin-left: 4vw" for="" class="text-dark">Nama</label>
                        <input style="margin-left: 4vw; width: 42vw;" type="text" name="user_nama"
                            class="form-control my-2" id="" value="{{ old('user_nama', '') }}"
                            placeholder="isi dengan nama...">

                        <label style="margin-left: 4vw" for="" class="text-dark">Username</label>
                        <input style="margin-left: 4vw; width: 42vw;" type="text" name="user_name"
                            class="form-control my-2" id="" value="{{ old('user_name', '') }}"
                            placeholder="isi dengan username...">

                        <label style="margin-left: 4vw" for="" class="text-dark">Email</label>
                        <input style="margin-left: 4vw; width: 42vw;" type="email" name="user_email"
                            class="form-control my-2" id="" value="{{ old('user_email', '') }}"
                            placeholder="isi dengan email...">

                        <label style="margin-left: 4vw" for="" class="text-dark">Phone Number</label>
                        <input style="margin-left: 4vw; width: 42vw;" type="text" name="user_phone"
                            class="form-control my-2" id="" value="{{ old('user_phone', '') }}"
                            placeholder="isi dengan nomor telepon...">

                        <label style="margin-left: 4vw" class="text-dark" for="">Gender</label>
                        <select style="margin-left: 4vw; width: 42vw;" name="user_gender" class="form-select my-2"
                            id="">
                            {{-- {{ old('user_gender') == 'W' ? 'selected' : '' }} --}}
                            <option value="W">Wanita</option>
                            <option value="P">Pria</option>
                            <option value="L">Lainnya</option>
                        </select>

                        <label style="margin-left: 4vw" class="text-dark" for="">Password</label>
                        <input style="margin-left: 4vw; width: 42vw;" type="password" name="user_password"
                            class="form-control my-2" id="" placeholder="isi dengan password...">

                        <label style="margin-left: 4vw" class="text-dark" for="">Confirm
                            Password</label>
                        <input style="margin-left: 4vw; width: 42vw;" type="password" name="password_confirmation"
                            class="form-control my-2" id="" placeholder="isi dengan confirm password...">
                        {{-- btn --}}
                        <input type="submit" class="text-center text-light"
                            style="margin-top: 1vw; width: 42vw; margin-left: 4vw; background-color: navy;" value="Register"
                            name="register">
                    </form>
                    <p style="margin-left: 4vw" class="text-dark">Already have an Account ? <a href="/loginPage">Log
                            in</a></p>
                </div>
            </div>
        </div>
    </div>
@endsection
