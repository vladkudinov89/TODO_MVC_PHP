$(document).ready(function(){

    $('.btn-complete').on('click' , function (e) {
        e.preventDefault();
        var taskID = $(this).parent().parent().attr('data-task-id');
        $.post("/complete/" + taskID , function () {
            location.reload();
        });
    });

    $('.btn-rollback').on('click' , function (e) {
        e.preventDefault();
        var taskID = $(this).parent().parent().attr('data-task-id');
        $.post("/rollback/" + taskID , function () {
            location.reload();
        });
    });

    $('.btn-edit').on('click' , function (e) {
        e.preventDefault();
        var taskID = $(this).parent().parent().attr('data-task-id');
        $.post("/edit/" + taskID , function () {
            // location.reload();
        });
    });

    $('.btn-delete').on('click' , function (e) {
        e.preventDefault();
        var taskID = $(this).parent().parent().attr('data-task-id');
        $.post("/delete/" + taskID , function () {
            location.reload();
        });
    });

});
