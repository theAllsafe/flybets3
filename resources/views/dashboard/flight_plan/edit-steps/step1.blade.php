<div>
    <div class="form-row">
    </div>
    <div class="form-row">
        <div class="col-12 col-md-12 mb-3">
            <label for="address">Please select the area of operation for the Flight Plan</label>
            <div id="map"></div>
        </div>
    </div>
    <div class="form-row">
        <div class="col-12 col-md-12 mb-3">
            <label for="purpose" class="form-title">purpose of flight plan
                <span style="color: red; font-size: 18px">*</span> :</label>
            <input type="text" placeholder="Enter Purpose of Flight Plan" name="purpose"
                @isset($flight_plan->purpose)value="{{ old('purpose') != null ? old('purpose') : $flight_plan->purpose
            }}"
            @else value="{{ old('purpose') }}"
            @endisset
            class="form-control @error('purpose') input-error @enderror">
            @error('purpose')
            <div class="invalid-feedback" style="display: block !important;">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="form-row">
        <div class="col-12 col-md-12 mb-3">
            <label for="description" class="form-title">description
                <span style="color: red; font-size: 18px">*</span> :</label>
            <textarea id="description" cols="30" rows="2" placeholder="Enter Description" name="description"
                class="form-control @error('description') input-error @enderror">@isset($flight_plan->description){{ old('description') != null ? old('description') : $flight_plan->description }}@else{{ old('description') }} @endisset</textarea>
            @error('description')
            <div class="invalid-feedback" style="display: block !important;">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="form-row">
        <div class="col-6 col-md-6 mb-3">
            <label for="timezone" class="form-title">time zone
                <span style="color: red; font-size: 18px">*</span> :</label>
            <select id="timezone" data-toggle="select" name="timezone"
                class="form-control  @error('timezone') input-error @enderror">
                <option value="null" selected>Select Time Zone</option>
                @foreach($countries as $timezone)
                <option @isset($flight_plan->timezone)
                    {{ old('timezone') == $timezone || $flight_plan->timezone == $timezone ? 'selected' : ''}}
                    @else
                    {{ old('timezone') == $timezone ? 'selected' : ''}}@endisset
                    value="{{ $timezone }}">
                    {{ $timezone }}
                </option>
                @endforeach
            </select>
            @error('timezone')
            <div class="invalid-feedback" style="display: block !important;">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-6 col-md-6 mb-3">
            <label for="vlos_cylinder_radius" class="form-title">VLOS cylinder radius
                <span style="color: red; font-size: 18px">*</span> :</label>
            <div class="row">
                <div class="col-sm-6">
                    <div class="flex">
                        <div class="custom-control" style="display: inline-block !important;">
                            <input type="radio" id="vlos_cylinder_radius_unit_feet" name="vlos_cylinder_radius_unit"
                                value="feet" @if(old('vlos_cylinder_radius_unit') !=null &&
                                old('vlos_cylinder_radius_unit')=='feet' ) checked
                                @elseif(old('vlos_cylinder_radius_unit')==null &&
                                isset($flight_plan->vlos_cylinder_radius_unit) &&
                            $flight_plan->vlos_cylinder_radius_unit == 'feet')
                            checked
                            @endif
                            >
                            <label for="vlos_cylinder_radius_unit_feet">Feet</label>
                        </div>
                        <div class="custom-control" style="display: inline-block !important;">
                            <input type="radio" id="vlos_cylinder_radius_unit_meters" name="vlos_cylinder_radius_unit"
                                value="meters" @if(old('vlos_cylinder_radius_unit') !=null &&
                                old('vlos_cylinder_radius_unit')=='meters' ) checked
                                @elseif(old('vlos_cylinder_radius_unit')==null &&
                                isset($flight_plan->vlos_cylinder_radius_unit) &&
                            $flight_plan->vlos_cylinder_radius_unit == 'meters')
                            checked
                            @endif>
                            <label for="vlos_cylinder_radius_unit_meters">Meters</label>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <input type="number" id="vlos_cylinder_radius" placeholder="0" min="0" name="vlos_cylinder_radius"
                        class="form-control @error('vlos_cylinder_radius') input-error @enderror"
                        @isset($flight_plan->vlos_cylinder_radius)
                    value="{{ old('vlos_cylinder_radius') != null ? old('vlos_cylinder_radius') :
                    $flight_plan->vlos_cylinder_radius }}"
                    @else value="{{ old('vlos_cylinder_radius') }}"
                    @endisset
                    >
                </div>
            </div>
            @error('vlos_cylinder_radius')
            <div class="invalid-feedback" style="display: block !important;">{{ $message }}</div>
            @enderror
        </div>
    </div>
    {{-- @dd($flight_plan->start_date_time)--}}
    <div class="form-row">
        <div class="col-6 col-md-6 mb-3">
            <label for="start_date_time" class="form-title">Start date & time (DD/MM/YY)
                <span style="color: red; font-size: 18px">*</span> :</label>
            <input type="datetime-local" id="start_date_time" name="start_date_time"
                placeholder="Enter start date & time"
                class="form-control @error('start_date_time') input-error @enderror" value="2022-01-3" {{--
                @isset($flight_plan->start_date_time)--}}
            {{-- value="{{ old('start_date_time') != null ? old('start_date_time') : $flight_plan->start_date_time
            }}"--}}
            {{-- value="2022-01-3"--}}
            {{-- @else value="{{ old('start_date_time') }}"--}}
            {{-- @endisset--}}
            >
            @error('start_date_time')
            <div class="invalid-feedback" style="display: block !important;">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-6 col-md-6 mb-3">
            <label for="max_height" class="form-title">max height (above ground level)
                <span style="color: red; font-size: 18px">*</span> :</label>
            <div class="row">
                <div class="col-sm-6">
                    <div class="flex">
                        <div class="custom-control" style="display: inline-block !important;">
                            <input type="radio" id="max_height_unit_feet" name="max_height_unit" value="feet"
                                @if(old('max_height_unit') !=null && old('max_height_unit')=='feet' ) checked
                                @elseif(old('max_height_unit')==null && isset($flight_plan->max_height_unit) &&
                            $flight_plan->max_height_unit == 'feet')
                            checked
                            @endif>
                            <label for="max_height_unit_feet">Feet</label>
                        </div>
                        <div class="custom-control" style="display: inline-block !important;">
                            <input type="radio" id="max_height_unit_meters" name="max_height_unit" value="meters"
                                @if(old('max_height_unit') !=null && old('max_height_unit')=='meters' ) checked
                                @elseif(old('max_height_unit')==null && isset($flight_plan->max_height_unit) &&
                            $flight_plan->max_height_unit == 'meters')
                            checked
                            @endif>
                            <label for="max_height_unit_meters">Meters</label>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <input type="number" id="max_height" placeholder="0" min="0" name="max_height"
                        class="form-control @error('max_height') input-error @enderror" @isset($flight_plan->max_height)
                    value="{{ old('max_height') != null ? old('max_height') : $flight_plan->max_height }}"
                    @else value="{{ old('max_height') }}"
                    @endisset
                    >
                </div>
                @error('max_height')
                <div class="invalid-feedback" style="display: block !important;">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>
    <div class="form-row">
        <div class="col-6 col-md-6 mb-3">
            <label for="end_date_time" class="form-title">End date & time (DD/MM/YY)
                <span style="color: red; font-size: 18px">*</span> :</label>
            <input type="datetime-local" id="end_date_time" name="end_date_time" placeholder="Enter end date & time"
                class="form-control @error('end_date_time') input-error @enderror" @isset($flight_plan->end_date_time)
            value="{{ old('end_date_time') != null ? old('end_date_time') : $flight_plan->end_date_time }}"
            @else value="{{ old('end_date_time')}}"
            @endisset>
            @error('end_date_time')
            <div class="invalid-feedback" style="display: block !important;">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-6 col-md-6 mb-3">
            <label for="fly_less_120m" style="display: contents;font-size: 14px;padding-bottom: 5px" class="form-title">
                Agree to fly less than 120 meter in height :
            </label>
            <br>
            <br>
            <input type="checkbox" id="fly_less_120m" name="fly_less_120m">
            <label style="padding-top: 10px;color: gray;padding-left: 10px;" for="fly_less_120m">
                Tick here too agree</label>
            @error('fly_less_120m')
            <div class="invalid-feedback" style="display: block !important;">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>
{{-- @section('script')
<script !src="">
    $("#start_date_time").flatpickr().setDate('2022-01-25');
</script>
@endsection --}}