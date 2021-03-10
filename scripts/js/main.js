


function removeMessagesError() {
    let nodeErrorEmail = document.getElementById('error-email').childNodes[0];
    if(nodeErrorEmail != undefined) {
        document.getElementById('error-email').removeChild(nodeErrorEmail);
    }
    
    let nodeErrorLogin = document.getElementById('error-login').childNodes[0];
    if(nodeErrorLogin != undefined) {
        document.getElementById('error-login').removeChild(nodeErrorLogin);
    }
    
    /*document.getElementById('error-email').hidden = true;
    document.getElementById('error-login').hidden = true;*/
}

function showErrorForFieldEmail(textError) {
    let node = document.createTextNode(textError);
    document.getElementById('error-email').appendChild(node);
}

function showErrorForFieldName(textError) {
    let node = document.createTextNode(textError);
    document.getElementById('error-login').appendChild(node);
}

function showResultRegister(responseText) {
    let response = JSON.parse(responseText);
    if(response.error == false) {
        document.getElementById('main-container').hidden = true;
        let resultQuery = document.getElementById('result-register');
        //let node = document.createTextNode("Register succesfull!");
        
        //document.getElementById('main-container')
        //document.body.innerHTML = "Register succesfull!<br>";
        resultQuery.innerText = response.textMesage;
        //resultQuery.appendChild(node);
    } else {
        if(response.typeError == 'name') {
            showErrorForFieldName(response.textError);
        } else if(response.typeError == 'email') {
            showErrorForFieldEmail(response.textError);
        }
    }
}

function sendQuery() {
	let login = document.getElementById('login').value;
	let email = document.getElementById('email').value;
	let psw = document.getElementById('psw').value;
	let pswRepeat = document.getElementById('psw-repeat').value;
	
	let xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			showResultRegister(this.responseText);
	    }
    };
    let url = "scripts/php/action_page.php?email=" + email + '&login=' + 
        login + '&psw=' + psw + '&psw-repeat=' + pswRepeat;
    xmlhttp.open("GET", url, true);
    xmlhttp.send();
}


function afterPageLoad() {
	let form = document.getElementById('main-form');
	form.addEventListener('submit', function(event) {
            event.preventDefault();
            removeMessagesError();
            sendQuery();
    });
}

afterPageLoad();



