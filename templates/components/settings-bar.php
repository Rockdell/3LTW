<aside id="settings-bar" class="settings-bar modal container">
    <button class="fill close-btn">&times;</button>
    <span id="warning" class="modal container"></span>
    <form id="update-profile" class="modal-content">
        <h1>Profile settings</h1>
        <div>
            <label for="picture-preview">
                <img src="/img/users/unknown.png" class="profile-picture">
                <input id="picture-preview" type="file" name="picture" accept="image/png">
            </label>
        </div>
        <div>
            <input type="text" name="username" placeholder="Update name">
            <input type="email" name="mail" placeholder="Update mail">
            <textarea type="text" name="bio" placeholder="Update bio"></textarea>
        </div>
        <div>
            <button type="submit" class="fill">Update profile</button>
            <button type="button" class="fill" onclick="profileOrPassword()">Update password</button>
        </div>
    </form>

    <form id="update-password" class="modal-content">
        <h1>Password settings</h1>  
        <div>
            <input type="password" name="password" placeholder="Enter new password">
            <input type="password" name="chkpassword" placeholder="Reenter new password">
        </div>
        <div>
            <button type="submit" class="fill">Update password</button>
            <button type="button" class="fill" onclick="profileOrPassword()">Update profile</button>
        </div>
    </form>
</aside>