<?php

if (Auth::isLoggedIn()){
    echo '<section id="user-bar">
    <div class="container">
        <nav>
            <ul>';
                foreach ($userNavItems as $userNavItem){
                    echo "<li><a href='{$userNavItem['link']}'>{$userNavItem['title']}</a></li>";
                }
    echo '
<img src="/trex/assets/images/profile-picture_generic-user.png">
</ul>
</nav>
</div>
</section>';


}
