
<aside id="login-open" class="sign-bar modal container">
    <button class="fill" onclick="closeSignIn()">&times;</button>
    <form id="login" class="modal-content" action="/actions/login.php" method="post">
        <h1>Login</h1>
        <div>
            <input type="text" name="username" placeholder="Enter username" required>
            <input type="password" name="password" placeholder="Enter password" required>
        </div>
        <div>
            <button type="submit" class="fill">Login</button>
            <button type="button" class="fill" onclick="signInOrUp()">Go to register</button>
        </div>
    </form>

    <form id="register" class="modal-content" action="/actions/register.php" method="post">
        <h1>Register</h1>
        <div>
            <input type="text" name="username" placeholder="Enter username" required>
            <input type="text" name="email" placeholder="Enter email" required>
            <input type="password" name="password" placeholder="Enter password" required>
            <input type="password" name="password2" placeholder="Reenter password" required>
        </div>
        <div>
            <button type="submit" class="fill">Register</button>
            <button type="button" class="fill" onclick="signInOrUp()">Go to login</button>
        </div>
    </form>
</aside>