<?php

   if (isset($_GET['selector'])) :

       $selector = $_GET['selector'];

       ?>


       <h1>Confirm your comment</h1>

       <form action="verify?selector=<?=$selector?>" method="POST">

           <input type="submit" value="Submit" class="btn-theme" name="submitCommentVerify">

       </form>


<?php
else: echo "<h2>Not found</h2>";

endif;
?>
