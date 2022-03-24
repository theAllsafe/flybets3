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
    
    body {         
    font:14px sans-serif;           
} 
input {
    margin: 0.6em 0.6em 0; 
    width:398px;
}
#map_canvas {         
    height: 400px;         
    width: 100%;         
    margin: 0.6em;       
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
        <h4 class="card-header__title mb-3">Add an Unmanned Aircraft</h4>

        <div class="card card-form">
            <div class="row no-gutters">
                <div class="col-lg-4 card-body">
                    <p><strong class="headings-color form-header">Provide unmanned aircraft details</strong></p>
                    <p class="text-muted form-subheader">Please provide details information about the unmanned
                        aircraft for your flight's plan.</p>
                </div>
               
                <div class="col-lg-8 card-form__body card-body">
                    <form action="{{ route('unmanned-aircraft.store')}}" method="POST">
                        @csrf
                        <!--<div class="form-row">
                            <div class="col-12 col-md-12 mb-3">
                                <input id="searchTextField" type="text" size="50">             
                                <div id="map_canvas"></div>
                            </div>
                        </div>-->
                        <div class="form-row">
                            <div class="col-12 col-md-12 mb-3">
                                <label for="description" class="form-title">Description
                                    <span style="color: red; font-size: 18px">*</span> :</label>
                                <input type="text" id="description" name="description"
                                    class="form-control @error('description') input-error @enderror"
                                    value="{{ old('description') != null ? old('description') : auth()->user()->description }}">
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
                                    value="{{ old('manufacturer_name') != null ? old('manufacturer_name') : auth()->user()->manufacturer_name }}">
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
                                    value="{{ old('model_name') != null ? old('model_name') : auth()->user()->model_name }}">
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
                                    <option value="Fixed-wing" {{old('airframe') !=null && old('airframe')=='Fixed-wing'
                                        ? 'selected' : '' }}>
                                        Fixed-wing
                                    </option>
                                    <option value="Rotary" {{old('airframe') !=null && old('airframe')=='Rotary'
                                        ? 'selected' : '' }}>
                                        Rotary
                                    </option>
                                    <option value="VTOL" {{old('airframe') !=null && old('airframe')=='VTOL'
                                        ? 'selected' : '' }}>
                                        VTOL
                                    </option>
                                    <option value="Tethered" {{old('airframe') !=null && old('airframe')=='Tethered'
                                        ? 'selected' : '' }}>
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
                                    value="{{ old('uas_registration_number') != null ? old('uas_registration_number') : auth()->user()->uas_registration_number }}">
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
                                    value="{{ old('colour') != null ? old('colour') : auth()->user()->colour }}">
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
                                    value="{{ old('markings') != null ? old('markings') : auth()->user()->markings }}">
                                @error('markings')
                                <div class="invalid-feedback" style="display: block !important;">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-12 col-md-12 mb-3">
                                <label for="mtow" class="form-title">MAXIMUM TAKE-OFF MASS(MTOW)
                                    <span style="color: red; font-size: 18px">*</span> :</label>
                                <div class="input-group">
                                    <input type="number" id="mtow" min="0.1" max="100" autocomplete="off" name="mtow"
                                        aria-label="Amount (to the nearest dollar)" step="0.1"
                                        class="form-control @error('mtow') input-error @enderror"
                                        value="{{ old('mtow') != null ? old('mtow') : auth()->user()->mtow }}">
                                    <div class="input-group-append">
                                        <span class="input-group-text" style="background-color: lightgray">kg</span>
                                    </div>
                                    @error('mtow')
                                    <div class="invalid-feedback" style="display: block !important;">{{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-12 col-md-12 mb-3">
                                <label for="serial_number" class="form-title">UA SERIAL NUMBER
                                    <span style="color: red; font-size: 18px">*</span> :</label>
                                <input type="text" id="serial_number" name="serial_number"
                                    class="form-control @error('serial_number') input-error @enderror"
                                    value="{{ old('serial_number') != null ? old('serial_number') : auth()->user()->serial_number }}">
                                @error('serial_number')
                                <div class="invalid-feedback" style="display: block !important;">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-12 col-md-12 mb-3">
                                <label for="additional_information" class="form-title">ADDITIONAL INFORMATION :</label>
                                <textarea name="additional_information" id="additional_information" cols="30" rows="5"
                                    class="form-control @error('additional_information') input-error @enderror">{{ old('additional_information') != null ? old('additional_information') : auth()->user()->additional_information }}</textarea>
                                @error('additional_information')
                                <div class="invalid-feedback" style="display: block !important;">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <a class="btn btn-danger" type="submit" href="{{ route('unmanned-aircraft.index') }}">Cancel</a>
                        <button class="btn btn-primary" type="submit" style="margin-left: 20px">Submit</button>
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
