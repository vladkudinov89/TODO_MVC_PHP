<?php include ROOT . '/views/layouts/header.php'; ?>

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
            <tr>
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
