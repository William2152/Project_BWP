@extends('template.main')
@section('login')
    <div class="containerBox"
        style="background-color: rgba(7, 7, 58, 0.904); width: 100vw; height: 40vw; display: flex; flex-direction: row">
        <div class="logoContainer" style="width: 40vw; text-align: center; padding-top: 14vw;">
            <img src="{{ asset('assets/ka_store2.png') }}" alt="" style="width: 10vw; height: 12vw;">
        </div>
        <div class="loginContainer" style="width: 60vw; color: aliceblue; display: flex; flex-direction: column;">
            <div class="titleBox" style="height: 7vw; color: aliceblue; text-align: center; padding-top: 4vw;">
                <h1>Log In</h1>
            </div>
            <div class="loginBox" style="height: 33vw; display: flex; flex-direction: row; justify-content: center;">

                <div class="loginCard"
                    style="width: 50vw; background-color: #fff; height: 24vw; margin-top: 3vw; border-radius: 4vw; border: 3px solid; border-color: black">

                    <form action="{{ url('/login') }}" method="post">
                        @csrf
                        <label style="margin-top: 2vw; margin-left: 4vw" for="" class="text-dark">Username</label>
                        <br>
                        <input style="margin-left: 4vw; width: 42vw;" type="text" name="username"
                            class="form-control mt-2" id="">
                        <br>
                        <label style="margin-left: 4vw" class="text-dark" for="">Password</label>
                        <br>
                        <input style="margin-left: 4vw; width: 42vw;" type="password" name="password"
                            class="form-control mt-2" id="">
                        <input type="submit" class="text-center text-light"
                            style="margin-top: 2vw; width: 42vw; margin-left: 4vw; background-color: navy;" value="Log In"
                            name="login">
                        <p style="margin-left: 4vw" class="text-dark">dont have account ? <a
                                href="/registerPage">Register</a></p>
                    </form>
                    @if ($errors->any())
                        <div class="alert alert-danger">{{ $errors->first() }}</div>
                        {{-- @foreach ($errors->all() as $pesanError)
                    @endforeach --}}
                    @elseif (Session::has('success'))
                        <div class="alert alert-success">{{ Session::get('success') }}</div>
                    @elseif (Session::has('err'))
                        <div class="alert alert-danger">{{ Session::get('err') }}</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
