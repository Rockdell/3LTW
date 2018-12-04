<aside class="search-bar container">

    <section id="search">
        <input type="search" placeholder="Search posts..."/>
        <button class="fill" onclick="searchPosts()"> Search </button>
    </section>

    <section id="sort" class="sort-by">
        <h1>Sort:</h1>
        <ul>
            <li>
                <input type="radio" id="points" name="selector1" checked>
                <label for="points">Points</label>
            </li>
            <li>
                <input type="radio" id="comments" name="selector1">
                <label for="comments">Comments</label>
            </li>
            <li>
                <input type="radio" id="date" name="selector1">
                <label for="date">Date</label>
            </li>
        </ul>
    </section>

    <section id="by" class="sort-by">
        <h1>By:</h1>
        <ul>
            <li>
                <input type="radio" id="asc" name="selector2">
                <label for="asc">Ascending</label>
            </li>
            <li>
                <input type="radio" id="desc" name="selector2" checked>
                <label for="desc">Descending</label>
            </li>
        </ul>
    </section>
</aside>