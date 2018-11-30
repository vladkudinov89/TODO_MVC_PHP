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

    // $('.btn-edit').on('click', function (e) {
    //     e.preventDefault();
    //     var taskID = $(this).parent().parent().attr('data-task-id');
    //     $.post("/edit/" + taskID, function () {
    //         // location.reload();
    //     });
    // });
    //
    // $('#saveTask').on('click', function (e) {
    //
    //     e.preventDefault();
    //
    //     var taskID = $(this).attr('data-task-id');
    //     $.post("/edit/" + taskID, function () {
    //         // location.reload();
    //     });
    // });

    $('.btn-delete').on('click', function (e) {
        e.preventDefault();
        var taskID = $(this).parent().parent().attr('data-task-id');
        $.post("/delete/" + taskID, function () {
            location.reload();
        });
    });

    function getLength() {
        if ($("th").length >= 7) {
            return 6;
        }
    }

    $('#task-table').DataTable({
        "info": false,
        "lengthMenu": [[4, 10, 25, -1], [4, 10, 25, "All"]],
        stateSave: true,
        "columnDefs": [
            {
                orderable: false, targets: [4, 5, getLength()]
            }
        ]
    });

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#task_img').attr('src', e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }

    $('#preview_task_preview').prop('disabled', true);

    $('#taskname').change(function () {
        if (!$(this).val()) {
            $('#preview_task_preview').prop('disabled', true);
        } else {
            $('#preview_task_preview').prop('disabled', false);
        }
    });

    $('#preview_task_preview').click(function (e) {
        e.preventDefault();

        var task_name = $('#taskname').val();
        var task_text = $('#tasktext').val();

        $('#task_name').html(task_name);
        $('#task_text').html(task_text);
        if($('#taskphoto')[0]){
            $('#task_img').attr("src","/upload/default.png");
        }
        readURL($('#taskphoto')[0]);

    });

});
