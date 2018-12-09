<aside id="newPost-bar" class="newPost-bar container">
    <div id="newPostButtons">
        <button type="button" class="fill newPostBtn" onclick="openCloseNewStory()">New Story</button>
        <button type="button" class="fill newPostBtn" onclick="openCloseNewImage()">New Image</button>
    </div>
 
    <form id="newStory-form" class="modal-content">
        <h1>New Story</h1>
        <div id="newPostInput">
            <input type="text" name="postTitle" placeholder="Enter Post Title" required>
            <textarea name="postContent" placeholder="You can write your Post here!" required></textarea>
        </div>
        <div>
            <button type="submit" class="fill">Create new Post</button>
        </div>
    </form>
   
    <form id="newImage-form" class="modal-content">
        <h1>New Image</h1>
        <div id="newPostInput">
            <input type="text" name="postTitle" placeholder="Enter Post Title" required>
            <label for="picture-preview">
                <img src="/img/posts/insertImage.png" class="newPost-picture">
                <input id="picture-preview" type="file" name="picture" accept="image/*">
            </label>
        </div>
        <div>
            <button type="submit" class="fill">Create new Post</button>
        </div>
    </form>
</aside>