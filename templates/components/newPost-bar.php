<aside id="newpost-bar" class="container">

    <span id="warning" class="modal container"></span>

    <div id="newPostButtons">
        <button type="button" class="fill newPostBtn storyBtn" onclick="openCloseNewStory()">New Story</button>
        <button type="button" class="fill newPostBtn imageBtn" onclick="openCloseNewImage()">New Image</button>
    </div>
 
    <form id="story-form">
        <h1>New Story</h1>
        <div id="newPostInput">
            <input type="text" name="postTitle" placeholder="Enter Post Title" required>
            <textarea name="postContent" placeholder="You can write your Post here!" required></textarea>
        </div>
        <div>
            <button type="submit" class="fill">Create new Post</button>
        </div>
    </form>
   
    <form id="image-form">
        <h1>New Image</h1>
        <div id="newPostInput">
            <input type="text" name="postTitle" placeholder="Enter Post Title" required>
            <div id="picture-preview-enclosure">
                <label for="picture-preview">
                    <img src="../img/posts/insertImage.png" class="newPost-picture">
                    <input id="picture-preview" type="file" name="picture" accept="image/*" required>
                </label>
            </div>
        </div>
        <div>
            <button type="submit" class="fill">Create new Post</button>
        </div>
    </form>
</aside>