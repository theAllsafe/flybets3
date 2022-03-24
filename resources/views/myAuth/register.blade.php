@extends('myAuth.layouts')
@section('form')
    <form class="login100-form validate-form" method="POST" onSubmit="return validateForm()" id="theFormID" action="{{ route('register') }}"
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
        @if (\Session::has('success'))
                <p class="alert alert-success" style="width: 314px;">CREATING A NEW ACCOUNT SUCCESSFUL</p>
                <div><a class="btn btn-success" style="margin-right: 15px" href="{{ route('loginPage') }}">Done</a></div>
        @else
        <div id="msg-old">
        </div>
        <div class="form-row first_name">
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
        <div class="form-row last_name">
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
        <div class="form-row email">
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
        <div class="form-row password">
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
        <div class="form-row password_confirmation">
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
        <div class="form-group terms_condition">
            <div class="col-6 col-md-6 os-form-input">
                <input type="checkbox" id="terms" required>
                <label for="terms" style="display: contents;font-size: 14px">
                    I have read the <a href="#" style="font-size: 14px">Terms and Conditions</a>
                </label>
            </div>
        </div>
        <div class="otp">
        </div>
        <div class="container-login100-form-btn login_button" style="justify-content: normal">
            <button class="btn btn-primary col-md-6 os-form-input">SIGN UP NOW</button>
        </div>
        <br>
        <div class="flex-sb-m w-full p-t-3 p-b-32">
            <div class="txt1">Have an account?
                <a href="{{ route('loginPage') }}" class="txt1"><span style="color: blue">Sign In</span></a>
            </div>
        </div>
        
        @endif
        
    </form>
@endsection
@section('script')
<script>
function validateForm(){
    if($('#terms').length == 0)
    {
        $("#msg-old").html('Please accept terms and Conditions');
        return false;
    }
    if($('#first_name').val().length ==0)
    {
        $("#msg-old").html('<p style="color:red;">Please Enter First Name</p>');
        return false;
    }
    if($('#last_name').val().length ==0)
    {
        $("#msg-old").html('<p style="color:red;">Please Enter Last Name</p>');
        return false;
    }
    if($('#email').val().length ==0)
    {
        $("#msg-old").html('<p style="color:red;">Please Enter Email</p>');
        return false;
    }
    if($('#password').val().length ==0)
    {
        $("#msg-old").html('<p style="color:red;">Please Enter Password</p>');
        return false;
    }
    if($('#password_confirmation').val().length ==0)
    {
        $("#msg-old").html('<p style="color:red;">Please Enter Confirm Password</p>');
        return false;
    }
    let first_name=$('#first_name').val();
    let last_name=$('#last_name').val();
    let email=$('#email').val();
    let password=$('#password').val();
    let password_confirmation=$('#password_confirmation').val();
    let verifyotp=$('#verifyotp').val();
    $.ajax({
        type: "GET",
        url: '/drone/public/checkregistervalid',
        data: {
            'first_name':first_name,
            'last_name':last_name,
            'email':email,
            'password':password,
            'password_confirmation':password_confirmation,
            'otp':verifyotp
        }, // serializes the form's elements.
        success: function(data)
        {
            console.log(data);
            if(data.success && data.message!='verified')
            {
                //$("#msg-old").html('<p style="color:red;">You have received an email with a verification code.<br /> If you have not received it, you can request to resend by pressing <button style="color:red;"><b><u>here</u></b></button>.</p>');
                $("#msg-old").html("<p style='color:black;'>Enter the verification code we've sent to <span style='color:blue;'> "+ email +"</span>.<br /> If you have not received it, you can request to resend <button style='color:black;'><b>HERE</b></button>.</p>");
                $('.login_button').html('');
                $('.login_button').html('<button class="btn btn-danger col-md-2" onClick="return location.reload();">BACK</button><div class="col-md-1"></div><button class="btn btn-primary col-md-3 os-form-input">SIGN UP NOW</button>');
                $(".terms_condition"). css("display", "none");
                $(".first_name"). css("display", "none");
                $(".last_name"). css("display", "none");
                $(".email"). css("display", "none");
                $(".password"). css("display", "none");
                $(".password_confirmation"). css("display", "none");
                $('.otp').html('');
                $('.otp').append('<div class="form-row"><div class="col-6 col-md-6 os-form-input"><input type="text" id="verifyotp" maxlength="6" placeholder="Enter Code" name="otp" class="form-control input-error"></div></div>');
                return false;

            }else if(data.success && data.message=='verified')
            {
                document.getElementById('theFormID').submit();
                return(true);
            }
            else{
                    $("#msg-old").html("<p style='color:black;'>Enter the verification code we've sent to <span style='color:blue;'> "+ email +"</span>.<br /> If you have not received it, you can request to resend <button style='color:black;'><b>HERE</b></button>.</p>");
                    $("#msg-old").append('<p style="color:red;">' + data.message + '</p>');
                    $("#verifyotp").val('');
                    return false;
            }
          
        },
        error:function(){
                return false;
            }
    });
    return false;
    
  }
</script>

@endsection
