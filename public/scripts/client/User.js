// VARIABLES

// JS Confirm Lazy Loading
// let cnfrmLoading = $.dialog({
//   lazyOpen: true,
//   title: '',
//   content: '<i class="fa fa-spinner fa-pulse"></i> Loading...',
//   type: 'orange',
//   closeIcon: false,
//   // autoClose: 'btnAction|8000',
//   // backgroundDismiss: true,
// });

// let cnfrmAutoLogin = $.confirm({
//   lazyOpen: true,
//   title: 'Session Expired',
//   content: 'Your session is expired, you will be automatically logged out in 10 seconds.',
//   type: 'red',
//   autoClose: 'logoutUser|10000',
//   buttons: {
//     logoutUser: {
//       text: 'Logout now',
//       action: function () {
//         window.location = '{{ route("login") }}';
//       }
//     },
//   }
// });

// let cnfrmTokenMismatch = $.confirm({
//   lazyOpen: true,
//   title: 'Token Mismatched',
//   content: 'Your token is expired, you will be automatically refresh the page in 10 seconds.',
//   type: 'red',
//   autoClose: 'refreshPage|10000',
//   buttons: {
//     refreshPage: {
//       text: 'Refresh now',
//       action: function () {
//         window.location.reload();
//       }
//     },
//   }
// });

// FUNCTIONS
function SignIn(){
    let url = globalLink.replace('link', 'sign_in');
    let dashboard = globalLink.replace('link', 'dashboard');

    $.ajax({
        url: url,
        method: 'post',
        data: $('#frmSigIn').serialize(),
        beforeSend() {
            $('#frmSigIn button[type="submit"]').prop('disabled', true);
            $('#frmSigIn #spanBtnSignIn').text('Logging in...');
            $("#iBtnSignInIcon").removeClass('fa-unlock');
            $("#iBtnSignInIcon").addClass('fa-spinner');
            $("#iBtnSignInIcon").addClass('fa-pulse');

            $('#frmSigIn input[type="text"]').prop('readonly', true);
            $('#frmSigIn input[type="password"]').prop('readonly', true);
            cnfrmLoading.open();
        },
        success(data){
            cnfrmLoading.close();
            $('#frmSigIn button[type="submit"]').prop('disabled', false);
            $('#frmSigIn #spanBtnSignIn').text('Login');
            $('#frmSigIn input[type="text"]').prop('readonly', false);
            $('#frmSigIn input[type="password"]').prop('readonly', false);

            $("#iBtnSignInIcon").addClass('fa-unlock');
            $("#iBtnSignInIcon").removeClass('fa-spinner');
            $("#iBtnSignInIcon").removeClass('fa-pulse');

            if(data['result'] == 0){
                $('.pLoginErrMsg', $('#frmSigIn')).show();

                if(data['user_info'] == null){
                    $('.pLoginErrMsg', $('#frmSigIn')).html('User not registered.');
                }
                else{
                    if(data['user_info']['status'] == 2){
                        $('.pLoginErrMsg', $('#frmSigIn')).html('User deactivated. <br> <i style="font-size: 13px;">Please contact Administrator for your help.</i>');
                    }
                    else if(data['user_info']['status'] == 3){
                        $('.pLoginErrMsg', $('#frmSigIn')).html('User was disabled. <br> <i style="font-size: 13px;">Please contact Administrator for your help.</i>');
                    }
                    else{
                        $('.pLoginErrMsg', $('#frmSigIn')).html('Login Failed!.');
                    }
                }
            }
            else{
                window.location = dashboard;
            }
        },
        error(xhr, data, status){

            $('#frmSigIn button[type="submit"]').prop('disabled', false);
            $('#frmSigIn #spanBtnSignIn').text('Login');
            $("#iBtnSignInIcon").addClass('fa-unlock');
            $("#iBtnSignInIcon").removeClass('fa-spinner');
            $("#iBtnSignInIcon").removeClass('fa-pulse');
            $('#frmSigIn input[type="text"]').prop('readonly', false);
            $('#frmSigIn input[type="password"]').prop('readonly', false);
        }
    });
}

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
            $("input[name='name']", frmSaveUser).focus();

            if(data['auth'] == 1){
                if(data['result'] == 1){
                    toastr.success('Record Saved!');
                    frmSaveUser[0].reset();
                    $(".input-error", frmSaveUser).text('');
                    $(".form-control", frmSaveUser).removeClass('is-invalid');
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

                        if(data['error']['username'] != null){
                            $("input[name='username']", frmSaveUser).addClass('is-invalid');
                            $("input[name='username']", frmSaveUser).siblings('.input-error').text(data['error']['username']);
                        }
                        else{
                            $("input[name='username']", frmSaveUser).removeClass('is-invalid');
                            $("input[name='username']", frmSaveUser).siblings('.input-error').text('');
                        }

                        if(data['error']['email'] != null){
                            $("input[name='email']", frmSaveUser).addClass('is-invalid');
                            $("input[name='email']", frmSaveUser).siblings('.input-error').text(data['error']['email']);
                        }
                        else{
                            $("input[name='email']", frmSaveUser).removeClass('is-invalid');
                            $("input[name='email']", frmSaveUser).siblings('.input-error').text('');
                        }

                        if(data['error']['password'] != null){
                            $("input[name='password']", frmSaveUser).addClass('is-invalid');
                            $("input[name='password']", frmSaveUser).siblings('.input-error').text(data['error']['password']);
                        }
                        else{
                            $("input[name='password']", frmSaveUser).removeClass('is-invalid');
                            $("input[name='password']", frmSaveUser).siblings('.input-error').text('');
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
                    $('input[name="username"]', frmSaveUser).val(data['user_info']['username']);
                    $('input[name="email"]', frmSaveUser).val(data['user_info']['email']);
                    $('select[name="user_level"]', frmSaveUser).val(data['user_info']['user_level']);
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

function AddUserBranch(branchId, selectedUserId){
    let url = globalLink.replace('link', 'add_user_branch');
    let login = globalLink.replace('link', 'login');

    $.ajax({
        url: url,
        method: 'post',
        data: {
            _token: _token,
            user_id: selectedUserId,
            branch_id: branchId,
        },
        dataType: 'json',
        beforeSend() {
            cnfrmLoading.open();
        },
        success(data){
            cnfrmLoading.close();
            // dtAddBranches.draw();
            // dtExistingBranchUsers.draw();
            dtUsers.draw();

            if(data['auth'] == 1){
                if(data['result'] == 1){
                    toastr.success('Record Saved!');
                }
                else if(data['result'] == 2){
                    toastr.warning('Already Exist!');
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

function BranchUserAction(branchUserId, userId, branchId, status){
    let url = globalLink.replace('link', 'branch_user_action');
    let login = globalLink.replace('link', 'login');

    $.ajax({
        url: url,
        method: 'post',
        data: {
            _token: _token,
            id: branchUserId,
            user_id: userId,
            branch_id: branchId,
            status: status,
        },
        dataType: 'json',
        beforeSend() {
            cnfrmLoading.open();
        },
        success(data){
            cnfrmLoading.close();
            dtUsers.draw();
            // dtExistingBranchUsers.draw();
            // dtAddBranches.draw();

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

// CSO Dashboard
function CountUsers(){
    let url = globalLink.replace('link', 'count_users');
    let login = globalLink.replace('link', 'login');

    $.ajax({
        url: url,
        method: 'get',
        data: {
            
        },
        dataType: 'json',
        beforeSend() {
            $("#h3NewUsersCount").html(0);
        },
        success(data){
            $("#h3NewUsersCount").html(data['count']);
        },
        error(xhr, data, status){
            
            toastr.error('An error occured!');
        }
    });
}