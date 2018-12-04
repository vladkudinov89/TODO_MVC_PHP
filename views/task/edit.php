<?php include ROOT . '/views/layouts/header.php'; ?>

    <div class="addTask-form">
        <h2>Edit Task</h2>
        <form method="post" enctype="multipart/form-data">
            <div class="form-group">
                <input type="text" name="taskname" id="taskname" placeholder="Task Name"
                       value="<?php echo $task_name; ?>"/>
            </div>
            <div class="form-group">
                <textarea name="tasktext" id="tasktext" cols="40" rows="10"
                          placeholder="Task Text"><?php echo $task_text; ?></textarea>
            </div>
            <div class="form-group">
                <img style="width: 240px;" src="  <?php echo '/' . $task_img; ?>" alt="">
                <input type="file" name="editTaskPhoto" id="taskphoto">
            </div>
            <div class="form-group">
                <input type="submit" name="editTask"
                       class="btn btn-success" value="Save Task"/>
            </div>
        </form>
    </div>

<?php include ROOT . '/views/layouts/footer.php'; ?>