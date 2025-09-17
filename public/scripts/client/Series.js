// VARIABLES

// FUNCTIONS
// Save Series
function SaveSeries(){
    let url = globalLink.replace('link', 'save_series');
    let login = globalLink.replace('link', 'login');

    $.ajax({
        url: url,
        method: 'post',
        data: frmSaveSeries.serialize(),
        dataType: 'json',
        beforeSend() {
            btnSaveSeries.prop('disabled', true);
            btnSaveSeries.html('Saving...');
            $(".input-error", frmSaveSeries).text('');
            $(".form-control", frmSaveSeries).removeClass('is-invalid');
            cnfrmLoading.open();
        },
        success(data){
            btnSaveSeries.prop('disabled', false);
            btnSaveSeries.html('Save');
            cnfrmLoading.close();
            $("input[name='description']", frmSaveSeries).focus();

            if(data['auth'] == 1){
                if(data['result'] == 1){
                    toastr.success('Record Saved!');
                    frmSaveSeries[0].reset();
                    $(".input-error", frmSaveSeries).text('');
                    $(".form-control", frmSaveSeries).removeClass('is-invalid');
                    dtSerieses.draw();
                }
                else{
                    toastr.error('Saving Failed!');
                    if(data['error'] != null){
                        if(data['error']['description'] != null){
                            $("input[name='description']", frmSaveSeries).addClass('is-invalid');
                            $("input[name='description']", frmSaveSeries).siblings('.input-error').text(data['error']['description']);
                        }
                        else{
                            $("input[name='description']", frmSaveSeries).removeClass('is-invalid');
                            $("input[name='description']", frmSaveSeries).siblings('.input-error').text('');
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
            btnSaveSeries.prop('disabled', false);
            btnSaveSeries.html('Save');
            toastr.error('Saving Failed!');
        }
    });
}

function GetSeriesById(seriesId){
    let url = globalLink.replace('link', 'get_series_by_id');
    let login = globalLink.replace('link', 'login');

    $.ajax({
        url: url,
        method: 'get',
        data: {
            series_id: seriesId
        },
        dataType: 'json',
        beforeSend() {
            btnSaveSeries.prop('disabled', true);
            btnSaveSeries.html('Saving...');
            $(".input-error", frmSaveSeries).text('');
            $(".form-control", frmSaveSeries).removeClass('is-invalid');
            cnfrmLoading.open();
            frmSaveSeries[0].reset();
            $('input[name="series_id"]', frmSaveSeries).val('');
        },
        success(data){
            btnSaveSeries.prop('disabled', false);
            btnSaveSeries.html('Save');
            cnfrmLoading.close();
            $("input[name='description']", frmSaveSeries).focus();

            if(data['auth'] == 1){
                if(data['series_info'] != null){
                    $("#mdlSaveSeries").modal('show');
                    $('input[name="series_id"]', frmSaveSeries).val(data['series_info']['id']);
                    $('input[name="description"]', frmSaveSeries).val(data['series_info']['description']);
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
            btnSaveSeries.prop('disabled', false);
            btnSaveSeries.html('Save');
            toastr.error('An error occured!');
        }
    });
}

function SeriesAction(seriesId, action, status){
    let url = globalLink.replace('link', 'series_action');
    let login = globalLink.replace('link', 'login');

    $.ajax({
        url: url,
        method: 'post',
        data: {
            _token: _token,
            series_id: seriesId,
            action: action,
            status: status,
        },
        dataType: 'json',
        beforeSend() {
            cnfrmLoading.open();
        },
        success(data){
            cnfrmLoading.close();
            dtSerieses.draw();

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
