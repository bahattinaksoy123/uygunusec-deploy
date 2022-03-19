<?php

header('Access-Control-Allow-Origin: *');
?> 

<section class="signup-for">
    <h2>SIgnUp</h2>
    <div>
        <form action="includes/signup.inc.php" method="post">
        <input  type="text" name="email">
        <input  type="text" name="password">

        <button type="submit" name="submit">Signup</button>

        </form>
    </div>
</section>

