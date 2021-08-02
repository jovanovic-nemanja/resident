$(function() {
    "use strict";

    var element = '<div class="mt-4 field-form"><div class="border pl-10 pr-10"><div class="form-group pt-2"><label class="col-form-label">Field Name</label><div class="controls"><input type="text" class="form-control" name="field_name" placeholder="Field Name" required></div></div><div class="form-group"><label class="col-form-label">Field Type Value</label><div class="controls field_type_input_area"><input type="text" class="form-control initial_type" name="typeName" placeholder="Field Type Value" required></div></div><div class="pb-5"><button class="btn btn-success add_more_type mr-5" id="add_more_type" type="button">Add New Type</button><button class="btn btn-danger delete_this_field" type="button">Delete This Field</button></div></div></div>';

    $('.add_more_field').click(function() {
        addMoreField();
    });
    
    $('.add_more_field').click();

    function addMoreField() {
        const id = Math.round(Math.random() * 10000000);
        
        const newField = $(element);
        
        newField.attr('id', id);
        newField.find('.add_more_type').attr('data', id);
        newField.find('.add_more_type').click(function () {
            addMoreType(id);
        });

        newField.find('.delete_this_field').click(function () {
            newField.remove();
        });

        $('.form_area').append(newField);
    }

    function addMoreType(id) {
        var element = "<div class='d-flex pt-5'><input type='text' class='form-control' name='typeName' placeholder='Field Type Value' /><button class='btn btn-danger delete_type' id='delete_type'>Delete</button></div>";

        $('#' + id + ' .initial_type').after(element);
        
        $('.delete_type').click(function() {
            $(this).parent().remove();
        });
    }

    $('.validate_btn').click(function(e) {
        e.preventDefault();
        var tabsID = $('#tabs-control-dropdown').val();
        var template_id = $('#template_id').val();

        const formData = new FormData();
        const sendArray = [];

        $('.field-form').each((index) => {

            const oneItem = {
                fieldName: '',
                fieldValue: []
            };

            let fieldForm = $('.field-form').eq(index);
            const fieldName = fieldForm.find("input[name='field_name']").val();

            if(!fieldName) {
                alert('Please input the Field Name.');
                return;
            }else{
                oneItem.fieldName = fieldName;
            }
            fieldForm.find("input[name='typeName']").each((typeNameInx) => {
                const fieldValue = fieldForm.find("input[name='typeName']").eq(typeNameInx).val();
                if(!fieldValue) {
                    alert('Please input the Field Type Value.');
                    return;
                }else{
                    oneItem.fieldValue.push(fieldValue);
                }
            });
            sendArray.push(oneItem);
        });

        if(sendArray.length == 0) {
            alert('Please input the Field Name and Type Value.');
            return;
        }else{
            formData.append("tabsID", tabsID);
            formData.append("template_id", template_id);
            formData.append("arrayValue", JSON.stringify(sendArray));

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "/templates/storeSettings",
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
    });
});
