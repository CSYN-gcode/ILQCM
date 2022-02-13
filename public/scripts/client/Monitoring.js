// VARIABLES

// FUNCTIONS
// Save Monitoring
function SaveMonitoring(){
    let url = globalLink.replace('link', 'save_monitoring');
    let login = globalLink.replace('link', 'login');

    $.ajax({
        url: url,
        method: 'post',
        data: frmSaveMonitoring.serialize(),
        dataType: 'json',
        beforeSend() {
            btnSaveMonitoring.prop('disabled', true);
            btnSaveMonitoring.html('Saving...');
            $(".input-error", frmSaveMonitoring).text('');
            $(".form-control", frmSaveMonitoring).removeClass('is-invalid');
            cnfrmLoading.open();
        },
        success(data){
            btnSaveMonitoring.prop('disabled', false);
            btnSaveMonitoring.html('Save');
            cnfrmLoading.close();
            $("input[name='description']", frmSaveMonitoring).focus();

            if(data['auth'] == 1){
                if(data['result'] == 1){
                    toastr.success('Record Saved!');
                    frmSaveMonitoring[0].reset();
                    $(".input-error", frmSaveMonitoring).text('');
                    $(".form-control", frmSaveMonitoring).removeClass('is-invalid');
                    dtMonitorings.draw();
                }
                else{
                    toastr.error('Saving Failed!');
                    if(data['error'] != null){
                        if(data['error']['description'] != null){
                            $("input[name='description']", frmSaveMonitoring).addClass('is-invalid');
                            $("input[name='description']", frmSaveMonitoring).siblings('.input-error').text(data['error']['description']);
                        }
                        else{
                            $("input[name='description']", frmSaveMonitoring).removeClass('is-invalid');
                            $("input[name='description']", frmSaveMonitoring).siblings('.input-error').text('');
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
            btnSaveMonitoring.prop('disabled', false);
            btnSaveMonitoring.html('Save');
            toastr.error('Saving Failed!');
        }
    });
}

function GetMonitoringById(monitoringId){
    let url = globalLink.replace('link', 'get_monitoring_by_id');
    let login = globalLink.replace('link', 'login');

    $.ajax({
        url: url,
        method: 'get',
        data: {
            monitoring_id: monitoringId
        },
        dataType: 'json',
        beforeSend() {
            btnSaveMonitoring.prop('disabled', true);
            btnSaveMonitoring.html('Saving...');
            $(".input-error", frmSaveMonitoring).text('');
            $(".form-control", frmSaveMonitoring).removeClass('is-invalid');
            cnfrmLoading.open();
            frmSaveMonitoring[0].reset();
            $('input[name="monitoring_id"]', frmSaveMonitoring).val('');
        },
        success(data){
            btnSaveMonitoring.prop('disabled', false);
            btnSaveMonitoring.html('Save');
            cnfrmLoading.close();
            $("input[name='description']", frmSaveMonitoring).focus();

            if(data['auth'] == 1){
                if(data['monitoring_info'] != null){
                    $("#mdlSaveMonitoring").modal('show');
                    $('input[name="monitoring_id"]', frmSaveMonitoring).val(data['monitoring_info']['id']);
                    $('input[name="description"]', frmSaveMonitoring).val(data['monitoring_info']['description']);
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
            btnSaveMonitoring.prop('disabled', false);
            btnSaveMonitoring.html('Save');
            toastr.error('An error occured!');
        }
    });
}

function MonitoringAction(monitoringId, action, status){
    let url = globalLink.replace('link', 'monitoring_action');
    let login = globalLink.replace('link', 'login');

    $.ajax({
        url: url,
        method: 'post',
        data: {
            _token: _token,
            monitoring_id: monitoringId,
            action: action,
            status: status,
        },
        dataType: 'json',
        beforeSend() {
            cnfrmLoading.open();
        },
        success(data){
            cnfrmLoading.close();
            dtMonitorings.draw();

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