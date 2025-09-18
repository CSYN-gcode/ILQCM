// VARIABLES

// FUNCTIONS
// Save Line
function SaveLine(){
    let url = globalLink.replace('link', 'save_line');
    let login = globalLink.replace('link', 'login');

    $.ajax({
        url: url,
        method: 'post',
        data: frmSaveLine.serialize(),
        dataType: 'json',
        beforeSend() {
            btnSaveLine.prop('disabled', true);
            btnSaveLine.html('Saving...');
            $(".input-error", frmSaveLine).text('');
            $(".form-control", frmSaveLine).removeClass('is-invalid');
            cnfrmLoading.open();
        },
        success(data){
            btnSaveLine.prop('disabled', false);
            btnSaveLine.html('Save');
            cnfrmLoading.close();
            $("input[name='description']", frmSaveLine).focus();

            if(data['auth'] == 1){
                if(data['result'] == 1){
                    toastr.success('Record Saved!');
                    frmSaveLine[0].reset();
                    $(".input-error", frmSaveLine).text('');
                    $(".form-control", frmSaveLine).removeClass('is-invalid');
                    dtLines.draw();
                    $('input[name="product_line_id"]', frmSaveLine).val($(".txtSelectedProdLineId").val());
                }
                else{
                    toastr.error('Saving Failed!');
                    if(data['error'] != null){
                        if(data['error']['description'] != null){
                            $("input[name='description']", frmSaveLine).addClass('is-invalid');
                            $("input[name='description']", frmSaveLine).siblings('.input-error').text(data['error']['description']);
                        }
                        else{
                            $("input[name='description']", frmSaveLine).removeClass('is-invalid');
                            $("input[name='description']", frmSaveLine).siblings('.input-error').text('');
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
            btnSaveLine.prop('disabled', false);
            btnSaveLine.html('Save');
            toastr.error('Saving Failed!');
        }
    });
}

function GetLineById(lineId){
    let url = globalLink.replace('link', 'get_line_by_id');
    let login = globalLink.replace('link', 'login');

    $.ajax({
        url: url,
        method: 'get',
        data: {
            line_id: lineId
        },
        dataType: 'json',
        beforeSend() {
            btnSaveLine.prop('disabled', true);
            btnSaveLine.html('Saving...');
            $(".input-error", frmSaveLine).text('');
            $(".form-control", frmSaveLine).removeClass('is-invalid');
            cnfrmLoading.open();
            frmSaveLine[0].reset();
            $('input[name="line_id"]', frmSaveLine).val('');
        },
        success(data){
            btnSaveLine.prop('disabled', false);
            btnSaveLine.html('Save');
            cnfrmLoading.close();
            $("input[name='description']", frmSaveLine).focus();

            if(data['auth'] == 1){
                if(data['line_info'] != null){
                    $("#mdlSaveLine").modal('show');
                    $('input[name="line_id"]', frmSaveLine).val(data['line_info']['id']);
                    $('input[name="description"]', frmSaveLine).val(data['line_info']['description']);
                    $('input[name="product_line_id"]', frmSaveLine).val(data['line_info']['product_line_id']);
                }
                else{
                    toastr.error('No record found.');
                }
            }
            else{ // if session expired
                cnfrmAutoLogin.open();
            }
        },
        error(xhr, data, status){
            cnfrmLoading.close();
            btnSaveLine.prop('disabled', false);
            btnSaveLine.html('Save');
            toastr.error('An error occured!');
        }
    });
}

function LineAction(lineId, action, status){
    let url = globalLink.replace('link', 'line_action');
    let login = globalLink.replace('link', 'login');

    $.ajax({
        url: url,
        method: 'post',
        data: {
            _token: _token,
            line_id: lineId,
            action: action,
            status: status,
        },
        dataType: 'json',
        beforeSend() {
            cnfrmLoading.open();
        },
        success(data){
            cnfrmLoading.close();
            dtLines.draw();

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