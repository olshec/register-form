
function transformFormToSignIn() {
    document.getElementById('type-form').setAttribute('type-form','sign-in');
    document.getElementById('email').removeAttribute('required');
    document.getElementById('email-block').hidden = true;
    let nodeNameSubmitButton = document.getElementById('register-btn').childNodes[0];
    nodeNameSubmitButton.nodeValue = "Sign In";
    let nodeNameForm = document.getElementById('form-name').childNodes[0];
    nodeNameForm.nodeValue = "Sign In";
    let nodeFormHeader = document.getElementById('form-header').childNodes[0];
    nodeFormHeader.nodeValue = "Please fill in this form to log into your account.";
    let resultQuery = document.getElementById('result-query').childNodes[0];
    if(resultQuery != undefined) {
        resultQuery.remove();
    }
    
    document.getElementById('link-register').hidden = false;
    document.getElementById('link-sign-in').hidden = true;
    document.getElementById('main-container').hidden = false;
}

function transformFormToRegister() {
    document.getElementById('type-form').setAttribute('type-form','register');
    document.getElementById('email').setAttribute('required', 'true');
    let nodeNameSubmitButton = document.getElementById('register-btn').childNodes[0];
    nodeNameSubmitButton.nodeValue = "Register";
    let nodeNameForm = document.getElementById('form-name').childNodes[0];
    nodeNameForm.nodeValue = "Register";
    let nodeFormHeader = document.getElementById('form-header').childNodes[0];
    nodeFormHeader.nodeValue = "Please fill in this form to create an account.";
    let resultQuery = document.getElementById('result-query').childNodes[0];
    if(resultQuery != undefined) {
        resultQuery.remove();
    }
    document.getElementById('email-block').hidden = false;
    document.getElementById('link-register').hidden = true;
    document.getElementById('link-sign-in').hidden = false;
    document.getElementById('main-container').hidden = false;
}

function removeMessagesError() {
    let nodeErrorEmail = document.getElementById('error-email').childNodes[0];
    if(nodeErrorEmail != undefined) {
        document.getElementById('error-email').removeChild(nodeErrorEmail);
    }
    let nodeErrorLogin = document.getElementById('error-login').childNodes[0];
    if(nodeErrorLogin != undefined) {
        document.getElementById('error-login').removeChild(nodeErrorLogin);
    }
}

function showErrorForFieldEmail(textError) {
    let node = document.createTextNode(textError);
    document.getElementById('error-email').appendChild(node);
}

function showErrorForFieldLogin(textError) {
    let node = document.createTextNode(textError);
    document.getElementById('error-login').appendChild(node);
}

function showErrorForWrongSingIn(textError) {
    let node = document.createTextNode(textError);
    let resultQuery = document.getElementById('error-login');
    resultQuery.appendChild(node);
}

function showResultQuery(responseText) {
    let response = JSON.parse(responseText);
    if(response.hasError == false) {
        document.getElementById('main-container').hidden = true;
        let node = document.createTextNode(response.textMessage);
        let resultQuery = document.getElementById('result-query');
        resultQuery.appendChild(node);
        
        let typeForm = document.getElementById('type-form').getAttribute('type-form');
        if (typeForm == "sign-in") {
            document.getElementById('link-register').hidden = true;
        }
        
    } else {
        let listError = response.listApplicationError;
        for(let i = 0; i < listError.length; i++) {
            if(listError[i].typeError == 'login') {
            showErrorForFieldLogin(listError[i].textError);
            } 
            if(listError[i].typeError == 'email') {
                showErrorForFieldEmail(listError[i].textError);
            }
            if(listError[i].typeError == 'sign-in') {
                showErrorForWrongSingIn(listError[i].textError);
            }
        }
    }
}

function sendQuery(url) {
    let xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                showResultQuery(this.responseText);
            }
        };
    xmlhttp.open("GET", url, true);
    xmlhttp.send();
}

function sendForm() {
    let typeForm = document.getElementById('type-form').getAttribute('type-form');
    
    let login = document.getElementById('login').value;
    let psw = document.getElementById('psw').value;
    let pswRepeat = document.getElementById('psw-repeat').value;
        
    if (typeForm == 'register') {
        let email = document.getElementById('email').value;
        let url = 'scripts/php/action_page.php?email=' + email + '&login=' + 
            login + '&psw=' + psw + '&type-form=' + 'register';
        sendQuery(url);
    } else  if (typeForm == 'sign-in') {
        let url = 'scripts/php/action_page.php?login=' + 
            login + '&psw=' + psw + '&type-form=' + 'sign-in';
        sendQuery(url);
    }

}


function afterPageLoad() {
    let form = document.getElementById('main-form');
    form.addEventListener('submit', function(event) {
            event.preventDefault();
            removeMessagesError();
            sendForm();
    });
    
    let signInLink = document.getElementById('link-sign-in');
    signInLink.addEventListener('click', function(event) {
            event.preventDefault();
            transformFormToSignIn();
    });
    
    let registerLink = document.getElementById('link-register');
    registerLink.addEventListener('click', function(event) {
            event.preventDefault();
            transformFormToRegister();
    })
}

afterPageLoad();



