<div class="modal fade" id="{{ $modalId }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id='{{ $formID }}' method='POST' action='{{ $CRUDendpoint }}'>
                <!-- Modal Header -->
                <div class="modal-header main-bg">
                    <h4 class="modal-title white-text"><b>{{ $modalTitle }}</b></h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body, slot will contain form content-->
                <div class="modal-body">
                    @csrf
                    {{ $slot }}
                </div>

                <!-- Modal footer -->
                <div class="modal-footer alt-bg">
                    <a id = '{{ $modalSubmitBtnID }}' class='btn btn-secondary btn-lg white-text pointer'>{{ $modalSubmitBtnText }}</a>
                    <button type="button" class="btn btn-outline-dark btn-lg" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>