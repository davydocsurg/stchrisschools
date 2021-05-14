<form action="" method="POST" id="deleteTeacherForm">
    @csrf
    @method('DELETE')
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content bg-danger">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Delete Teacher</h5><button
                        class="close btn btn-default text-white" type="button" data-dismiss="modal"
                        aria-label="Close"><span class="font-weight-light" aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <p class="text-bold">
                        Are you sure you want to delete this teacher?
                    </p>
                </div>
                <div class="modal-footer"><button class="btn btn-secondary btn-sm" type="button"
                        data-dismiss="modal">Cancel</button><button class="btn btn-danger btn-sm" type="submit">Yes,
                        Delete</button></div>
            </div>
        </div>
    </div>
</form>
