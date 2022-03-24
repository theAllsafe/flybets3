@extends('layouts.index')
@section('style')
    <style>
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
                <h1 class="m-lg-0">My Profile</h1>
            </div>
        </div>
        <div class="container-fluid page__container">
            <h4 class="card-header__title mb-3">Show your user profile details</h4>

            <div class="card card-form">
                <div class="row no-gutters">
                    <div class="col-lg-4 card-body">
                        <p><strong class="headings-color form-header">User Profile</strong></p>
                        <p class="text-muted">This fields show your user profile. Go to Edit Account to edit the
                            details.</p>
                    </div>
                    <div class="col-lg-8 card-form__body card-body">
                        <form>
                            <div class="form-row">
                                <div class="col-6 col-md-6 mb-3">
                                    <label for="first_name" class="form-title">First name
                                        :</label>
                                    <input disabled type="text" id="first_name" placeholder="First name"
                                           name="first_name"
                                           class="form-control @error('first_name') input-error @enderror"
                                           value="{{ old('first_name') != null ? old('first_name') : $user->first_name }}">
                                    @error('first_name')
                                    <div class="invalid-feedback"
                                         style="display: block !important;">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-6 col-md-6 mb-3">
                                    <label for="last_name" class="form-title">Last name
                                        :</label>
                                    <input disabled type="text" id="last_name"
                                           placeholder="Last name" name="last_name"
                                           class="form-control @error('last_name') input-error @enderror"
                                           value="{{ old('last_name') != null ? old('last_name') : $user->last_name }}">
                                    @error('last_name')
                                    <div class="invalid-feedback"
                                         style="display: block !important;">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-6 col-md-6 mb-3">
                                    <label for="national_passport_id" class="form-title">Document Type :</label>
                                    <input disabled type="text" id="national_passport_id"
                                           name="national_passport_id"
                                           placeholder="National / Passport ID"
                                           class="form-control @error('document_type') input-error @enderror"
                                           value="{{ old('document_type') != null ? old('document_type') : $user->getDocumentType() }}">
                                    @error('national_passport_id')
                                    <div class="invalid-feedback"
                                         style="display: block !important;">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-6 col-md-6 mb-3">
                                    <label for="national_passport_file_link" class="form-title">Nationality :</label>
                                    <input disabled type="text" id="national_passport_file_link"
                                           placeholder="National / Passport file" name="national_passport_file_link"
                                           class="form-control @error('national_passport_file_link') input-error @enderror"
                                           value="{{ $user->nationality }}">
                                    @error('national_passport_file_link')
                                    <div class="invalid-feedback"
                                         style="display: block !important;">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-6 col-md-6 mb-3">
                                    <label for="national_passport_id" class="form-title">National / Passport
                                        Id :</label>
                                    <input disabled type="text" id="national_passport_id"
                                           name="national_passport_id"
                                           placeholder="National / Passport ID"
                                           class="form-control @error('national_passport_id') input-error @enderror"
                                           value="{{ old('national_passport_id') != null ? old('national_passport_id') : $user->national_passport_id }}">
                                    @error('national_passport_id')
                                    <div class="invalid-feedback"
                                         style="display: block !important;">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-6 col-md-6 mb-3">
                                    <label for="national_passport_file_link" class="form-title">Upload copy
                                        national / passport id :</label>
                                    <input disabled type="text" id="national_passport_file_link"
                                           placeholder="National / Passport file" name="national_passport_file_link"
                                           class="form-control @error('national_passport_file_link') input-error @enderror"
                                           value="{{ old('national_passport_file_link') != null ? old('national_passport_file_link') : $user->getFileName() }}">
                                    @error('national_passport_file_link')
                                    <div class="invalid-feedback"
                                         style="display: block !important;">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-6 col-md-6 mb-3">
                                    <label for=" date_of_birth" class="form-title">Date of birth
                                        (DD/MM/YY) :</label>
                                    <input disabled type="date" id="date_of_birth" placeholder="Date of birth"
                                           name="date_of_birth"
                                           class="form-control @error('date_of_birth') input-error @enderror"
                                           value="{{ old('date_of_birth') != null ? old('date_of_birth') : $user->date_of_birth }}">
                                    @error('date_of_birth')
                                    <div class="invalid-feedback"
                                         style="display: block !important;">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-6 col-md-6 mb-3">
                                    <label for=" gender" class="form-title">Gender
                                        :</label>
                                    <input disabled type="text" id="gender" name="gender" placeholder="Gender"
                                           class="form-control @error('gender') input-error @enderror"
                                           value="{{ old('gender') != null ? old('gender') : $user->gender }}">
                                    @error('gender')
                                    <div class="invalid-feedback"
                                         style="display: block !important;">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-6 col-md-6 mb-3">
                                    <label for="email" class="form-title">Email address :</label>
                                    <input disabled type="text" id="email" placeholder="Email address" name="email"
                                           class="form-control @error('email') input-error @enderror"
                                           value="{{ old('email') != null ? old('email') : $user->email }}">
                                    @error('email')
                                    <div class="invalid-feedback"
                                         style="display: block !important;">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-6 col-md-6 mb-3">
                                    <label for="mobile_number" class="form-title">Contact Mobile Number
                                        :</label>
                                    <input disabled type="text" id="mobile_number" name="mobile_number"
                                           placeholder="Contact Mobile Number"
                                           class="form-control @error('mobile_number') input-error @enderror"
                                           value="{{ old('mobile_number') != null ? old('mobile_number') : $user->mobile_number }}">
                                    @error('mobile_number')
                                    <div class="invalid-feedback"
                                         style="display: block !important;">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
