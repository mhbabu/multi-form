<div class="row p-3 text-left flowing-question">
    <div class="col-md-12 mb-3 text-center">
        <h3 class="uppercase-text">Please answer these following questions</h2>
    </div>
    <div class="form-group col-md-6">
        {!! Form::label('primary_focous','1. What is your primary focus in the companion?',['class'=>'required-star']) !!}
        {!! Form::select('primary_focous',['Pornstar' => 'Pornstar', 'Cam Model' => 'Cam Model', 'MILF' => 'MILF', 'Hot Wife' => 'Hot Wife', 'Dominatrix' => 'Dominatrix'],'',['class'=>$errors->has('primary_focous')?'form-control is-invalid':'form-control required','placeholder'=>'---']) !!}
    </div>
    <div class="form-group col-md-6">
        {!! Form::label('secondary_focus','2. What is your secondary focus in the companion?',['class'=>'required-star']) !!}
        {!! Form::text('secondary_focus','',['class'=>$errors->has('secondary_focus')?'form-control is-invalid':'form-control required','placeholder'=>'Type Here']) !!}
    </div>

    <div class="form-group col-md-6">
        {!! Form::label('entertain','3. What fetishes do you entertain?',['class'=>'required-star']) !!}
        {!! Form::select('entertain',['Femdome' => 'Femdome', 'Submissive' => 'Submissive', 'Bondages' => 'Bondages', 'Others' => 'Others'],'',['class'=>$errors->has('entertain')?'form-control is-invalid':'form-control required','placeholder'=>'---', 'id' => 'entertain']) !!}
    </div>
    <div class="form-group col-md-6 fetish-entertain-div">
        {!! Form::label('others_fetiches','Your other fetiches',['class'=>'required-star']) !!}
        {!! Form::text('others_fetiches','',['class'=>$errors->has('others_fetiches')?'form-control is-invalid':'form-control required','placeholder'=>'Type Here','id' => '']) !!}
    </div>

    <div class="form-group col-md-6">
        {!! Form::label('racial_objections','4. Do you have any racial objections?',['class'=>'required-star']) !!}
        {!! Form::text('racial_objections','',['class'=>$errors->has('racial_objections')?'form-control is-invalid':'form-control required','placeholder'=>'Type Here']) !!}
    </div>
    <div class="col-md-12">
        <div class="form-group">
            {!! Form::label('','6. Do you only see:',['class'=>'required-star']) !!}
            <div class="d-flex justify-content-around">
                <div class="checkbox">
                    <label>{!! Form::checkbox('men', 'Men', false,['class'=> 'mr-2'])!!} Men</label>
                </div>
                <div class="checkbox">
                    <label>{!! Form::checkbox('women', 'Women', false,['class'=> 'mr-2'])!!} Women</label>
                </div>
                <div class="checkbox">
                    <label>{!! Form::checkbox('couple', 'Couple', false,['class'=> 'mr-2'])!!} Couple</label>
                </div>
                <div class="checkbox">
                    <label>{!! Form::checkbox('transgender', 'Transgender', false,['class'=> 'mr-2'])!!} Transgender</label>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="upload-container mb-2">
            <h1>Upload Your Photos</h1>
            <p>
                High resolution & professionally shot photos are preferred. No Selfies Please.<br>
                <small>Minimun 5 photos is mandatory and Maximum 20</small>
            </p>
            <label class="btn btn-default btn-xs">
                <input class="required" type="file" onchange="uploadFiles(this)" name="image_multiple" id="image_multiple" accept="image/jpg,image/jpeg,image/png" multiple>
            </label>
        </div>
        <span class="uploaded-file mt-2 float-right"></span>
        <div class="uplodedImages"></div>
        <div class="uploded-inputs"></div>
    </div>
</div>
    