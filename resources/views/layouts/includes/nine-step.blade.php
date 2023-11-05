
<div class="row mx-2">
    <div class="col-md-12 mb-4">
        {!!Form::label('image_signature', 'Select Your Signature Type',['class' => 'required-star'])!!}
        {!!Form::select('signature_status', ['Digital Signature' => 'Digital Signature', 'Image Signature' => 'Image Signature'],'',['class' => $errors->has('other_profession') ? 'form-control is-invalid':'form-control required','placeholder'=> '---', 'id' => 'signatureStatus']) !!}
    </div>
    <div class="col-md-6 form-group digital-signature",>
        {!! Form::label('', 'Add your Signature', ['class' => 'required-star']) !!}
        <div class="signature-container">
            <div class="canvas-container">
                <input type="hidden" name="signatureImage" id="signature-image-input" />
                <canvas id="signature-canvas"></canvas>
            </div>
            <label style="margin-top: 10px; padding: 8px 16px; background-color: #007bff; color: white; border: none;
            border-radius: 4px; cursor: pointer;" id="clear-button">Clear</label>
        </div>
    </div>
    <div class="col-md-6 img-signature">
        <div class="form-group">
            {!! Form::label('signature_photo', 'Signature Photo :',['class' => 'required-star']) !!}
            <br>
            <img class="border border-primary img-view" src="{{ url('img/photo.png') }}" height="250" width="100%">

            <label class="btn btn-block btn-secondary btn-sm rounded-0" style="width: 100%; cursor: pointer">
                <input class="img-file signature-img" type="file" name="signature_photo" style="display: none" accept="image/png,image/jpeg,image/jpg">
                <i class="fa fa-upload"></i> Upload
            </label>
            <span id="photo_err" class="text-danger" style="font-size: 16px;"></span>
        </div>
    </div>
</div>
    
