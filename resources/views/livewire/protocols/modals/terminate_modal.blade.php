    <!----------------------------Return to Uploader Modal----------------------------->

    <div class="modal fade" id="terminateModal{{ $protocol->id }}" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Terminate Protocol</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="mb-2">Are you sure? You may leave a note below.</div>
                <form id="terminate_protocol{{ $protocol->id }}" action="/terminate_protocol/{{ $protocol->id }}" enctype="multipart/form-data" method="POST">
                   @csrf
                   @method('PUT')
                    <textarea class="p-2" name="terminate_note" style="resize: none; width: 100%; height: 120px"></textarea>
                <div class="d-flex align-items-center mt-2">
                    <label for="terminate_attachment" class="mt-2">Attachment: </label>
                    <input type="file" class="form-control border border-secondary ms-2" name="terminate_attachment" id="terminate_attachment">
                </div>
            </div>
         
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-danger" data-bs-dismiss="modal">Terminate Protocol</button>
            </div>
            </form>
            </div>
        </div>
        </div>
        <!----------------------------------------------------------------------------------->