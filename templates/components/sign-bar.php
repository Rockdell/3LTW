<div id="dim-masks"></div>
<aside id="sign-bar" class="sign-bar modal container">
    <button class="fill" onclick="closeSignIn()">&times;</button>
    <span id="warning" class="modal container"></span>
    <form id="login-form" class="modal-content">
        <h1>Login</h1>
        <div>
            <input type="text" name="userID" placeholder="Enter userID" required>
            <input type="password" name="password" placeholder="Enter password" required>
        </div>
        <div>
            <button type="submit" class="fill">Sign in</button>
            <button type="button" class="fill" onclick="signInOrUp()">Sign up</button>
        </div>
    </form>

    <form id="register-form" >
        <h1>Register</h1>
        <div>
            <label for="reg-picture">
                <img id="reg-picture-preview" src="/img/users/unknown.png" class="profile-picture">
            </label>
            <input id="reg-picture" type="file" name="picture" accept="image/png">
        </div>
        <div>
            <input id="reg-userID" type="text" name="userID" placeholder="Enter userID" onblur="validateUserId()" required>
            <input id="reg-username" type="text" name="username" placeholder="Enter name" required>
            <input id="reg-email" type="email" name="email" placeholder="Enter email" onblur="validateEmail()" required>
            <input id="reg-pwd" type="password" name="password" placeholder="Enter password" onblur="validatePassword()" required>
            <input id="reg-chkpwd" type="password" name="chkpassword" placeholder="Reenter password" onblur="comparePasswords()" required>
        </div>
        <div>
            <button type="submit" class="fill">Sign up</button>
            <button type="button" class="fill" onclick="signInOrUp()">Sign in</button>
        </div>
    </form>
</aside>