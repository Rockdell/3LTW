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

    let sign_bar = document.getElementsByClassName("sign-bar")[0];
    sign_bar.style.display = "block";
    sign_bar.id = "login-open";

    document.getElementById("login").style.display = "flex";
    document.getElementById("register").style.display = "none";
}

function closeSignIn() {

    let sign_bar = document.getElementsByClassName("sign-bar")[0];
    sign_bar.style.display = "none";
    sign_bar.id = "login-open";

    document.getElementById("login").style.display = "flex";
    document.getElementById("register").style.display = "none";
}

function signInOrUp() {

    let sign_bar = document.getElementsByClassName("sign-bar")[0];

    if (sign_bar.id === "login-open") {
        sign_bar.id = "register-open";
        document.getElementById("login").style.display = "none";
        document.getElementById("register").style.display = "flex";
    }
    else if (sign_bar.id === "register-open") {
        sign_bar.id = "login-open";
        document.getElementById("login").style.display = "flex";
        document.getElementById("register").style.display = "none";
    }
}

// Ajax

function login(form) {

    let request = new XMLHttpRequest();

    request.onreadystatechange = function() {
        if (this.readyState === 4 && this.status === 200) {

            if (this.responseText === "success") {
                location.replace("/pages/feed.php");
            }
        }
    }

    let data = {
        username: form.username.value,
        password: form.password.value
    }

    sendRequest(request, "POST", "/actions/login.php", data);
}

function check_passwords(form) {

}

function register(form) {

    let request = new XMLHttpRequest();

    request.onreadystatechange = function() {
        if (this.readyState === 4 && this.status === 200) {

            if (this.responseText === "success") {
                location.replace("/pages/feed.php");
            }
            else {

            }
        }
    }

    let data = {
        username: form.username.value,
        email: form.email.value,
        password: form.password.value,
        password2: form.password2.value
    }

}

function sendRequest(request, method, url, data) {

    // let request = new XMLHttpRequest();

    if (method === "GET") {
        request.open("get", url + encodeForAjax(data) , true);
        request.send();
    }
    else if (method === "POST") {
        request.open("post", url, true);
        request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        request.send(encodeForAjax(data));
    }
}

function encodeForAjax(data) {
    return Object.keys(data).map(function(k) {
        return encodeURIComponent(k) + "=" + encodeURIComponent(data[k])
    }).join("&");
}