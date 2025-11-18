// VARIABLES

// FUNCTIONS
// Save Family
function SaveFamily(){
    let url = globalLink.replace('link', 'save_family');
    let login = globalLink.replace('link', 'login');

    $.ajax({
        url: url,
        method: 'post',
        data: frmSaveFamily.serialize(),
        dataType: 'json',
        beforeSend() {
            btnSaveFamily.prop('disabled', true);
            btnSaveFamily.html('Saving...');
            $(".input-error", frmSaveFamily).text('');
            $(".form-control", frmSaveFamily).removeClass('is-invalid');
            cnfrmLoading.open();
        },
        success(data){
            btnSaveFamily.prop('disabled', false);
            btnSaveFamily.html('Save');
            cnfrmLoading.close();
            $("input[name='family_name']", frmSaveFamily).focus();

            if(data['auth'] == 1){
                if(data['result'] == 1){
                    toastr.success('Record Saved!');
                    frmSaveFamily[0].reset();
                    $(".input-error", frmSaveFamily).text('');
                    $(".form-control", frmSaveFamily).removeClass('is-invalid');
                    dtFamily.draw();
                    $("#mdlSaveFamily").modal('hide');
                }else{
                    toastr.error('Saving Failed!');
                    if(data['error'] != null){
                        if(data['error']['family_name'] != null){
                            $("input[name='family_name']", frmSaveFamily).addClass('is-invalid');
                            $("input[name='family_name']", frmSaveFamily).siblings('.input-error').text(data['error']['family_name']);
                        }else{
                            $("input[name='family_name']", frmSaveFamily).removeClass('is-invalid');
                            $("input[name='family_name']", frmSaveFamily).siblings('.input-error').text('');
                        }
                    }
                }
            }
            else{ // if session expired
                cnfrmAutoLogin.open();
            }
        },
        error(xhr, data, status){
            cnfrmLoading.close();
            btnSaveFamily.prop('disabled', false);
            btnSaveFamily.html('Save');
            toastr.error('Saving Failed!');
        }
    });
}

function GetFamilyById(family_id){
    let url = globalLink.replace('link', 'get_family_by_id');
    let login = globalLink.replace('link', 'login');

    $.ajax({
        url: url,
        method: 'get',
        data: {
            id: family_id
        },
        dataType: 'json',
        beforeSend() {
            btnSaveFamily.prop('disabled', true);
            btnSaveFamily.html('Saving...');
            $(".input-error", frmSaveFamily).text('');
            $(".form-control", frmSaveFamily).removeClass('is-invalid');
            cnfrmLoading.open();
            frmSaveFamily[0].reset();
            $('input[name="series_id"]', frmSaveFamily).val('');
        },
        success(data){
            btnSaveFamily.prop('disabled', false);
            btnSaveFamily.html('Save');
            cnfrmLoading.close();
            // $("input[name='description']", frmSaveFamily).focus();

            if(data['auth'] == 1){
                if(data['family_info'] != null){
                    $("#mdlSaveFamily").modal('show');
                    $('input[name="id"]', frmSaveFamily).val(data['family_info']['id']);
                    $('input[name="family_name"]', frmSaveFamily).val(data['family_info']['family_name']);
                    // $('input[name="series_name"]', frmSaveFamily).val(data['family_info']['series_name']);

                    // let seriesDetails = '';
                    // if(data['family_info']['series_name'] != null){
                    //     seriesDetails += '<option value="' + data['family_info']['series_name'] + '">' + data['family_info']['series_description'] + '</option>';

                    //     $("select[name='series_name']", frmSaveFamily).append(seriesDetails);
                    //     $("select[name='series_name']", frmSaveFamily).val(data['family_info']['series_name']).trigger("change");
                    // }
                }else{
                    toastr.error('No record found.');
                }
            }else{ // if session expired
                cnfrmAutoLogin.open();
            }
        },
        error(xhr, data, status){
            cnfrmLoading.close();
            btnSaveFamily.prop('disabled', false);
            btnSaveFamily.html('Save');
            toastr.error('An error occured!');
        }
    });
}

function FamilyAction(family_id, action, status){
    let url = globalLink.replace('link', 'family_action');
    let login = globalLink.replace('link', 'login');

    $.ajax({
        url: url,
        method: 'post',
        data: {
            _token: _token,
            id: family_id,
            action: action,
            status: status,
        },
        dataType: 'json',
        beforeSend() {
            cnfrmLoading.open();
        },
        success(data){
            cnfrmLoading.close();
            dtFamily.draw();

            if(data['auth'] == 1){
                if(data['result'] == 1){
                    toastr.success('Record Saved!');
                }
                else{
                    toastr.error('Saving Failed!');
                }
            }
            else{ // if session expired
                cnfrmAutoLogin.open();
            }
        },
        error(xhr, data, status){
            cnfrmLoading.close();
            toastr.error('An error occured!');
        }
    });
}

function GetFamilyName(cboElement, FamilyId = null){
    let result;
    $.ajax({
        url: 'get_family_by_id',
        method: 'get',
        dataType: 'json',
        beforeSend: function() {
            result = '<option value="0" disabled selected>--Loading--</option>';
            cboElement.html(result);
        },
        success: function(response) {
            let data = response['family_info'];
            if(data.length > 0){
                console.log('nandito1');
                    $('.selFilByProdLineDesc').val("").trigger("change");
                    result = '<option value="" disabled selected>Select Family Name</option>';
                    result += '<option value="N/A"> N/A </option>';
                for(let i = 0; i < data.length; i++){
                    result += '<option value="' + data[i].id + '">' + data[i].family_name + '</option>';
                }
            }else{
                result = '<option value="0" selected disabled> -- No record found -- </option>';
            }
            cboElement.html(result);

            if(FamilyId != null){
                cboElement.val(FamilyId).trigger('change');
            }
        },
        error: function(data, xhr, status) {
            result = '<option value="0" selected disabled> -- Reload Again -- </option>';
            cboElement.html(result);
            console.log('Data: ' + data + "\n" + "XHR: " + xhr + "\n" + "Status: " + status);
        }
    });
}
