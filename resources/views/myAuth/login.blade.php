@extends('myAuth.layouts')
@section('form')
    <form class="login100-form validate-form" id="theFormID" onSubmit="return validateForm()" method="POST" action="{{ route('login') }}" style="padding-top: 50px">
        @csrf
        <div class="row" style="padding-bottom: 50px">
            <img src="{{ asset('assets/12FlyIcons/12FlyLogoGrey.png') }}" alt="" width="150px">
        </div>
        <div class="row">
            <span class="col-md-6 login100-form-title p-b-43"
                  style="text-align: left;display: block"> OPERATOR PORTAL </span>
        </div>
        <div class="form-row">
            <div class="col-6 col-md-6 ">
                <label class="form-title" style="font-size: 18px; color: black">Sign in</label>
                <label class="form-title" style="font-size: 14px">Sign in with your registered account</label>
            </div>
        </div>
        <div id="msg-old">
        </div>
        <div class="form-row email">
            <div class="col-6 col-md-6 os-form-input">
                {{--                <label for="email" class="form-title">Email :</label>--}}
                <input type="text" id="email" placeholder="Enter Email" name="email" autofocus
                       class="form-control @error('email') input-error @enderror" value="{{ old('email') }}">
                @error('email')
                <div class="invalid-feedback"
                     style="display: block !important;">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="form-row password">
            <div class="col-6 col-md-6 os-form-input">
                {{--                <label for="password" class="form-title">password :</label>--}}
                <input type="password" id="password" placeholder="Enter Password" name="password"
                       class="form-control @error('password') input-error @enderror">
                @error('password')
                <div class="invalid-feedback"
                     style="display: block !important;">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="otp">
        </div>
        <div class="container-login100-form-btn login_button" style="justify-content: normal">
            <button class="btn btn-primary col-md-6 os-form-input login_button">SIGN IN</button>
        </div>
        <br>
        <div class="flex-sb-m w-full p-t-3 p-b-10">
            <div class="txt1">Forget your Password?
                <a href="{{ route('password.request') }}" class="txt1"><span style="color: blue">Reset Password</span></a>
            </div>
        </div>
        <div class="flex-sb-m w-full p-t-3 p-b-32">
            <div class="txt1">Don't have an account?
                <a href="{{ route('register') }}" class="txt1"><span style="color: blue">Sign Up</span></a>
            </div>
        </div>
    </form>
@endsection
@section('script')
<script>
function validateForm(){
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
    
    let email=$('#email').val();
    let password=$('#password').val();
    let verifyotp=$('#verifyotp').val();
    $.ajax({
        type: "GET",
        url: '/drone/public/checkemailvalid',
        data: {
            'email':email,
            'password':password,
            'otp':verifyotp
        }, // serializes the form's elements.
        success: function(data)
        {
            console.log(data);
            if(data.success && data.message != 'verified')
            {
                $("#msg-old").html("<p style='color:black;'>Enter the verification code we've sent to <span style='color:blue;'> "+ email +"</span>.<br /> If you have not received it, you can request to resend <button style='color:black;'><b>HERE</b></button>.</p><br />");
                $('.login_button').html('');
                $('.login_button').html('<button class="btn btn-danger col-md-2 os-form-input" onClick="return location.reload();">BACK</button><div class="col-md-2"></div><button class="btn btn-primary col-md-2 os-form-input login_button">SIGN IN</button>');
                $(".email"). css("display", "none");
                $(".password"). css("display", "none");
                $('.otp').html('');
                $('.otp').append('<div class="form-row"><div class="col-6 col-md-6 os-form-input"><input type="text" id="verifyotp" maxlength="6" placeholder="Enter Code" name="otp" class="form-control input-error"></div></div>');
                return false;

            }else if(data.success && data.message == 'verified')
            {
                document.getElementById('theFormID').submit();
                return(true);
            }
            else{
                    //$("#msg-old").html("<p style='color:black;'>Enter the verification code we've sent to <span style='color:blue;'> "+ email +"</span>.<br /> If you have not received it, you can request to resend <button style='color:black;'><b>HERE</b></button>.</p>");
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


