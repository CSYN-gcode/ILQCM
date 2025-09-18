// VARIABLES

// FUNCTIONS
// Save Machine
function SaveMachine(){
    let url = globalLink.replace('link', 'save_machine');
    let login = globalLink.replace('link', 'login');

    $.ajax({
        url: url,
        method: 'post',
        data: frmSaveMachine.serialize(),
        dataType: 'json',
        beforeSend() {
            btnSaveMachine.prop('disabled', true);
            btnSaveMachine.html('Saving...');
            $(".input-error", frmSaveMachine).text('');
            $(".form-control", frmSaveMachine).removeClass('is-invalid');
            cnfrmLoading.open();
        },
        success(data){
            btnSaveMachine.prop('disabled', false);
            btnSaveMachine.html('Save');
            cnfrmLoading.close();
            $("input[name='description']", frmSaveMachine).focus();

            if(data['auth'] == 1){
                if(data['result'] == 1){
                    toastr.success('Record Saved!');
                    frmSaveMachine[0].reset();
                    $(".input-error", frmSaveMachine).text('');
                    $(".form-control", frmSaveMachine).removeClass('is-invalid');
                    dtMachines.draw();
                }
                else{
                    toastr.error('Saving Failed!');
                    if(data['error'] != null){
                        if(data['error']['description'] != null){
                            $("input[name='description']", frmSaveMachine).addClass('is-invalid');
                            $("input[name='description']", frmSaveMachine).siblings('.input-error').text(data['error']['description']);
                        }
                        else{
                            $("input[name='description']", frmSaveMachine).removeClass('is-invalid');
                            $("input[name='description']", frmSaveMachine).siblings('.input-error').text('');
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
            btnSaveMachine.prop('disabled', false);
            btnSaveMachine.html('Save');
            toastr.error('Saving Failed!');
        }
    });
}

function GetMachineById(machineId){
    let url = globalLink.replace('link', 'get_machine_by_id');
    let login = globalLink.replace('link', 'login');

    $.ajax({
        url: url,
        method: 'get',
        data: {
            machine_id: machineId
        },
        dataType: 'json',
        beforeSend() {
            btnSaveMachine.prop('disabled', true);
            btnSaveMachine.html('Saving...');
            $(".input-error", frmSaveMachine).text('');
            $(".form-control", frmSaveMachine).removeClass('is-invalid');
            cnfrmLoading.open();
            frmSaveMachine[0].reset();
            $('input[name="machine_id"]', frmSaveMachine).val('');
        },
        success(data){
            btnSaveMachine.prop('disabled', false);
            btnSaveMachine.html('Save');
            cnfrmLoading.close();
            $("input[name='description']", frmSaveMachine).focus();

            if(data['auth'] == 1){
                if(data['machine_info'] != null){
                    $("#mdlSaveMachine").modal('show');
                    $('input[name="machine_id"]', frmSaveMachine).val(data['machine_info']['id']);
                    $('input[name="description"]', frmSaveMachine).val(data['machine_info']['description']);
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
            btnSaveMachine.prop('disabled', false);
            btnSaveMachine.html('Save');
            toastr.error('An error occured!');
        }
    });
}

function MachineAction(machineId, action, status){
    let url = globalLink.replace('link', 'machine_action');
    let login = globalLink.replace('link', 'login');

    $.ajax({
        url: url,
        method: 'post',
        data: {
            _token: _token,
            machine_id: machineId,
            action: action,
            status: status,
        },
        dataType: 'json',
        beforeSend() {
            cnfrmLoading.open();
        },
        success(data){
            cnfrmLoading.close();
            dtMachines.draw();

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