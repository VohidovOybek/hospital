
<?php

use Warehouse\View\View;
/***
 * @Var array $positions
 */
?>
<?php
View::StartContent();
?>

    <a class="btn btn-primary "  href="/positions/createForm">Create New Positions</a>
    <table class="table" width="100%">
    <table class="table table-striped table-bordered table-hover" width="100%">

        <thead>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>

        <?php foreach ($positions as $position): ?>
            <tr>
                <td><?= $position['id'] ?></td>
                <td><?= $position['name'] ?></td>
                <td>
                    <a href="/positions/updateForm?id=<?= $position['id']?>"  class="btn btn-md bg-danger">update</a>
                    <a href="/positions/delete?id=<?= $position['id']?>" class="btn btn-md bg-warning">delete</a>
                    <a href="/positions/show?id=<?= $position['id']?>" class="btn btn-md bg-success">show</a>
                </td>
            </tr>
        <?php endforeach; ?>

        </tbody>
    </table>
<?php
View::EndContent();
?>
<?php
View::parentLayout('layout.main');
?>