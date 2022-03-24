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
                <h1 class="m-lg-0">UAS Operator</h1>
            </div>
        </div>
        <div class="container-fluid page__container">
            <h4 class="card-header__title mb-3">Add as UAS Operator</h4>
            <form action="{{ route('uas-operator.store')}}" method="POST"
                  enctype="multipart/form-data">
                @csrf
                <div class="card card-form">
                    <!-- User Profile -->
                    <div class="row no-gutters">
                        <div class="col-lg-4 card-body">
                            <p><strong class="headings-color form-header">User Profile</strong></p>
                            <p class="text-muted">These fields show your user profile.</p>
                        </div>
                        <div class="col-lg-8 card-form__body card-body">
                            @includeIf('dashboard.forms.create-user-profile')
                        </div>
                    </div>
                    <!-- Additional Profile Details -->
                    <div style="border-top: solid 2px lightgray" class="row no-gutters">
                        <div class="col-lg-4 card-body">
                            <p><strong class="headings-color form-header">Additional Profile Details</strong></p>
                            <p class="text-muted form-subheader">Please provide additional details profile about Remote
                                Pilot.</p>
                            <p class="text-muted" style="color: #111 !important; font-weight: bold">NOTE: This will add
                                a new UAS Operator,
                                and generate 1-2Fly Remote Pilot ID.</p>
                        </div>
                        <div class="col-lg-8 card-form__body card-body">
                            <div class="form-row">
                                <div class="col-12 col-md-12 mb-3">
                                    <label for="address" class="form-title">Address Line 1
                                        <span style="color: red; font-size: 18px">*</span> :</label>
                                    <input type="text" id="address" placeholder="Enter Address Line 1" name="address"
                                           class="form-control input-value @error('address') input-error @enderror"
                                           value="{{ old('address') != null ? old('address') : auth()->user()->address }}">
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
                                           value="{{ old('address2') != null ? old('address2') : auth()->user()->address2 }}">
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
                                           value="{{ old('city') != null ? old('city') : auth()->user()->city }}">
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
                                           value="{{ old('postcode') != null ? old('postcode') : auth()->user()->postcode }}">
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
                                            <!--<option value="{{ $country }}" {{old('country') !=null &&
                                        old('country')==$country ? 'selected' : ''}}>
                                                {{ $country }}
                                            </option>-->
                                            <option value="{{ $country }}" {{($country =='Malaysia') ? 'selected' : ''}}>
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
                                    <label for="type" class="form-title">Certification
                                        <span style="color: red; font-size: 18px">*</span> :</label>
                                    <select id="certification" data-toggle="select" name="certification"
                                            class="form-control input-value  @error('certification') input-error @enderror">
                                        <option value="-1" selected
                                            {{old('certification') !=null && old('certification')== -1 ? 'selected' : '' }}>
                                            None
                                        </option>
                                        <option value="1"
                                            {{old('certification') !=null && old('certification') == 1 ? 'selected' : '' }}>
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
                                               name="rcoc_type[]">
                                        <label class="custom-control-label" for="basic">
                                            Basic
                                        </label>
                                    </div>
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" value="rcoc_type[module1]"
                                               id="Module1"
                                               name="rcoc_type[]">
                                        <label class="custom-control-label" for="Module1">
                                            Module 1
                                        </label>
                                    </div>
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" value="rcoc_type[module2]"
                                               id="Module2"
                                               name="rcoc_type[]">
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
                            <button class="btn btn-primary showSubmit" type="submit" style="margin-left: 20px">Submit
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
                                           value="{{ old('rpto_name') != null ? old('rpto_name') : auth()->user()->rpto_name }}">
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
                                           value="{{ old('date_of_issuance') != null ? old('date_of_issuance') : auth()->user()->date_of_issuance }}">
                                    @error('date_of_issuance')
                                    <div class="invalid-feedback"
                                         style="display: block !important;">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-6 col-md-6 mb-3">
                                    <label for="rpto_certificate" class="form-title">Upload copy Certificate
                                        <span style="color: red; font-size: 18px">*</span> :</label>

                                    <div class="row">
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="rpto_certificate_name">
                                        </div>
                                        <div class="col-sm-2" style="padding-left: 0">
                                            <button class="btn btn-primary" type="button"
                                                    onclick="document.getElementById('rpto_certificate').click()">
                                                Upload
                                            </button>
                                        </div>
                                    </div>
                                    <input type="file" id="rpto_certificate" style="display: none"
                                           name="rpto_certificate"
                                           onchange="getFileData(this, 'rpto_certificate_name');"
                                           class="form-control  @error('rpto_certificate') input-error @enderror">
                                    @error('rpto_certificate')
                                    <div class="invalid-feedback"
                                         style="display: block !important;">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-6 col-md-6 mb-3">
                                    <label for="ua_manufacturer" class="form-title">UA Manufacturer
                                        <span style="color: red; font-size: 18px">*</span> :</label>
                                    <input type="text" id="ua_manufacturer" placeholder="Enter UA Manufacturer"
                                           name="ua_manufacturer"
                                           class="form-control input-value @error('ua_manufacturer') input-error @enderror"
                                           value="{{ old('ua_manufacturer') != null ? old('ua_manufacturer') : auth()->user()->ua_manufacturer }}">
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
                                           value="{{ old('ua_model') != null ? old('ua_model') : auth()->user()->ua_model }}">
                                    @error('ua_model')
                                    <div class="invalid-feedback"
                                         style="display: block !important;">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <a class="btn btn-danger"
                               href="{{ route('uas-operator.index') }}">Cancel</a>
                            <button class="btn btn-primary" type="submit" style="margin-left: 20px">Submit</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('script')
    <script>
        let certification = document.getElementById('certification');
        certification.onchange = function () {
            let only_none = document.getElementById('only-none');
            // let showSubmit = document.getElementById('showSubmit');
            let show_submit = document.getElementsByClassName('showSubmit');
            if (certification.value == -1) {
                Array.prototype.forEach.call(show_submit, function (el) {
                    el.style.display = "inline-block";
                });
                only_none.style.display = "none";
                document.getElementById('rcoc').style.display = "none";
            } else {
                Array.prototype.forEach.call(show_submit, function (el) {
                    el.style.display = "none";
                });
                only_none.style.display = "flex";
                document.getElementById('rcoc').style.display = "inline-block";

            }
        }
    </script>

    @if(old('certification') == -1)
        <script>
            let show_submit = document.getElementsByClassName('showSubmit');

            Array.prototype.forEach.call(show_submit, function (el) {
                el.style.display = "inline-block";
            });
            document.getElementById('only-none').style.display = "none";
            document.getElementById('rcoc').style.display = "none";
        </script>
    @elseif(old('certification') == 1)
        <script>
            let show_submit = document.getElementsByClassName('showSubmit');
            Array.prototype.forEach.call(show_submit, function (el) {
                el.style.display = "none";
            });
            document.getElementById('only-none').style.display = "flex";
            document.getElementById('rcoc').style.display = "inline-block";
        </script>
    @endif
@endsection
