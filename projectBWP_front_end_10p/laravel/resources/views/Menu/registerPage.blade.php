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
                    @if (Session::has('success'))
                        <div class="alert alert-success">{{ Session::get('success') }}</div>
                    @elseif (Session::has('error'))
                        <div class="alert alert-danger">{{ Session::get('error') }}</div>
                    @endif
                    <form action="{{ url('/register') }}" method="post">
                        @csrf
                        <label style="margin-top: 2vw; margin-left: 4vw" for="" class="text-dark">Nama</label>
                        <br>
                        <input style="margin-left: 4vw; width: 42vw;" type="text" name="user_nama"
                            class="form-control mt-2" id="">
                        <br>
                        <label style="margin-left: 4vw" for="" class="text-dark">Username</label>
                        <br>
                        <input style="margin-left: 4vw; width: 42vw;" type="text" name="user_name"
                            class="form-control mt-2" id="">
                        <br>
                        <label style="margin-left: 4vw" for="" class="text-dark">Email</label>
                        <br>
                        <input style="margin-left: 4vw; width: 42vw;" type="email" name="user_email"
                            class="form-control mt-2" id="">
                        <br>
                        <label style="margin-left: 4vw" class="text-dark" for="">Password</label>
                        <br>
                        <input style="margin-left: 4vw; width: 42vw;" type="password" name="user_password"
                            class="form-control mt-2" id="">

                        <label style="margin-top: 1vw;margin-left: 4vw" class="text-dark" for="">Confirm
                            Password</label>
                        <br>
                        <input style="margin-left: 4vw; width: 42vw;" type="password" name="password_confirmation"
                            class="form-control mt-2" id="">

                        <br>
                        <label style="margin-left: 4vw" class="text-dark" for="">Role</label>
                        <br>
                        <select style="margin-left: 4vw; width: 42vw;" name="user_role" class="form-select mt-2"
                            id="">
                            <option value="Customer">Customer</option>
                            <option value="StoreOwner">Store Owner</option>
                        </select>

                        <input type="submit" class="text-center text-light"
                            style="margin-top: 2vw; width: 42vw; margin-left: 4vw; background-color: navy;" value="Register"
                            name="register">
                    </form>
                    <p style="margin-left: 4vw" class="text-dark">Already have an Account ? <a href="/loginPage">Log
                            in</a></p>
                </div>
            </div>
        </div>
    </div>
@endsection
