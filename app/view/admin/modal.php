<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form id="editForm" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header text-white" style="background-color: #b91c1c;">
                    <h5 class="modal-title" id="editModalLabel">Edit Record</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="editModalBody">
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id" id="edit-id">
                    <input type="hidden" name="page" id="edit-page" value="<?= basename($_SERVER['PHP_SELF']) ?>">
                    <button type="submit" class="btn btn-primary" id="modal-submit-btn" style="background-color: #b91c1c;">Save Changes</button>
                </div>
            </div>
        </form>
    </div>
</div>