let postUpvotes = document.querySelectorAll('#post-info input[id="upvote"]');
let postDownvotes = document.querySelectorAll('#post-info input[id="downvote"]');

postUpvotes.forEach((postUpvote) => {
    postUpvote.onclick = () => { upvoteAction(postUpvote, "post") };
});

postDownvotes.forEach((postDownvote) => {
    postDownvote.onclick = () => { downvoteAction(postDownvote, "post"); };
});

let commentUpvotes = document.querySelectorAll('#comment-info input[id="upvote"]');
let commentDownvotes = document.querySelectorAll('#comment-info input[id="downvote"]');

commentUpvotes.forEach((commentUpvote) => {
    commentUpvote.onclick = () => { upvoteAction(commentUpvote, "comment") };
});

commentDownvotes.forEach((commentDownvote) => {
    commentDownvote.onclick = () => { downvoteAction(commentDownvote, "comment"); };
});

function upvoteAction(up, type) {

    let parent = up.parentElement.parentElement;
    let componentID;
    if (type === "post")
        componentID = up.closest("article").getAttribute("data-id");
    else if (type === "comment")
        componentID = up.closest("article").getAttribute("data-commentID");

    if (up.checked) {

        if (type === "post")
            postVote("add", componentID, 1);
        else if (type === "comment")
            commentVote("add", componentID, 1);

        parent.querySelector("i[id='staticUp']").id = "movingUp";

        //Associated Downvote
        if ((mvDown = parent.querySelector("i[id='movingDown']")) != null)
            mvDown.id = "staticDown";

        // Uncheck the associated downvote
        parent.querySelector("label input[id='downvote']").checked = false;
    }
    else {
        if (type === "post")
            postVote("del", componentID, 1);
        else if (type === "comment")
            commentVote("del", componentID, 1);;

        if ((mvUp = parent.querySelector("i[id='movingUp']")) != null)
            mvUp.id = "staticUp";
    }
}

function downvoteAction(down, type) {

    let parent = down.parentElement.parentElement;
    let componentID;
    if (type === "post")
        componentID = down.closest("article").getAttribute("data-id");
    else if (type === "comment")
        componentID = down.closest("article").getAttribute("data-commentID");

    if (down.checked) {
        if (type === "post")
            postVote("add", componentID, 0);
        else if (type === "comment")
            commentVote("add", componentID, 0);

        parent.querySelector("i[id='staticDown']").id = "movingDown";

        //Associated Upvote
        if ((mvUp = parent.querySelector("i[id='movingUp']")) != null)
            mvUp.id = "staticUp";

        // Uncheck the associated upvote
        parent.querySelector("label input[id='upvote']").checked = false;
    }
    else {
        if (type === "post")
            postVote("del", componentID, 0);
        else if (type === "comment")
            commentVote("del", componentID, 0);

        if ((mvDown = parent.querySelector("i[id='movingDown']")) != null)
            mvDown.id = "staticDown";
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
            document.querySelector("article[data-id=\'" + postID + "\'] #post-info #dp").innerHTML = response;
    }

    sendRequest("/actions/postVote.php", data, callback);
}

function commentVote(action, commentID, value) {

    let data = {
        action: action,
        commentID: commentID,
        value: value,
    }

    let callback = (response) => {
        if (response == "NOT SIGNED IN!" || response == "failure")
            console.log(response);
        else
            document.querySelector("article[data-commentID=\'" + commentID + "\'] #comment-info #dp").innerHTML = response;
    }

    sendRequest("/actions/commentVote.php", data, callback);
}

// Media queries
let maxWidth = window.matchMedia("(max-width: 768px)");

if (maxWidth.matches) {

    if (document.querySelector("#post-page") != null) {
        document.querySelector("header #search-btn").style.display = "none";
    }
    
    if (document.querySelector("#user-bar button") != null) {
        document.querySelector("#user-bar").style.display = "none";
    }
    else {
        document.querySelector("header #sign-btn").style.display = "none";
    }

    let search_bar = document.querySelector("#search-bar");
    if (search_bar)
        search_bar.classList.add("modal");
}

// Comment colors
// let colorIndex = 0;
document.querySelectorAll("#list-comments .comment").forEach((comment) => {
    // let colors = ["firebrick", "#001f3f", "#0074D9", "green", "#FFDC00", "#FF851B", "#FF4136"];
    // comment.style.borderLeft = "2px " + colors[colorIndex] + " solid";
    // comment.style.borderTop = "1px " + colors[colorIndex++] + " solid";
    comment.style.borderLeft = "2px " + "black" + " solid";
    comment.style.borderTop = "1px " + "black" + " solid";

    // if (colorIndex >= colors.length) colorIndex = 0;
})

document.querySelectorAll("#list-comments #sub-comments .comment").forEach((comment) => {
    // let colors = ["firebrick", "#001f3f", "#0074D9", "green", "#FFDC00", "#FF851B", "#FF4136"];
    // comment.style.borderLeft = "2px " + colors[colorIndex] + " solid";
    // comment.style.borderTop = "1px " + colors[colorIndex++] + " solid";
    comment.style.borderLeft = "2px " + "gray" + " solid";
    comment.style.borderTop = "1px " + "gray" + " solid";

    // if (colorIndex >= colors.length) colorIndex = 0;
})


// Handle click
window.onclick = (e) => {
    if (e.target.id == "dim-mask") {
        document.querySelectorAll(".modal").forEach((modal) => {
            modal.style.display = "none";
            modal.classList.remove("pop");
            modal.classList.remove("one");
            modal.classList.remove("two");

            // document.querySelector("#popup-picture").removeAttribute('src');
            document.querySelector("body").style.overflow = "visible";
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
        
        document.querySelector("body").style.overflow = "hidden";

        modal.style.display = "flex";

        modal.classList.add("pop");
        modal.classList.add("one");

        let one = modal.querySelector(".one");
        if (one != null) one.style.display = "flex";

        let two = modal.querySelector(".two");
        if (two != null) two.style.display = "none";

        document.querySelector("#dim-mask").classList.add("dim");
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
    document.querySelector(".imageBtn").disabled = true;
    document.querySelector(".storyBtn").disabled = true;

    if (newpost_bar.classList.contains("newStory-open")) {
        newpost_bar.classList.remove("unfold");
        newpost_bar.classList.add("conceal");

        setTimeout(() => {
            // newpost_bar.style.height = "4.5em";
            newpost_bar.classList.remove("conceal");
            document.querySelector(".imageBtn").disabled = false;
            document.querySelector(".storyBtn").disabled = false;
        }, 190);

        newpost_bar.classList.remove("newStory-open");

        document.getElementById("story-form").style.display = "none";
    }
    else if (newpost_bar.classList.contains("newImage-open")) {
        newpost_bar.classList.remove("newImage-open");
        newpost_bar.classList.add("newStory-open");

        document.getElementById("story-form").style.display = "initial";
        document.getElementById("image-form").style.display = "none";
        document.querySelector(".imageBtn").disabled = false;
        document.querySelector(".storyBtn").disabled = false;
    }
    else {
        newpost_bar.classList.add("unfold");

        setTimeout(() => {
            // newpost_bar.style.height = "28em";
            document.getElementById("story-form").style.display = "initial";
            document.querySelector(".imageBtn").disabled = false;
            document.querySelector(".storyBtn").disabled = false;
        }, 190);

        newpost_bar.classList.add("newStory-open");
    }
}

let openCloseNewImage = () => {

    let newpost_bar = document.querySelector("#newpost-bar");
    document.querySelector(".imageBtn").disabled = true;
    document.querySelector(".storyBtn").disabled = true;

    if (newpost_bar.classList.contains("newStory-open")) {
        newpost_bar.classList.remove("newStory-open");
        newpost_bar.classList.add("newImage-open");

        document.getElementById("image-form").style.display = "initial";
        document.getElementById("story-form").style.display = "none";
        document.querySelector(".imageBtn").disabled = false;
        document.querySelector(".storyBtn").disabled = false;
    }
    else if (newpost_bar.classList.contains("newImage-open")) {
        newpost_bar.classList.remove("unfold");
        newpost_bar.classList.add("conceal");

        setTimeout(() => {
            // newpost_bar.style.height = "4.5em";
            newpost_bar.classList.remove("conceal");
            document.querySelector(".imageBtn").disabled = false;
            document.querySelector(".storyBtn").disabled = false;
        }, 190);

        newpost_bar.classList.remove("newImage-open");

        document.getElementById("image-form").style.display = "none";
    }
    else {
        newpost_bar.classList.add("unfold");

        setTimeout(() => {
            // newpost_bar.style.height = "28em";
            document.getElementById("image-form").style.display = "initial";
            document.querySelector(".imageBtn").disabled = false;
            document.querySelector(".storyBtn").disabled = false;
        }, 190);

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

        loginForm.querySelector("button[type=submit]").disabled = true;

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
        loginForm.querySelector("button[type=submit]").disabled = false;
    }
}

// Logout

let logoutButtons = document.querySelectorAll(".logout-btn");

logoutButtons.forEach((logoutButton) => {

    logoutButton.onclick = (e) => {
        e.preventDefault();

        let callback = (response) => {
            if (response === "success")
                setTimeout(window.location.replace("/pages/feed.php"), 1000);
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

        registerForm.querySelector("button[type=submit]").disabled = true;

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

                if (picture.files.length > 0) {
                    let picture_name = "users." + userID + picture.files[0].name.match(/(\.\w+$)/)[0];
                    uploadPicture(picture.files[0], picture_name, callback_upload);
                }
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
        registerForm.querySelector("button[type=submit]").disabled = false;
    }
}

// Post Images Popup

document.querySelectorAll("#list-posts .post-picture").forEach((postImage) => {
    postImage.onclick = (e) => {
        let modal = document.querySelector("#picture-modal");

        document.querySelector("#popup-picture").src = postImage.src;

        modal.style.display = "block";
        modal.classList.add("pop");

        document.querySelector("body").style.overflow = "hidden";
        document.querySelector("#dim-mask").classList.add("dim");
    }
});

// Create New Story Post

let createNewStoryPost = document.querySelector("#story-form");

if (createNewStoryPost) {

    createNewStoryPost.onsubmit = (e) => {
        e.preventDefault();
       
        createNewStoryPost.querySelector("button[type=submit]").disabled = true;

        let title = createNewStoryPost.querySelector("input[name='postTitle']");
        let content = createNewStoryPost.querySelector("textarea[name='postContent']");

        let data = {
            title: title.value,
            content: content.value
        }

        let callback = (response) => {

            if (isNaN(parseInt(response))) {
                errorInput(title);
                errorInput(content);
                warnUser(response);
            }
            else
                setTimeout(window.location.reload(), 1000);
        }

        sendRequest("/actions/createNewStoryPost.php", data, callback);
        createNewStoryPost.querySelector("button[type=submit]").disabled = false;
    }
}

// Create new Image Post

let createNewImagePost = document.querySelector("#image-form");

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

        createNewImagePost.querySelector("button[type=submit]").disabled = true;

        let title = createNewImagePost.querySelector("input[name='postTitle']");
        let picture = createNewImagePost.querySelector("input[name='picture']");

        let data = {
            title: title.value,
            content: ""
        }

        let callback = (response) => {

            if (isNaN(parseInt(response))) {
                errorInput(title);
                warnUser(response);
            }
            else {
                let newPostID = parseInt(response);

                let callback_upload = (response) => {
                    if (response === "success")
                        setTimeout(window.location.reload(), 1000);
                    else {
                        errorInput(title);
                        warnUser(response);

                        let dataDelete = { postID: newPostID }

                        let callback_receive_upload = (response) => {
                            if (response === "failure" || response === "NOT SIGNED IN!") {
                                warnUser(response);
                            }
                        }
                        sendRequest("/actions/deletePost.php", dataDelete, callback_receive_upload);
                    }

                }

                if (picture.files.length > 0) {
                    let picture_name = "posts." + newPostID + picture.files[0].name.match(/(\.\w+$)/)[0];
                    uploadPicture(picture.files[0], picture_name, callback_upload);
                }
            }
        }

        sendRequest("/actions/createNewImagePost.php", data, callback);
        createNewImagePost.querySelector("button[type=submit]").disabled = false;
    }
}

// Delete Post

let deletePost = document.querySelector("#delete-post");

if (deletePost) {
    let postID = deletePost.closest("article").getAttribute("data-id");
    console.log(postID);
    deletePost.onclick = (e) => {
        e.preventDefault();
        deleteConfirmation("post", postID);
    }
}

// Delete Comment

let deleteComment = document.querySelector("#delete-comment");

if (deleteComment) {
    // let commentID = deletePost.closest("article").classList[2]; TODO alter to fit comments needs
    deleteComment.onclick = (e) => {
        e.preventDefault();
        // deleteConfirmation("comment", commentID);
    }
}

// Delete User

let deleteUser = document.querySelector("#delete-user");

if (deleteUser) {

    deleteUser.onclick = (e) => {
        e.preventDefault();
        deleteConfirmation("user");
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

        updateProfile.querySelector("button[type=submit]").disabled = true;

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

                if (picture.files.length > 0) {
                    let picture_name = "users." + picture.files[0].name.match(/(\.\w+$)/)[0];
                    uploadPicture(picture.files[0], picture_name, callback_upload);
                }
                else {
                    setTimeout(window.location.reload(), 1000);
                }
            }
            else {
                warnUser(response);

                updateProfile.querySelectorAll("input, textarea").forEach((input) => {
                   errorInput(input);
                });
            }
        }

        sendRequest("/actions/updateProfile.php", data, callback);
        updateProfile.querySelector("button[type=submit]").disabled = false;
    }
}

// Update password

let updatePassword = document.querySelector("#update-password");

if (updatePassword) {

    updatePassword.onsubmit = (e) => {
        e.preventDefault();

        updatePassword.querySelector("button[type=submit]").disabled = true;

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
        updatePassword.querySelector("button[type=submit]").disabled = false;
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

let deleteConfirmation = (component, postID, commentID) => {

    let confirmation = document.querySelector("#delete-" + component + "-confirmation");

    if (confirmation) {

        confirmation.style.display = "block";
        confirmation.classList.add("pop");
        document.querySelector("#dim-mask").classList.add("dim");

        let yesBtn = document.querySelector("#delete-" + component + "-confirmation #yes");
        let noBtn = document.querySelector("#delete-" + component + "-confirmation #no");

        yesBtn.onclick = (e) => {

            if (component === "post") {

                let data = { postID: postID }

                let callback = (response) => {
                    if (response === "failure" || response === "NOT SIGNED IN!")
                        console.log(response);

                    setTimeout(window.location.replace("/pages/feed.php"), 1000);
                }
                sendRequest("/actions/deletePost.php", data, callback);

            } else if (component === "comment") {

                let data = { commentID: commentID }

                let callback = (response) => {
                    if (response === "failure" || response === "NOT SIGNED IN!")
                        console.log(response);
                    else
                        setTimeout(window.location.replace("/pages/post.php?id=" + postID), 1000);
                }
                sendRequest("/actions/deleteComment.php", data, callback);

            } else if (component === "user") {

                let callback = (response) => {

                    if (response === "failure" || response === "NOT SIGNED IN!")
                        console.log(response);
                    else {
                        let callback = (response) => {
                            if (response === "success") {
                                setTimeout(window.location.replace("/pages/feed.php"), 1000);
                            }
                        }
                        sendRequest("/actions/logout.php", {}, callback);
                    }
                }

                sendRequest("/actions/deleteUser.php", {}, callback);
            }

            confirmation.style.display = "none";
        }

        noBtn.onclick = (e) => {
            confirmation.style.display = "none";
            confirmation.classList.remove("pop");
            document.querySelector("#dim-mask").classList.remove("dim");
        }
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