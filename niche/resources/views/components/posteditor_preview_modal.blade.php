<div class="modal fade w-100" id="previewModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" id="modal-sizing" role="document">
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
            <hr>
            <div class="container-fluid m-2">
                <p>Upload Settings</p>
                <div class="row my-2">
                    <label for="selectOption" class="w-auto m-auto">Upload Channel: </label>
                    <select id="modalSelectChannel" class="form-select form-select-sm w-auto m-auto d-inline-block">
                        <option value="" disabled selected>Select a channel</option>
                        @foreach($channels as $channel)
                        <option value="{{ $channel->id }}">{{ $channel->title }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="row my-2">
                    <div class="w-auto m-auto form-check">
                        <input type="radio" id="is_public" name="visibilityInp" class="form-check-input" value="1" checked>
                        <label for="is_public" class="form-check-label">Public</label>
                    </div>
                    <div class="m-auto w-auto form-check">
                        <input type="radio" id="is_private" name="visibilityInp" class="form-check-input" value="0">
                        <label for="is_private" class="form-check-label">Private</label>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button id="modalSubmitBtn" type="button" class="btn btn-primary" onclick="submitForm()" disabled>Confirm</button>
            </div>
        </div>
    </div>
</div>