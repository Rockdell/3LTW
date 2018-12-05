function upvoteAction(doc) {

    postID = this.id.match(/upvote(\d+)/)[1];

    if (this.checked) {
        //postVote($postID, $userID, 1);
        postVote(postID,1);
        console.log("up");

        doc.getElementById('staticUp' + postID).id = 'movingUp' + postID;

        if((mvDown = doc.getElementById('movingDown' + postID)) != null)
            mvDown.id = 'staticDown' + postID;

        let associatedDownvote = doc.getElementById('downvote' + postID);
        console.log(associatedDownvote);
        associatedDownvote.checked = false;
    }
    else {
        console.log("delete up");
        doc.getElementById('movingUp' + postID).id = 'staticUp' + postID;
        //removePostVote($postID, $userID)
    }
}

function postVote(postID, value) {

    let request = new XMLHttpRequest();
    console.log("hey");
    request.onreadystatechange = function() {
        if (this.readyState === 4 && this.status === 200) {

            if (this.responseText === "success") {
                location.replace("/pages/feed.php");
            }
        }
    }

    let data = {
        postID: postID,
        value: value,
    }
    
    sendRequest(request, "POST", "/actions/postVote.php", data);
}

function downvoteAction(doc) {

    postID = this.id.match(/downvote(\d+)/)[1];

    if (this.checked) {
        //postVote($postID, $userID, 1)
        console.log("down");

        doc.getElementById('staticDown' + postID).id = 'movingDown' + postID;

        if((mvUp = doc.getElementById('movingUp' + postID)) != null)
            mvUp.id = 'staticUp' + postID;

        let associatedUpvote = doc.getElementById('upvote' + postID);
        console.log(associatedUpvote);
        associatedUpvote.checked = false;
    }
    else {
        console.log("delete down");
        doc.getElementById('movingDown' + postID).id = 'staticDown' + postID;
        //removePostVote($postID, $userID)
    }
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