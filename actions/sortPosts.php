<?php

    if (isset($_GET["search"])) {
        $postsID = array();

        foreach ($posts as $search_post) {
            array_push($postsID, $search_post["postID"]);
        }

        $posts = searchPosts(implode(', ', $postsID), $_GET["search"]);
    }

    if (isset($_GET["sort"])) {

        function cmp_post_points($a, $b) {
            if ($a["points"] == $b["points"])
                return 0;

            return ($a["points"] > $b["points"]) ? -1 : 1;
        }

        function cmp_post_comments($a, $b) {
            if ($a["nrComments"] == $b["nrComments"])
                return 0;

            return ($a["nrComments"] > $b["nrComments"]) ? -1 : 1;
        }

        switch ($_GET["sort"]) {
            case "points":
                usort($posts, "cmp_post_points");
                break;
            case "comments":
                usort($posts, "cmp_post_comments");
                break;
            case "date":
                // Default
                break;
        }  
    }

    if (isset($_GET["order"])) {
        switch ($_GET["order"]) {
            case "asc":
                $posts = array_reverse($posts);
                break;
            case "desc":
                // Default
                break;
        }
    }
?>