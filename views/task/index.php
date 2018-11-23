<?php include ROOT . '/views/layouts/header.php'; ?>

<?php //if (isset($messages) && is_array($messages)): ?>
<!--    <ul>-->
<!--        --><?php //foreach ($messages as $message): ?>
<!--            <li  class="alert alert-success"> - --><?php //echo $message; ?><!--</li>-->
<!--        --><?php //endforeach; ?>
<!--    </ul>-->
<!---->
<?php //endif; ?>
<!---->
<?php //if (isset($errors) && is_array($errors)): ?>
<!--    <ul>-->
<!--        --><?php //foreach ($errors as $error): ?>
<!--            <li class="alert alert-danger"> - --><?php //echo $error; ?><!--</li>-->
<!--        --><?php //endforeach; ?>
<!--    </ul>-->
<?php //endif; ?>

<div class="form-group">
    <div class="pull-left">
        <a href="task/add" class="btn btn-success btn-lg">Add Task</a>
    </div>
    <?php if (!\Models\User::isGuest()) : ?>
    <div class="pull-right alert alert-success" role="alert"
    ">
    Hello,Admin
</div>
<?php endif; ?>
<div class="clearfix"></div>
</div>


<table class="table">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Task name</th>
        <th scope="col">Username</th>
        <th scope="col">Email</th>
        <th scope="col">Image</th>
        <?php if (!\Models\User::isGuest()): ?>
            <th scope="col">Action's Task</th>
        <?php endif; ?>
    </tr>
    </thead>
    <tbody>

    <?php
    $i = 1;
    foreach ($tasks as $task) {
        ?>
        <tr
                data-task-id="<?php echo $task['task_id']; ?>"
                class="
            <?php
                if ($task['is_complete']) {
                    echo 'not-complete';
                } else {
                    echo '';
                } ?>
                "
        >
            <td><?php echo $i++ ?></td>
            <td><?php echo $task['task_name'] ?></td>
            <td><?php echo $task['username'] ?></td>
            <td><?php echo $task['email'] ?></td>
            <td><img style="width:220px; height: 120px;" src="<?php echo $task['task_img'] ?>" alt=""></td>

            <?php if (!\Models\User::isGuest()): ?>
                <td>
                    <?php if (!$task['is_complete']) : ?>
                        <button class="btn btn-sm btn-success btn-complete">Complete</button>
                    <?php endif; ?>

                    <?php if ($task['is_complete']) : ?>
                        <button class="btn btn-sm btn-info btn-rollback">Rollback</button>
                    <?php endif; ?>

                    <?php if (!$task['is_complete']) : ?>
                        <button class="btn btn-sm btn-warning btn-edit">Edit</button>
                    <?php endif; ?>

                    <button class="btn btn-sm btn-danger btn-delete">Delete</button>
                </td>
            <?php endif; ?>
        </tr>
    <?php } ?>

    </tbody>
</table>
<?php echo $pagination->get(); ?>

<?php include ROOT . '/views/layouts/footer.php'; ?>
