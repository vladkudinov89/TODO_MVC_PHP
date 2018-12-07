<?php include ROOT . '/views/layouts/header.php'; ?>

<div class="form-group">
    <div class="pull-left">
        <a href="task/add" class="btn btn-success btn-md">Add Task</a>
    </div>
    <?php if (!App\Models\User::isGuest()) : ?>
    <div class="pull-right alert alert-success" role="alert"
    ">
    Hello,Admin
</div>
<?php endif; ?>
<div class="clearfix"></div>
</div>

<h2 class="text-center">Tasks Table</h2>
<div class="table-responsive">
    <table class="table" id="task-table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Username</th>
            <th scope="col">Email</th>
            <th scope="col">Status</th>
            <th scope="col">Task name</th>
            <th scope="col">Image</th>

            <?php if (!App\Models\User::isGuest()): ?>
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
            <?php echo $task['is_complete'] ? "not-complete" : ""; ?>
                "
            >
                <td><?php echo $i++; ?></td>
                <td><?php echo $task['username'] ?></td>
                <td><?php echo $task['email'] ?></td>
                <td><?php echo $task['is_complete'] ? "complete" : "not complete"; ?></td>
                <td class="no-sort"><?php echo $task['task_name'] ?></td>
                <td><img style="width:220px; height: 120px;" src="<?php echo $task['task_img'] ?>" alt=""></td>


                <?php if (!App\Models\User::isGuest()): ?>
                    <td>
                        <?php if (!$task['is_complete']) : ?>
                            <button class="btn btn-sm btn-success btn-complete">Complete</button>
                        <?php endif; ?>

                        <?php if ($task['is_complete']) : ?>
                            <button class="btn btn-sm btn-info btn-rollback">Rollback</button>
                        <?php endif; ?>

                        <?php if (!$task['is_complete']) : ?>
                            <a href="task/edit/<?php echo $task['task_id']; ?>" class="btn btn-sm btn-warning btn-edit">Edit</a>
                        <?php endif; ?>

                        <button class="btn btn-sm btn-danger btn-delete">Delete</button>
                    </td>
                <?php endif; ?>
            </tr>
        <?php } ?>

        </tbody>
    </table>
</div>

<?php include ROOT . '/views/layouts/footer.php'; ?>
