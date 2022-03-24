@if(session()->has('success'))
    <!-- Success Modal -->
    <div id="success-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-body text-center p-4">
                    <img src="{{ asset('assets/12FlyIcons/uaspiloticon2x.png') }}" alt="" width="70px" height="70px">
                    <h4 style="margin-top: 10px">{{ session()->get('success')['title'] }}</h4>
                    <p class="mt-3">{{ session()->get('success')['content'] }}</p>
                    <button type="button" class="btn btn-success my-2" data-dismiss="modal">Done
                        <i class="material-icons">check</i>
                    </button>
                </div> <!-- // END .modal-body -->
            </div> <!-- // END .modal-content -->
        </div> <!-- // END .modal-dialog -->
    </div> <!-- // END .modal --><!-- // END .modal -->
@endif
@if(session()->has('error'))
    <!-- Success Modal -->
    <div id="error-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-body text-center p-4">
                    <img src="{{ asset('assets/12FlyIcons/uaspiloticon2x.png') }}" alt="" width="70px" height="70px">
                    <h4 style="margin-top: 10px">{{ session()->get('error')['title'] }}</h4>
                    <p class="mt-3">{{ session()->get('error')['content'] }}</p>
                    <button type="button" class="btn btn-danger my-2" data-dismiss="modal">Done
                        <i class="material-icons">check</i>
                    </button>
                </div> <!-- // END .modal-body -->
            </div> <!-- // END .modal-content -->
        </div> <!-- // END .modal-dialog -->
    </div> <!-- // END .modal --><!-- // END .modal -->
@endif



