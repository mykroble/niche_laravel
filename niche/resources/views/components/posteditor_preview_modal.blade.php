<div class="modal fade w-100" id="previewModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" id="modal-sizing">
        <div class="modal-content">
            <div class="modal-header">
                <label for="titleInput">Title: </label>
                <input class="form-control" type="text" id="titleInput" placeholder="title">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="d-flex justify-content-between m-1">
                    <label for="preview"><b>Preview</b></label>
                    <div class="d-inline-block toggle-preview-img-div" id="togglePreview">
                        <img class="h-100 toggle-preview-img" src="{{ asset('pics/togglePreview.svg') }}"></img>
                    </div>
                </div>
                <div id="preview" class="w-100 border border-black"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="submitForm()">Confirm</button>
            </div>
        </div>
    </div>
</div>