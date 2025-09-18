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
                    $('input[name="monitoring_id"]', frmSaveMonitoring).val('');
                    $('select[name="machine_id"]', frmSaveMonitoring).html('').val('').trigger("change");
                    $('select[name="qc_inspector"]', frmSaveMonitoring).html('').val('').trigger("change");
                    $('select[name="qc_checked_by"]', frmSaveMonitoring).html('').val('').trigger("change");
                }
                else if(data['result'] == 2){
                    toastr.warning('Record Already Exist!');
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
    let cboLineByProdLine = globalLink.replace('link', 'get_cbo_line_by_product_line');

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
            $('select[name="line_id"]', frmSaveMonitoring).html('').val('').trigger("change");
            $('select[name="machine_id"]', frmSaveMonitoring).html('').val('').trigger("change");
            $('select[name="qc_inspector"]', frmSaveMonitoring).html('').val('').trigger("change");
            $('select[name="qc_checked_by"]', frmSaveMonitoring).html('').val('').trigger("change");
            $("input[name='work_week']", frmSaveMonitoring).prop('readonly', true);
            // $("input[name='work_week']", frmSaveMonitoring).prop('readonly', false); //Clark Comment 01/02/2024
        },
        success(data){
            btnSaveMonitoring.prop('disabled', false);
            btnSaveMonitoring.html('Save');
            cnfrmLoading.close();

            $("input[name='description']", frmSaveMonitoring).focus();

            if(data['auth'] == 1){
                if(data['monitoring_info'] != null){
                    $("#mdlSaveMonitoring").modal('show');
                    $('input[name="monitoring_id"]', frmSaveMonitoring).val(data['monitoring_info']['m_id']);
                    $('input[name="product_line_id"]', frmSaveMonitoring).val(data['monitoring_info']['m_product_line_id']);
                    $('input[name="work_week"]', frmSaveMonitoring).val(data['monitoring_info']['work_week']);
                    $('input[name="date_from"]', frmSaveMonitoring).val(data['monitoring_info']['m_date_from']);
                    $('input[name="date_to"]', frmSaveMonitoring).val(data['monitoring_info']['m_date_to']);
                    $('select[name="shift"]', frmSaveMonitoring).val(data['monitoring_info']['shift']);
                    $('select[name="line_id"]', frmSaveMonitoring).select2({
                      placeholder: "",
                      minimumInputLength: 2,
                      allowClear: true,
                      ajax: {
                         url: cboLineByProdLine,
                         type: "get",
                         dataType: 'json',
                         delay: 250,
                         // quietMillis: 100,
                         data: function (params) {
                          return {
                            search: params.term, // search term
                            product_line_id: $('input[name="product_line_id"]', frmSaveMonitoring).val(),
                          };
                         },
                         processResults: function (response) {
                           return {
                              results: response
                           };
                         },
                         cache: true
                      },
                    });

                    if(data['monitoring_info']['line_id'] != null){
                        $('select[name="line_id"]', frmSaveMonitoring).html('').val('').trigger("change");
                        $('select[name="line_id"]', frmSaveMonitoring).append('<option value="' + data['monitoring_info']['line_id'] + '">' + data['monitoring_info']['l_description'] + '</option>').val(data['monitoring_info']['line_id']).trigger("change");
                    }

                    if(data['monitoring_info']['machine_id'] != null){
                        $('select[name="machine_id"]', frmSaveMonitoring).html('').val('').trigger("change");
                        $('select[name="machine_id"]', frmSaveMonitoring).append('<option value="' + data['monitoring_info']['machine_id'] + '">' + data['monitoring_info']['m_description'] + '</option>').val(data['monitoring_info']['machine_id']).trigger("change");
                    }

                    if(data['monitoring_info']['qc_inspector'] != null){
                        $('select[name="qc_inspector"]', frmSaveMonitoring).html('').val('').trigger("change");
                        $('select[name="qc_inspector"]', frmSaveMonitoring).append('<option value="' + data['monitoring_info']['qc_inspector'] + '">' + data['monitoring_info']['uqi_name'] + ' (' + data['monitoring_info']['uqi_employee_id'] + ')' + '</option>').val(data['monitoring_info']['qc_inspector']).trigger("change");
                    }

                    if(data['monitoring_info']['qc_checked_by'] != null){
                        $('select[name="qc_checked_by"]', frmSaveMonitoring).html('').val('').trigger("change");
                        $('select[name="qc_checked_by"]', frmSaveMonitoring).append('<option value="' + data['monitoring_info']['qc_checked_by'] + '">' + data['monitoring_info']['qcb_name'] + ' (' + data['monitoring_info']['qcb_employee_id'] + ')' + '</option>').val(data['monitoring_info']['qc_checked_by']).trigger("change");
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

// function SaveDLACheckItems(monitoringId, dlaCheckItems){ //nmodify
//     let url = globalLink.replace('link', 'save_dla_check_items');
//     let login = globalLink.replace('link', 'login');

//     $.ajax({
//         url: url,
//         method: 'post',
//         data: {
//             _token: _token,
//             monitoring_id: monitoringId,
//             dla_check_items: dlaCheckItems,
//         },
//         // data: data,
//         dataType: 'json',
//         beforeSend() {
//             cnfrmLoading.open();
//         },
//         success(data){
//             cnfrmLoading.close();

//             if(data['auth'] == 1){
//                 // console.log('hereeeee');
//                 if(data['result'] == 1){
//                     toastr.success('Record Saved!');
//                     // LoadDLA(monitoringId);
//                 }
//                 else{
//                     toastr.error('Saving Failed!');
//                 }
//             }
//             else{ // if session expired
//                 // cnfrmAutoLogin.open();
//             }
//         },
//         error(xhr, data, status){
//             cnfrmLoading.close();
//             toastr.error('An error occured!');
//         }
//     });
// }

function SaveDLAUncheckedCheckItems(monitoringId, test){ //nmodify
    let url = globalLink.replace('link', 'save_unchecked_dla_check_items');
    let login = globalLink.replace('link', 'login');

    $.ajax({
        url: url,
        method: 'post',
        data: {
            _token: _token,
            monitoring_id: monitoringId,
            unchecked_dlaCheckItems: test
        },
        // data: data,
        dataType: 'json',
        beforeSend() {
            cnfrmLoading.open();
        },
        success(data){
            cnfrmLoading.close();
            if(data['auth'] == 1){
                if(data['result'] == 1){
                    // toastr.success('Record Saved!'); /cmodify --clark||sucess alert is in the dlaresults
                    // LoadDLA(monitoringId);
                }else{
                    toastr.error('ERROR Saving Unchecked Items!');
                }
            }
            else{ // if session expired
                // cnfrmAutoLogin.open();
                window.location = "../RapidX/";
            }
        },
        error(xhr, data, status){
            cnfrmLoading.close();
            toastr.error('An error occured!');
        }
    });
}

function SaveDLAFirstArrCheckItems(monitoringId, firstArrdlaCheckItems){ //nmodify
    let url = globalLink.replace('link', 'save_first_arr_dla_check_items');
    let login = globalLink.replace('link', 'login');

    $.ajax({
        url: url,
        method: 'post',
        data: {
            _token: _token,
            monitoring_id: monitoringId,
            first_dla_check_items: firstArrdlaCheckItems
        },
        // data: data,
        dataType: 'json',
        beforeSend() {
            cnfrmLoading.open();
        },
        success(data){
            cnfrmLoading.close();

            if(data['auth'] == 1){
                // console.log('hereeeee');
                if(data['result'] == 1){
                    // toastr.success('Record Saved!'); /cmodify --clark||sucess alert is in the dlaresults
                    // LoadDLA(monitoringId);
                }
                else{
                    toastr.error('Saving Failed!');
                }
            }
            else{ // if session expired
                window.location = "../RapidX/";
                // cnfrmAutoLogin.open();
            }
        },
        error(xhr, data, status){
            cnfrmLoading.close();
            toastr.error('An error occured!');
        }
    });
}

function SaveDLASecondArrCheckItems(monitoringId, secondArrdlaCheckItems){ //nmodify
    let url = globalLink.replace('link', 'save_second_arr_dla_check_items');
    let login = globalLink.replace('link', 'login');

    $.ajax({
        url: url,
        method: 'post',
        data: {
            _token: _token,
            monitoring_id: monitoringId,
            second_dla_check_items: secondArrdlaCheckItems,
        },
        // data: data,
        dataType: 'json',
        beforeSend() {
            cnfrmLoading.open();
        },
        success(data){
            cnfrmLoading.close();

            if(data['auth'] == 1){
                // console.log('hereeeee');
                if(data['result'] == 1){
                    // toastr.success('Record Saved!'); /cmodify --clark||sucess alert is in the dlaresults
                    // LoadDLA(monitoringId);
                }
                else{
                    toastr.error('Saving Failed!');
                }
            }
            else{ // if session expired
                // cnfrmAutoLogin.open();
                window.location = "../RapidX/";
            }
        },
        error(xhr, data, status){
            cnfrmLoading.close();
            toastr.error('An error occured!');
        }
    });
}

function SaveDLAResults(monitoringId, dlaResults){ //nmodify
    let url = globalLink.replace('link', 'save_dla_results');
    let login = globalLink.replace('link', 'login');

    $.ajax({
        url: url,
        method: 'post',
        data: {
            _token: _token,
            monitoring_id: monitoringId,
            dla_results: dlaResults,
        },
        // data: data,
        dataType: 'json',
        beforeSend() {
            cnfrmLoading.open();
        },
        success(data){
            cnfrmLoading.close();

            if(data['auth'] == 1){
                // console.log('hereeeee');
                if(data['result'] == 1){
                    toastr.success('Record Saved!');
                    console.log('saveDLAResult');
                    LoadDLACheckItems(monitoringId);
                }
                else{
                    toastr.error('Saving Failed!');
                }
            }
            else{ // if session expired
                // cnfrmAutoLogin.open();
                window.location = "../RapidX/";
            }
        },
        error(xhr, data, status){
            cnfrmLoading.close();
            toastr.error('An error occured!');
        }
    });
}

function LoadDLACheckItems(monitoringId, PushToCheckedChckboxArr, fnChkDLA){
    let url = globalLink.replace('link', 'get_dla_check_items_by_monitoring_id');
    let login = globalLink.replace('link', 'login');

    $.ajax({
        url: url,
        method: 'get',
        data: {
            monitoring_id: monitoringId
        },
        dataType: 'json',
        beforeSend() {
            // btnSaveMonitoring.prop('disabled', true);
            // btnSaveMonitoring.html('Loading...');
            cnfrmLoading.open();
            // $("input[name='work_week']", frmSaveMonitoring).prop('readonly', true);
        },
        success(data){
            // console.log('LoadDLACheckItems called');
            // btnSaveMonitoring.prop('disabled', false);
            // btnSaveMonitoring.html('Save');
            cnfrmLoading.close();

            // $('.selInCharge').html('').val('').trigger('change');

            let test = [];
            if(data['auth'] == 1){
                if(data['dla_check_items'].length > 0){
                    for(let index = 0; index < data['dla_check_items'].length; index++){
                        $('.chkDLA[index="'+ data['dla_check_items'][index]['index'] + '"][value="' + data['dla_check_items'][index]['value'] + '"]').prop('checked', true);
                        // checked_chckbox_arr.push([data['dla_check_items'][index]['index']]);
                        // let test;
                        // console.log(data['dla_check_items'][index]['index']);
                        if(data['dla_check_items'][index]['value'] == '1'){
                            test.push(data['dla_check_items'][index]['index']);
                        }
                        // if($('.chkDLA[index="'+ data['dla_check_items'][index]['index'] + '"][value="' + data['dla_check_items'][index]['value'] + '"]').attr('value') == 1){
                        //     let yes_check = $('.chkDLA[index="'+ data['dla_check_items'][index]['index'] + '"][value="' + data['dla_check_items'][index]['value'] + '"]').attr('index');
                        //     test.push([yes_check]);
                        // }
                        //
                    }
                    // CLARK COMMENT 10/02/2024 WORKING FOR CHECKING(CHECKED ITEMS) RETRIEVED DATA
                    PushToCheckedChckboxArr(test, fnChkDLA);
                }else{
                    $('.chkDLA').prop('checked', false);
                }
            }
            else{ // if session expired
                cnfrmAutoLogin.open();
            }
        },
        error(xhr, data, status){
            cnfrmLoading.close();
            // btnSaveMonitoring.prop('disabled', false);
            // btnSaveMonitoring.html('Save');
            toastr.error('An error occured!');
        }
    });
}


function LoadDLAResults(monitoringId){
    let url = globalLink.replace('link', 'get_dla_results_by_monitoring_id');
    let login = globalLink.replace('link', 'login');

    $.ajax({
        url: url,
        method: 'get',
        data: {
            monitoring_id: monitoringId
        },
        dataType: 'json',
        beforeSend() {
            // btnSaveMonitoring.prop('disabled', true);
            // btnSaveMonitoring.html('Loading...');
            cnfrmLoading.open();
            // $("input[name='work_week']", frmSaveMonitoring).prop('readonly', true);
        },
        success(data){
            // btnSaveMonitoring.prop('disabled', false);
            // btnSaveMonitoring.html('Save');
            cnfrmLoading.close();

            $('.selInCharge').html('').val('').trigger('change');

            if(data['auth'] == 1){

                if(data['dla_results'].length > 0){
                    for(let index = 0; index < data['dla_results'].length; index++){
                        $('.txtResult[index="'+ data['dla_results'][index]['index'] + '"]').val(data['dla_results'][index]['result']);
                        $('.txtDueDate[index="'+ data['dla_results'][index]['index'] + '"]').val(data['dla_results'][index]['capa_due_date']);
                        $('.txtCorrectiveAction[index="'+ data['dla_results'][index]['index'] + '"]').val(data['dla_results'][index]['corrective_action']);
                        $('.selInCharge[index="'+ data['dla_results'][index]['index'] + '"]').html('<option value="' + data['dla_results'][index]['person_in_charge'] + '">' + data['dla_results'][index]['user_name'] + ' (' + data['dla_results'][index]['employee_id'] + ')</option>').val(data['dla_results'][index]['person_in_charge']).trigger('change');
                    }
                }else{
                    $('.chkDLA').prop('checked', false);
                }
            }else{ // if session expired
                cnfrmAutoLogin.open();
            }
        },
        error(xhr, data, status){
            cnfrmLoading.close();
            // btnSaveMonitoring.prop('disabled', false);
            // btnSaveMonitoring.html('Save');
            toastr.error('An error occured!');
        }
    });
}
