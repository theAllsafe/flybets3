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
                <h1 class="m-lg-0">Invite Users</h1>
            </div>
        </div>
        <div class="container-fluid page__container">
            <h4 class="card-header__title mb-3">Invite a User</h4>
            <form action="{{ route('organisation.invite' )}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card card-form">
                    <!-- Additional Profile Details -->
                    <div style="border-top: solid 2px lightgray" class="row no-gutters">
                        <div class="col-lg-4 card-body">
                            <p><strong class="headings-color form-header">Select the role to invite the user
                                    to.</strong></p>
                            <p class="text-muted form-subheader">The created invite will be usable by any user to add
                                themselves to your organization. The invite will be valid for 24 hours and a single user
                                only.</p>
                        </div>
                        <div class="col-lg-8 card-form__body card-body">
                            <div class="form-row">
                                <div class="col-12 col-md-12 mb-3 d-flex align-items-center">
                                    <div class="flex">
                                        <label for="email" class="form-title">user roles <span
                                                style="color: red; font-size: 18px">*</span> :</label>
                                        <div class="custom-control mr-1">
                                            <input type="radio" id="manager" name="role" value="manager"
                                                {{ old('role') == 'manager' ? 'checked' : '' }}>
                                            <label for="manager">Organisation Manager - Manages the
                                                organisation.</label>
                                        </div>
                                        <div class="custom-control mr-1">
                                            <input type="radio" id="remote" name="role" value="pilot"
                                                {{ old('role') == 'pilot' ? 'checked' : '' }}>
                                            <label for="remote">Remote Pilot - Operates drones for the
                                                organisation.</label>
                                        </div>
                                    </div>
                                </div>
                                @error('role')
                                <div class="invalid-feedback"
                                     style="display: block !important;">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-row">
                                <div class="col-12 col-md-12 mb-3">
                                    <label for="email" class="form-title">Email Address <span
                                            style="color: red; font-size: 18px">*</span> :</label>
                                    <input type="text" id="email" placeholder="Enter Email address" name="email"
                                           class="form-control input-value @error('email') input-error @enderror"
                                           value="{{ old('email') != null ? old('email') : '' }}">
                                    @error('email')
                                    <div class="invalid-feedback"
                                         style="display: block !important;">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <button class="btn btn-primary" type="submit" id="showSubmit">Send Email invite</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
