function emailTextFocus(){
    if(document.getElementById('email').value==='Email address')
        document.getElementById('email').value='';
        document.getElementById('email').style.color='black';

}
function emailTextBlur(){
    if(document.getElementById('email').value === ''){
        document.getElementById('email').value = 'Email address';
        document.getElementById('email').style.color='gray';
    }
}
function passwordTextFocus() {
    if (document.getElementById('password').value === 'Password') {
        document.getElementById('password').value = '';
        document.getElementById('password').type='password';
    }
    document.getElementById('password').style.color='black';
}
function passwordTextBlur(){
    if(document.getElementById('password').value === ''){
        document.getElementById('password').value = 'Password';
        document.getElementById('password').type='text';
        document.getElementById('password').style.color='gray';
    }
}
