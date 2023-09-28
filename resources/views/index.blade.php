@extends('layouts.app')
@section('header-css')
    {!! Html::style('/assets/backend/dist/css/custom-design.css') !!}
    {!! Html::style('/assets/backend/plugins/multistep-form/multi-form.css') !!}
    {!! Html::style('/assets/login/css/icofont.min.css') !!}
    {!! Html::style('/assets/login/css/site-flaticon.css') !!}
    <style>
        /*Signature*/
        .signature-container {
            background-color: #fff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
            width: 320px;
            text-align: center;
            position: relative;
        }

        .canvas-container {
            position: relative;
            width: 100%;
            padding-top: 66.67%;
            /* Maintain a 3:2 aspect ratio for the canvas */
        }

        canvas {
            border: 1px solid #ccc;
            border-radius: 4px;
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }


        .signature-container button {
            margin-top: 10px;
            padding: 8px 16px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>
@endsection
@section('content')
    <div class="col-md-10 mx-auto">
        {!! Form::open(['route' => 'document.submit', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'class' => 'dataForm', 'id' => 'myForm']) !!}
        <div class="card">
            <div class="infoDiv">
                <div class="row">
                    <div class="col-md-3" style="box-shadow: 3px 0 5px -2px #888">
                        <div class="step-left">
                            <div class="step-list-content text-uppercase">
                                <ul class="step-list m-0 p-0">
                                    <li class="general-info" style="cursor:pointer;">First Step</li>
                                    <li class="ssc-level" style="cursor:pointer;">MODEL EXPERIENCE</li>
                                    <li class="hsc-level" style="cursor:pointer;">LEGAL ADULTS</li>
                                    <li class="bachelor-degree" style="cursor:pointer;">YOUR STATS</li>
                                    <li class="master-degree" style="cursor:pointer;">YOUR DOMINATIONS</li>
                                    <li class="english-language" style="cursor:pointer;">QUESTION & ANS</li>
                                    <li class="testimonial" style="cursor:pointer;">AGGREMENT</li>
                                    <li class="interested-country" style="cursor:pointer;">Social Network Accts</li>
                                    <li class="last-one-step" style="cursor:pointer;">NETWORK & SIGNATURE</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8 mx-auto mt-3">
                        <div class="tab general-info-tab" active-tab="general-info">
                            @include("layouts.includes.one-step")
                        </div>
                        <div class="tab ssc-tab" active-tab="ssc-level">
                            @include("layouts.includes.two-step")
                        </div>
                        <div class="tab hsc-tab" active-tab="hsc-level">
                            @include("layouts.includes.three-step")
                        </div>
                        <div class="tab bachelor-tab" active-tab="bachelor-degree">
                            @include("layouts.includes.four-step")
                        </div>
                        <div class="tab master-tab" active-tab="master-degree">
                                @include("layouts.includes.five-step")
                        </div>
                        <div class="tab english-language-tab" active-tab="english-language">
                            @include("layouts.includes.six-step")
                        </div>
                        <div class="tab" active-tab="testimonial">
                            @include('layouts.includes.seven-step')
                        </div>
                        <div class="tab" active-tab="interested-country">
                            @include('layouts.includes.eight-step')
                        </div>
                        <div class="tab" active-tab="last-one-step">
                            @include('layouts.includes.nine-step')
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-end mt-2 mb-3">
            <button type="button" class="previous btnPrevious mr-2"><i class="icofont-long-arrow-left"></i> Previous</button>
            <button type="button" class="next btnNext">Next <i class="icofont-long-arrow-right"></i></button>
            <button type="button" class="btn-nxt submit-btn submit">Submit</button>
        </div>
        {!! Form::close() !!}
    </div>
@endsection

@section('footer-script')
    {!! Html::script('/assets/backend/plugins/multistep-form/multi-form-create.js') !!}
    {!! Html::script('js/signature_pad.min.js') !!}

    <script type="text/javascript">
        /***********************************
        MULTISTEP FORM VALIDATION SCRIPT
        *********************************/
        $(document).ready(function() {
            $("#myForm").multiStepFormCreate({
                validations: {}
            }).navigateTo(0);
        });

        /*******************************
        FORM VALIDATION WITH CHECKBOX
        *******************************/
        $.validator.addMethod("checkbox", function (value, elem, param) { // First Step 
            if ($('.profession').find('input[type=checkbox]:checked').length === 0)
                return false;
            return true;
        });

        $.validator.addMethod("radio", function (value, elem, param) { // Second Step
            if ($('.model-experiences').find('input[type=radio]:checked').length !== 7 )
                return false;
            return true;
        });

        /*********************************************
        FRIST STEP OTHER FIELD SCRIPTING START HERE 
        **********************************************/
        $(".other-profession-div").hide();
        $(".other-profession").change(function() {
            if ($(this).is(":checked")) {
                $(".other-profession-div").show();
            } else {
                $(".other-profession-div").hide();
            }
        });

        $(".fetish-entertain-div").hide();
        $("#entertain").change(function() {
            if ($(this).val() == 'Others') {
                $(".fetish-entertain-div").show();
            } else {
                $(".fetish-entertain-div").hide();
            }
        });

        /**************************************
        SIGNATURE STATUS SCRIPTING START HERE 
        ***************************************/
        $(".digital-signature").hide();
        $(".img-signature").hide();
        $("#signatureStatus").change(function() {
            const value = $(this).val();
            if (value == 'Digital Signature') {
                $(".digital-signature").show();
                $(".img-signature").hide();
            } else if (value == 'Image Signature') {
                $(".digital-signature").hide();
                $(".img-signature").show();
            } else {
                $(".digital-signature").hide();
                $(".img-signature").hide();
            }
        });

        /*****************************************
         SIGNATURE PHOTO UPLOAD SRIPT START HERE
        *******************************************/
        $(document).on("change", ".img-file", function() {
            let parentHtml = $(this).parent().parent();
            let image = parentHtml.find('.img-view');
            if (this.files && this.files[0]) {
                let mime_type = this.files[0].type;
                if (!(mime_type == 'image/jpeg' || mime_type == 'image/jpg' || mime_type == 'image/png')) {
                    swal("Invalid file format Only jpg jpeg png is allowed");
                    this.value = null;
                    $(this).prop('required', true);
                    image.attr('src', '/img/photo.png');
                    return false;
                }
                let size = this.files[0].size;
                if (size > 3000000) {
                    swal("Please upload image must less than 1MB!!");
                    this.value = null;
                    $(this).prop('required', true);
                    image.attr('src', '/img/photo.png');
                    return false;
                }
                let reader = new FileReader();
                reader.onload = function(e) {
                    image.attr('src', e.target.result);
                };
                reader.readAsDataURL(this.files[0]);
            }
        });


        /******************************************
         MULTIPLE FILE UPLOAD SCRIPTING START HERE
        *******************************************/
        function uploadFiles(input) {
            if (input.files || input.files) {
                let allowedFileTypes = ['image/jpeg', 'image/jpg', 'image/png'];
                let formData = new FormData();

                for (let i = 0; i < input.files.length; i++) {
                    let fileType = input.files[i].type;
                    let fileSize = (input.files[i].size / 1024 / 1024).toFixed(2);

                    if (!allowedFileTypes.includes(fileType)) {
                        swal("Only PDF, PNG, JPEG, JPG types are allowed!");
                        return false;
                    }

                    if (fileSize > 2) {
                        swal("Maximum file size 2MB allowed!");
                        input.value = '';
                        return false;
                    }

                    formData.append('_token', "{{ csrf_token() }}");
                    formData.append('file_data[]', input.files[i]);
                }

                $(input).parent().parent().find('.uploaded-file').html('Uploading....');
                let action = "{{ url('upload-multiple-files') }}"; // upload the URL
                $.ajax({
                    url: action,
                    dataType: 'json',
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: formData,
                    type: 'post',
                    success: function(response) {
                        if (response.status) {
                            $(input).parent().parent().find('.uploaded-file').html('');
                            // $(input).val('');
                            $.each(response.file_paths, function(index, value) {
                                var anchor = $(`<a class="btn btn-primary btn-sm m-1" href="${value}" target="_blank">File ${index+1}</a>`);
                                var input = $(`<input class="uploadedImges" type="hidden" name="uploaded_images[]" value="${value}" />`);
                                $('.uplodedImages').append(anchor);
                                $('.uploded-inputs').append(input);
                            });
                        } else {
                            $(input).parent().parent().find('.uploaded-file').html('');
                        }
                    }
                });
            } else {
                $(this).val('');
                swal("Please select between 5 and 20 files.");
            }
        }

        /********************************
         SIGNATURE SCRIPTING START HERE
        *********************************/

        const canvas = $("#signature-canvas")[0];
        const clearButton = $("#clear-button");
        const signaturePad = new SignaturePad(canvas);

        clearButton.on("click", function() {
            signaturePad.clear();
        });

        const signatureToImageInput = $("#signature-image-input");

        $(".submit").on("click", function() {
            const signatureImage = signaturePad.toDataURL();
            signatureToImageInput.val(signatureImage);
        });    
    </script>
@endsection
