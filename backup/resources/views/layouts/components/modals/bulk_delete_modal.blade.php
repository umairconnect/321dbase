<div class="modal fade" id="bulkDeleteModal" tabindex="-1" role="dialog" aria-labelledby="bulkDeleteModal" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <form method="post" action="">
            @csrf
            @method('delete')
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title text-muted" id="deleteConfirmModal">ALERT</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">{{ $modalText }}</div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger font-weight-bold">Confirm</button>
                    <button type="button" class="btn btn-outline-secondary font-weight-bold" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>