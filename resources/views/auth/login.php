
<?php

use Warehouse\View\View;

?>
<?php
View::StartContent();
?>
<div class="row">
    <div class="col-md-12">
        <form action="/login" method="POST">
            <div class="mb-3">
                <label for="username" class="form-label">Enter username:</label>
                <input type="text" class="form-control" id="username" name="username">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <button type="submit" class="btn btn-primary">LOGIN</button>
        </form>
    </div>
    <div class="col-md-12">
        <a class="link-info" href="/register">Register</a>
    </div>
</div>

<?php
View::EndContent();
?>
<?php
View::parentLayout('layout.main');
?>

