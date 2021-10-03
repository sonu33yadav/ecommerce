function logCheck() {
    localStorage.setItem('status','login');
    return true;
}

function registerCheck(){
    localStorage.setItem('status','register');
    return true;
}

function resetCheck(){
    localStorage.setItem('status','reset');
}

$(() => {
    $( ".fc-datepicker" ).datepicker({
        dateFormat: "yy-mm-dd"
    });
    if(dashboard == 1){
        localStorage.removeItem('status');
    }
    let status  = localStorage.getItem('status');
    if(status === 'login') {
        $('#loginModal').modal('show');
        $('#register_email').removeClass('is-invalid');
        $('#register_password').removeClass('is-invalid');
    }
    else if(status === 'register') {
        $('#registerModal').modal('show');
        $('#login_email_error').hide();
        $('#login_email').removeClass('is-invalid');
        $('#login_password').removeClass('is-invalid');
    }
    else if(status === 'reset'){
        $('#pResetModal').modal('show');
        $('#register_email').removeClass('is-invalid');
        $('#register_password').removeClass('is-invalid');
        $('#login_email_error').hide();
        $('#login_email').removeClass('is-invalid');
        $('#login_password').removeClass('is-invalid');
    }
    localStorage.removeItem('status');
})
