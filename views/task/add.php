<?php include ROOT . '/views/layouts/header.php'; ?>

    <div class="addTask-form">
        <h2>Add Task</h2>
        <form method="post" enctype="multipart/form-data">
            <div class="form-group">
                <input type="text" name="taskname" id="taskname" placeholder="Task Name"/>
            </div>
            <div class="form-group">
                <textarea name="tasktext" id="tasktext" cols="40" rows="10" placeholder="Task Text"></textarea>
            </div>
            <div class="form-group">
                <input type="file" name="addTaskPhoto" id="taskphoto">
            </div>
            <div class="form-group">
                <p>
                    <!-- Button trigger modal -->
                    <button type="button" id="preview_task_preview" class="btn btn-primary" data-toggle="modal"
                            data-target="#myModal">
                        Task Preview
                    </button>
                    <input type="submit" name="addTask" class="btn btn-success" value="Add Task"/>
                </p>
            </div>
        </form>
    </div>

<?php include ROOT . '/views/task/preview.php'; ?>

<?php include ROOT . '/views/layouts/footer.php'; ?>