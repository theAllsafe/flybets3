<div class="step4">
    <!-- Review Details section -->
    <div class="form-row">
    </div>
    <div class="form-row">
        <div class="col-12 col-md-12 mb-3">
            <label for="type" class="form-title" style="color: black;font-size: 16px">
                review details</label>
            <div
                style="background-color: white; padding: 10px;border: 1px solid lightgray;font-size: 15px">
                <p class="text-muted form-subheader">Please review the details you have entered into
                    this flight plan for accuracy and completeness, and then click Submit at the
                    bottom
                    of the page.</p>
                <p class="text-muted form-subheader">By submitting you understand and agree to the
                    following:</p>
                <ul>
                    <li class="chevron" style="font-weight: 700">Submission of this form does not
                        constitute any
                        approval of clearance to cross or enter any controlled airspace.
                    </li>
                    <li class="chevron" style="font-weight: 700">I understand and accept the CAAM
                        Privacy Policy
                        and Portal Terms
                        of Use, and authorise CAAM to process information in this request.
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Map section -->
    <div class="form-row">
        <div class="col-12 col-md-12 mb-3">
            <label for="address">Please select the area of operation for the Flight Plan</label>
            <div id="map"></div>
        </div>
    </div>
    <!-- Purpose section -->
    <div class="form-row">
        <div class="col-12 col-md-12 mb-3">
            <label for="purpose" class="form-title">purpose of flight plan :</label>
            <input type="text" class="form-control" value="{{-- $purpose --}}" id="final_purpose" disabled>
        </div>
    </div>
    <!-- Description section -->
    <div class="form-row">
        <div class="col-12 col-md-12 mb-3">
            <label for="description" class="form-title">description :</label>
            <textarea name="description" id="final_description" cols="30" rows="3" disabled
                      class="form-control"></textarea>
        </div>
    </div>
    <!-- Time zone and VLOS section -->
    <div class="form-row">
        <div class="col-6 col-md-6 mb-3">
            <label for="time_zone" class="form-title">time zone :</label>
            <input type="text" class="form-control" id="final_time_zone" disabled>
        </div>
        <div class="col-6 col-md-6 mb-3">
            <label for="vlos_cylinder_radius" class="form-title">VLOS cylinder radius :</label>
            <input type="text" class="form-control" disabled id="final_vlos_cylinder"
                   value="{{-- $vlos_cylinder_radius . ' ' . $vlos_cylinder_radius_unit --}}">
        </div>
    </div>
    <!-- Start Date section -->
    <div class="form-row">
        <div class="col-6 col-md-6 mb-3">
            <label for="start_date_time" class="form-title">Start date & time (DD/MM/YY) :</label>
            <input type="text" class="form-control" id="final_start_date_time" disabled>
        </div>
        <div class="col-6 col-md-6 mb-3">
            <label for="max_height" class="form-title">max height (above ground level) :</label>
            <input type="text" class="form-control" disabled id="final_max_height">
        </div>
    </div>
    <!-- End Date section -->
    <div class="form-row">
        <div class="col-6 col-md-6 mb-3">
            <label for="end_date_time" class="form-title">End date & time (DD/MM/YY) :</label>
            <input type="text" class="form-control" id="final_end_date_time" disabled>
        </div>
        <div class="col-6 col-md-6 mb-3">
            <label for="fly_less_120m" class="form-title">
                Agree to fly less than 120 meter in height :
            </label>
            <input type="text" class="form-control" id="final_fly_less_120m" disabled>
        </div>
    </div>
    <!-- UAS Pilot and Unmanned Aircraft section -->
    <div class="form-row">
        <div class="col-6 col-md-6 mb-3">
            <label for="end_date_time" class="form-title" style="color: blue">UAS Pilot</label>
        </div>
        <div class="col-6 col-md-6 mb-3">
            <label for="fly_less_120m" class="form-title" style="color: blue">
                Unmanned Aircraft
            </label>
        </div>
    </div>
    <!-- First name and manufacture name section -->
    <div class="form-row">
        <div class="col-6 col-md-6 mb-3">
            <label for="first_name" class="form-title">First name :</label>
            <input type="text" class="form-control input-value" disabled id="final_first_name">
        </div>
        <div class="col-6 col-md-6 mb-3">
            <label for="last_name" class="form-title">Manufactor name :</label>
            <input type="text" class="form-control input-value" id="final_manufacturer_name" disabled>
        </div>
    </div>
    <!-- Last name and model name section -->
    <div class="form-row">
        <div class="col-6 col-md-6 mb-3">
            <label for="last_name" class="form-title">Last name :</label>
            <input type="text" class="form-control input-value" id="final_last_name" disabled>
        </div>
        <div class="col-6 col-md-6 mb-3">
            <label class="form-title">model name:</label>
            <input type="text" class="form-control input-value" disabled id="final_model_name">
        </div>
    </div>
    <!-- National ID and Airframe section -->
    <div class="form-row">
        <div class="col-6 col-md-6 mb-3">
            <label for="national_passport_id" class="form-title">National / Passport ID
                :</label>
            <input type="text" class="form-control input-value" disabled id="final_national_passport_id">
        </div>
        <div class="col-6 col-md-6 mb-3">
            <label for="gender" class="form-title">airframe :</label>
            <input type="text" class="form-control input-value input-value" id="final_airframe" disabled>
        </div>
    </div>
    <!-- Contact mobile and UA Registration section -->
    <div class="form-row">
        <div class="col-6 col-md-6 mb-3">
            <label for="mobile_number" class="form-title">Contact Mobile Number :</label>
            <input type="text" class="form-control input-value" id="final_mobile_number" disabled>
        </div>
        <div class="col-6 col-md-6 mb-3">
            <label for="ua_registration_number" class="form-title">UA REGISTRATION number :</label>
            <input type="text" class="form-control input-value" id="final_uas_registration_number" disabled>
        </div>
    </div>
    <!-- Email and colour section -->
    <div class="form-row">
        <div class="col-6 col-md-6 mb-3">
            <label for="email" class="form-title">Email address :</label>
            <input type="text" class="form-control input-value" id="final_email" disabled>
        </div>
        <div class="col-6 col-md-6 mb-3">
            <label for="first_name" class="form-title">Colour :</label>
            <input type="text" class="form-control input-value" disabled id="final_colour">
        </div>
    </div>
    <!-- Address and Markings section -->
    <div class="form-row">
        <div class="col-6 col-md-6 mb-3">
            <label for="last_name" class="form-title">Address line 1 :</label>
            <input type="text" class="form-control input-value"
                   id="final_address" disabled>
        </div>
        <div class="col-6 col-md-6 mb-3">
            <label for="last_name" class="form-title">MARKINGS :</label>
            <input type="text" class="form-control input-value" id="final_markings" disabled>
        </div>
    </div>
    <!-- City and MAXIMUM TAKE-OFF MASS(MTOW) section -->
    <div class="form-row">
        <div class="col-6 col-md-6 mb-3">
            <label for="gender" class="form-title">City :</label>
            <input type="text" class="form-control input-value input-value" id="final_city" disabled>
        </div>
        <div class="col-6 col-md-6 mb-3">
            <label for="national_passport_id" class="form-title">MAXIMUM TAKE-OFF MASS(MTOW)
                :</label>
            <input type="text" class="form-control input-value" disabled id="final_mtow">
        </div>
    </div>
    <!-- Postcode and UA Serial Number section -->
    <div class="form-row">
        <div class="col-6 col-md-6 mb-3">
            <label for="postcode" class="form-title">postcode :</label>
            <input type="text" class="form-control input-value" id="final_postcode" disabled>
        </div>
        <div class="col-6 col-md-6 mb-3">
            <label for="mobile_number" class="form-title">SERIAL NUMBER :</label>
            <input type="text" class="form-control input-value" id="final_serial_number" disabled>
        </div>
    </div>
    <!-- Country and Additional Information section -->
    <div class="form-row">
        <div class="col-6 col-md-6 mb-3">
            <label for="country" class="form-title">Country :</label>
            <input type="text" class="form-control input-value" id="final_country" disabled>
        </div>
        <div class="col-6 col-md-6 mb-3">
            <label for="mobile_number" class="form-title">Additional Information :</label>
            <input type="text" class="form-control input-value" id="final_aircraft_additional_information" disabled>
        </div>
    </div>
    <!-- 1-2Fly ID section -->
    <div class="form-row">
        <div class="col-6 col-md-6 mb-3">
            <label for="fly_id" class="form-title">1-2fly id :</label>
            <input type="text" class="form-control input-value" id="final_fly_registration_id" disabled>
        </div>
    </div>
    <!-- Additional Information section -->
    <div class="form-row">
        <div class="col-6 col-md-6 mb-3">
            <label for="mobile_number" class="form-title">Additional Information :</label>
            <input type="text" class="form-control input-value" id="final_additional_information" disabled>
        </div>
    </div>
</div>
