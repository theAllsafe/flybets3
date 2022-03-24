<div class="step3">

    <div class="form-row">
        <div class="col-6 col-md-6 mb-3">
            <label for="type" class="form-title">Select aircraft
                <span style="color: red; font-size: 18px">*</span> :</label>
            <select id="aircraft_id" data-toggle="select"
                    name="unmanned_aircraft_id"
                    class="form-control  @error('type_of_intended_operation') input-error @enderror">
                <option selected value="0">Select</option>
                @foreach($aircrafts as $aircraft)
                    <option value="{{ $aircraft->id }}"
                    @if(old('aircraft_id') == null) {{ $aircraft->id == $flight_plan->unmanned_aircraft_id ? 'selected' : '' }}
                        @else {{ old('aircraft_id') == $aircraft->id ? 'selected' : ''}}
                        @endif
                        {{--                        {{ old('aircraft_id') != null && old('aircraft_id') == $aircraft->id ? 'selected' : ''}}--}}
                    >
                        {{ $aircraft->description }}
                    </option>
                @endforeach
            </select>
            @error('aircraft_id')
            <div class="invalid-feedback"
                 style="display: block !important;">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="form-row">
        <div class="col-6 col-md-6 mb-3">
            <label for="colour" class="form-title">Colour :</label>
            <input type="text" class="form-control input-value" disabled id="colour"
                   value="{{ isset($aircraft->colour) ? $aircraft->colour : '' }}">
        </div>
        <div class="col-6 col-md-6 mb-3">
            <label for="manufacturer_name" class="form-title">Manufacture name :</label>
            <input type="text" class="form-control input-value" id="manufacturer_name"
                   value="{{ isset($aircraft->manufacturer_name) ? $aircraft->manufacturer_name : '' }}"
                   disabled>
        </div>
    </div>
    <div class="form-row">
        <div class="col-6 col-md-6 mb-3">
            <label for="last_name" class="form-title">MARKINGS :</label>
            <input type="text" class="form-control input-value"
                   value="{{ isset($aircraft->markings) ? $aircraft->markings : '' }}" id="markings"
                   disabled>
        </div>
        <div class="col-6 col-md-6 mb-3">
            <label class="form-title">model name:</label>
            <input type="text" class="form-control input-value" disabled id="model_name"
                   value="{{ isset($aircraft->model_name) ? $aircraft->model_name : '' }}">
        </div>
    </div>
    <div class="form-row">
        <div class="col-6 col-md-6 mb-3">
            <label for="national_passport_id" class="form-title">MAXIMUM TAKE-OFF MASS(MTOW)
                :</label>
            <input type="text" class="form-control input-value" disabled id="mtow"
                   value="{{ isset($aircraft->mtow) ? $aircraft->mtow : '' }}">
        </div>

        <div class="col-6 col-md-6 mb-3">
            <label for="gender" class="form-title">airframe :</label>
            <input type="text" class="form-control input-value input-value" id="airframe"
                   value="{{ isset($aircraft->airframe) ? $aircraft->airframe : '' }}" disabled>
        </div>
    </div>
    <div class="form-row">
        <div class="col-6 col-md-6 mb-3">
            <label for="mobile_number" class="form-title">SERIAL NUMBER :</label>
            <input type="text" class="form-control input-value" id="serial_number"
                   value="{{ isset($aircraft->serial_number) ? $aircraft->serial_number : '' }}" disabled>
        </div>
        <div class="col-6 col-md-6 mb-3">
            <label for="ua_registration_number" class="form-title">UA REGISTRATION number :</label>
            <input type="text" class="form-control input-value" id="uas_registration_number"
                   value="{{ isset($aircraft->uas_registration_number) ? $aircraft->uas_registration_number : '' }}"
                   disabled>
        </div>
    </div>
    <div class="form-row">
        <div class="col-12 col-md-12 mb-3">
            <label for="additional_information" class="form-title">additional information :</label>
            <textarea name="additional_information" id="aircraft_additional_information" cols="25" disabled
                      class="form-control input-value @error('additional_information') input-error @enderror"
                      rows="2">{{ isset($aircraft->additional_information) ? $aircraft->additional_information : '' }}</textarea>
        </div>
    </div>
</div>
