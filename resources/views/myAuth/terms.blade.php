@extends('myAuth.layouts')
@section('form')
    <form class="login100-form validate-form" method="POST" action="{{ route('register') }}"
          style="padding-top: 50px">
        @csrf
        <div class="row" style="padding-bottom: 50px">
            <img src="{{ asset('assets/12FlyIcons/12FlyLogoGrey.png') }}" alt="" width="150px">
        </div>
        <div class="row">
            <span class="col-md-6 os-form-input login100-form-title p-b-43"
                  style="text-align: left;display: block"> OPERATOR PORTAL </span>
        </div>
        <div class="form-row">
            <div class="col-6 col-md-6 os-form-input ">
                <label class="form-title" style="font-size: 18px; color: black">Create new account</label>
                <label class="form-title" style="font-size: 14px">Please register to create a new
                    account</label>
            </div>
        </div>
        <div class="form-row">
            <div class="col-6 col-md-6 os-form-input ">
                {{--                <label for="first_name" class="form-title">First name :</label>--}}
                <input type="text" id="first_name" placeholder="Enter First name" name="first_name"
                       class="form-control @error('first_name') input-error @enderror"
                       value="{{ old('first_name') }}">
                @error('first_name')
                <div class="invalid-feedback"
                     style="display: block !important;">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="form-row">
            <div class="col-6 col-md-6 os-form-input ">
                {{--                <label for="last_name" class="form-title">Last name :</label>--}}
                <input type="text" id="last_name" placeholder="Enter Last name" name="last_name"
                       class="form-control @error('last_name') input-error @enderror"
                       value="{{ old('last_name') }}">
                @error('last_name')
                <div class="invalid-feedback"
                     style="display: block !important;">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="form-row">
            <div class="col-6 col-md-6 os-form-input ">
                {{--                <label for="email" class="form-title">Email :</label>--}}
                <input type="text" id="email" placeholder="Enter Email" name="email"
                       value="{{ old('email') }}"
                       class="form-control @error('email') input-error @enderror">
                @error('email')
                <div class="invalid-feedback"
                     style="display: block !important;">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="form-row">
            <div class="col-6 col-md-6 os-form-input ">
                {{--                <label for="password" class="form-title">Password :</label>--}}
                <input type="password" id="password" placeholder="Enter Password" name="password"
                       class="form-control @error('password') input-error @enderror">
                @error('password')
                <div class="invalid-feedback"
                     style="display: block !important;">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="form-row">
            <div class="col-6 col-md-6 os-form-input ">
                {{--                <label for="password_confirmation" class="form-title">Password Confirmation :</label>--}}
                <input type="password" id="password_confirmation" placeholder="Enter Password Confirmation"
                       name="password_confirmation"
                       class="form-control @error('password_confirmation') input-error @enderror">
                @error('password_confirmation')
                <div class="invalid-feedback"
                     style="display: block !important;">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="form-group">
            <div class="col-6 col-md-6 os-form-input">
                <input type="checkbox" id="terms" required>
                <label for="terms" style="display: contents;font-size: 14px">
                    I have read the <a href="#" style="font-size: 14px">Terms and Conditions</a>
                </label>
            </div>
        </div>
        <div class="container-login100-form-btn" style="justify-content: normal">
            <button class="btn btn-primary col-md-6 os-form-input">SIGN UP NOW</button>
        </div>
        <br>
        <div class="flex-sb-m w-full p-t-3 p-b-32">
            <div class="txt1">Have an account?
                <a href="{{ route('loginPage') }}" class="txt1"><span style="color: blue">Sign In</span></a>
            </div>
        </div>
    </form>
@endsection
