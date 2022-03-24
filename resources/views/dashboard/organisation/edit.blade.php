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
                <h1 class="m-lg-0">Organisation</h1>
            </div>
        </div>
        <div class="container-fluid page__container">
            <h4 class="card-header__title mb-3">Update an organisation</h4>
            <form action="{{ route('organisation.update', $organisation->id )}}" method="POST"
                  enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card card-form">
                    <!-- Organisation Profile -->
                    <div class="row no-gutters">
                        <div class="col-lg-4 card-body">
                            <p><strong class="headings-color form-header">Organisation Profile</strong></p>
                            <p class="text-muted form-subheader">Adding these fields will add organisation profile to
                                listing.</p>
                        </div>
                        <div class="col-lg-8 card-form__body card-body">
                            <div class="form-row">
                                <div class="col-12 col-md-12 mb-3">
                                    <label for="name" class="form-title">Name
                                        <span style="color: red; font-size: 18px">*</span> :</label>
                                    <input type="text" id="name" placeholder="Enter Name" name="name"
                                           class="form-control @error('name') input-error @enderror"
                                           value="{{ old('name') != null ? old('name') : $organisation->name }}">
                                    @error('name')
                                    <div class="invalid-feedback"
                                         style="display: block !important;">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-12 col-md-12 mb-3">
                                    <label for="registration_number" class="form-title">Registration Number :</label>
                                    <input type="text" id="registration_number" placeholder="Enter Registration Number"
                                           name="registration_number"
                                           class="form-control @error('registration_number') input-error @enderror"
                                           value="{{ old('registration_number') != null ? old('registration_number') : $organisation->registration_number }}">
                                    @error('registration_number')
                                    <div class="invalid-feedback"
                                         style="display: block !important;">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-6 col-md-6 mb-3">
                                    <label for="email" class="form-title">Email Address
                                        <span style="color: red; font-size: 18px">*</span> :</label>
                                    <input type="text" id="email" placeholder="Enter Email Address" name="email"
                                           class="form-control @error('email') input-error @enderror"
                                           value="{{ old('email') != null ? old('email') : $organisation->email }}">
                                    @error('email')
                                    <div class="invalid-feedback"
                                         style="display: block !important;">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-6 col-md-6 mb-3">
                                    <label for="contact_number" class="form-title">Contact Official Number
                                        <span style="color: red; font-size: 18px">*</span> :</label>
                                    <input type="text" id="contact_number" placeholder="Enter Contact Official Numer"
                                           name="contact_number"
                                           class="form-control @error('contact_number') input-error @enderror"
                                           value="{{ old('contact_number') != null ? old('contact_number') : $organisation->contact_number }}">
                                    @error('contact_number')
                                    <div class="invalid-feedback"
                                         style="display: block !important;">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Additional Profile Details -->
                    <div style="border-top: solid 2px lightgray" class="row no-gutters">
                        <div class="col-lg-4 card-body">
                            <p><strong class="headings-color form-header">Additional Profile Details</strong></p>
                            <p class="text-muted form-subheader">Please provide additional details profile about
                                Organisation.</p>
                        </div>
                        <div class="col-lg-8 card-form__body card-body">
                            <div class="form-row">
                                <div class="col-12 col-md-12 mb-3">
                                    <label for="address" class="form-title">Address Line 1
                                        <span style="color: red; font-size: 18px">*</span> :</label>
                                    <input type="text" id="address" placeholder="Enter Address Line 1" name="address"
                                           class="form-control input-value @error('address') input-error @enderror"
                                           value="{{ old('address') != null ? old('address') : $organisation->address }}">
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
                                           value="{{ old('address2') != null ? old('address2') : $organisation->address2 }}">
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
                                           value="{{ old('city') != null ? old('city') : $organisation->city }}">
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
                                           value="{{ old('postcode') != null ? old('postcode') : $organisation->postcode }}">
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
                                            <option value="{{ $country }}"
                                                {{ $organisation->country == $country ? 'selected' : ''}}>{{ $country }}
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
                                    <label for="type" class="form-title">Organisation type
                                        <span style="color: red; font-size: 18px">*</span> :</label>
                                    <select id="type" data-toggle="select" name="type"
                                            class="form-control input-value  @error('type') input-error @enderror">
                                        @foreach($organisation_types as $type)
                                            <option value="{{ $type }}"
                                                {{ $organisation->type == $type ? 'selected' : '' }}>
                                                {{ $type }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('type')
                                    <div class="invalid-feedback"
                                         style="display: block !important;">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-12 col-md-12 mb-3">
                                    <label for="terms" style="display: contents;font-size: 14px;padding-bottom: 5px"
                                           class="form-title">
                                        I AM A REMOTE PILOT FOR THIS ORGANISATION (YES/NO) :
                                    </label>
                                    <br>
                                    <input type="checkbox" id="terms" required name="is_organisation_pilot"
                                        {{ $organisation->is_organisation_pilot == 1 ? 'checked' : '' }}>
                                    <span style="padding-top: 10px;color: gray;padding-left: 10px;">
                                        Tick here if Yes</span>
                                </div>
                            </div>
                            <a class="btn btn-danger" type="submit" href="{{ route('organisation.index') }}">Cancel</a>
                            <button class="btn btn-primary" type="submit" id="showSubmit" style="margin-left: 20px">Update</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
