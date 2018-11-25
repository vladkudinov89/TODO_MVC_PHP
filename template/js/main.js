$(document).ready(function () {

    $('.btn-complete').on('click', function (e) {
        e.preventDefault();
        var taskID = $(this).parent().parent().attr('data-task-id');
        $.post("/complete/" + taskID, function () {
            location.reload();
        });
    });

    $('.btn-rollback').on('click', function (e) {
        e.preventDefault();
        var taskID = $(this).parent().parent().attr('data-task-id');
        $.post("/rollback/" + taskID, function () {
            location.reload();
        });
    });

    $('.btn-edit').on('click', function (e) {
        e.preventDefault();
        var taskID = $(this).parent().parent().attr('data-task-id');
        $.post("/edit/" + taskID, function () {
            // location.reload();
        });
    });

    $('.btn-delete').on('click', function (e) {
        e.preventDefault();
        var taskID = $(this).parent().parent().attr('data-task-id');
        $.post("/delete/" + taskID, function () {
            location.reload();
        });
    });

    function getLength() {
        if ($("th").length >= 7)
        {
            return 6;
        }
    }

    $('#task-table').DataTable({
        "info":     false,
        "lengthMenu": [[4, 10, 25, -1], [4, 10, 25, "All"]],
        stateSave: true,
        "columnDefs": [
            {
                orderable: false, targets: [4,5 , getLength()]
            }
        ]
    });

});
