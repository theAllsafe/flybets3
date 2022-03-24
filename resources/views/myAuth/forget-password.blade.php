@extends('myAuth.layouts')
@section('style')
    <style>

        .submit-button{
            margin-left: 15px;
        }

        @media screen and (max-width: 425px) {
            .submit-button{
                margin-left: 30px;
            }
        } @media screen and (max-width: 375px) {
            .submit-button{
                margin-left: 50px;
            }
        }


    </style>
@endsection
@section('form')
    <form class="login100-form validate-form" method="POST" onSubmit="return validateForm()" id="theFormID" action="{{ route('password.email') }}"
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
            <div class="col-6 col-md-6">
                <label class="form-title" style="font-size: 18px; color: black">Reset Password</label>
                <label class="form-title" style="font-size: 14px">Please enter the email address registered when Sign
                    Up. </label>
            </div>
        </div>
        <div id="msg-old">
        </div>
        <div class="form-row email">
            <div class="col-6 col-md-6 os-form-input">
                {{--                <label for="email" class="form-title">Email  :</label>--}}
                <input type="text" id="email" placeholder="Enter Email" name="email"
                       value="{{ old('email') }}"
                       class="form-control @error('email') input-error @enderror">
                @error('email')
                <div class="invalid-feedback"
                     style="display: block !important;">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="otp">
        </div>
        <div class="password">
        </div>
        <div class="row all_button" style="justify-content: normal">
            <div class="col-2">
                <a class="btn btn-danger" style="margin-right: 15px" href="{{ route('loginPage') }}">BACK</a>
            </div>
            <div class="col-2 submit_buttons">
                <button class="btn btn-primary submit-button">SUBMIT </button>
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
    let email=$('#email').val();
    let password=$('#password').val();
    let verifyotp=$('#verifyotp').val();
    $.ajax({
        type: "GET",
        url: '/drone/public/checkresetvalid',
        data: {
            'email':email,
            'password':password,
            'otp':verifyotp
        }, // serializes the form's elements.
        success: function(data)
        {
            console.log(data);
            if(data.success && data.message!='verified')
            {
                $(".email"). css("display", "none");
                $("#msg-old").html("<p style='color:black;'>Enter the verification code we've sent to <span style='color:blue;'> "+ email +"</span>.<br /> If you have not received it, you can request to resend <button style='color:black;'><b>HERE</b></button>.</p>");
                $('.otp').html('');
                $('.otp').append('<div class="form-row otp_verifying"><div class="col-6 col-md-6 os-form-input"><input type="text" id="verifyotp" maxlength="6" placeholder="Enter OTP" name="otp" class="form-control input-error"></div></div>');
                return false;

            }else if(data.success && data.message=='verified')
            {
                $(".otp_verifying"). css("display", "none");
                $("#msg-old").html('<p style="color:green;">OTP Verify Successfully, Enter new Password.</p>');
                $(".password"). html('');
                $('.password').append('<div class="form-row passwordvalue"><div class="col-6 col-md-6 os-form-input"><input type="password" id="password" placeholder="Enter Password" name="password" class="form-control" minlength="8" required></div></div>');
                return false;
                /*document.getElementById('theFormID').submit();
                return(true);*/
            }else if(data.success!='true' && data.message=='password_updated')
            {
                
                $("#msg-old").html('<p style="color:green;">Password Changed Successfully, Now you can login with new password.</p>');
                $(".passwordvalue"). css("display", "none");
                $(".all_button").html('');
                $(".all_button").append('<div class="col-2"><a class="btn btn-success" style="margin-right: 15px" href="{{ route('loginPage') }}">Done</a>');
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
