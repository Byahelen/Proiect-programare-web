
<header>
    <div class="container">
        <div id="brand"><h3>TrEx</h3></div>
        <nav>
            <ul>
<?php
if (Auth::isLoggedIn())
{
    foreach ($mainNavItems as $mainNavItem)
    {
        if($mainNavItem['title']=='Login' || $mainNavItem['title']=='Register'){
            continue;
        } else {
            if(TITLE==$mainNavItem['title']){
                echo "<li class='current'><a href='{$mainNavItem['link']}'>{$mainNavItem['title']}</a></li>";
            }else{
                echo "<li><a href='{$mainNavItem['link']}'>{$mainNavItem['title']}</a></li>";
            }
        }
    }
} else {
    foreach ($mainNavItems as $mainNavItem)
    {
        if(TITLE==$mainNavItem['title']){
            echo "<li class='current'><a href='{$mainNavItem['link']}'>{$mainNavItem['title']}</a></li>";
        }else{
            echo "<li><a href='{$mainNavItem['link']}'>{$mainNavItem['title']}</a></li>";
        }
    }
}
?>

            </ul>
        </nav>
    </div>
</header>
