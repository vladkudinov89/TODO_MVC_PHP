<?php include ROOT . '/views/layouts/header.php'; ?>

    <div class="addTask-form">
        <h2>Add Task</h2>
        <form method="post" enctype="multipart/form-data">
            <div class="form-group">
                <input type="text" name="taskname" id="taskname" placeholder="Task Name" value="<?php echo $taskName; ?>"/>
            </div>
            <div class="form-group">
                <textarea name="tasktext" id="tasktext" cols="40" rows="10" placeholder="Task Text"><?php echo $taskText; ?></textarea>
            </div>
            <div class="form-group">
                <input type="file" name="addTaskPhoto" id="taskphoto">
            </div>
            <div class="form-group">
                <input type="submit" name="addTask" class="btn btn-success" value="Add Task"/>
            </div>
        </form>
    </div>

<?php include ROOT . '/views/task/preview.php'; ?>

<?php include ROOT . '/views/layouts/footer.php'; ?>