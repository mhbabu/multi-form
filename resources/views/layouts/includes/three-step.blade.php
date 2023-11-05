<div class="row text-left p-3 legal-adults">
    <div class="col-md-12 text-center">
        <h3 class="text-uppercase">All AIA Models are legal adults</h3>
    </div>
    <div class="col-md-12 form-group">
        {!! Form::label('over_eighteen', 'Are you over the age of 18?', ['class' => 'required-star']) !!} <br>
        <div class="form-check form-check-inline ml-3">
            <input class="form-check-input required" type="radio" name="over_eighteen" id="overEghiteenYes" value="Yes" />
            <label class="form-check-label" for="overEghiteenYes">Yes</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="over_eighteen" id="overEghiteenNo" value="No" />
            <label class="form-check-label" for="overEghiteenNo">No</label>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('imageFileOfId', "Submit form of ID: Passport or Driver’s Licence for Proof of Age", ['class' => 'required-star']) !!}
            <br>
            <img class="border border-primary img-view imageFileOfId" src="{{ url('img/photo.png') }}" height="250" width="100%" style="cursor: pointer" />
            <label class="btn btn-block btn-secondary btn-sm rounded-0" style="cursor: pointer">
                <input class="img-file required" type="file" name="imageFileOfId" style="display: none" accept="image/png,image/jpeg,image/jpg" id="imageFileOfId" >
                <i class="fa fa-upload"></i> Upload
            </label>
        </div>
    </div>
    <div class="col-md-6"></div>
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('imageBackOfId', 'We must also have a picture of the back of your ID', ['class' => 'required-star']) !!}
            <br>
            <img class="border border-primary img-view imageBackOfId" src="{{ url('img/photo.png') }}" height="250" width="100%" style="cursor: pointer" />
            <label class="btn btn-block btn-secondary btn-sm rounded-0" style="cursor: pointer">
                <input class="img-file" class="file" type="file" name="imageBackOfId" style="display: none" accept="image/png,image/jpeg,image/jpg" id="imageBackOfId">
                <i class="fa fa-upload"></i> Upload
            </label>
        </div>
    </div>
</div>
        