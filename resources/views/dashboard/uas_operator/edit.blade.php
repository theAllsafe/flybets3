@extends('layouts.index')
@section('style')
    <style>
        .text-muted {
            line-height: 1.3 !important;
        }

        .input-error {
            border-color: #bb3434 !important;
            padding-right: calc(1.5em + 0.75rem) !important;
            background-image: url('data:image/svg+xml,<svg xmlns=\'http://www.w3.org/2000/svg\' width=\'12\' height=\'12\' fill=\'none\' stroke=\'%23bb3434\' viewBox=\'0 0 12 12\'><circle cx=\'6\' cy=\'6\' r=\'4.5\'/><path stroke-linejoin=\'round\' d=\'M5.8 3.6h.4L6 6.5z\'/><circle cx=\'6\' cy=\'8.2\' r=\'.6\' fill=\'%23bb3434\' stroke=\'none\'/></svg>') !important;
            background-repeat: no-repeat !important;
            background-position: right calc(0.375em + 0.1875rem) center !important;
            background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem) !important;
        }

        .only_recreational {
            display: none;
        }

        .showSubmit {
            display: none;
        }

        #only-none {
            display: none;
        }

        #rcoc {
            display: none;
        }

        .qr-code{
            width: 250px;
            height: 250px;
        }

        .download-btn-text{
            font-size: 15px;
        }

        .download-btn{
            display: block;
            width: 80%;
        }

        @media screen and (max-width: 1150px) {
            .qr-code svg{
                width: 230px;
                height: 230px;
            }
        }

        @media screen and (max-width: 1050px) {
            .qr-code svg{
                width: 200px;
                height: 200px;
            }
        }

        @media screen and (max-width: 720px) {
            .qr-code svg{
                width: 180px;
                height: 180px;
            }
        }
        @media screen and (max-width: 552px) {
            .form-title{
                font-size: 12px;
            }
        }

        @media screen and (max-width: 520px) {
            /*.form-title{*/
            /*    font-size: 11px;*/
            /*}*/

            .download-btn-text{
                font-size: 14px;
            }
        }


    </style>
@endsection
@section('content')
    <div class="mdk-drawer-layout__content page">
        <div class="container-fluid page__heading-container">
            <div class="
                  page__heading
                  d-flex
                  flex-column flex-md-row
                  align-items-center
                  justify-content-center justify-content-lg-between
                  text-center text-lg-left
                ">
                <h1 class="m-lg-0">Update Profile</h1>
            </div>
        </div>
        <div class="container-fluid page__container">
            <h4 class="card-header__title mb-3">Update Profile</h4>
            <form action="{{ route('uas-operator.update', $uas_operator->id)}}" method="POST"
                  enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card card-form">
                    <!-- User Profile -->
                    <div class="row no-gutters">
                        <div class="col-lg-4 card-body">
                            <p><strong class="headings-color form-header">Update your UAS Operator profile</strong></p>
                            <p class="text-muted form-subheader">These fields show your UAS Operator profile.</p>
                        </div>
                        <div class="col-lg-8 card-form__body card-body">
                            <div class="form-row">
                                <div class="col-6 col-md-6 mb-3">
                                    <label for="first_name" class="form-title">UAS Operator registration id :</label>
                                    <input type="text" class="form-control input-value" disabled
                                           value="{{ isset($uas_operator->registration_id) ? $uas_operator->registration_id : '' }}">
                                </div>
                                <div class="col-6 col-md-6 mb-3">
                                    <label for="first_name" class="form-title">QR Code:</label>
                                    <button class="btn btn-success form-control input-value" type="button" onclick="download()">
                                        <span class="download-btn-text">Download</span>
                                    </button>
                                </div>
{{--                                <div class="col-3 col-md-3 mb-3">--}}
{{--                                </div>--}}
                            </div>
                            <div class="form-row">
                                <div class="col-6 col-md-6 mb-3">
                                </div>
                                <div class="col-6 col-md-6 mb-3">
                                    <div class="qr-code" id="qr-code">
                                        {!! QrCode::size(250)->generate('National/Passport ID: ' . auth()->user()->national_passport_id); !!}
                                    </div>
                                    {{-- <img src="{{ asset('assets/images/login/alexandre-godreau-431553-unsplash.jpg') }}"--}}
                                    {{-- alt="" width="200px" height="200px">--}}
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-12 col-md-12 mb-3">
                                    <label for="gender" class="form-title">1-2Fly registration id :</label>
                                    <input type="text" class="form-control input-value input-value"
                                           value="{{ isset($uas_operator->fly_registration_id) ? $uas_operator->fly_registration_id : '' }}"
                                           disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Additional Profile Details -->
                    <div style="border-top: solid 2px lightgray" class="row no-gutters">
                        <div class="col-lg-4 card-body">
                            <p><strong class="headings-color form-header">Additional Profile Details</strong></p>
                            <p class="text-muted form-subheader">Please update additional details profile about UAS
                                Operator and Remote Pilot.</p>
                        </div>
                        <div class="col-lg-8 card-form__body card-body">
                            <div class="form-row">
                                <div class="col-12 col-md-12 mb-3">
                                    <label for="address" class="form-title">Address Line 1
                                        <span style="color: red; font-size: 18px">*</span> :</label>
                                    <input type="text" id="address" placeholder="Enter Address Line 1" name="address"
                                           class="form-control input-value @error('address') input-error @enderror"
                                           value="{{ old('address') != null ? old('address') : $uas_operator->address }}">
                                    @error('address')
                                    <div class="invalid-feedback"
                                         style="display: block !important;">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-12 col-md-12 mb-3">
                                    <label for="address2" class="form-title">Address Line 2 :</label>
                                    <input type="text" id="address2" placeholder="Enter Address Line 2" name="address2"
                                           class="form-control input-value @error('address2') input-error @enderror"
                                           value="{{ old('address2') != null ? old('address2') : $uas_operator->address2 }}">
                                    @error('address2')
                                    <div class="invalid-feedback"
                                         style="display: block !important;">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-12 col-md-12 mb-3">
                                    <label for="city" class="form-title">City
                                        <span style="color: red; font-size: 18px">*</span> :</label>
                                    <input type="text" id="city" placeholder="Enter City" name="city"
                                           class="form-control input-value @error('city') input-error @enderror"
                                           value="{{ old('city') != null ? old('city') : $uas_operator->city }}">
                                    @error('city')
                                    <div class="invalid-feedback"
                                         style="display: block !important;">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-12 col-md-12 mb-3">
                                    <label for="postcode" class="form-title">Postcode
                                        <span style="color: red; font-size: 18px">*</span> :</label>
                                    <input type="text" id="postcode" placeholder="Enter Postcode" name="postcode"
                                           class="form-control input-value @error('postcode') input-error @enderror"
                                           value="{{ old('postcode') != null ? old('postcode') : $uas_operator->postcode }}">
                                    @error('postcode')
                                    <div class="invalid-feedback"
                                         style="display: block !important;">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-12 col-md-12 mb-3">
                                    <label for="country" class="form-title">Country
                                        <span style="color: red; font-size: 18px">*</span> :</label>
                                    <select id="country" data-toggle="select" name="country"
                                            class="form-control input-value  @error('country') input-error @enderror">
                                        <option value="null" selected>Select Country</option>
                                        @foreach($countries as $country)
                                            <option
                                                value="{{ $country }}" {{ $uas_operator->country==$country ? 'selected' : ''}}>
                                                {{ $country }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('country')
                                    <div class="invalid-feedback"
                                         style="display: block !important;">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-12 col-md-12 mb-3">
                                    <label for="type" class="form-title">Type of Intended
                                        Operation
                                        <span style="color: red; font-size: 18px">*</span> :</label>
                                    <select id="type_of_intended_operation"
                                            data-toggle="select"
                                            name="type_of_intended_operation"
                                            class="form-control input-value  @error('type_of_intended_operation') input-error @enderror">
                                        <option selected
                                                value="1"
                                                @if(old('type_of_intended_operation') != null && old('type_of_intended_operation') == 1)
                                                selected
                                                @elseif($uas_operator->type_of_intended_operation == 1)
                                                selected
                                            @endif
                                        >Recreational
                                        </option>
                                        <option
                                            value="2"
                                            @if(old('type_of_intended_operation') != null && old('type_of_intended_operation') == 2)
                                            selected
                                            @elseif($uas_operator->type_of_intended_operation == 2)
                                            selected
                                            @endif
                                        >Hire & Reward
                                        </option>
                                        <option
                                            value="3"
                                            @if(old('type_of_intended_operation') != null && old('type_of_intended_operation') == 3)
                                            selected
                                            @elseif($uas_operator->type_of_intended_operation == 3)
                                            selected
                                            @endif
                                        >Both (Recreational / Hire & Reward)
                                        </option>
                                    </select>
                                    @error('type_of_intended_operation')
                                    <div class="invalid-feedback"
                                         style="display: block !important;">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="only_recreational">
                                <div class="form-row">
                                    <div class="col-12 col-md-12">
                                        <label for="name_of_entity_registered_with_ssm" class="form-title">Name of
                                            Entity Registered with SSM
                                            <span style="color: red; font-size: 18px">*</span> :</label>
                                        <input type="text" id="name_of_entity_registered_with_ssm"
                                               placeholder="Enter Name of Entiry Registered with SSM"
                                               name="name_of_entity_registered_with_ssm"
                                               class="form-control input-value @error('name_of_entity_registered_with_ssm') input-error @enderror"
                                               value="{{ old('name_of_entity_registered_with_ssm') != null ?
                                                    old('name_of_entity_registered_with_ssm') :
                                                     $uas_operator->name_of_entity_registered_with_ssm }}">
                                        @error('name_of_entity_registered_with_ssm')
                                        <div class="invalid-feedback" style="display: block !important;">{{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            {{-- @dd(auth()->user()) --}}
                            <div class="only_recreational">
                                <div class="form-row">
                                    <div class="col-6 col-md-6 mb-3">
                                        <label for="ssm_registration_number" class="form-title">SSM Registration Number
                                            <span style="color: red; font-size: 18px">*</span> :</label>
                                        <input type="text" id="ssm_registration_number" name="ssm_registration_number"
                                               placeholder="Enter SSM Registration Number"
                                               class="form-control input-value @error('ssm_registration_number') input-error @enderror"
                                               value="{{ old('ssm_registration_number') != null ? old('ssm_registration_number') : $uas_operator->ssm_registration_number }}">
                                        @error('ssm_registration_number')
                                        <div class="invalid-feedback" style="display: block !important;">{{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    {{-- @dd($uas_operator->ssm_certificate) --}}
                                    <div class="col-6 col-md-6 mb-3">
                                        <label for="ssm_certificate" class="form-title custom-file-upload">
                                            Upload copy SSM CERTIFICATE <span
                                                style="color: red; font-size: 18px">*</span>
                                            :</label>
                                        <div class="row">
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="ssm_certificate_name"
                                                       value="{{  $uas_operator->ssm_certificate }}" disabled style="background:white;">
                                            </div>
                                            <div class="col-sm-2" style="padding-left: 0">
                                                <button class="btn btn-primary" type="button"
                                                        onclick="document.getElementById('ssm_certificate').click()">
                                                    Upload
                                                </button>
                                                <label id="ssm_certificate_name_label" style="padding-top: 5px;"></label>
                                            </div>
                                        </div>
                                        <input type="file" id="ssm_certificate" style="display: none"
                                               name="ssm_certificate"
                                               onchange="getFileData(this, 'ssm_certificate_name');"
                                               class="form-control  @error('ssm_certificate') input-error @enderror">
                                        @error('ssm_certificate')
                                        <div class="invalid-feedback" style="display: block !important;">{{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    {{--                                    <div class="col-6 col-md-6 mb-3">--}}
                                    {{--                                        <label for="ssm_certificate" class="form-title">Upload copy SSM CERTIFICATE--}}
                                    {{--                                            <span style="color: red; font-size: 18px">*</span> :</label>--}}
                                    {{--                                        <input type="file" id="ssm_certificate"--}}
                                    {{--                                               placeholder="Upload copy SSM CERTIFICATE"--}}
                                    {{--                                               name="ssm_certificate"--}}
                                    {{--                                               class="form-control input-value @error('ssm_certificate') input-error @enderror"--}}
                                    {{--                                               value="{{ old('ssm_certificate') != null ? old('ssm_certificate') : $uas_operator->ssm_certificate }}">--}}
                                    {{--                                        @error('ssm_certificate')--}}
                                    {{--                                        <div class="invalid-feedback" style="display: block !important;">{{ $message }}--}}
                                    {{--                                        </div>--}}
                                    {{--                                        @enderror--}}
                                    {{--                                    </div>--}}
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-12 col-md-12 mb-3">
                                    <label for="type" class="form-title">Certification
                                        <span style="color: red; font-size: 18px">*</span> :</label>
                                    <select id="certification" data-toggle="select" name="certification"
                                            class="form-control input-value  @error('certification') input-error @enderror">
                                        <option value="-1"
                                                @if(old('certification') == -1 || $uas_operator->certification == -1) selected @endif >
                                            None
                                        </option>
                                        <option value="1"
                                                @if(old('certification') == 1 || $uas_operator->certification==1) selected @endif >
                                            RCoC
                                        </option>
                                    </select>
                                    @error('certification')
                                    <div class="invalid-feedback"
                                         style="display: block !important;">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <div id="rcoc">
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" value="rcoc_type[basic]"
                                               id="basic"
                                               name="rcoc_type[]" {{ str_contains($uas_operator->rcoc_type,'basic') ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="basic">
                                            Basic
                                        </label>
                                    </div>
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" value="rcoc_type[module1]"
                                               id="Module1"
                                               name="rcoc_type[]" {{ str_contains($uas_operator->rcoc_type,'module1') ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="Module1">
                                            Module 1
                                        </label>
                                    </div>
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" value="rcoc_type[module2]"
                                               id="Module2"
                                               name="rcoc_type[]" {{ str_contains($uas_operator->rcoc_type,'module2') ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="Module2">
                                            Module 2
                                        </label>
                                    </div>
                                    @error('rcoc_type')
                                    <div class="invalid-feedback"
                                         style="display: block !important;">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <a class="btn btn-danger showSubmit"
                               href="{{ route('uas-operator.index') }}">Cancel</a>
                            <button class="btn btn-primary showSubmit" type="submit" style="margin-left: 20px">Update
                            </button>
                        </div>
                    </div>
                    <!-- Remote Pilot Training Organisation (RPTO) -->
                    <div class="row no-gutters" id="only-none">
                        <div class="col-lg-4 card-body">
                            <p class="text-muted form-subheader">Please provide your details Remote Pilot Training
                                Organisation (RPTO)
                                information.</p>
                        </div>
                        <div class="col-lg-8 card-form__body card-body" style="border-top: solid 2px lightgray">
                            <div class="form-row">
                                <div class="col-12 col-md-12 mb-3">
                                    <label class="form-title" style="font-weight: 900;color: #111">Remote Pilot Training
                                        Organisation (RPTO)</label>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-12 col-md-12 mb-3">
                                    <label for="rpto_name" class="form-title">NAME<span
                                            style="color: red; font-size: 18px">*</span> :</label>
                                    <input type="text" id="rpto_name" placeholder="Enter Name" name="rpto_name"
                                           class="form-control input-value @error('rpto_name') input-error @enderror"
                                           value="{{ old('rpto_name') != null ? old('rpto_name') : $rpto->name }}">
                                    @error('rpto_name')
                                    <div class="invalid-feedback"
                                         style="display: block !important;">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-6 col-md-6 mb-3">
                                    <label for="date_of_issuance" class="form-title">Date of Issuance (DD/MM/YY)
                                        <span style="color: red; font-size: 18px">*</span> :</label>
                                    <input type="date" id="date_of_issuance" name="date_of_issuance"
                                           placeholder="Choose Date of Issuance"
                                           class="form-control input-value @error('date_of_issuance') input-error @enderror"
                                           value="{{ old('date_of_issuance') != null ? old('date_of_issuance') : $rpto->date_of_issuance }}">
                                    @error('date_of_issuance')
                                    <div class="invalid-feedback"
                                         style="display: block !important;">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-6 col-md-6 mb-3">
                                    <label for="rpto_certificate" class="form-title custom-file-upload">
                                        Upload copy Certificate <span
                                            style="color: red; font-size: 18px">*</span>
                                        :</label>
                                    <div class="row">
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="rpto_certificate_name" disabled
                                                   value="{{  $rpto->rpto_certificate }}" style="background:white;">
                                        </div>
                                        <div class="col-sm-2" style="padding-left: 0">
                                            <button class="btn btn-primary" type="button"
                                                    onclick="document.getElementById('rpto_certificate').click()">
                                                Upload
                                            </button>
                                            <label id="rpto_certificate_name_label" style="padding-top: 5px;"></label>
                                        </div>
                                    </div>
                                    <input type="file" id="rpto_certificate" style="display: none"
                                           name="rpto_certificate"
                                           onchange="getFileData(this, 'rpto_certificate_name');"
                                           class="form-control  @error('rpto_certificate') input-error @enderror">
                                    @error('rpto_certificate')
                                    <div class="invalid-feedback" style="display: block !important;">{{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                {{--                                <div class="col-6 col-md-6 mb-3">--}}
                                {{--                                    <label for="rpto_certificate" class="form-title">Upload copy Certificate--}}
                                {{--                                        <span style="color: red; font-size: 18px">*</span> :</label>--}}
                                {{--                                    <input type="file" id="rpto_certificate" placeholder="Upload copy Certificate"--}}
                                {{--                                           name="rpto_certificate"--}}
                                {{--                                           class="form-control input-value @error('rpto_certificate') input-error @enderror"--}}
                                {{--                                           value="{{ old('rpto_certificate') != null ? old('rpto_certificate') : $rpto->rpto_certificate }}">--}}
                                {{--                                    @error('rpto_certificate')--}}
                                {{--                                    <div class="invalid-feedback"--}}
                                {{--                                         style="display: block !important;">{{ $message }}</div>--}}
                                {{--                                    @enderror--}}
                                {{--                                </div>--}}
                            </div>
                            <div class="form-row">
                                <div class="col-6 col-md-6 mb-3">
                                    <label for="ua_manufacturer" class="form-title">UA Manufacturer
                                        <span style="color: red; font-size: 18px">*</span> :</label>
                                    <input type="text" id="ua_manufacturer" placeholder="Enter UA Manufacturer"
                                           name="ua_manufacturer"
                                           class="form-control input-value @error('ua_manufacturer') input-error @enderror"
                                           value="{{ old('ua_manufacturer') != null ? old('ua_manufacturer') : $rpto->ua_manufacturer }}">
                                    @error('ua_manufacturer')
                                    <div class="invalid-feedback"
                                         style="display: block !important;">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-6 col-md-6 mb-3">
                                    <label for="ua_model" class="form-title">UA Model
                                        <span style="color: red; font-size: 18px">*</span> :</label>
                                    <input type="text" id="ua_model" placeholder="Enter UA Model" name="ua_model"
                                           class="form-control input-value @error('ua_model') input-error @enderror"
                                           value="{{ old('ua_model') != null ? old('ua_model') : $rpto->ua_model }}">
                                    @error('ua_model')
                                    <div class="invalid-feedback"
                                         style="display: block !important;">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <a class="btn btn-danger" href="{{ route('dashboard') }}">Cancel</a>
                            <button class="btn btn-primary" type="submit" style="margin-left: 20px">Update
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $('#ssm_certificate').change(function() {
            var file = $('#ssm_certificate')[0].files[0].name;
            //$('#ssm_certificate_name_label').html(file);
          $('#ssm_certificate_name').val(file);
          //alert(file);
        });
        $('#rpto_certificate').change(function() {
            var file = $('#rpto_certificate')[0].files[0].name;
            //$('#rpto_certificate_name_label').html(file);
            $('#rpto_certificate_name').val(file);
          //alert(file);
        });
    </script>
    <script>

    // Set ID for svg so it can be downloaded using download function
    let svg = document.getElementsByTagName('svg');
    svg[0].setAttribute('id','qr-code-svg');

    // Function that is help to download the QR code by convert it to png
    function download()
    {

        img = new Image(),
        serializer = new XMLSerializer(),
        svgStr = serializer.serializeToString(document.getElementById('qr-code-svg'));

        let svg = document.getElementsByTagName('svg');
        svg[0].setAttribute('id','qr-code-svg');

        img.src = 'data:image/svg+xml;base64,'+window.btoa(svgStr);

        // You could also use the actual string without base64 encoding it:
        //img.src = "data:image/svg+xml;utf8," + svgStr;

        var canvas = document.createElement("canvas");

        // svg[0].getAttribute('width')
        // svg[0].getAttribute('height')
        var w = 250;
        var h = 250;

        canvas.width = w;
        canvas.height = h;
        canvas.getContext("2d").drawImage(img,0,0,w,h);

        var imgURL = canvas.toDataURL("image/png");

        var dlLink = document.createElement('a');
        dlLink.download = "image";
        dlLink.href = imgURL;
        dlLink.dataset.downloadurl = ["image/png", dlLink.download, dlLink.href].join(':');

        document.body.appendChild(dlLink);
        dlLink.click();
        document.body.removeChild(dlLink);
    }

    </script>
    <script>
        let type_of_intended_operation = document.getElementById('type_of_intended_operation');
        type_of_intended_operation.onchange = function () {
            let only_recreational = document.getElementsByClassName('only_recreational');
            if (type_of_intended_operation.value == 1) {
                Array.prototype.forEach.call(only_recreational, function (el) {
                    el.style.display = "none";
                });
            } else {
                Array.prototype.forEach.call(only_recreational, function (el) {
                    el.style.display = "block";
                });
            }
        };

        let certification = document.getElementById('certification');
        certification.onchange = function () {
            let only_none = document.getElementById('only-none');
            let showSubmit = document.getElementsByClassName('showSubmit');
            let rcoc = document.getElementById('rcoc');
            if (certification.value == -1) {
                Array.prototype.forEach.call(showSubmit, function (el) {
                    el.style.display = "inline-block";
                });
                only_none.style.display = "none";
                // showSubmit.style.display = "flex";
                rcoc.style.display = "none";
            } else {
                only_none.style.display = "flex";
                Array.prototype.forEach.call(showSubmit, function (el) {
                    el.style.display = "none";
                });
                // showSubmit.style.display = "none";
                rcoc.style.display = "inline-block";
            }
        };
    </script>

    @if(old('type_of_intended_operation') != null && old('type_of_intended_operation') != 1)
        <script>
            let only_recreational = document.getElementsByClassName('only_recreational');
            Array.prototype.forEach.call(only_recreational, function (el) {
                el.style.display = "block";
            });
        </script>
    @endif
    @if($uas_operator->type_of_intended_operation == 2 || $uas_operator->type_of_intended_operation == 3)
        <script>
            let only_recreational = document.getElementsByClassName('only_recreational');
            Array.prototype.forEach.call(only_recreational, function (el) {
                el.style.display = "block";
            });
        </script>
    @endif
    @if($uas_operator->certification == -1)
        <script>
            let showSubmit = document.getElementsByClassName('showSubmit');

            document.getElementById('only-none').style.display = "none";
            Array.prototype.forEach.call(showSubmit, function (el) {
                el.style.display = "inline-block";
            });
            // document.getElementById('showSubmit').style.display = "flex";
            document.getElementById('rcoc').style.display = "none";
        </script>
    @elseif($uas_operator->certification == 1)
        <script>
            let showSubmit = document.getElementsByClassName('showSubmit');

            document.getElementById('only-none').style.display = "flex";
            Array.prototype.forEach.call(showSubmit, function (el) {
                el.style.display = "none";
            });
            // document.getElementById('showSubmit').style.display = "none";
            document.getElementById('rcoc').style.display = "inline-block";
        </script>
    @endif
    @if(old('certification') == -1)
        <script>
            let showSubmit = document.getElementsByClassName('showSubmit');

            document.getElementById('only-none').style.display = "none";
            Array.prototype.forEach.call(showSubmit, function (el) {
                el.style.display = "inline-block";
            });
            // document.getElementById('showSubmit').style.display = "flex";
            document.getElementById('rcoc').style.display = "none";
        </script>
    @elseif(old('certification') == 1)
        <script>
            let showSubmit = document.getElementsByClassName('showSubmit');

            document.getElementById('only-none').style.display = "flex";
            Array.prototype.forEach.call(showSubmit, function (el) {
                el.style.display = "none";
            });
            // document.getElementById('showSubmit').style.display = "none";
            document.getElementById('rcoc').style.display = "inline-block";
        </script>
    @endif
@endsection
