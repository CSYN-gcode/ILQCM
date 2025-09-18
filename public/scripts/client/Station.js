// VARIABLES

// FUNCTIONS
// Save Station
function SaveStation(){
    let url = globalLink.replace('link', 'save_station');
    let login = globalLink.replace('link', 'login');

    $.ajax({
        url: url,
        method: 'post',
        data: frmSaveStation.serialize(),
        dataType: 'json',
        beforeSend() {
            btnSaveStation.prop('disabled', true);
            btnSaveStation.html('Saving...');
            $(".input-error", frmSaveStation).text('');
            $(".form-control", frmSaveStation).removeClass('is-invalid');
            cnfrmLoading.open();
        },
        success(data){
            btnSaveStation.prop('disabled', false);
            btnSaveStation.html('Save');
            cnfrmLoading.close();
            $("input[name='description']", frmSaveStation).focus();

            if(data['auth'] == 1){
                if(data['result'] == 1){
                    toastr.success('Record Saved!');
                    frmSaveStation[0].reset();
                    $(".input-error", frmSaveStation).text('');
                    $(".form-control", frmSaveStation).removeClass('is-invalid');
                    $("select[name='series_ids[]']", frmSaveStation).val("").trigger("change");
                    dtStations.draw();
                }
                else{
                    toastr.error('Saving Failed!');
                    if(data['error'] != null){
                        if(data['error']['description'] != null){
                            $("input[name='description']", frmSaveStation).addClass('is-invalid');
                            $("input[name='description']", frmSaveStation).siblings('.input-error').text(data['error']['description']);
                        }
                        else{
                            $("input[name='description']", frmSaveStation).removeClass('is-invalid');
                            $("input[name='description']", frmSaveStation).siblings('.input-error').text('');
                        }
                        if(data['error']['series_ids'] != null){
                            $("select[name='series_ids[]']", frmSaveStation).addClass('is-invalid');
                            $("select[name='series_ids[]']", frmSaveStation).siblings('.input-error').text(data['error']['series_ids']);
                        }
                        else{
                            $("select[name='series_ids[]']", frmSaveStation).removeClass('is-invalid');
                            $("select[name='series_ids[]']", frmSaveStation).siblings('.input-error').text('');
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
            btnSaveStation.prop('disabled', false);
            btnSaveStation.html('Save');
            toastr.error('Saving Failed!');
        }
    });
}

function GetStationById(stationId){
    let url = globalLink.replace('link', 'get_station_by_id');
    let login = globalLink.replace('link', 'login');

    $.ajax({
        url: url,
        method: 'get',
        data: {
            station_id: stationId
        },
        dataType: 'json',
        beforeSend() {
            btnSaveStation.prop('disabled', true);
            btnSaveStation.html('Saving...');
            $(".input-error", frmSaveStation).text('');
            $(".form-control", frmSaveStation).removeClass('is-invalid');
            cnfrmLoading.open();
            frmSaveStation[0].reset();
            $('input[name="station_id"]', frmSaveStation).val('');
            $("select[name='series_ids[]']", frmSaveStation).html("");
            $("select[name='series_ids[]']", frmSaveStation).val("").trigger("change");
        },
        success(data){
            btnSaveStation.prop('disabled', false);
            btnSaveStation.html('Save');
            cnfrmLoading.close();
            $("input[name='description']", frmSaveStation).focus();

            if(data['auth'] == 1){
                if(data['station_info'] != null){
                    $("#mdlSaveStation").modal('show');
                    $('input[name="station_id"]', frmSaveStation).val(data['station_info']['id']);
                    $('input[name="description"]', frmSaveStation).val(data['station_info']['description']);

                    let stationSeriesDetails = "";
                    let seriesIds = [];
                    if(data['station_info']['station_series_details'].length > 0){
                        for(let index = 0; index < data['station_info']['station_series_details'].length; index++){
                            if(data['station_info']['station_series_details'][index]['series_info'] != null && data['station_info']['station_series_details'][index]['series_info']['status'] == 1){
                                seriesIds.push(data['station_info']['station_series_details'][index]['series_id']);
                                stationSeriesDetails += '<option value="' + data['station_info']['station_series_details'][index]['series_id'] + '">' + data['station_info']['station_series_details'][index]['series_info']['description'] + '</option>';
                            }
                        }
                        $("select[name='series_ids[]']", frmSaveStation).append(stationSeriesDetails);
                        $("select[name='series_ids[]']", frmSaveStation).val(seriesIds).trigger("change");
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
            btnSaveStation.prop('disabled', false);
            btnSaveStation.html('Save');
            toastr.error('An error occured!');
        }
    });
}

function StationAction(stationId, action, status){
    let url = globalLink.replace('link', 'station_action');
    let login = globalLink.replace('link', 'login');

    $.ajax({
        url: url,
        method: 'post',
        data: {
            _token: _token,
            station_id: stationId,
            action: action,
            status: status,
        },
        dataType: 'json',
        beforeSend() {
            cnfrmLoading.open();
        },
        success(data){
            cnfrmLoading.close();
            dtStations.draw();

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