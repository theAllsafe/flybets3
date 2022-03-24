<label for="{{ $name }}" class="form-title custom-file-upload">
    {{ $label_name }} <span style="color: red; font-size: 18px">*</span>
    :</label>
<div class="row">
    <div class="col-sm-8">
        <input type="text" class="form-control"
               value="{{ $value }}">
    </div>
    <div class="col-sm-2" style="padding-left: 0">
        <button class="btn btn-primary" type="button" onclick="document.getElementById('{{$name}}').click()">
            Upload
        </button>
    </div>
</div>
<input type="file" id="{{ $name }}" style="display: none"
       class="form-control  @error($name) input-error @enderror">
@error($name)
<div class="invalid-feedback" style="display: block !important;">{{ $message }}
</div>
@enderror
