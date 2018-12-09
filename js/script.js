function upvoteAction(doc) {

    postID = this.id.match(/upvote(\d+)/)[1];

    if (this.checked) {
        postVote('add',postID,1);

        doc.getElementById('staticUp' + postID).id = 'movingUp' + postID;

        if((mvDown = doc.getElementById('movingDown' + postID)) != null)
            mvDown.id = 'staticDown' + postID;

        let associatedDownvote = doc.getElementById('downvote' + postID);
        associatedDownvote.checked = false;
    }
    else {
        postVote('del',postID,1);
        if (doc.getElementById('movingUp' + postID) !== null)
            doc.getElementById('movingUp' + postID).id = 'staticUp' + postID;
    }
}

function downvoteAction(doc) {

    postID = this.id.match(/downvote(\d+)/)[1];

    if (this.checked) {
        postVote('add',postID,0);

        doc.getElementById('staticDown' + postID).id = 'movingDown' + postID;

        if((mvUp = doc.getElementById('movingUp' + postID)) != null)
            mvUp.id = 'staticUp' + postID;

        let associatedUpvote = doc.getElementById('upvote' + postID);
        associatedUpvote.checked = false;
    }
    else {
        postVote('del',postID,0);
        if (doc.getElementById('movingDown' + postID) !== null)
            doc.getElementById('movingDown' + postID).id = 'staticDown' + postID;
    }
}

function postVote(action, postID, value) {

    let data = {
        action: action,
        postID: postID,
        value: value,
    }

    let callback = (response) => {
        if (response == "NOT SIGNED IN!" || response == "failure")
            console.log(response);
        else
            document.querySelector("#post-info #pp" + postID).innerHTML = response;
    }
    
    sendRequest("/actions/postVote.php", data, callback);
}

let upvotes = document.querySelectorAll('#post-info input[id^="upvote"]');
let downvotes = document.querySelectorAll('#post-info input[id^="downvote"]');

for (let i = 0; i < upvotes.length; i++) {
    upvotes[i].addEventListener('click', upvoteAction.bind(upvotes[i], document));
}

for (let i = 0; i < downvotes.length; i++) {
    downvotes[i].addEventListener('click', downvoteAction.bind(downvotes[i], document));
}

// Open and close buttons

let open_btn = document.querySelector(".open-btn");

if (open_btn) {
    open_btn.onclick = () => {

        switch (open_btn.id) {
            case "sign-btn":
                openSign();
                break;
            case "settings-btn":
                openSettings();
                break;
        }

        document.querySelector("#dim-mask").classList.add("dim");
    }
}

let close_btn = document.querySelector(".close-btn");

if (close_btn) {
    close_btn.onclick = () => {
        switch (close_btn.parentElement.id) {
            case "sign-bar":
                closeSign();
                break;
            case "settings-bar":
                closeSettings();
                break;
        }

        document.querySelector("#dim-mask").classList.remove("dim");
    }
}

// Sign

function openSign() {

    // Reset preview
    document.querySelector("#register-form img").src = "/img/users/unknown.png";

    let sign_bar = document.getElementById("sign-bar");
    sign_bar.style.display = "block";

    sign_bar.classList.add("pop");
    sign_bar.classList.add("login-open");

    document.getElementById("login-form").style.display = "flex";
    document.getElementById("register-form").style.display = "none";
}

function closeSign() {

    let sign_bar = document.getElementById("sign-bar");
    sign_bar.style.display = "none";

    sign_bar.classList.remove("pop");
    sign_bar.classList.remove("login-open");
    sign_bar.classList.remove("register-open");
}

function signInOrUp() {

    // Reset preview
    document.querySelector("#register-form img").src ="/img/users/unknown.png";

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

// New Post

let openCloseNewStory = () => {

    let newPost_bar = document.getElementById("newPost-bar");

    if (newPost_bar.classList.contains("newStory-open")) {
        newPost_bar.classList.remove("unfold");
        newPost_bar.classList.add("conceal");
        setTimeout(() => { 
            newPost_bar.style = "height: 4.5em";
            newPost_bar.classList.remove("conceal");
        }, 200);

        newPost_bar.classList.remove("newStory-open");

        document.getElementById("newStory-form").style.display = "none";
    }
    else if (newPost_bar.classList.contains("newImage-open")) {
        newPost_bar.classList.remove("newImage-open");
        newPost_bar.classList.add("newStory-open");

        document.getElementById("newStory-form").style.display = "initial";
        document.getElementById("newImage-form").style.display = "none";
    }
    else {
        newPost_bar.classList.add("unfold");
        setTimeout(() => { 
            newPost_bar.style = "height: 30em";
            document.getElementById("newStory-form").style.display = "initial";
        }, 200);

        newPost_bar.classList.add("newStory-open");
    }
}

let openCloseNewImage= () => {

    let newPost_bar = document.getElementById("newPost-bar");

    if (newPost_bar.classList.contains("newStory-open")) {
        newPost_bar.classList.remove("newStory-open");
        newPost_bar.classList.add("newImage-open");

        document.getElementById("newImage-form").style.display = "initial";
        document.getElementById("newStory-form").style.display = "none";
    }
    else if (newPost_bar.classList.contains("newImage-open")) {
        newPost_bar.classList.remove("unfold");
        newPost_bar.classList.add("conceal");
        setTimeout(() => { 
            newPost_bar.style = "height: 4.5em";
            newPost_bar.classList.remove("conceal");
        }, 200);

        newPost_bar.classList.remove("newImage-open");

        document.getElementById("newImage-form").style.display = "none";
    }
    else {
        newPost_bar.classList.add("unfold");
        setTimeout(() => { 
            newPost_bar.style = "height: 30em";
            document.getElementById("newImage-form").style.display = "initial";
        }, 200);

        newPost_bar.classList.add("newImage-open");
    }

}

// Settings

let openSettings = () => {

    document.querySelector("#update-profile img").src = "/img/users/unknown.png";

    let settings_bar = document.getElementById("settings-bar");
    settings_bar.style.display = "block";

    settings_bar.classList.add("pop");
    settings_bar.classList.add("profile-open");

    document.getElementById("update-profile").style.display = "flex";
    document.getElementById("update-password").style.display = "none";
}

let closeSettings = () => {

    let settings_bar = document.getElementById("settings-bar");
    settings_bar.style.display = "none";

    settings_bar.classList.remove("pop");
    settings_bar.classList.remove("profile-open");
    settings_bar.classList.remove("password-open");
}

let profileOrPassword = () => {

    document.querySelector("#update-profile img").src = "/img/users/unknown.png";

    let settings_bar = document.getElementById("settings-bar");

    if (settings_bar.classList.contains("profile-open")) {
        settings_bar.classList.remove("profile-open");
        settings_bar.classList.add("password-open");

        document.getElementById("update-profile").style.display = "none";
        document.getElementById("update-password").style.display = "flex";
    }
    else if (settings_bar.classList.contains("password-open")) {
        settings_bar.classList.remove("password-open");
        settings_bar.classList.add("profile-open");

        document.getElementById("update-profile").style.display = "flex";
        document.getElementById("update-password").style.display = "none";
    }
}

// Error

let errorInput = (element) => {

    element.value = "";

    if (!element.classList.contains("shake-pulse")) {
        element.classList.add("shake-pulse");

        setTimeout(() => { 
            element.classList.remove("shake-pulse");
        }, 750);
    }
}

// Warning

let warnUser = (message) => {

    let warning = document.querySelector("#warning");

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

// Search

let searchBar = document.querySelector(".search-bar");

if (searchBar) {

    let searchPosts = searchBar.querySelector("input[type=search]");

    searchPosts.onsearch = (e) => {
        e.preventDefault();

        let url = new URL(window.location.href);

        if (e.srcElement.value !== "")
            url.searchParams.set("search", encodeURIComponent(e.srcElement.value));
        else
            url.searchParams.delete("search");

        window.location.replace(url);
    }

    let setParam = (category, value) => {
        let url = new URL(window.location.href);
        url.searchParams.set(category, value);

        window.location.replace(url);
    }

    let sortPoints = searchBar.querySelector("#points");

    sortPoints.onclick = (e) => {
        e.preventDefault();
        setParam("sort", "points");
    }

    let sortComments = searchBar.querySelector("#comments");

    sortComments.onclick = (e) => {
        e.preventDefault();
        setParam("sort", "comments");
    }

    let sortDate = searchBar.querySelector("#date");

    sortDate.onclick = (e) => {
        e.preventDefault();
        setParam("sort", "date");
    }

    let orderAsc = searchBar.querySelector("#asc");

    orderAsc.onclick = (e) => {
        e.preventDefault();
        setParam("order", "asc");
    }

    let orderDesc = searchBar.querySelector("#desc");

    orderDesc.onclick = (e) => {
        e.preventDefault();
        setParam("order", "desc");
    }
}

// Login

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
                warnUser(response);

                loginForm.querySelectorAll("input").forEach((input) => {
                   errorInput(input);
                });
            }
        }
    
        sendRequest("/actions/login.php", data, callback); 
    }
}

// Logout

let logoutButton = document.querySelector("#logout-btn");

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

// Register

let registerForm = document.querySelector("#register-form");

if (registerForm) {

    registerForm.querySelector("input[name='picture']").onchange = (e) => {
        e.preventDefault();

        let picture = registerForm.querySelector("input[name='picture']");
        let picturePreview = registerForm.querySelector("img");

        if (picture.files.length > 0)
            picturePreview.src = URL.createObjectURL(picture.files[0]);
    }

    registerForm.onsubmit = (e) => {

        e.preventDefault();

        let picture = registerForm.querySelector("input[name='picture']");
        let userID = registerForm.querySelector("input[name='userID']").value;
        let username = registerForm.querySelector("input[name='username']").value;
        let mail = registerForm.querySelector("input[name='mail']").value;
        let password = registerForm.querySelector("input[name='password']").value;
        let chkpassword = registerForm.querySelector("input[name='chkpassword']").value;

        let data = {
            userID: userID,
            username: username,
            mail: mail,
            password: password,
            chkpassword: chkpassword
        }

        let callback = (response) => {

            if (response === "success") {

                let callback_upload = (response) => {
                    if (response === "success")
                        setTimeout(window.location.reload(), 1000);
                    else
                        warnUser(response);
                }

                if (picture.files.length > 0)
                    uploadPicture(picture.files[0], "users_" + userID, callback_upload);
                else
                    setTimeout(window.location.reload(), 1000);
            }
            else {
                warnUser(response);

                registerForm.querySelectorAll("input").forEach((input) => {
                    errorInput(input);
                });
            }
        }

        sendRequest("/actions/register.php", data, callback);
    }
}

// Create New Story Post

let createNewStoryPost = document.querySelector("#newStory-form");

if (createNewStoryPost) {

    createNewStoryPost.onsubmit = (e) => {
        e.preventDefault();

        let title = createNewStoryPost.querySelector("input[name='postTitle']").value;
        let content = createNewStoryPost.querySelector("textarea[name='postContent']").value;

        let data = {
            title: title,
            content: content
        }

        let callback = (response) => {

            if (response === "failure" || response === "NOT SIGNED IN!") {
                // warnUser(response);
                console.log(response);

                // updateProfile.querySelectorAll("input, textarea").forEach((input) => {
                //    errorInput(input);
                // });
            }
            else
                setTimeout(window.location.reload(), 1000);  
        }

        sendRequest("/actions/createNewPost.php", data, callback);
    }
}

// Create new Image Post

let createNewImagePost = document.querySelector("#newImage-form");

if (createNewImagePost) {

    createNewImagePost.querySelector("input[name='picture']").onchange = (e) => {
        e.preventDefault();

        let picture = createNewImagePost.querySelector("input[name='picture']");
        let picturePreview = createNewImagePost.querySelector("img");

        if (picture.files.length > 0)
            picturePreview.src = URL.createObjectURL(picture.files[0]);
    }

    createNewImagePost.onsubmit = (e) => {
        e.preventDefault();

        let title = createNewImagePost.querySelector("input[name='postTitle']").value;
        let picture = createNewImagePost.querySelector("input[name='picture']");

        let data = {
            title: title,
            content: ""
        }

        let callback = (response) => {

            if (response === "failure" || response === "NOT SIGNED IN!") {
                // warnUser(response);
                console.log(response);

                // updateProfile.querySelectorAll("input, textarea").forEach((input) => {
                //    errorInput(input);
                // });

            }
            else {
                postID = parseInt(response);
                
                let callback_upload = (response) => {
                    if (response === "success")
                        setTimeout(window.location.reload(), 1000);
                    else
                        console.log(response);
                        // warnUser(response);
                }

                if (picture.files.length > 0)
                    uploadPicture(picture.files[0], "posts_" + postID, callback_upload);

                // setTimeout(window.location.reload(), 1000);
            }
        }

        sendRequest("/actions/createNewPost.php", data, callback);
    }
}

// Update profile

let updateProfile = document.querySelector("#update-profile");

if (updateProfile) {

    updateProfile.querySelector("input[name='picture']").onchange = (e) => {
        e.preventDefault();

        let picture = updateProfile.querySelector("input[name='picture']");
        let picturePreview = updateProfile.querySelector("img");

        if (picture.files.length > 0)
            picturePreview.src = URL.createObjectURL(picture.files[0]);
    }

    updateProfile.onsubmit = (e) => {
        e.preventDefault();

        let picture = updateProfile.querySelector("input[name='picture']");
        let username = updateProfile.querySelector("input[name='username']").value;
        let mail = updateProfile.querySelector("input[name='mail']").value;
        let bio = updateProfile.querySelector("textarea[name='bio']").value;

        let data = {
            username: username,
            mail: mail,
            bio: bio
        }

        let callback = (response) => {

            if (response === "success") {

                let callback_upload = (response) => {
                    if (response === "success")
                        setTimeout(window.location.reload(), 1000);
                    else
                        warnUser(response);
                }

                if (picture.files.length > 0)
                    uploadPicture(picture.files[0], "users_", callback_upload);
                else
                    setTimeout(window.location.reload(), 1000);
            }
            else {
                warnUser(response);

                updateProfile.querySelectorAll("input, textarea").forEach((input) => {
                   errorInput(input);
                });
            }
        }

        sendRequest("/actions/updateProfile.php", data, callback);
    }
}

// Update password

let updatePassword = document.querySelector("#update-password");

if (updatePassword) {

    updatePassword.onsubmit = (e) => {
        e.preventDefault();

        let password = updatePassword.querySelector("input[name='password']").value;
        let chkpassword = updatePassword.querySelector("input[name='chkpassword']").value;

        let data = {
            password: password,
            chkpassword: chkpassword
        }

        let callback = (response) => {

            if (response === "success") {
                setTimeout(window.location.reload(), 1000);
            }
            else {
                warnUser(response);

                updatePassword.querySelectorAll("input").forEach((input) => {
                   errorInput(input);
                });
            }
        }

        sendRequest("/actions/updatePassword.php", data, callback);
    }
}

// Upload

let uploadPicture = (picture, name, callback) => {

    let request = new XMLHttpRequest();

    let formData = new FormData();
    formData.append("picture", picture, name);

    request.open("post", "/actions/upload.php", true);
    request.send(formData);

    request.addEventListener("load", () => callback(request.responseText));
}

// Ajax

let requestGET = (url, data) => {

    let request = new XMLHttpRequest();

    request.open("get", url + "?" + encodeForAjax(data), true);
    request.send();
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