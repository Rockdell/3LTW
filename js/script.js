function upvoteAction(doc) {

    postID = this.id.match(/upvote(\d+)/)[1];

    if (this.checked) {
        postVote("add", postID, 1);

        doc.getElementById("staticUp" + postID).id = "movingUp" + postID;

        if((mvDown = doc.getElementById("movingDown" + postID)) != null)
            mvDown.id = "staticDown" + postID;

        let associatedDownvote = doc.getElementById("downvote" + postID);
        associatedDownvote.checked = false;
    }
    else {
        postVote("del", postID, 1);
        if (doc.getElementById("movingUp" + postID) !== null)
            doc.getElementById("movingUp" + postID).id = "staticUp" + postID;
    }
}

function downvoteAction(doc) {

    postID = this.id.match(/downvote(\d+)/)[1];

    if (this.checked) {
        postVote("add", postID, 0);

        doc.getElementById("staticDown" + postID).id = "movingDown" + postID;

        if((mvUp = doc.getElementById("movingUp" + postID)) != null)
            mvUp.id = "staticUp" + postID;

        let associatedUpvote = doc.getElementById("upvote" + postID);
        associatedUpvote.checked = false;
    }
    else {
        postVote("del", postID, 0);
        if (doc.getElementById("movingDown" + postID) !== null)
            doc.getElementById("movingDown" + postID).id = "staticDown" + postID;
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

// Media queries
let maxWidth = window.matchMedia("(max-width: 1024px)");

if (maxWidth.matches) {

    let feed = document.querySelector("#feed-page");
    let profile = document.querySelector("#profile-page");
    let post = document.querySelector("#post-page");

    if (feed != null) {
        document.querySelector("header #settings-btn").style.display = "none";
    }
    else if (profile != null) {
        document.querySelector("header #write-btn").style.display = "none";
    }
    else if (post != null) {
        document.querySelector("header #search-btn").style.display = "none";
        document.querySelector("header #write-btn").style.display = "none";
        document.querySelector("header #settings-btn").style.display = "none";
    }

    let user_bar = document.querySelector("#user-bar button");
    
    if (user_bar != null) {
        document.querySelector("header .logout-btn").style.display = "none";
        document.querySelector("#user-bar").style.display = "none";
    }
    else {
        document.querySelector("header #sign-btn").style.display = "none";

        if (profile != null)
            document.querySelector("#user-bar").style.display = "none";
        else
            document.querySelector("header .logout-btn").style.display = "none";
    }

    let search_bar = document.querySelector("#search-bar");

    if (search_bar)
        search_bar.classList.add("modal");

    let profile_bar = document.querySelector("#profile-bar");

    if (profile_bar)
        profile_bar.classList.add("modal");

    let newpost_bar = document.querySelector("#newpost-bar"); 

    if (newpost_bar)
        newpost_bar.classList.add("modal");
}

// Handle click
window.onclick = (e) => {
    if (e.target.id == "dim-mask") {
        document.querySelectorAll(".modal").forEach((modal) => {
            modal.style.display = "none";
            modal.classList.remove("pop");
            modal.classList.remove("one");
            modal.classList.remove("two");
        });

        document.querySelector("#dim-mask").classList.remove("dim");
    }
}

// Open buttons
document.querySelectorAll(".open-btn").forEach((openButton) => {
    openButton.onclick = (e) => {
        e.preventDefault();

        let modal;

        switch (openButton.id) {
            case "sign-btn":
                modal = document.querySelector("#sign-bar");
                break;
            case "logout-btn":

            case "write-btn":
                modal = document.querySelector("#newpost-bar");
                break;
            case "settings-btn":
                modal = document.querySelector("#settings-bar");
                break;
            case "search-btn":
                modal = document.querySelector("#search-bar");
                break;
            case "profile-btn":
                modal = document.querySelector("#profile-bar");
                break;
        }

        if (modal == null)
            return;

        modal.style.display = "block";

        modal.classList.add("pop");
        modal.classList.add("one");

        let one = modal.querySelector(".one");
        if (one != null) one.style.display = "flex";

        let two = modal.querySelector(".two");
        if (two != null) two.style.display = "none";

        document.querySelector("#dim-mask").classList.add("dim");
    }
});

// Close buttons
document.querySelectorAll(".close-btn").forEach((closeButton) => {
    closeButton.onclick = (e) => {
        e.preventDefault();

        let modal = closeButton.parentElement;

        modal.style.display = "none";
        modal.classList.remove("pop");
        modal.classList.remove("one");
        modal.classList.remove("two");
    
        document.querySelector("#dim-mask").classList.remove("dim");
    }
});

// Switch buttons
document.querySelectorAll(".switch-btn").forEach((switchButton) => {
    switchButton.onclick = (e) => {
        e.preventDefault();

        let modal = switchButton.parentElement.parentElement.parentElement;
    
        if (modal.classList.contains("one")) {
            modal.classList.remove("one");
            modal.classList.add("two");
    
            modal.querySelector(".one").style.display = "none";
            modal.querySelector(".two").style.display = "flex";
        }
        else if (modal.classList.contains("two")) {
            modal.classList.remove("two");
            modal.classList.add("one");
    
            modal.querySelector(".one").style.display = "flex";
            modal.querySelector(".two").style.display = "none";
        }
    }
});

// New Post

let openCloseNewStory = () => {

    let newpost_bar = document.querySelector("#newpost-bar");

    if (newpost_bar.classList.contains("newStory-open")) {
        newpost_bar.classList.remove("unfold");
        newpost_bar.classList.add("conceal");

        setTimeout(() => { 
            newpost_bar.style.height = "4.5em";
            newpost_bar.classList.remove("conceal");
        }, 200);

        newpost_bar.classList.remove("newStory-open");

        document.getElementById("story-form").style.display = "none";
    }
    else if (newpost_bar.classList.contains("newImage-open")) {
        newpost_bar.classList.remove("newImage-open");
        newpost_bar.classList.add("newStory-open");

        document.getElementById("story-form").style.display = "initial";
        document.getElementById("image-form").style.display = "none";
    }
    else {
        newpost_bar.classList.add("unfold");
            
        setTimeout(() => { 
            newpost_bar.style.height = "30em";
            document.getElementById("story-form").style.display = "initial";
        }, 200);

        newpost_bar.classList.add("newStory-open");
    }
}

let openCloseNewImage= () => {

    let newpost_bar = document.querySelector("#newpost-bar");

    if (newpost_bar.classList.contains("newStory-open")) {
        newpost_bar.classList.remove("newStory-open");
        newpost_bar.classList.add("newImage-open");

        document.getElementById("image-form").style.display = "initial";
        document.getElementById("story-form").style.display = "none";
    }
    else if (newpost_bar.classList.contains("newImage-open")) {
        newpost_bar.classList.remove("unfold");
        newpost_bar.classList.add("conceal");

        setTimeout(() => { 
            newpost_bar.style.height = "4.5em";
            newpost_bar.classList.remove("conceal");
        }, 200);

        newpost_bar.classList.remove("newImage-open");

        document.getElementById("image-form").style.display = "none";
    }
    else {
        newpost_bar.classList.add("unfold");

        setTimeout(() => { 
            newpost_bar.style.height = "30em";
            document.getElementById("image-form").style.display = "initial";
        }, 200);

        newpost_bar.classList.add("newImage-open");
    }

}

// Search

let searchBar = document.querySelector("#search-bar");

if (searchBar) {

    let setParam = (category, value) => {
        let url = new URL(window.location.href);

        if (value != "")
            url.searchParams.set(category, value);
        else
            url.searchParams.delete(category);

        window.location.replace(url);
    }

    searchBar.querySelector("input[type=search]").onsearch = (e) => {
        e.preventDefault();
        setParam("search", e.srcElement.value);
    }

    searchBar.querySelector("#points").onclick = (e) => {
        e.preventDefault();
        setParam("sort", "points");
    }

    searchBar.querySelector("#comments").onclick = (e) => {
        e.preventDefault();
        setParam("sort", "comments");
    }

    searchBar.querySelector("#date").onclick = (e) => {
        e.preventDefault();
        setParam("sort", "date");
    }

    searchBar.querySelector("#asc").onclick = (e) => {
        e.preventDefault();
        setParam("order", "asc");
    }

    searchBar.querySelector("#desc").onclick = (e) => {
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

let logoutButtons = document.querySelectorAll(".logout-btn");

logoutButtons.forEach((logoutButton) => {

    logoutButton.onclick = (e) => {
        e.preventDefault();

        let callback = (response) => {
            if (response === "success")
                setTimeout(window.location.reload(), 1000);
        }
        
        sendRequest("/actions/logout.php", {}, callback);
    }
});

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

// Delete Post

let deletePost = document.querySelector("#delete-post");

if (deletePost) {

    deletePost.onclick = (e) => {
        e.preventDefault();

        let postID = deletePost.closest("article").classList[2];

        // deleteConfirmation("post");

        let data = {
            postID: postID,
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
                setTimeout(window.location.replace("/pages/feed.php"), 1000);  
        }

        sendRequest("/actions/deletePost.php", data, callback);
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

// Delete Confirmation

let deleteConfirmation = (message) => {

    let confirmation = document.querySelector("#delete-post-confirmation");

    if (confirmation) {
        console.log("Are you sure you want to delete this " + message + "?");
        // confirmation.textContent = message;
        confirmation.style.display = "block";
        // confirmation.classList.add("fade");

        setTimeout(() => {
            // confirmation.classList.remove("fade");
            confirmation.style.display = "none";
            // confirmation.textContent = "";
        }, 2000);
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

// Upload
let uploadPicture = (picture, name, callback) => {

    let request = new XMLHttpRequest();

    let formData = new FormData();
    formData.append("picture", picture, name);

    request.open("post", "/actions/upload.php", true);
    request.send(formData);

    request.addEventListener("load", () => callback(request.responseText));
}

// Request
let sendRequest = (url, data, callback) => {

    let request = new XMLHttpRequest();

    request.open("post", url, true);
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    request.send(encodeForAjax(data));
    request.addEventListener("load", () => callback(request.responseText));
}

// Encode
let encodeForAjax = (data) => {
    return Object.keys(data).map(function(k) {
        return encodeURIComponent(k) + "=" + encodeURIComponent(data[k])
    }).join("&");
}