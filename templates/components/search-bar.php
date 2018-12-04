<aside class="search-bar container">

    <section id="search" class="sort-by">
        <h1>Search</h1>
        <input type="search" placeholder="Search posts..."/>
        <!-- <button class="fill" onclick="searchPosts()"> Search </button> -->
    </section>

    <section id="sort" class="sort-by">
        <h1>Sort by</h1>
        <ul>
            <li>
                <input type="radio" id="points" name="selector1" checked>
                <label for="points"><i class="material-icons">trending_up</i></label>
            </li>
            <li>
                <input type="radio" id="comments" name="selector1">
                <label for="comments"><i class="material-icons">comment</i></label>
            </li>
            <li>
                <input type="radio" id="date" name="selector1">
                <label for="date"><i class="material-icons">timelapse</i></label>
            </li>
        </ul>
    </section>

    <section id="order" class="sort-by">
        <h1>Order</h1>
        <ul>
            <li>
                <input type="radio" id="asc" name="selector2">
                <label for="asc"><i class="material-icons">expand_less</i></label>
            </li>
            <li>
                <input type="radio" id="desc" name="selector2" checked>
                <label for="desc"><i class="material-icons">expand_more</i></label>
            </li>
        </ul>
    </section>
</aside>