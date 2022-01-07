<div class="modal fade" id="deleteConfirmModal" tabindex="-1" role="dialog" aria-labelledby="deleteConfirmModal" aria-hidden="true" style="display: none">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title text-muted" id="deleteConfirmModal">ALERT</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">{{ $modalText }}</div>
            <div class="modal-footer">
                <button type="button" id="delConfirm" class="btn btn-danger font-weight-bold" data-dismiss="modal">Confirm</button>
                <button type="button" class="btn btn-outline-secondary font-weight-bold" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

@push('js')
<script>
    $(function() {
        $('#deleteConfirmModal').on('show.bs.modal', function(e) {
            $(this).find('#delConfirm').attr('data-action', $(e.relatedTarget).data('action'));
        });
    });
</script>
@endpush