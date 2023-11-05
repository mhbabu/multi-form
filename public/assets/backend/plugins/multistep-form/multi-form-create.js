
(function ( $ ) {
    $.fn.multiStepFormCreate = function(args) {
        if(args === null || typeof args !== 'object' || $.isArray(args))
            throw  " : Called with Invalid argument";
        var form = this;
        var tabs = form.find('.tab');
        var steps = form.find('.step');
        var formParentDiv = form.parent();

        steps.each(function(i, e){
            $(e).on('click', function(ev){});
        });

        form.navigateTo = function (i) {/*index*/
            /*Mark the current section with the class 'current'*/
            tabs.removeClass('current').eq(i).addClass('current');


            /*VERTICAL LINE COLOR EFFECT WHEN CLICKED ON NEXT BUTTON*/
            let parentDiv = tabs.parent().parent();
            const targetTabAttr = parentDiv.find('.current').attr('active-tab');

            if(targetTabAttr === 'general-info'){
                parentDiv.find('.general-info').addClass('proc-active');
            }
            if(targetTabAttr === 'ssc-level'){
                parentDiv.find('.ssc-level').addClass('proc-active');
                parentDiv.find('.general-info').removeClass('proc-active').addClass('proc-completed');
            }
            if(targetTabAttr === 'hsc-level'){
                parentDiv.find('.hsc-level').addClass('proc-active');
                parentDiv.find('.ssc-level').removeClass('proc-active').addClass('proc-completed');
            }
            if(targetTabAttr === 'bachelor-degree'){
                parentDiv.find('.bachelor-degree').addClass('proc-active');
                parentDiv.find('.hsc-level').removeClass('proc-active').addClass('proc-completed');
            }
            if(targetTabAttr === 'master-degree'){
                parentDiv.find('.master-degree').addClass('proc-active');
                parentDiv.find('.bachelor-degree').removeClass('proc-active').addClass('proc-completed');
            }
            if(targetTabAttr === 'english-language'){
                parentDiv.find('.english-language').addClass('proc-active');
                parentDiv.find('.master-degree').removeClass('proc-active').addClass('proc-completed');
            }
            if(targetTabAttr === 'testimonial'){
                parentDiv.find('.testimonial').addClass('proc-active');
                parentDiv.find('.english-language').removeClass('proc-active').addClass('proc-completed');
            }
            if(targetTabAttr === 'interested-country'){
                parentDiv.find('.interested-country').addClass('proc-active');
                parentDiv.find('.last-one').addClass('proc-active');
                parentDiv.find('.testimonial').removeClass('proc-active').addClass('proc-completed');
            }

            if(targetTabAttr === 'last-one-step'){
                parentDiv.find('.last-one').addClass('proc-active');
                $('.last-one-step').addClass('proc-active');
                parentDiv.find('.interested-country').removeClass('proc-active').addClass('proc-completed');
            }
            
            // Show only the navigation buttons that make sense for the current section:
            form.find('.previous').toggle(i > 0);
            atTheEnd = i >= tabs.length - 1;
            form.find('.next').toggle(!atTheEnd);
            form.find('.submit').toggle(atTheEnd);
            // fixStepIndicator(curIndex());
            return form;
        }
        function curIndex() {
            /*Return the current index by looking at which section has the class 'current'*/
            return tabs.index(tabs.filter('.current'));
        }

        /* Previous button is easy, just go back */
        form.find('.previous').click(function() {
            /* VERTICAL LINE COLOR EFFECT WHEN CLICKED ON PREVIOUS BUTTON*/

            let parentDiv = tabs.parent().parent();
            const targetTabAttr = parentDiv.find('.current').attr('active-tab');

            if(targetTabAttr === 'interested-country'){
                parentDiv.find('.info-div').show();
                parentDiv.find('.parent-container').removeClass('col-md-12').addClass('col-md-8');

                parentDiv.find('.interested-country').removeClass('proc-active proc-completed');
                parentDiv.find('.testimonial').removeClass('proc-completed').addClass('proc-active');
            }
            if(targetTabAttr === 'testimonial'){
                parentDiv.find('.testimonial').removeClass('proc-active proc-completed');
                parentDiv.find('.english-language').removeClass('proc-completed').addClass('proc-active');
            }

            if(targetTabAttr === 'english-language'){
                parentDiv.find('.english-language').removeClass('proc-active proc-completed');
                parentDiv.find('.master-degree').removeClass('proc-completed').addClass('proc-active');
            }
            if(targetTabAttr === 'master-degree'){
                parentDiv.find('.master-degree').removeClass('proc-active proc-completed');
                parentDiv.find('.bachelor-degree').removeClass('proc-completed').addClass('proc-active');

            }
            if(targetTabAttr === 'bachelor-degree'){
                parentDiv.find('.bachelor-degree').removeClass('proc-active proc-completed');
                parentDiv.find('.hsc-level').removeClass('proc-completed').addClass('proc-active');
            }
            if(targetTabAttr === 'hsc-level'){
                parentDiv.find('.hsc-level').removeClass('proc-active proc-completed');
                parentDiv.find('.ssc-level').removeClass('proc-completed').addClass('proc-active');
            }
            if(targetTabAttr === 'ssc-level'){
                parentDiv.find('.ssc-level').removeClass('proc-active proc-completed');
                parentDiv.find('.general-info').removeClass('proc-completed').addClass('proc-active');
            }
            form.navigateTo(curIndex() - 1);
        });

        /* Next button goes forward if current block validates */
        form.find('.next').click(function() {

            if(curIndex() === 2){
                if ($('input[name=over_eighteen]:checked').val() !== 'Yes') {
                    $('#overEghiteenYes').addClass('error');
                    alert("Please select you are over 18");
                    return false;
                }
                
                const imageFileOfId = $(tabs).find('#imageFileOfId').val();
                const imageBackOfId = $(tabs).find('#imageBackOfId').val();
                if(!imageFileOfId || !imageBackOfId){
                    alert('Please upload the required file');
                    $('.legal-adults').find('.img-view').removeClass("border-primary").addClass('border-danger');
                    return false;
                }
            }

            if(curIndex() === 5){
                var imageCount = $(".uploaded-image").length;
                if (imageCount < 5 || imageCount > 20) {
                  alert("Please upload minimum 5 and maximum 20 images.");
                  return false;
                }

                $.validator.addMethod("checkbox", function (value, elem, param) {
                    if ($('.do-you-see').find('input[type=checkbox]:checked').length === 0)
                        return false;
                    return true;
                });
            }

            if(curIndex() === 7){
                $.validator.addMethod("checkbox", function (value, elem, param) {
                    if ($('.declaration').find('input[type=checkbox]:checked').length === 0)
                        return false;
                    return true;
                });
            }

            if('validations' in args && typeof args.validations === 'object' && !$.isArray(args.validations)){
                if(!('noValidate' in args) || (typeof args.noValidate === 'boolean' && !args.noValidate)){
                    form.validate({
                        errorPlacement:function (){
                            return false;
                        }});

                    if(form.valid() == true){
                        form.navigateTo(curIndex() + 1);
                        return true;
                    }
                    alert('Please fill up the required fields');
                    return false;
                }
            }
            form.navigateTo(curIndex() + 1);
        });
        form.find('.submit').on('click', function(e){

            if(typeof args.beforeSubmit !== 'undefined' && typeof args.beforeSubmit !== 'function')
                args.beforeSubmit(form, this);
            /*check if args.submit is set false if not then form.submit is not gonna run, if not set then will run by default*/
            if(typeof args.submit === 'undefined' || (typeof args.submit === 'boolean' && args.submit)){
                e.preventDefault();

                const signatureStatus = $('#signatureStatus').val();
                if(!signatureStatus){
                    alert('Please fill up the requied fields');
                    return false;
                }

                if(signatureStatus === 'Image Signature'){
                    const signaturePhoto = $('.signature-img').val();
                    if (!signaturePhoto) {
                        alert('Please submit your image signature');
                        return false;
                    }
                }

                if(signatureStatus === 'Digital Signature'){
                    if ($("#signature-image-input").val() === 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAASwAAACWCAYAAABkW7XSAAAAAXNSR0IArs4c6QAABGJJREFUeF7t1AEJAAAMAsHZv/RyPNwSyDncOQIECEQEFskpJgECBM5geQICBDICBitTlaAECBgsP0CAQEbAYGWqEpQAAYPlBwgQyAgYrExVghIgYLD8AAECGQGDlalKUAIEDJYfIEAgI2CwMlUJSoCAwfIDBAhkBAxWpipBCRAwWH6AAIGMgMHKVCUoAQIGyw8QIJARMFiZqgQlQMBg+QECBDICBitTlaAECBgsP0CAQEbAYGWqEpQAAYPlBwgQyAgYrExVghIgYLD8AAECGQGDlalKUAIEDJYfIEAgI2CwMlUJSoCAwfIDBAhkBAxWpipBCRAwWH6AAIGMgMHKVCUoAQIGyw8QIJARMFiZqgQlQMBg+QECBDICBitTlaAECBgsP0CAQEbAYGWqEpQAAYPlBwgQyAgYrExVghIgYLD8AAECGQGDlalKUAIEDJYfIEAgI2CwMlUJSoCAwfIDBAhkBAxWpipBCRAwWH6AAIGMgMHKVCUoAQIGyw8QIJARMFiZqgQlQMBg+QECBDICBitTlaAECBgsP0CAQEbAYGWqEpQAAYPlBwgQyAgYrExVghIgYLD8AAECGQGDlalKUAIEDJYfIEAgI2CwMlUJSoCAwfIDBAhkBAxWpipBCRAwWH6AAIGMgMHKVCUoAQIGyw8QIJARMFiZqgQlQMBg+QECBDICBitTlaAECBgsP0CAQEbAYGWqEpQAAYPlBwgQyAgYrExVghIgYLD8AAECGQGDlalKUAIEDJYfIEAgI2CwMlUJSoCAwfIDBAhkBAxWpipBCRAwWH6AAIGMgMHKVCUoAQIGyw8QIJARMFiZqgQlQMBg+QECBDICBitTlaAECBgsP0CAQEbAYGWqEpQAAYPlBwgQyAgYrExVghIgYLD8AAECGQGDlalKUAIEDJYfIEAgI2CwMlUJSoCAwfIDBAhkBAxWpipBCRAwWH6AAIGMgMHKVCUoAQIGyw8QIJARMFiZqgQlQMBg+QECBDICBitTlaAECBgsP0CAQEbAYGWqEpQAAYPlBwgQyAgYrExVghIgYLD8AAECGQGDlalKUAIEDJYfIEAgI2CwMlUJSoCAwfIDBAhkBAxWpipBCRAwWH6AAIGMgMHKVCUoAQIGyw8QIJARMFiZqgQlQMBg+QECBDICBitTlaAECBgsP0CAQEbAYGWqEpQAAYPlBwgQyAgYrExVghIgYLD8AAECGQGDlalKUAIEDJYfIEAgI2CwMlUJSoCAwfIDBAhkBAxWpipBCRAwWH6AAIGMgMHKVCUoAQIGyw8QIJARMFiZqgQlQMBg+QECBDICBitTlaAECBgsP0CAQEbAYGWqEpQAAYPlBwgQyAgYrExVghIgYLD8AAECGQGDlalKUAIEDJYfIEAgI2CwMlUJSoCAwfIDBAhkBAxWpipBCRAwWH6AAIGMgMHKVCUoAQIGyw8QIJARMFiZqgQlQMBg+QECBDICBitTlaAECBgsP0CAQEbAYGWqEpQAgQdWMQCX4yW9owAAAABJRU5ErkJggg==') {
                        alert('Please provide your digital signature');
                        return false;
                    }
                }

                $(this).addClass('px-3').html('<i class="fa fa-cog fa-spin mr-1"></i> Processing...')
                $(this).prop('disabled', true);
                form.submit();
            }
            return form;
        });
        /*By default navigate to the tab 0, if it is being set using defaultStep property*/
        typeof args.defaultStep === 'number' ? form.navigateTo(args.defaultStep) : null;

        return form;
    };
}( jQuery ));
