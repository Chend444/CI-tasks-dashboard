<div class="container-sm">
    <div class="table-responsive">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-xl-8 col-lg-8 col-sm-3 col-xs-2">
                        <h2>Manage <b>Tasks</b></h2>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-sm-4 col-xs-2">
                        <a href="#addEmployeeModal" class="btn btn-success" data-toggle="modal">
                            <i class="material-icons">&#xE147;</i> <span>Add New Task</span></a>
                    </div>
                </div>
            </div>
            <div class="table-responsive col-xl-12 col-lg-12 col-sm-12">
                <table class="table table-striped table-hover table-sm">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Text</th>
                        <th>Status</th>
                        <th>Due Date</th>
                        <th>Creation Date</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $counter = 1;
                    foreach ($tasks as $task) { ?>
                        <tr>
                            <td><?= $task['id'] ?></td>
                            <td><?= $task['name'] ?></td>
                            <td data-text="<?= $task['text'] ?>"><?= $task['text'] ?></td>
                            <td data-status="<?= $task['status'] ?>"><?= $task['status'] ?></td>
                            <td><?= $task['due_date'] ?></td>
                            <td><?= $task['creation_date'] ?></td>
                            <td>
                                <a href="#editEmployeeModal" data-id="<?= $task['id'] ?>" class="edit_row"
                                   data-toggle="modal"><i class="material-icons"
                                                          data-toggle="tooltip"
                                                          title="Edit">&#xE254;</i></a>
                                <a href="#deleteEmployeeModal" data-id="<?= $task['id'] ?>" class="delete_row"
                                   data-toggle="modal"><i class="material-icons"
                                                          data-toggle="tooltip"
                                                          title="Delete">&#xE872;</i></a>
                            </td>
                        </tr>
                        <?php $counter++;
                    } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- Edit Modal HTML -->
<div id="addEmployeeModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form>
                <div class="modal-header">
                    <h4 class="modal-title">Add Task</h4>
                    <button type="button" id="add_close" class="close" data-dismiss="modal" aria-hidden="true">
                        &times;
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Name</label>
                        <input id="add_name" name="name" type="text" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Text</label>
                        <textarea id="add_text" name="text" class="form-control" required></textarea>
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <input id="add_status" name="status" type="text" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Due Date</label>
                        <input id="add_due_date" name="due_date" type="date" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                    <input type="submit" class="btn btn-success" value="Add">
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Edit Modal HTML -->
<div id="editEmployeeModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form>
                <div class="modal-header">
                    <h4 class="modal-title">Edit Task</h4>
                    <button type="button" id="edit_close" class="close" data-dismiss="modal" aria-hidden="true">
                        &times;
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Text</label>
                        <textarea name="text" id="edit_text" class="form-control" required></textarea>
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <input name="status" id="edit_status" type="text" class="form-control" required>
                        <input name="id" type="hidden" id="edit_id">
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                    <input type="submit" class="btn btn-info" value="Save">
                </div>
            </form>
        </div>
    </div>
</div>
