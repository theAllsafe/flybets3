<div class="form-row">
    <div class="col-12 col-md-12 mb-3">
        <label for="first_name" class="form-title">First name
            <span style="color: red; font-size: 18px">*</span> :</label>
        <input type="text" id="first_name" placeholder="Enter First name" name="first_name"
               class="form-control @error('first_name') input-error @enderror"
               value="{{ old('first_name') }}">
        @error('first_name')
        <div class="invalid-feedback"
             style="display: block !important;">{{ $message }}</div>
        @enderror
    </div>
</div>
<div class="form-row">
    <div class="col-12 col-md-12 mb-3">
        <label for="last_name" class="form-title">Last name
            <span style="color: red; font-size: 18px">*</span> :</label>
        <input type="text" id="last_name"
               placeholder="Enter Last name" name="last_name"
               class="form-control @error('last_name') input-error @enderror"
               value="{{ old('last_name') }}">
        @error('last_name')
        <div class="invalid-feedback"
             style="display: block !important;">{{ $message }}</div>
        @enderror
    </div>
</div>
<div class="form-row">
    <div class="col-6 col-md-6 mb-3">
        <label for="document_type" class="form-title">Document Type
            <span style="color: red; font-size: 18px">*</span> :</label>
        <select id="document_type" data-toggle="select" name="document_type"
                onchange="changeDocumentTypeText()"
                class="form-control input-value @error('document_type') input-error @enderror">
            <option value="0">Select Document</option>
            <option value="national_id"
                {{old('document_type') != null && old('document_type') == 'national_id' ? 'selected' : ''}}>
                National ID
            </option>
            <option value="passport"
                {{old('document_type') != null && old('document_type') == 'passport' ? 'selected' : ''}}>
                Passport
            </option>
        </select>
        @error('document_type')
        <div class="invalid-feedback"
             style="display: block !important;">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-6 col-md-6 mb-3">
        <label for="nationality" class="form-title custom-file-upload">
            Nationality
            <span style="color: red; font-size: 18px">*</span>:</label>
        <select id="nationality" data-toggle="select" name="nationality"
                class="form-control input-value  @error('nationality') input-error @enderror">
            <option value="0" selected>Select Nationality</option>
            @foreach($nationalities as $nationality)
                <option value="{{ $nationality }}" {{old('nationality') !=null &&
                                        old('nationality')==$nationality ? 'selected' : ''}}>
                    {{ $nationality }}
                </option>
            @endforeach
        </select>
        @error('nationality')
        <div class="invalid-feedback" style="display: block !important;">{{ $message }}
        </div>
        @enderror
    </div>
</div>
<div class="form-row">
    <div class="col-6 col-md-6 mb-3">
        <label for="national_passport_id" class="form-title">
            <span id="document_type_value">Document id</span>
            <span style="color: red; font-size: 18px">*</span> :</label>
        <input type="text" id="national_passport_id" name="national_passport_id"
               placeholder="Enter National / Passport ID"
               class="form-control @error('national_passport_id') input-error @enderror"
               value="{{ old('national_passport_id') }}">
        @error('national_passport_id')
        <div class="invalid-feedback"
             style="display: block !important;">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-6 col-md-6 mb-3">
        <label for=" national_passport_file_link" class="form-title">Upload copy
            national / passport id <span style="color: red; font-size: 18px">*</span>
            :</label>
        <div class="row">
            <div class="col-sm-8">
                <input type="text" class="form-control" disabled
                       id="national_passport_file_link_name">
            </div>
            <div class="col-sm-2" style="padding-left: 0">
                <button class="btn btn-primary" type="button"
                        onclick="document.getElementById('national_passport_file_link').click()">
                    Upload
                </button>
            </div>
        </div>
        <input type="file" id="national_passport_file_link" style="display: none"
               name="national_passport_file_link"
               onchange="getFileData(this, 'national_passport_file_link_name');"
               class="form-control  @error('national_passport_file_link') input-error @enderror">

        @error('national_passport_file_link')
        <div class="invalid-feedback"
             style="display: block !important;">{{ $message }}</div>
        @enderror
    </div>
</div>
<div class="form-row">
    <div class="col-6 col-md-6 mb-3">
        <label for=" date_of_birth" class="form-title">Date of birth
            (DD/MM/YY) <span style="color: red; font-size: 18px">*</span> :</label>
        <input type="date" id="date_of_birth" placeholder="Select Date of birth"
               name="date_of_birth"
               class="form-control @error('date_of_birth') input-error @enderror"
               value="{{ old('date_of_birth') }}">
        @error('date_of_birth')
        <div class="invalid-feedback"
             style="display: block !important;">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-6 col-md-6 mb-3">
        <label for="gender" class="form-title">Gender
            <span style="color: red; font-size: 18px">*</span> :</label>
        <select id="gender" data-toggle="select" name="gender"
                class="form-control  @error('gender') input-error @enderror">
            <option value="0" selected>Select Gender</option>
            <option
                value="1" {{old('gender') != null && old('gender') == 1 ? 'selected' : ''}}>
                Male
            </option>
            <option
                value="2" {{ old('gender') != null && old('gender') == 2 ? 'selected' : ''}}>
                Female
            </option>
        </select>
        @error('gender')
        <div class="invalid-feedback"
             style="display: block !important;">{{ $message }}</div>
        @enderror
    </div>
</div>
<div class="form-row">
    <div class="col-6 col-md-6 mb-3">
        <label for="email" class="form-title">Email address
            <span style="color: red; font-size: 18px">*</span>:</label>
        <input type="text" class="form-control  @error('email') input-error @enderror"
               id="email" name="email" placeholder="Enter Email" value="{{ old('email')}}">
        @error('email')
        <div class="invalid-feedback"
             style="display: block !important;">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-6 col-md-6 mb-3">
        <label for="mobile_number" class="form-title">Contact Mobile Number
            <span style="color: red; font-size: 18px">*</span> :</label>
        <input type="text" id="mobile_number" name="mobile_number"
               placeholder="Contact Mobile Number"
               class="form-control @error('mobile_number') input-error @enderror"
               value="{{ old('mobile_number')  }}">
        @error('mobile_number')
        <div class="invalid-feedback"
             style="display: block !important;">{{ $message }}</div>
        @enderror
    </div>
</div>
