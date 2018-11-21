<?php include ROOT . '/views/layouts/header.php'; ?>

    <div class="form-group">
        <a href="task/add" class="btn btn-success btn-lg">Add Task</a>
    </div>

    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Task name</th>
            <th scope="col">Username</th>
            <th scope="col">Email</th>
        </tr>
        </thead>
        <tbody>

        <?php
        $i = 1;
        foreach ($tasks as $task) {
            ?>
            <tr class="<?php
            if( $task['is_complete'] == true )
            {
               echo 'not-complete';
            } else {
                echo '';
            }  ?>">
                <td><?php echo $i++ ?></td>
                <td><?php echo $task['task_name'] ?></td>
                <td><?php echo $task['username'] ?></td>
                <td><?php echo $task['email'] ?></td>
            </tr>
        <?php } ?>

        </tbody>
    </table>
    <?php echo $pagination->get(); ?>

<?php include ROOT . '/views/layouts/footer.php'; ?>
