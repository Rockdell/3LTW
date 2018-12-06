<aside id="newPost-bar" class="container">
    <button class="fill" onclick="closeNewPost()">&times;</button>
    <!-- <span id="warning" class="modal container"></span> -->
    <form id="newPost-form" class="modal-content">
        <h1>New Post</h1>
        <div>
            <input type="text" name="postTitle" placeholder="Enter Post Title" required>
            <textarea name="postContent" placeholder="You can write your Post here!" required></textarea>
        </div>
        <div>
            <button type="submit" class="fill" onclick="createNewPost()">Create new Post</button>
        </div>
    </form>
</aside>