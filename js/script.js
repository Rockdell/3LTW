function upvoteAction(doc) {
    if (this.checked) {
        //postVote($postID, $userID, 1)
        console.log("up");

        let associatedDownvote = doc.getElementById('downvote' + this.id.match(/upvote(\d+)/)[1]);
        console.log(associatedDownvote);
        associatedDownvote.checked = false;
    }
    else
        console.log("delete up");
        //removePostVote($postID, $userID)
}

function downvoteAction(doc) {
    if (this.checked) {
        //postVote($postID, $userID, 1)
        console.log("down");
        
        let associatedUpvote = doc.getElementById('upvote' + this.id.match(/downvote(\d+)/)[1]);
        console.log(associatedUpvote);
        associatedUpvote.checked = false;
    }
    else    
        console.log("delete down");
        //removePostVote($postID, $userID)
}

let upvotes = document.querySelectorAll('#post-info input[id^="upvote"]');
let downvotes = document.querySelectorAll('#post-info input[id^="downvote"]');

for (let i = 0; i < upvotes.length; i++) {
    upvotes[i].addEventListener('click', upvoteAction.bind(upvotes[i], document));
}

for (let i = 0; i < downvotes.length; i++) {
    downvotes[i].addEventListener('click', downvoteAction.bind(downvotes[i], document));
}

function openSignIn() {

    // Reset preview
    let preview = document.querySelector("#reg-picture-preview");
    if (preview)
        preview.src = "/img/users/unknown.png";

    let sign_bar = document.getElementById("sign-bar");
    sign_bar.style.display = "block";

    // Dim in
    document.querySelectorAll("#dim-masks").forEach((div) => {
        div.classList.add("dim");
    });

    sign_bar.classList.add("pop");

    sign_bar.classList.add("login-open");

    document.getElementById("login-form").style.display = "flex";
    document.getElementById("register-form").style.display = "none";
}

function closeSignIn() {

    let sign_bar = document.getElementById("sign-bar");
    sign_bar.style.display = "none";

    //Dim out
    document.querySelectorAll("#dim-masks").forEach((div) => {
        div.classList.remove("dim");
    });

    sign_bar.classList.remove("login-open");
    sign_bar.classList.remove("register-open");

    document.getElementById("login-form").style.display = "flex";
    document.getElementById("register-form").style.display = "none";
}

function signInOrUp() {

    // Reset preview
    let preview = document.querySelector("#reg-picture-preview");
    if (preview)
        preview.src = "/img/users/unknown.png";

    let sign_bar = document.getElementById("sign-bar");

    if (sign_bar.classList.contains("login-open")) {
        sign_bar.classList.remove("login-open");
        sign_bar.classList.add("register-open");

        document.getElementById("login-form").style.display = "none";
        document.getElementById("register-form").style.display = "flex";
    }
    else if (sign_bar.classList.contains("register-open")) {
        sign_bar.classList.remove("register-open");
        sign_bar.classList.add("login-open");

        document.getElementById("login-form").style.display = "flex";
        document.getElementById("register-form").style.display = "none";
    }
}

let openSettings = () => {

    let settings_bar = document.getElementById("settings-bar");
    settings_bar.style.display = "block";
}

let validateUserId = () => {

    let userID = document.querySelector("#reg-userID");

    if(!userID.value.match(/^[a-zA-Z][a-zA-Z0-9-_]{3,32}$/gi)) {
        displayWarning("UserID is not valid!")
        displayError(userID);
    }
}

let validateEmail = () => {

    let email = document.querySelector("#reg-email");

    if (!email.value.match(/^[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?$/g)) {
        displayWarning("Email is not valid!");
        displayError(email);
    }
}

let validatePassword = () => {

    let password = document.querySelector("#reg-pwd");

    if (!password.value.match(/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$/gm)) {
        displayWarning("Password is not valid!");
        displayError(password);
    }
}

let comparePasswords = () => {

    let password = document.querySelector("#reg-pwd");
    let chkPassword = document.querySelector("#reg-chkpwd");

    if (password.value !== chkPassword.value) {
        displayWarning("Passwords don't match!");
        displayError(chkPassword);
    }
}

let displayError = (element) => {

    if (!element.classList.contains("shake-pulse")) {
        element.classList.add("shake-pulse");
        setTimeout(() => { element.classList.remove("shake-pulse"); }, 750);
    }
}

let displayWarning = (message) => {

    let warning = document.getElementById("warning");

    if (!warning.classList.contains("fade")) {
        warning.textContent = message;
        warning.style.display = "block";
        warning.classList.add("fade");

        setTimeout(() => {
            warning.classList.remove("fade");
            warning.style.display = "none";
            warning.textContent = "";
        }, 2000);
    }
}

// Ajax

let loginForm = document.querySelector("#login-form");

if (loginForm) {

    loginForm.onsubmit = (e) => {
        e.preventDefault();

        let userID = loginForm.querySelector("input[name='userID']").value;
        let password = loginForm.querySelector("input[name='password']").value;

        let data = {
            userID: userID,
            password: password
        }
    
        let callback = (response) => {
            if (response === "success") {
                setTimeout(window.location.reload(), 1000);
            }
            else {

                displayWarning("Sign in failed!")

                document.querySelectorAll("#login-form input").forEach((input) => {
                   displayError(input);
                });
            }
        }
    
        sendRequest("/actions/login.php", data, callback); 
    }
}

let logoutButton = document.querySelector("#logout-button");

if (logoutButton) {

    logoutButton.onclick = (e) => {
        e.preventDefault();

        let callback = (response) => {
            if (response === "success")
                setTimeout(window.location.reload(), 1000);
        }
        
        sendRequest("/actions/logout.php", {}, callback);
    }
}

let registerForm = document.querySelector("#register-form");

if (registerForm) {

    registerForm.querySelector("#reg-picture").onchange = (e) => {
        e.preventDefault();

        let picture = registerForm.querySelector("#reg-picture");
        let picturePreview = registerForm.querySelector("#reg-picture-preview");

        if (picture.files.length > 0)
            picturePreview.src = URL.createObjectURL(picture.files[0]);
    }

    registerForm.onsubmit = (e) => {
        e.preventDefault();

        let picture = registerForm.querySelector("input[name='picture']");
        let userID = registerForm.querySelector("input[name='userID']").value;
        let username = registerForm.querySelector("input[name='username']").value;
        let email = registerForm.querySelector("input[name='email']").value;
        let password = registerForm.querySelector("input[name='password']").value;

        let callback = (response) => {

            if (response === "success") {

                let callback_upload = (response) => {
                    if (response === "sucess")
                        setTimeout(window.location.reload(), 1000);
                    else
                        displayWarning("Upload failed!");
                }

                if (picture.files.length > 0)
                    uploadPicture(picture.files[0], "users_" + userID, callback_upload);

                setTimeout(window.location.reload(), 1000);
            }
            else {

                displayWarning("Sign up failed!")

                document.querySelector("#register-form input").forEach((input) => {
                    displayError(input);
                })
            }
        }

        let data = {
            userID: userID,
            username: username,
            email: email,
            password: password
        }

        sendRequest("/actions/register.php", data, callback);
    }
}

let uploadPicture = (picture, name, callback) => {

    let request = new XMLHttpRequest();

    let formData = new FormData();
    formData.append("picture", picture, name);

    request.open("post", "/actions/upload.php", true);
    request.send(formData);

    request.addEventListener("load", () => callback(request.responseText));
}

let sendRequest = (url, data, callback) => {

    let request = new XMLHttpRequest();

    request.open("post", url, true);
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    request.send(encodeForAjax(data));

    request.addEventListener("load", () => callback(request.responseText));
}

let encodeForAjax = (data) => {
    return Object.keys(data).map(function(k) {
        return encodeURIComponent(k) + "=" + encodeURIComponent(data[k])
    }).join("&");
}