// VARIABLES

// FUNCTIONS
// Save Series
function SaveStrategicPo(){
    let url = globalLink.replace('link', 'save_strategic_po');
    let login = globalLink.replace('link', 'login');

    $.ajax({
        url: url,
        method: 'post',
        data: frmSaveStrategicPo.serialize(),
        dataType: 'json',
        beforeSend() {
            btnSaveStrategicPo.prop('disabled', true);
            btnSaveStrategicPo.html('Saving...');
            $(".input-error", frmSaveStrategicPo).text('');
            $(".form-control", frmSaveStrategicPo).removeClass('is-invalid');
            cnfrmLoading.open();
        },
        success(data){
            btnSaveStrategicPo.prop('disabled', false);
            btnSaveStrategicPo.html('Save');
            cnfrmLoading.close();
            $("input[name='description']", frmSaveStrategicPo).focus();

            if(data['auth'] == 1){
                if(data['result'] == 1){
                    toastr.success('Record Saved!');
                    frmSaveStrategicPo[0].reset();
                    $(".input-error", frmSaveStrategicPo).text('');
                    $(".form-control", frmSaveStrategicPo).removeClass('is-invalid');
                    dtStrategicPo.draw();
                    $("#mdlSaveStrategicPo").modal('hide');
                }
                else{
                    toastr.error('Saving Failed!');
                    if(data['error'] != null){
                        if(data['error']['series_name'] != null){
                            $("input[name='series_name']", frmSaveStrategicPo).addClass('is-invalid');
                            $("input[name='series_name']", frmSaveStrategicPo).siblings('.input-error').text(data['error']['series_name']);
                        }
                        else{
                            $("input[name='series_name']", frmSaveStrategicPo).removeClass('is-invalid');
                            $("input[name='series_name']", frmSaveStrategicPo).siblings('.input-error').text('');
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
            btnSaveStrategicPo.prop('disabled', false);
            btnSaveStrategicPo.html('Save');
            toastr.error('Saving Failed!');
        }
    });
}

function GetStrategicPoById(strat_po_id){
    let url = globalLink.replace('link', 'get_strategic_po_by_id');
    let login = globalLink.replace('link', 'login');

    $.ajax({
        url: url,
        method: 'get',
        data: {
            id: strat_po_id
        },
        dataType: 'json',
        beforeSend() {
            btnSaveStrategicPo.prop('disabled', true);
            btnSaveStrategicPo.html('Saving...');
            $(".input-error", frmSaveStrategicPo).text('');
            $(".form-control", frmSaveStrategicPo).removeClass('is-invalid');
            cnfrmLoading.open();
            frmSaveStrategicPo[0].reset();
            $('input[name="series_id"]', frmSaveStrategicPo).val('');
        },
        success(data){
            btnSaveStrategicPo.prop('disabled', false);
            btnSaveStrategicPo.html('Save');
            cnfrmLoading.close();
            // $("input[name='description']", frmSaveStrategicPo).focus();

            if(data['auth'] == 1){
                if(data['strategic_po_info'] != null){
                    $("#mdlSaveStrategicPo").modal('show');
                    $('input[name="id"]', frmSaveStrategicPo).val(data['strategic_po_info']['id']);
                    $('input[name="po_number"]', frmSaveStrategicPo).val(data['strategic_po_info']['po_number']);
                    // $('input[name="series_name"]', frmSaveStrategicPo).val(data['strategic_po_info']['series_name']);

                    let seriesDetails = '';
                    if(data['strategic_po_info']['series_name'] != null){
                        seriesDetails += '<option value="' + data['strategic_po_info']['series_name'] + '">' + data['strategic_po_info']['series_description'] + '</option>';

                        $("select[name='series_name']", frmSaveStrategicPo).append(seriesDetails);
                        $("select[name='series_name']", frmSaveStrategicPo).val(data['strategic_po_info']['series_name']).trigger("change");
                    }
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
            btnSaveStrategicPo.prop('disabled', false);
            btnSaveStrategicPo.html('Save');
            toastr.error('An error occured!');
        }
    });
}

function StrategicAction(strat_po_id, action, status){
    let url = globalLink.replace('link', 'strategic_action');
    let login = globalLink.replace('link', 'login');

    $.ajax({
        url: url,
        method: 'post',
        data: {
            _token: _token,
            id: strat_po_id,
            action: action,
            status: status,
        },
        dataType: 'json',
        beforeSend() {
            cnfrmLoading.open();
        },
        success(data){
            cnfrmLoading.close();
            dtStrategicPo.draw();

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
