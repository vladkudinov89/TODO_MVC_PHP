<!-- Button trigger modal -->
<button type="button" id="preview_task_preview" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal">
    Task Preview
</button>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Modal title</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <p class="text-muted">Task Name</p>
                    <span id="task_name"></span>
                </div>
                <div class="form-group">
                    <p class="text-muted">Task Text</p>
                    <span id="task_text"></span>
                </div>
                <div class="form-group">
                    <p class="text-muted">Task Image</p>
                    <img id="task_img" src="" width="320px">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>