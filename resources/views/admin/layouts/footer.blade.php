<footer class="main-footer">
    <div id="footer-modal" class="modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Modal Default</h4>
                </div>
                <div class="modal-body row">
                    <p>Modal Body</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <strong>Copyright &copy; {{ date('Y') }} <a href="{{ route('admin::login.form') }}">{{ config('settings.companyName') }}</a></strong> All rights reserved.
    
</footer>