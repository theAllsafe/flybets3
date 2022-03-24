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
<!-- Dropzone -->
<link type="text/css" href="{{ asset('assets/css/vendor-dropzone.css') }}" rel="stylesheet">
<link type="text/css" href="{{ asset('assets/css/vendor-dropzone.rtl.css') }}" rel="stylesheet">
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
            <h1 class="m-lg-0">Unmanned Aircraft</h1>
        </div>
    </div>
    <div class="container-fluid page__container">
        <h4 class="card-header__title mb-3">Edit selected an Unmanned Aircraft</h4>

        <div class="card card-form">
            <div class="row no-gutters">
                <div class="col-lg-4 card-body">
                    <p><strong class="headings-color form-header">Provide unmanned aircraft details</strong></p>
                    <p class="text-muted">Please make changes to details information about the unmanned aircraft for
                        your
                        flight's plan.</p>
                </div>
                <div class="col-lg-8 card-form__body card-body">
                    <form action="{{ route('unmanned-aircraft.update', $unmanned_aircraft->id)}}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-row">
                            <div class="col-12 col-md-12 mb-3">
                                <label for="description" class="form-title">Description
                                    <span style="color: red; font-size: 18px">*</span> :</label>
                                <input type="text" id="description" name="description"
                                    class="form-control @error('description') input-error @enderror"
                                    value="{{ old('description') != null ? old('description') : $unmanned_aircraft->description }}">
                                @error('description')
                                <div class="invalid-feedback" style="display: block !important;">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-12 col-md-12 mb-3">
                                <label for="manufacturer_name" class="form-title">Manufacturer name
                                    <span style="color: red; font-size: 18px">*</span> :</label>
                                <input type="text" id="manufacturer_name" name="manufacturer_name"
                                    class="form-control @error('manufacturer_name') input-error @enderror"
                                    value="{{ old('manufacturer_name') != null ? old('manufacturer_name') : $unmanned_aircraft->manufacturer_name }}">
                                @error('manufacturer_name')
                                <div class="invalid-feedback" style="display: block !important;">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-12 col-md-12 mb-3">
                                <label for="model_name" class="form-title">MODEL NAME
                                    <span style="color: red; font-size: 18px">*</span> :</label>
                                <input type="text" id="model_name" name="model_name"
                                    class="form-control @error('model_name') input-error @enderror"
                                    value="{{ old('model_name') != null ? old('model_name') : $unmanned_aircraft->model_name }}">
                                @error('model_name')
                                <div class="invalid-feedback" style="display: block !important;">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-12 col-md-12 mb-3">
                                <label for=" airframe" class="form-title">AIRFRAME
                                    <span style="color: red; font-size: 18px">*</span> :</label>
                                <select id="airframe" data-toggle="select" name="airframe"
                                    class="form-control  @error('airframe') input-error @enderror">
                                    <option value="null">Select airframe</option>
                                    <option value="Fixed-wing" {{ $unmanned_aircraft->airframe == 'Fixed-wing' ?
                                        'selected' : ''}}>
                                        Fixed-wing
                                    </option>
                                    <option value="Rotary" {{ $unmanned_aircraft->airframe == 'Rotary' ? 'selected' :
                                        ''}}>
                                        Rotary
                                    </option>
                                    <option value="VTOL" {{ $unmanned_aircraft->airframe == 'VTOL' ? 'selected' : ''}}>
                                        VTOL
                                    </option>
                                    <option value="Tethered" {{ $unmanned_aircraft->airframe == 'Tethered' ? 'selected'
                                        : ''}}>
                                        Tethered
                                    </option>
                                </select>
                                @error('airframe')
                                <div class="invalid-feedback" style="display: block !important;">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-12 col-md-12 mb-3">
                                <label for="uas_registration_number" class="form-title">UAS REGISTRATION :</label>
                                <input type="text" id="uas_registration_number" name="uas_registration_number"
                                    class="form-control @error('uas_registration_number') input-error @enderror"
                                    value="{{ old('uas_registration_number') != null ? old('uas_registration_number') : $unmanned_aircraft->uas_registration_number }}">
                                @error('uas_registration_number')
                                <div class="invalid-feedback" style="display: block !important;">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-12 col-md-12 mb-3">
                                <label for="colour" class="form-title">colour
                                    <span style="color: red; font-size: 18px">*</span> :</label>
                                <input type="text" id="colour" name="colour"
                                    class="form-control @error('colour') input-error @enderror"
                                    value="{{ old('colour') != null ? old('colour') : $unmanned_aircraft->colour }}">
                                @error('colour')
                                <div class="invalid-feedback" style="display: block !important;">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-12 col-md-12 mb-3">
                                <label for="markings" class="form-title">MARKINGS
                                    <span style="color: red; font-size: 18px">*</span> :</label>
                                <input type="text" id="markings" name="markings"
                                    class="form-control @error('markings') input-error @enderror"
                                    value="{{ old('markings') != null ? old('markings') : $unmanned_aircraft->markings }}">
                                @error('markings')
                                <div class="invalid-feedback" style="display: block !important;">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-12 col-md-12 mb-3">
                                <label for="mtow" class="form-title">MAXIMUM TAKE-OFF MASS(MTOW)
                                    <span style="color: red; font-size: 18px">*</span> :</label>
                                <input type="number" id="mtow" min="0.1" max="100" step="0.1" name="mtow"
                                    class="form-control @error('mtow') input-error @enderror"
                                    value="{{ old('mtow') != null ? old('mtow') : $unmanned_aircraft->mtow }}">
                                @error('mtow')
                                <div class="invalid-feedback" style="display: block !important;">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-12 col-md-12 mb-3">
                                <label for="serial_number" class="form-title">UA SERIAL NUMBER
                                    <span style="color: red; font-size: 18px">*</span> :</label>
                                <input type="text" id="serial_number" name="serial_number"
                                    class="form-control @error('serial_number') input-error @enderror"
                                    value="{{ old('serial_number') != null ? old('serial_number') : $unmanned_aircraft->serial_number }}">
                                @error('serial_number')
                                <div class="invalid-feedback" style="display: block !important;">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-12 col-md-12 mb-3">
                                <label for="additional_information" class="form-title">ADDITIONAL INFORMATION :</label>
                                <textarea name="additional_information" id="additional_information" cols="30" rows="5"
                                    class="form-control @error('additional_information') input-error @enderror">{{ old('additional_information') != null ? old('additional_information') : $unmanned_aircraft->additional_information }}</textarea>
                                @error('additional_information')
                                <div class="invalid-feedback" style="display: block !important;">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <a class="btn btn-danger" type="submit" href="{{ route('unmanned-aircraft.index') }}">Cancel</a>
                        <button class="btn btn-primary" type="submit" style="margin-left: 20px">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<!-- Dropzone -->
<script src="{{ asset('assets/vendor/dropzone.min.js') }}"></script>
<script src="{{ asset('assets/js/dropzone.js') }}"></script>
@endsection