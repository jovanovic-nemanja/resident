$(function() {
    "use strict";

    var element = '<div class="mt-4 field-form"><div class="border pl-10 pr-10"><div class="form-group pt-2"><label class="col-form-label">Field Name</label><div class="controls"><input type="text" class="form-control" name="field_name" placeholder="Field Name" required></div></div><div class="form-group"><label class="col-form-label">Record Type</label><div class="controls d-flex"><div class="col-lg-1 form-check"><label class="form-check-label" for="single"><input type="radio" id="record_type_single" class="form-check-input single" value="single" /> Single</label></div><div class="col-lg-3 form-group"><label class="form-check-label" for="multiple"><input type="radio" id="record_type_multiple" class="form-check-input multiple" checked value="multiple" /> Multiple</label></div></div></div><div class="form-group"><label class="col-form-label">Field Type Value</label><div class="controls field_type_input_area"><input type="text" class="form-control initial_type" name="typeName" placeholder="Field Type Value" required></div></div><div class="pb-5"><button class="btn btn-success add_more_type mr-5" id="add_more_type" type="button">Add New Type</button><button class="btn btn-danger delete_this_field" type="button">Delete This Field</button></div></div></div>';

    $('.add_more_field').click(function() {
        addMoreField();
    });
    
    $('.add_more_field').click();

    function addMoreField() {
        const id = Math.round(Math.random() * 10000000);
        
        const newField = $(element);
        
        newField.attr('id', id);
        newField.find('.add_more_type').attr('data', id);
        newField.find('.form-check-input').attr('name', id);
        newField.find('.add_more_type').click(function () {
            addMoreType(id);
        });

        newField.find('.delete_this_field').click(function () {
            newField.remove();
        });

        $('.form_area').append(newField);
    }

    function addMoreType(id) {
        if($('input[name='+id+']:checked', '#settings_form').val() == 'single') {
            var msg = "Sorry! You can't add more type in this case. You should change the record type as multiple.";
            var title = "Record Type!";
            toastr.options = {
                "closeButton": true,
                "debug": false,
                "newestOnTop": false,
                "progressBar": false,
                "positionClass": "toast-top-right",
                "onclick": null,
                "showDuration": "2000",
                "hideDuration": "5000",
                "timeOut": "3000",
                "extendedTimeOut": "1000",
            };
            toastr.error(msg, title);

            return;
        }else{
            var element = "<div class='d-flex pt-5'><input type='text' class='form-control' name='typeName' placeholder='Field Type Value' /><button class='btn btn-danger delete_type' id='delete_type'>Delete</button></div>";

            $('#' + id + ' .initial_type').after(element);
            
            $('.delete_type').click(function() {
                $(this).parent().remove();
            });
        }        
    }

    $('.validate_btn').click(function(e) {
        e.preventDefault();
        var group_title = $("input[name='group_title']").val();

        const formData = new FormData();
        const sendArray = [];

        if (!group_title) {
            $('.submit_btn').click();
            return;
        }else{
            $('.field-form').each((index) => {

                const oneItem = {
                    fieldName: '',
                    fieldValue: []
                };

                let fieldForm = $('.field-form').eq(index);
                const fieldName = fieldForm.find("input[name='field_name']").val();

                if(!fieldName) {
                    $('.submit_btn').click();
                    return;
                }else{
                    oneItem.fieldName = fieldName;
                }
                fieldForm.find("input[name='typeName']").each((typeNameInx) => {
                    const fieldValue = fieldForm.find("input[name='typeName']").eq(typeNameInx).val();
                    if(!fieldValue) {
                        $('.submit_btn').click();
                        return;
                    }else{
                        oneItem.fieldValue.push(fieldValue);
                    }
                });

                sendArray.push(oneItem);
            });

            if(sendArray.length == 0) {
                $('.submit_btn').click();
                return;
            }else{
                formData.append("group_title", group_title);
                formData.append("arrayValue", JSON.stringify(sendArray));

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: "/storeSettings",
                    type: 'POST',
                    contentType: false,
                    cache: false,
                    processData: false,
                    data: formData,
                    success: function(result, status) {
                        window.location.href = result;
                    }
                });
            }                
        }
    });
});
