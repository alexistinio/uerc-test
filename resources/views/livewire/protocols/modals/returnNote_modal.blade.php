   <!------------------------------------Comment Modal----------------------------------------------->  
   <div class="modal fade" id="commentModal{{ $protocol->id }}" data-bs-backdrop="static" tabindex="-1000" role="dialog" 
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Return Notes:</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    @forelse($protocol->return_note->sortByDesc('created_at') as $return_note)
                    @php
                        $date_return = \Carbon\Carbon::parse($return_note->created_at)->timezone('Asia/Manila');
                        $date_return_note = $date_return->format('M d, Y g:ia');
                    @endphp
                    <div class="card p-2 mt-2 shadow-lg border-0">
                        <div class="fw-bold">{{ $return_note->note }}</div>
                        <div style="font-size: 12px">From: {{ $return_note->from.' on '.$date_return_note }}</div>
                    </div>
                      @empty
                      <div class="text-muted">No notes found.</div>
                    @endforelse   
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                    </div>
                </div>
            </div>
            <!------------------------------------------------------------------------------------------------>