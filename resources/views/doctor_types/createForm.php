
<?php

use Warehouse\View\View;

?>
<?php
View::StartContent();
?>
<div class="row">
    <h1 >Create Form</h1>
    <div class="col-md-12 ">
        <form action="/positions/create" method="POST">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name">
            </div>
            <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>
</div>

<?php
View::EndContent();
?>
<?php
View::parentLayout('layout.main');
?>


