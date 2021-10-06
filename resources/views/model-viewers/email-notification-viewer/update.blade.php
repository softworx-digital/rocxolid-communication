<div class="x_panel ajax-overlay">
    {!! $component->render('include.header') !!}

    {{ Form::open($component->getFormComponent()->getOptions()->except(['scripts'])->toArray()) }}
        {{ Form::hidden('_method', 'PUT') }}
        {{ Form::hidden('_submit-action', null) }}
        {{ Form::hidden('_param', $component->getFormComponent()->getForm()->getParam()) }}
        {{ Form::hidden('_section', $component->getFormComponent()->hasOption('section') ? $component->getFormComponent()->getOption('section') : null) }}

        <div class="x_content">
            <div class="col-xs-7">
                {!! $component->getFormComponent()->render('include.fieldset') !!}
            </div>
            <div class="keep-scroll-position">
                <div class="col-xs-5 padding-top-10">
                    <h3>{!! $component->translate('text.tokens') !!}</h3>
                    <p>{!! $component->translate('text.tokens-help') !!}</p>
                </div>
            @foreach ($component->getModel()->getAvailableTemplateVariables() as $param => $event_model)
                <div class="col-xs-5">
                    {!! $event_model->getModelViewerComponent()->render('include.tokenable', [ 'param' => $param ]) !!}
                </div>
            @if (false)
                <div class="col-xs-5">
                @foreach ($event_model->getRelationshipMethods() as $relationship)
                    <h4>{{ $param }}.{{ $relationship }}</h4>
                    <ul class="list-group">
                    @foreach ($event_model->$relationship()->make()->getAllAttributes() as $attribute)
                        <li class="list-group-item padding-0"><span class="btn btn-sm btn-primary margin-2 margin-right-10" data-add-html="${{ $param }}->{{ $relationship }}->{{ $attribute }}"><i class="fa fa-plus"></i></span>{{ $param }}.{{ $relationship }}.{{ $attribute }}</li>
                    @endforeach
                    </ul>
                @endforeach
                </div>
            @endif
            @endforeach
            </div>
        </div>
        {!! $component->getFormComponent()->render('include.footer') !!}
    {{ Form::close() }}

    @push('script')
    <script type="text/javascript">
        var $input = null;

        $('{{ $component->getFormComponent()->getDomIdHash('fieldset') }}')
            .on('focus', ':input', function (e) {
                $input = $(this);
            })
            .on('summernote.focus', 'textarea.wysiwyg', function (e) {
                $input = $(this);
            });

        $('.list-group-item .btn').on('click', function () {
            var $node = $('<span>');
            $node.text('\{\{ ' + $(this).attr('data-add-html') + ' \}\}');

            if ($input) {
                if (!$input.hasClass('wysiwyg')) {
                    var pos = $input[0].selectionStart;
                    var text = $input.val();

                    $input.val(text.substring(0, pos) + $node[0].innerText + text.substring(pos) );
                } else {
                    $input.summernote('insertNode', $node[0]);
                }
            }
        });
    </script>
    @endpush

    @if ($component->getFormComponent()->hasOption('scripts'))
    @push('script')
        @foreach ($component->getFormComponent()->getOption('scripts') as $script)
            {{ Html::script(asset(sprintf('assets/js/%s', $script))) }}
        @endforeach
    @endpush
    @endif
</div>