    <!----------------------------Return to Uploader Modal----------------------------->

    <div class="modal fade" id="returnModal{{ $protocol->id }}" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Return to Uploader</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="mb-2">Are you sure? You may leave a note below.</div>
                <form id="return_protocol{{ $protocol->id }}" action="/return_protocol/{{ $protocol->id }}" enctype="multipart/form-data" method="POST">
                   @csrf
                   @method('PUT')
                    <textarea class="p-2" name="comment" style="resize: none; width: 100%; height: 120px"></textarea>
                <div>Second attempt:</div>
                <div class="d-flex mt-2">
                    
                    <label class="container">
                        <input type="checkbox" name="doc1_c" <?php echo $protocol->doc1_2_access!=null ? 'disabled' :  '' ?>>
                        <span class="checkmark"></span>
                            Chapter 1-3
                    </label>
                    <label class="container">
                        <input type="checkbox" name="orreceipt_c" <?php echo $protocol->or_receipt2_access!=null ? 'disabled' :  '' ?>>
                        <span class="checkmark"></span>    
                        OR Receipt
                    </label>
                        <label class="container">
                        <input type="checkbox" name="progress_c" <?php echo $protocol->progress_report2_access!=null ? 'disabled' :  '' ?>>
                        Progress Report
                    <span class="checkmark"></span>
                    </label>
                   
                </div>
                <div class="d-flex">
                    <label class="container">
                        <input type="checkbox" name="report_c" <?php echo $protocol->reviewers_report2_access!=null ? 'disabled' :  '' ?>>
                        <span class="checkmark"></span>
                        Reviewer's Report
                    </label>
                    <label class="container">
                        <input type="checkbox" name="finalmanu_c" <?php echo $protocol->final_manuscript2_access!=null ? 'disabled' :  '' ?>>
                        <span class="checkmark"></span>
                        Final Manuscript
                    </label>
                    <label class="container">
                        <input type="checkbox" name="finalreport_c" <?php echo $protocol->final_report_form2_access!=null ? 'disabled' :  '' ?>>
                        <span class="checkmark"></span>
                        Final Report
                    </label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Return Protocol</button>
            </div>
            </form>
            </div>
        </div>
        </div>
        <!----------------------------------------------------------------------------------->