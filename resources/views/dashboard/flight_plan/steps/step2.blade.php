<div>
    <div class="form-row">
        <div class="col-6 col-md-6 mb-3">
            <label for="type" class="form-title">Select uas pilot
                <span style="color: red; font-size: 18px">*</span> :</label>
            <select id="uas_operator_id" data-toggle="select" name="uas_operator_id"
                    class="form-control  @error('type_of_intended_operation') input-error @enderror">
                <option selected value="0">Select</option>
                {{--                @if ($l oop->first) selected @endif--}}
                @foreach($uas_operators as $uas_operator)
                    <option value="{{ $uas_operator->id }}"
                        {{--                        {{ old('uas_pilot') != null && old('uas_pilot') == $uas_operator->id ? 'selected' : ''}}--}}
                        {{--                    @if(old('uas_pilot') == null) {{ $uas_operator->id == auth()->user()->uasOperator->id ? 'selected' : '' }}--}}
                        {{--                        @else {{ old('uas_pilot') == $uas_operator->id ? 'selected' : ''}}--}}
                        {{--                        @endif--}}
                    >
                        {{ $uas_operator->user->first_name . ' ' . $uas_operator->user->last_name }}
                    </option>
                @endforeach
            </select>
            @error('uas_pilot')
            <div class="invalid-feedback"
                 style="display: block !important;">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <span style="display: none">
        {{ $uas_operator = '' }}
        {{--        <script>--}}
        {{--            selectTags = document.getElementById("uas_pilot").selectedIndex = 1;--}}
        {{--        </script>--}}
    </span>
    <div class="form-row">
        <div class="col-6 col-md-6 mb-3">
            <label for="first_name" class="form-title">First name :</label>
            <input type="text" class="form-control input-value" disabled id="first_name" name="first_name"
                   value="{{ isset($uas_operator->user->first_name) ?? $uas_operator->user->first_name }}">
        </div>
        <div class="col-6 col-md-6 mb-3">
            <label for="address" class="form-title">Address line 1 :</label>
            <input type="text" class="form-control input-value" id="address"
                   value="{{ isset($uas_operator->address) ? $uas_operator->address : '' }}" disabled>
        </div>
    </div>
    <div class="form-row">
        <div class="col-6 col-md-6 mb-3">
            <label for="last_name" class="form-title">Last name :</label>
            <input type="text" class="form-control input-value"
                   value="{{ isset($uas_operator->user->last_name) ? $uas_operator->user->last_name : '' }}"
                   disabled id="last_name">
        </div>
        <div class="col-6 col-md-6 mb-3">
            <label class="form-title">address line 2 :</label>
            <input type="text" class="form-control input-value" disabled id="address2"
                   value="{{ isset($uas_operator->address2) ? $uas_operator->address2 : '' }}">
        </div>
    </div>
    <div class="form-row">
        <div class="col-6 col-md-6 mb-3">
            <label for="national_passport_id" class="form-title">National / Passport ID
                :</label>
            <input type="text" class="form-control input-value" disabled id="national_passport_id"
                   value="{{ isset($uas_operator->user->national_passport_id) ? $uas_operator->user->national_passport_id : '' }}">
        </div>
        <div class="col-6 col-md-6 mb-3">
            <label for="gender" class="form-title">City :</label>
            <input type="text" class="form-control input-value input-value" id="city"
                   value="{{ isset($uas_operator->city) ? $uas_operator->city : '' }}" disabled>
        </div>
    </div>
    <div class="form-row">
        <div class="col-6 col-md-6 mb-3">
            <label for="mobile_number" class="form-title">Contact Mobile Number :</label>
            <input type="text" class="form-control input-value" id="mobile_number"
                   value="{{ isset($uas_operator->user->mobile_number) ? $uas_operator->user->mobile_number : '' }}"
                   disabled>
        </div>
        <div class="col-6 col-md-6 mb-3">
            <label for="postcode" class="form-title">postcode :</label>
            <input type="text" class="form-control input-value" id="postcode"
                   value="{{ isset($uas_operator->postcode) ? $uas_operator->postcode : '' }}" disabled>
        </div>
    </div>
    <div class="form-row">
        <div class="col-6 col-md-6 mb-3">
            <label for="email" class="form-title">Email address :</label>
            <input type="text" class="form-control input-value"
                   value="{{ isset($uas_operator->user->email) ? $uas_operator->user->email : '' }}"
                   disabled id="email">
        </div>
        <div class="col-6 col-md-6 mb-3">
            <label for="country" class="form-title">Country :</label>
            <input type="text" class="form-control input-value"
                   value="{{ isset($uas_operator->country) ? $uas_operator->country : '' }}"
                   id="country" disabled>
        </div>
    </div>
    <div class="form-row">
        <div class="col-6 col-md-6 mb-3">
            <label for="observer_mobile_number" class="form-title">Observer mobile number :</label>
            <input type="text" id="observer_mobile_number" name="observer_mobile_number"
                   value="{{ old('observer_mobile_number') }}"
                   class="form-control input-value @error('observer_mobile_number') input-error @enderror">
            @error('observer_mobile_number')
            <div class="invalid-feedback"
                 style="display: block !important;">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-6 col-md-6 mb-3">
            <label for="fly_id" class="form-title">1-2fly id :</label>
            <input type="text" class="form-control input-value"
                   value="{{ isset($uas_operator->fly_registration_id) ? $uas_operator->fly_registration_id : '' }}"
                   disabled id="fly_registration_id">
        </div>
    </div>
    <div class="form-row">
        <div class="col-12 col-md-12 mb-3">
            <label for="additional_information" class="form-title">additional information :</label>
            <textarea name="additional_information" id="additional_information" cols="25"
                      class="form-control input-value @error('additional_information') input-error @enderror"
                      rows="2">{{old('additional_information')}}</textarea>
            @error('additional_information')
            <div class="invalid-feedback"
                 style="display: block !important;">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>
