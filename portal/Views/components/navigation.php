
<section id="navArea">
    <nav class="navbar navbar-inverse" role="navigation">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav main_nav">
                <li class="active"><a href="index.php"><span class="fa fa-home desktop-home"></span><span class="mobile-show">Home</span></a></li>
                <?php
                        if (isset($details['categories'])) :

                            foreach ($details['categories'] as $cat) :

                ?>

                                <li><a href="category?catID=<?=$cat->id ?>"><?= $cat->category_name ?></a></li>
                <?php
                            endforeach;;

                       else: echo "NO NAVIGATIONS";
                       endif;

                    if(isset($_SESSION['user']) && $_SESSION['user']->role_name != "User") :
                ?>
                <li><a href="/portal-back/index.php">Admin Panel</a>
                <?php
                    endif;
                ?>
                <li><a href="contact">Contact Us</a></li>

            </ul>
        </div>
    </nav>
</section>
</section>