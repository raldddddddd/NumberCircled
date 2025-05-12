<div class="modal fade" id="semanticModal" tabindex="-1" aria-labelledby="semanticModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form id="semanticForm" class="modal-content">
      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title" id="semanticModalLabel">Edit Semantics</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
          <label for="word" class="form-label">Word</label>
          <input type="text" class="form-control" id="word" name="word" required>
        </div>
        <div class="mb-3">
          <label for="sentiment" class="form-label">Sentiment</label>
          <select class="form-select" id="sentiment" name="sentiment" required>
            <option value="positive">Positive</option>
            <option value="negative">Negative</option>
          </select>
        </div>
        <div id="semantic-feedback" class="text-danger small"></div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-success">Add Word</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </form>
  </div>
</div>
