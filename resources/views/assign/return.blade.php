{{Form::open(array('url'=>route('assign.return.store', $issue->id),'method'=>'post'))}}
<div class="modal-body">
    <div class="row">
        <div class="form-group col-md-12">
            <p><strong>{{__('Client')}}:</strong> {{ optional($issue->user)->name }}</p>
            <p><strong>{{__('Document')}}:</strong> {{ optional($issue->document)->name }}</p>
            @if(optional($issue->document->essential)->rack)
                <p><strong>{{__('Rack')}}:</strong> {{ $issue->document->essential->rack }}</p>
            @endif
            @if(optional($issue->document->essential)->shelf)
                <p><strong>{{__('Shelf')}}:</strong> {{ $issue->document->essential->shelf }}</p>
            @endif
            @if(optional($issue->document->essential)->room)
                <p><strong>{{__('Room')}}:</strong> {{ $issue->document->essential->room }}</p>
            @endif
            @if(optional($issue->document->essential)->cabinet)
                <p><strong>{{__('Cabinet')}}:</strong> {{ $issue->document->essential->cabinet }}</p>
            @endif
            <p><strong>{{__('Issued Copies')}}:</strong> {{ $issue->quantity }}</p>
            <p><strong>{{__('Returned Copies')}}:</strong> {{ $issue->returned_quantity }}</p>
        </div>
        <div class="form-group col-md-6">
            {{Form::label('return_quantity',__('Return Copies'),array('class'=>'form-label'))}}
            {{Form::number('return_quantity', 1, array('class'=>'form-control', 'required'=>'required', 'min'=>'1', 'max'=>($issue->quantity - $issue->returned_quantity)))}}
        </div>
        <div class="form-group col-md-6">
            {{Form::label('return_date',__('Return Date'),array('class'=>'form-label'))}}
            {{Form::date('return_date', \Carbon\Carbon::now(), array('class'=>'form-control', 'required'=>'required'))}}
        </div>
        <div class="form-group col-md-12">
            {{Form::label('return_notes',__('Notes'),array('class'=>'form-label'))}}
            {{Form::textarea('return_notes', null, array('class'=>'form-control', 'rows'=>3))}}
        </div>
    </div>
</div>
<div class="modal-footer">
    {{Form::submit(__('Return'),array('class'=>'btn btn-secondary btn-rounded'))}}
</div>
{{ Form::close() }}
