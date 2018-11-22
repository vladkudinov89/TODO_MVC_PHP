<?php include ROOT . '/views/layouts/header.php'; ?>


<?php if (isset($errors) && is_array($errors)): ?>
    <ul>
        <?php foreach ($errors as $error): ?>
            <li> - <?php echo $error; ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

    <div class="addTask-form">
        <h2>Add Task</h2>
        <form method="post">
            <div class="form-group">
                <input type="text" name="taskname" placeholder="Task Name" value="<?php echo $taskName; ?>"/>
            </div>
            <div class="form-group">
                <textarea name="tasktext" cols="40" rows="10" placeholder="Task Text"><?php echo $taskText; ?></textarea>
            </div>
            <div class="form-group">
                <input type="submit" name="submit" class="btn btn-success" value="Add Task"/>
            </div>
        </form>
    </div>

<?php include ROOT . '/views/layouts/footer.php'; ?>