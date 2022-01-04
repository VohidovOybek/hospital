<?php

use Warehouse\View\View;

?>
<?php
View::StartContent();
?>
<div class="row">
    <div class="col-md-12">
        <form action="/register" method="POST">
            <div class="mb-3">
                <label for="name" class="form-label">Enter name:</label>
                <input type="text" class="form-control" id="name" name="name">
            </div>
            <div class="mb-3">
                <label for="username" class="form-label">Enter username:</label>
                <input type="text" class="form-control" id="username" name="username">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <button type="submit" class="btn btn-primary">Register</button>
        </form>
    </div>
    <div class="col-md-12">
        <a class="link-info" href="/login">Login</a>
    </div>
</div>

<?php
View::EndContent();
?>
<?php
View::parentLayout('layout.main');
?>

