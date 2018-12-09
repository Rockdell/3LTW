<aside id="search-bar" class="container">

    <section>
        <h1>Search</h1>
        <input type="search" placeholder="Search posts"/>
    </section>

    <section>
        <h1>Sort by</h1>
        <ul>
            <li>
                <input type="radio" id="points" name="selector1"
                <?php if(isset($_GET["sort"]) && $_GET["sort"] === "points") echo "checked"?>>

                <label for="points"><i class="material-icons">trending_up</i></label>
            </li>
            <li>
                <input type="radio" id="comments" name="selector1"
                <?php if(isset($_GET["sort"]) && $_GET["sort"] === "comments") echo "checked"?>>

                <label for="comments"><i class="material-icons">comment</i></label>
            </li>
            <li>
                <input type="radio" id="date" name="selector1"
                <?php if(!isset($_GET["sort"]) || $_GET["sort"] === "date") echo "checked"?>>
                
                <label for="date"><i class="material-icons">timelapse</i></label>
            </li>
        </ul>
    </section>

    <section>
        <h1>Order</h1>
        <ul>
            <li>
                <input type="radio" id="asc" name="selector2"
                <?php if(isset($_GET["order"]) && $_GET["order"] === "asc") echo "checked"?>>

                <label for="asc"><i class="material-icons">expand_less</i></label>
            </li>
            <li>
                <input type="radio" id="desc" name="selector2"
                <?php if(!isset($_GET["order"]) || $_GET["order"] === "desc") echo "checked"?>>
                <label for="desc"><i class="material-icons">expand_more</i></label>
            </li>
        </ul>
    </section>
</aside>