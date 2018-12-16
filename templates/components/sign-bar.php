<aside id="sign-bar" class="modal container">
    
    <span id="warning" class="modal container"></span>

    <form id="login-form" class="one">
        <h1>Login</h1>
        <div>
            <input type="text" name="userID" placeholder="Enter userID" required>
            <input type="password" name="password" placeholder="Enter password" required>
        </div>
        <div>
            <button type="submit" class="fill">Sign in</button>
            <button type="button" class="fill switch-btn">Sign up</button>
        </div>
    </form>

    <form id="register-form" class="two">
        <h1>Register</h1>
        <div>
            <label for="picture-preview">
                <img src="../img/users/unknown.png" class="profile-picture">
                <input id="picture-preview" type="file" name="picture" accept="image/*">
            </label>
        </div>
        <div>
            <input type="text" name="userID" placeholder="Enter userID" required>
            <input type="text" name="username" placeholder="Enter name" required>
            <input type="email" name="mail" placeholder="Enter mail" required>
            <input type="password" name="password" placeholder="Enter password" required>
            <input type="password" name="chkpassword" placeholder="Reenter password" required>
        </div>
        <div>
            <button type="submit" class="fill">Sign up</button>
            <button type="button" class="fill switch-btn">Sign in</button>
        </div>
    </form>
    
</aside>