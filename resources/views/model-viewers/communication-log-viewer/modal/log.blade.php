<div class="modal fade bs-example-modal-xl" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-xl">
        <div class="modal-content ajax-overlay">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><i class="fa fa-times"></i></button>
                <h4 class="modal-title">{{ $log_model->getTitle() }} <small>Log správ</small></h4>
            </div>
            <div class="modal-body text-center">
                {!! $table_component->render('modal') !!}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal"><i class="fa fa-chevron-left margin-right-10"></i>Späť</button>
            </div>
        </div>
    </div>
</div>