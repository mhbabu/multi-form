<div class="row p-3 text-left">
    <div class="col-md-12 mb-3 text-center">
        <h3 class="text-uppercase">Social Network Accts</h2>
    </div>
    <div class="col-md-12 form-group">
        {!! Form::label('facebook','Facebook:') !!}
        {!! Form::text('facebook','',['class'=>'form-control','placeholder'=>'Type Here']) !!}
    </div>
    <div class="col-md-6 form-group">
        {!! Form::label('twitter','Twitter:', ['class' => 'required-star']) !!}
        {!! Form::text('twitter','',['class'=>$errors->has('twitter')?'form-control is-invalid':'form-control required','placeholder'=>'Type Here']) !!}
    </div>

    <div class="col-md-6 form-group">
        {!! Form::label('instagram','Instagram:',['class' => 'required-star']) !!}
        {!! Form::text('instagram','',['class'=>$errors->has('instagram')?'form-control is-invalid':'form-control required','placeholder'=>'Type Here']) !!}
    </div>
</div>