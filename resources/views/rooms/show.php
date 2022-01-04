
<?php

use Warehouse\View\View;
/***
 * @Var array $positions
 */
?>
<?php
View::StartContent();
?>


<div class="card">
    <h3 class="card-header">Show Positions</h3>
    <div class="card-body">
        <h5 class="card-title">ID : <?= $positions['id'] ?></h5>
        <h5 class="card-title">Name : <?= $positions['name'] ?></h5>
        <a href="/positions" class="btn btn-primary">Go back</a>
    </div>
</div>



<?php
View::EndContent();
?>
<?php
View::parentLayout('layout.main');
?>
