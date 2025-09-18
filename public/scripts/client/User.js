// VARIABLES

// FUNCTIONS
// Save User
function SaveUser(){
    let url = globalLink.replace('link', 'save_user');
    let login = globalLink.replace('link', 'login');

    $.ajax({
        url: url,
        method: 'post',
        data: frmSaveUser.serialize(),
        dataType: 'json',
        beforeSend() {
            btnSaveUser.prop('disabled', true);
            btnSaveUser.html('Saving...');
            $(".input-error", frmSaveUser).text('');
            $(".form-control", frmSaveUser).removeClass('is-invalid');
            cnfrmLoading.open();
        },
        success(data){
            btnSaveUser.prop('disabled', false);
            btnSaveUser.html('Save');
            cnfrmLoading.close();
            $("input[name='description']", frmSaveUser).focus();

            if(data['auth'] == 1){
                if(data['result'] == 1){
                    toastr.success('Record Saved!');
                    frmSaveUser[0].reset();
                    $(".input-error", frmSaveUser).text('');
                    $(".form-control", frmSaveUser).removeClass('is-invalid');
                    $("select[name='station_ids[]']", frmSaveUser).val("").trigger("change");
                    $("select[name='series_ids[]']", frmSaveUser).val("").trigger("change");
                    dtUsers.draw();
                }
                else{
                    toastr.error('Saving Failed!');
                    if(data['error'] != null){
                        if(data['error']['name'] != null){
                            $("input[name='name']", frmSaveUser).addClass('is-invalid');
                            $("input[name='name']", frmSaveUser).siblings('.input-error').text(data['error']['name']);
                        }
                        else{
                            $("input[name='name']", frmSaveUser).removeClass('is-invalid');
                            $("input[name='name']", frmSaveUser).siblings('.input-error').text('');
                        }

                        if(data['error']['email'] != null){
                            $("input[name='email']", frmSaveUser).addClass('is-invalid');
                            $("input[name='email']", frmSaveUser).siblings('.input-error').text(data['error']['email']);
                        }
                        else{
                            $("input[name='email']", frmSaveUser).removeClass('is-invalid');
                            $("input[name='email']", frmSaveUser).siblings('.input-error').text('');
                        }
                        
                        if(data['error']['employee_id'] != null){
                            $("input[name='employee_id']", frmSaveUser).addClass('is-invalid');
                            $("input[name='employee_id']", frmSaveUser).siblings('.input-error').text(data['error']['employee_id']);
                        }
                        else{
                            $("input[name='employee_id']", frmSaveUser).removeClass('is-invalid');
                            $("input[name='employee_id']", frmSaveUser).siblings('.input-error').text('');
                        }

                        if(data['error']['position'] != null){
                            $("select[name='position']", frmSaveUser).addClass('is-invalid');
                            $("select[name='position']", frmSaveUser).siblings('.input-error').text(data['error']['position']);
                        }
                        else{
                            $("select[name='position']", frmSaveUser).removeClass('is-invalid');
                            $("select[name='position']", frmSaveUser).siblings('.input-error').text('');
                        }

                        if(data['error']['station_ids'] != null){
                            $("select[name='station_ids[]']", frmSaveUser).addClass('is-invalid');
                            $("select[name='station_ids[]']", frmSaveUser).siblings('.input-error').text(data['error']['station_ids']);
                        }
                        else{
                            $("select[name='station_ids[]']", frmSaveUser).removeClass('is-invalid');
                            $("select[name='station_ids[]']", frmSaveUser).siblings('.input-error').text('');
                        }

                        if(data['error']['series_ids'] != null){
                            $("select[name='series_ids[]']", frmSaveUser).addClass('is-invalid');
                            $("select[name='series_ids[]']", frmSaveUser).siblings('.input-error').text(data['error']['series_ids']);
                        }
                        else{
                            $("select[name='series_ids[]']", frmSaveUser).removeClass('is-invalid');
                            $("select[name='series_ids[]']", frmSaveUser).siblings('.input-error').text('');
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
            btnSaveUser.prop('disabled', false);
            btnSaveUser.html('Save');
            toastr.error('Saving Failed!');
        }
    });
}

function GetUserById(userId){
    let url = globalLink.replace('link', 'get_user_by_id');
    let login = globalLink.replace('link', 'login');

    $.ajax({
        url: url,
        method: 'get',
        data: {
            user_id: userId
        },
        dataType: 'json',
        beforeSend() {
            btnSaveUser.prop('disabled', true);
            btnSaveUser.html('Saving...');
            $(".input-error", frmSaveUser).text('');
            $(".form-control", frmSaveUser).removeClass('is-invalid');
            cnfrmLoading.open();
            frmSaveUser[0].reset();
            $('input[name="user_id"]', frmSaveUser).val('');
            $("select[name='station_ids[]']", frmSaveUser).html("");
            $("select[name='station_ids[]']", frmSaveUser).val("").trigger("change");
            $("select[name='series_ids[]']", frmSaveUser).html("");
            $("select[name='series_ids[]']", frmSaveUser).val("").trigger("change");
        },
        success(data){
            btnSaveUser.prop('disabled', false);
            btnSaveUser.html('Save');
            cnfrmLoading.close();
            $("input[name='name']", frmSaveUser).focus();

            if(data['auth'] == 1){
                if(data['user_info'] != null){
                    $("#mdlSaveUser").modal('show');
                    $('input[name="user_id"]', frmSaveUser).val(data['user_info']['id']);
                    $('input[name="name"]', frmSaveUser).val(data['user_info']['name']);
                    $('input[name="email"]', frmSaveUser).val(data['user_info']['email']);
                    $('input[name="employee_id"]', frmSaveUser).val(data['user_info']['employee_id']);
                    $('select[name="position"]', frmSaveUser).val(data['user_info']['position']);
                    
                    let userStationDetails = "";
                    let stationIds = [];
                    if(data['user_info']['user_station_details'].length > 0){
                        for(let index = 0; index < data['user_info']['user_station_details'].length; index++){
                            if(data['user_info']['user_station_details'][index]['station_info'] != null && data['user_info']['user_station_details'][index]['station_info']['status'] == 1){
                                stationIds.push(data['user_info']['user_station_details'][index]['station_id']);
                                userStationDetails += '<option value="' + data['user_info']['user_station_details'][index]['station_id'] + '">' + data['user_info']['user_station_details'][index]['station_info']['description'] + '</option>';
                            }
                        }
                        $("select[name='station_ids[]']", frmSaveUser).append(userStationDetails);
                        $("select[name='station_ids[]']", frmSaveUser).val(stationIds).trigger("change");
                    }

                    let userSeriesDetails = "";
                    let seriesIds = [];
                    if(data['user_info']['user_series_details'].length > 0){
                        for(let index = 0; index < data['user_info']['user_series_details'].length; index++){
                            if(data['user_info']['user_series_details'][index]['series_info'] != null && data['user_info']['user_series_details'][index]['series_info']['status'] == 1){
                                seriesIds.push(data['user_info']['user_series_details'][index]['series_id']);
                                userSeriesDetails += '<option value="' + data['user_info']['user_series_details'][index]['series_id'] + '">' + data['user_info']['user_series_details'][index]['series_info']['description'] + '</option>';
                            }
                        }
                        $("select[name='series_ids[]']", frmSaveUser).append(userSeriesDetails);
                        $("select[name='series_ids[]']", frmSaveUser).val(seriesIds).trigger("change");
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
            btnSaveUser.prop('disabled', false);
            btnSaveUser.html('Save');
            toastr.error('An error occured!');
        }
    });
}

function GetUserQRCode(userId){
    let url = globalLink.replace('link', 'get_user_by_id');
    let login = globalLink.replace('link', 'login');

    $.ajax({
        url: url,
        method: 'get',
        data: {
            user_id: userId
        },
        dataType: 'json',
        beforeSend() {
            btnSaveUser.prop('disabled', true);
            btnSaveUser.html('Saving...');
            $(".input-error", frmSaveUser).text('');
            $(".form-control", frmSaveUser).removeClass('is-invalid');
            cnfrmLoading.open();
            frmSaveUser[0].reset();
            $('input[name="user_id"]', frmSaveUser).val('');
        },
        success(data){
            btnSaveUser.prop('disabled', false);
            btnSaveUser.html('Save');
            cnfrmLoading.close();
            $("input[name='name']", frmSaveUser).focus();

            if(data['auth'] == 1){
                if(data['user_info'] != null){
                    var cnfrmGenQRCode = $.confirm({
                        lazyOpen: true,
                        title: "<center>" + data['user_info']['name'] + " (" + data['user_info']['employee_id'] + ")</center>",
                        content: '<center><img src="' + data['qrcode'] + '"</center>>',
                        type: 'success',
                        closeIcon: true,
                        backgroundDismiss: true,
                        buttons: {
                            cancel: function () {
                                
                            },
                            confirm: {
                                text: '<i class="fa fa-print"></i> Print',
                                btnClass: 'btn-success',
                                keys: ['enter'],
                                action: function(){
                                  popup = window.open();
                                  let content = '';
                                  content += '<html>';
                                  content += '<head>';
                                    content += '<title></title>';
                                    content += '<style type="text/css">';
                                      content += '.rotated {';
                                        content += 'border: 2px solid black;';
                                        content += 'width: 150px;';
                                        content += 'position: absolute;';
                                        content += 'left: 17.5px;';
                                        content += 'top: 15px;';
                                      content += '}';
                                    content += '</style>';
                                  content += '</head>';
                                  content += '<body>';
                                    content += '<center>';
                                    content += '<div class="rotated">';
                                    content += '<table>';
                                    content += '<tr>';
                                    content += '<td>';
                                    content += '<center>';
                                    content += '<img src="' + data['qrcode'] + '" style="max-width: 70px;">';
                                    content += '</center>';
                                    content += '</td>';
                                    content += '<td>';
                                    content += '<label style="text-align: center; font-weight: bold; font-family: Arial; font-size: 10px;"> E.N.: ' + data['user_info']['employee_id'] + '</label>';
                                    content += '<br>';
                                    content += '<label style="text-align: center; font-weight: bold; font-family: Arial Narrow; font-size: 8px;">' + data['user_info']['name'] + ' <br> </label>';
                                    content += '</td>';
                                    content += '</tr>';
                                    content += '</table>';
                                    content += '</div>';
                                    content += '</center>';
                                  content += '</body>';
                                  content += '</html>';
                                  popup.document.write(content);
                                  popup.focus(); //required for IE
                                  popup.print();
                                  popup.close();
                                }
                            },
                        }
                    });

                    cnfrmGenQRCode.open();
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
            btnSaveUser.prop('disabled', false);
            btnSaveUser.html('Save');
            toastr.error('An error occured!');
        }
    });
}

function UserAction(userId, action, status){
    let url = globalLink.replace('link', 'user_action');
    let login = globalLink.replace('link', 'login');

    $.ajax({
        url: url,
        method: 'post',
        data: {
            _token: _token,
            user_id: userId,
            action: action,
            status: status,
        },
        dataType: 'json',
        beforeSend() {
            cnfrmLoading.open();
        },
        success(data){
            cnfrmLoading.close();
            dtUsers.draw();

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