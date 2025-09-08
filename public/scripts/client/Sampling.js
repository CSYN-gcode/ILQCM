// VARIABLES
function SaveMultipleSamplingResult(multiSelectArrayValues){
    let url = globalLink.replace('link', 'save_multiple_sampling_result');
    let login = globalLink.replace('link', 'login');
    let formData = new FormData(frmSaveMultipleSamplingResult[0]);
        formData.append('multi_select_sampling_id', multiSelectArrayValues);

    $.ajax({
        url: url,
        method: 'post',
        data: formData,
        processData: false,
        contentType: false,
        dataType: 'json',
        beforeSend() {
            cnfrmLoading.open();
        },
        success(data){
            cnfrmLoading.close();
            if(data['auth'] == 1){
                if(data['result'] == 1){
                    $("#mdlSaveMultipleSamplingResult").modal('hide');
                    toastr.success('Record Saved!');
                    frmSaveMultipleSamplingResult[0].reset();
                    $(".input-error", frmSaveMultipleSamplingResult).text('');
                    $(".form-control", frmSaveMultipleSamplingResult).removeClass('is-invalid');
                    dtSamplingsPending.draw();
                    dtSamplingsOk.draw();
                    dtSamplingsNg.draw();
                    dtSamplingsNoProdNoMonitoring.draw();
                    btnSaveMultipleSamplingResult.addClass('d-none');
                }else{
                    toastr.error('Saving Failed!');
                    if(data['error'] != null){
                        if(data['error']['validation_result'] != null){
                            $("select[name='validation_result']", frmSaveMultipleSamplingResult).addClass('is-invalid');
                            $("select[name='validation_result']", frmSaveMultipleSamplingResult).siblings('.input-error').text(data['error']['validation_result']);
                        }
                        else{
                            $("select[name='validation_result']", frmSaveMultipleSamplingResult).removeClass('is-invalid');
                            $("select[name='validation_result']", frmSaveMultipleSamplingResult).siblings('.input-error').text('');
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
            btnSaveMultipleSamplingResult.prop('disabled', false);
            btnSaveMultipleSamplingResult.html('Save');
            toastr.error('Saving Failed!');
        }
    });
}

function SaveSampling(){
    let url = globalLink.replace('link', 'save_sampling');
    let login = globalLink.replace('link', 'login');

    $.ajax({
        url: url,
        method: 'post',
        data: frmSaveSampling.serialize(),
        dataType: 'json',
        beforeSend() {
            btnSaveSampling.prop('disabled', true);
            btnSaveSampling.html('Saving...');
            $(".input-error", frmSaveSampling).text('');
            $(".form-control", frmSaveSampling).removeClass('is-invalid');
            cnfrmLoading.open();
        },
        success(data){
            btnSaveSampling.prop('disabled', false);
            btnSaveSampling.html('Save');
            cnfrmLoading.close();
            $("input[name='description']", frmSaveSampling).focus();

            if(data['auth'] == 1){
                if(data['result'] == 1){
                    $("#mdlSaveSampling").modal('hide');
                    toastr.success('Record Saved!');
                    frmSaveSampling[0].reset();
                    $('.form-sampling').show();
                    $(".input-error", frmSaveSampling).text('');
                    $(".form-control", frmSaveSampling).removeClass('is-invalid');
                    dtSamplingsPending.draw();
                    dtSamplingsOk.draw();
                    dtSamplingsNg.draw();
                    dtSamplingsNoProdNoMonitoring.draw();
                }
                else{
                    toastr.error('Saving Failed!');
                    if(data['error'] != null){
                        if(data['error']['station_id'] != null){
                            $("select[name='station_id']", frmSaveSampling).addClass('is-invalid');
                            $("select[name='station_id']", frmSaveSampling).siblings('.input-error').text(data['error']['station_id']);
                        }
                        else{
                            $("select[name='station_id']", frmSaveSampling).removeClass('is-invalid');
                            $("select[name='station_id']", frmSaveSampling).siblings('.input-error').text('');
                        }

                        if(data['error']['operator'] != null){
                            $("input[name='operator_name']", frmSaveSampling).addClass('is-invalid');
                            $("input[name='operator']", frmSaveSampling).siblings('.input-error').text(data['error']['operator']);
                        }
                        else{
                            $("input[name='operator_name']", frmSaveSampling).removeClass('is-invalid');
                            $("input[name='operator']", frmSaveSampling).siblings('.input-error').text('');
                        }

                        if(data['error']['po_no'] != null){
                            $("input[name='po_no']", frmSaveSampling).addClass('is-invalid');
                            $("input[name='po_no']", frmSaveSampling).siblings('.input-error').text(data['error']['po_no']);
                        }
                        else{
                            $("input[name='po_no']", frmSaveSampling).removeClass('is-invalid');
                            $("input[name='po_no']", frmSaveSampling).siblings('.input-error').text('');
                        }

                        if(data['error']['series'] != null){
                            $("input[name='series']", frmSaveSampling).addClass('is-invalid');
                            $("input[name='series']", frmSaveSampling).siblings('.input-error').text(data['error']['series']);
                        }
                        else{
                            $("input[name='series']", frmSaveSampling).removeClass('is-invalid');
                            $("input[name='series']", frmSaveSampling).siblings('.input-error').text('');
                        }

                        if(data['error']['sample_size'] != null){
                            $("input[name='sample_size']", frmSaveSampling).addClass('is-invalid');
                            $("input[name='sample_size']", frmSaveSampling).siblings('.input-error').text(data['error']['sample_size']);
                        }
                        else{
                            $("input[name='sample_size']", frmSaveSampling).removeClass('is-invalid');
                            $("input[name='sample_size']", frmSaveSampling).siblings('.input-error').text('');
                        }

                        if(data['error']['accept'] != null){
                            $("input[name='accept']", frmSaveSampling).addClass('is-invalid');
                            $("input[name='accept']", frmSaveSampling).siblings('.input-error').text(data['error']['accept']);
                        }
                        else{
                            $("input[name='accept']", frmSaveSampling).removeClass('is-invalid');
                            $("input[name='accept']", frmSaveSampling).siblings('.input-error').text('');
                        }

                        if(data['error']['reject'] != null){
                            $("input[name='reject']", frmSaveSampling).addClass('is-invalid');
                            $("input[name='reject']", frmSaveSampling).siblings('.input-error').text(data['error']['reject']);
                        }
                        else{
                            $("input[name='reject']", frmSaveSampling).removeClass('is-invalid');
                            $("input[name='reject']", frmSaveSampling).siblings('.input-error').text('');
                        }

                        if(data['error']['result'] != null){
                            $("input[name='result']", frmSaveSampling).addClass('is-invalid');
                            $("input[name='result']", frmSaveSampling).siblings('.input-error').text(data['error']['result']);
                        }
                        else{
                            $("input[name='result']", frmSaveSampling).removeClass('is-invalid');
                            $("input[name='result']", frmSaveSampling).siblings('.input-error').text('');
                        }

                        if(data['error']['dppm'] != null){
                            $("input[name='dppm']", frmSaveSampling).addClass('is-invalid');
                            $("input[name='dppm']", frmSaveSampling).siblings('.input-error').text(data['error']['dppm']);
                        }
                        else{
                            $("input[name='dppm']", frmSaveSampling).removeClass('is-invalid');
                            $("input[name='dppm']", frmSaveSampling).siblings('.input-error').text('');
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
            btnSaveSampling.prop('disabled', false);
            btnSaveSampling.html('Save');
            toastr.error('Saving Failed!');
        }
    });
}

function GetSamplingById(samplingId){
    let url = globalLink.replace('link', 'get_sampling_by_id');
    let login = globalLink.replace('link', 'login');

    $.ajax({
        url: url,
        method: 'get',
        data: {
            sampling_id: samplingId
        },
        dataType: 'json',
        beforeSend() {
            btnSaveSampling.prop('disabled', true);
            btnSaveSampling.html('Saving...');
            $(".input-error", frmSaveSampling).text('');
            $(".form-control", frmSaveSampling).removeClass('is-invalid');
            cnfrmLoading.open();
            frmSaveSampling[0].reset();
            $('input[name="sampling_id"]', frmSaveSampling).val('');
        },
        success(data){
            btnSaveSampling.prop('disabled', false);
            btnSaveSampling.html('Save');
            cnfrmLoading.close();
            $("input[name='description']", frmSaveSampling).focus();

            if(data['auth'] == 1){
                if(data['sampling_info'] != null){
                    $("#mdlSaveSampling").modal('show');
                    $('select[name="station_id"]', frmSaveSampling).html('').val('').trigger("change");
                    $('select[name="station_id"]', frmSaveSampling).append('<option value="' + data['sampling_info']['station_id'] + '">' + data['sampling_info']['s_description'] + '</option>').val(data['sampling_info']['station_id']).trigger("change");
                    $('input[name="monitoring_id"]', frmSaveSampling).val(data['sampling_info']['monitoring_id']);
                    $('input[name="sampling_id"]', frmSaveSampling).val(data['sampling_info']['id']);
                    $('input[name="operator"]', frmSaveSampling).val(data['sampling_info']['operator']);
                    $('input[name="operator_name"]', frmSaveSampling).val(data['sampling_info']['operator_name'] +  " (" + data['sampling_info']['operator_employee_id'] + ")");
                    $('input[name="po_no"]', frmSaveSampling).val(data['sampling_info']['po_no']);
                    $('input[name="series"]', frmSaveSampling).val(data['sampling_info']['series']);
                    $('input[name="sample_size"]', frmSaveSampling).val(data['sampling_info']['sample_size']);
                    $('input[name="reject"]', frmSaveSampling).val(data['sampling_info']['reject']);
                    $('input[name="accept"]', frmSaveSampling).val(data['sampling_info']['accept']);
                    $('input[name="result"]', frmSaveSampling).val(data['sampling_info']['result']);
                    $('input[name="dppm"]', frmSaveSampling).val(data['sampling_info']['dppm']);
                    $('select[name="remarks"]', frmSaveSampling).val(data['sampling_info']['remarks']);
                    $('select[name="validation_result"]', frmSaveSampling).val(data['sampling_info']['validation_result']);
                    $('select[name="sampling_type"]', frmSaveSampling).val(data['sampling_info']['sampling_type']);
                    // $('input[name="description"]', frmSaveSampling).val(data['sampling_info']['description']);

                    if(data['sampling_info']['sampling_type'] == "0"){
                        $('.btnSearchPoNo').prop('disabled', false);
                        $('input[name="po_no"]', frmSaveSampling).prop('readonly', true).prop('placeholder', '(Click the button to fill-in)');
                        $('input[name="series"]', frmSaveSampling).prop('readonly', true).prop('placeholder', '(Click the button to fill-in)');
                      }
                      else{
                        $('.btnSearchPoNo').prop('disabled', true);
                        $('input[name="po_no"]', frmSaveSampling).removeAttr('readonly').prop('placeholder', 'Type here...');
                        $('input[name="series"]', frmSaveSampling).removeAttr('readonly').prop('placeholder', 'Type here...');
                      }

                    if(data['sampling_info']['remarks'] == "NO PRODUCTION" || data['sampling_info']['remarks'] == "NO MONITORING STATION"){
                        $('.form-sampling').hide();
                    }
                    else{
                        $('.form-sampling').show();
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
            btnSaveSampling.prop('disabled', false);
            btnSaveSampling.html('Save');
            toastr.error('An error occured!');
        }
    });
}

function SamplingAction(samplingId, action, status){
    let url = globalLink.replace('link', 'sampling_action');
    let login = globalLink.replace('link', 'login');

    $.ajax({
        url: url,
        method: 'post',
        data: {
            _token: _token,
            sampling_id: samplingId,
            action: action,
            status: status,
        },
        dataType: 'json',
        beforeSend() {
            cnfrmLoading.open();
        },
        success(data){
            cnfrmLoading.close();
            dtSamplings.draw();

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

function AddNoProduction(noProductionDate, monitoringId){
    let url = globalLink.replace('link', 'add_no_production');
    let login = globalLink.replace('link', 'login');

    $.ajax({
        url: url,
        method: 'post',
        data: {
            _token: _token,
            no_production_date: noProductionDate,
            monitoring_id: monitoringId,
        },
        dataType: 'json',
        beforeSend() {
            cnfrmLoading.open();
        },
        success(data){
            cnfrmLoading.close();
            dtSamplings.draw();

            if(data['auth'] == 1){
                if(data['result'] == 1){
                    toastr.success('Record Saved!', 'Record Saved!', {timeOut: 3000, preventDuplicates: true});
                    location.reload();
                }
                else if(data['result'] == 2){
                    toastr.warning('No Production Already Exist!');
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

function GetPODetails(po_no){
    let url = globalLink.replace('link', 'get_po_details');
    let login = globalLink.replace('link', 'login');

    $.ajax({
        url: url,
        method: 'get',
        data: {
            po_no: po_no
        },
        dataType: 'json',
        beforeSend() {
            cnfrmLoading.open();
            $('input[name="po_no"]', frmSaveSampling).val('');
            $('input[name="series"]', frmSaveSampling).val('');
        },
        success(data){
            cnfrmLoading.close();
            if(data['auth'] == 1){
                if(data['data'] != null){
                    $("#mdlSaveSampling").modal('show');
                    toastr.success('Record found.');
                    if(data['result'] == 1){
                        $('input[name="po_no"]', frmSaveSampling).val(data['data']['po_no']);
                        $('input[name="series"]', frmSaveSampling).val(data['data']['device_name']);
                    }else if(data['result'] == 2){
                        $('input[name="po_no"]', frmSaveSampling).val(data['data']['po_number']);
                        $('input[name="series"]', frmSaveSampling).val(data['data']['series_description']);
                    }
                }else{
                    toastr.warning('No record found.');
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

function GetOperatorDetails(employee_id, station_id){
    let url = globalLink.replace('link', 'get_operator_details');
    let login = globalLink.replace('link', 'login');

    // if(station_id === null){
    //     toastr.warning('Please select station first.');
    //     return;
    // }

    if(employee_id === null){
        toastr.warning('Employee ID is required.');
        return;
    }

    $.ajax({
        url: url,
        method: 'get',
        data: {
            employee_id: employee_id,
            station_id: station_id
        },
        dataType: 'json',
        beforeSend() {
            cnfrmLoading.open();
            $('input[name="operator"]', frmSaveSampling).val('');
            $('input[name="operator_name"]', frmSaveSampling).val('');
        },
        success(data){
            cnfrmLoading.close();
            if(data['auth'] == 1){
                if(data['data'] != null){
                    $("#mdlSaveSampling").modal('show');
                    if(station_id != null){
                        if(data['data']['user_station_details'].length > 0){
                            $('input[name="operator"]', frmSaveSampling).val(data['data']['id']);
                            $('input[name="operator_name"]', frmSaveSampling).val(data['data']['name'] + " (" + data['data']['employee_id'] + ")");
                            toastr.success('Record found.');
                        }
                        else{
                            toastr.warning('Operator is not certified.');
                        }
                    }
                    else{
                        $('input[name="operator"]', frmSaveSampling).val(data['data']['id']);
                        $('input[name="operator_name"]', frmSaveSampling).val(data['data']['name'] + " (" + data['data']['employee_id'] + ")");
                        toastr.success('Record found.');
                    }
                }
                else{
                    toastr.warning('Invalid Employee ID.');
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
