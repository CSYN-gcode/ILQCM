// VARIABLES

// FUNCTIONS
// Save ProductLine
function SaveProductLine(){
    let url = globalLink.replace('link', 'save_product_line');
    let login = globalLink.replace('link', 'login');

    $.ajax({
        url: url,
        method: 'post',
        data: frmSaveProductLine.serialize(),
        dataType: 'json',
        beforeSend() {
            btnSaveProductLine.prop('disabled', true);
            btnSaveProductLine.html('Saving...');
            $(".input-error", frmSaveProductLine).text('');
            $(".form-control", frmSaveProductLine).removeClass('is-invalid');
            cnfrmLoading.open();
        },
        success(data){
            btnSaveProductLine.prop('disabled', false);
            btnSaveProductLine.html('Save');
            cnfrmLoading.close();
            $("input[name='description']", frmSaveProductLine).focus();

            if(data['auth'] == 1){
                if(data['result'] == 1){
                    toastr.success('Record Saved!');
                    frmSaveProductLine[0].reset();
                    $(".input-error", frmSaveProductLine).text('');
                    $(".form-control", frmSaveProductLine).removeClass('is-invalid');
                    dtProductLines.draw();
                }
                else{
                    toastr.error('Saving Failed!');
                    if(data['error'] != null){
                        if(data['error']['family'] != null){
                            $("select[name='family']", frmSaveProductLine).addClass('is-invalid');
                            $("select[name='family']", frmSaveProductLine).siblings('.input-error').text(data['error']['family']);
                        }
                        else{
                            $("select[name='family']", frmSaveProductLine).removeClass('is-invalid');
                            $("select[name='family']", frmSaveProductLine).siblings('.input-error').text('');
                        }

                        if(data['error']['description'] != null){
                            $("input[name='description']", frmSaveProductLine).addClass('is-invalid');
                            $("input[name='description']", frmSaveProductLine).siblings('.input-error').text(data['error']['description']);
                        }
                        else{
                            $("input[name='description']", frmSaveProductLine).removeClass('is-invalid');
                            $("input[name='description']", frmSaveProductLine).siblings('.input-error').text('');
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
            btnSaveProductLine.prop('disabled', false);
            btnSaveProductLine.html('Save');
            toastr.error('Saving Failed!');
        }
    });
}

function GetProductLineById(productLineId){
    let url = globalLink.replace('link', 'get_product_line_by_id');
    let login = globalLink.replace('link', 'login');

    $.ajax({
        url: url,
        method: 'get',
        data: {
            product_line_id: productLineId
        },
        dataType: 'json',
        beforeSend() {
            btnSaveProductLine.prop('disabled', true);
            btnSaveProductLine.html('Saving...');
            $(".input-error", frmSaveProductLine).text('');
            $(".form-control", frmSaveProductLine).removeClass('is-invalid');
            cnfrmLoading.open();
            frmSaveProductLine[0].reset();
            $('input[name="product_line_id"]', frmSaveProductLine).val('');
        },
        success(data){
            btnSaveProductLine.prop('disabled', false);
            btnSaveProductLine.html('Save');
            cnfrmLoading.close();
            $("input[name='description']", frmSaveProductLine).focus();

            if(data['auth'] == 1){
                if(data['product_line_info'] != null){
                    $("#mdlSaveProductLine").modal('show');
                    $('input[name="product_line_id"]', frmSaveProductLine).val(data['product_line_info']['id']);
                    $('select[name="family"]', frmSaveProductLine).val(data['product_line_info']['family']);
                    $('input[name="description"]', frmSaveProductLine).val(data['product_line_info']['description']);
                }else{
                    toastr.error('No record found.');
                }

                GetFamilyName($("#selFamily"), data['product_line_info']['family']);
            }else{ // if session expired
                cnfrmAutoLogin.open();
            }
        },
        error(xhr, data, status){
            cnfrmLoading.close();
            btnSaveProductLine.prop('disabled', false);
            btnSaveProductLine.html('Save');
            toastr.error('An error occured!');
        }
    });
}

function ProductLineAction(productLineId, action, status){
    let url = globalLink.replace('link', 'product_line_action');
    let login = globalLink.replace('link', 'login');

    $.ajax({
        url: url,
        method: 'post',
        data: {
            _token: _token,
            product_line_id: productLineId,
            action: action,
            status: status,
        },
        dataType: 'json',
        beforeSend() {
            cnfrmLoading.open();
        },
        success(data){
            cnfrmLoading.close();
            dtProductLines.draw();

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
