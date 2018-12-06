<aside id="settings-bar" class="settings-bar modal container">
    <!-- <button class="fill" onclick="closeSignIn()">&times;</button> -->
    <span id="warning" class="modal container"></span>
    <form id="update-profile" class="modal-content">
        <h1>Profile settings</h1>
        <div>
            <input type="text" placeholder="Update name">
            <input type="email" placeholder="Update email">
            <input type="text" placeholder="Update bio">
        </div>
        <div>
            <button type="submit" class="fill">Update profile</button>
        </div>
    </form>

    <form id="update-password" class="modal-content">
        <h1>Personal settings</h1>
        <div>
            <input type="password" placeholder="Enter new password">
            <input type="password" placeholder="Reenter new password">
        </div>
        <div>
            <button type="submit" class="fill">Update password</button>
        </div>
    </form>
</aside>