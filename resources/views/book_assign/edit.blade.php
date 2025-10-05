{{ Form::model($bookAssign, ['route' => ['book-assign.update', $bookAssign->id], 'method' => 'PUT', 'enctype' => 'multipart/form-data']) }}
<div class="modal-body">
    <div class="row">
        {{-- Assign To --}}
        <div class="form-group col-md-6">
            {{ Form::label('assign_to', __('Assign To'), ['class' => 'form-label']) }}
            {{ Form::select('assign_to', $clients, null, ['class' => 'form-control hidesearch']) }}
        </div>

        {{-- Book Name --}}
        <div class="form-group col-md-6">
            {{ Form::label('name', __('Book Name'), ['class' => 'form-label']) }}
            {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => __('Enter book name')]) }}
        </div>

        {{-- Room No --}}
        <div class="form-group col-md-3">
            {{ Form::label('room_no', __('Room No'), ['class' => 'form-label']) }}
            {{ Form::text('room_no', null, ['class' => 'form-control', 'placeholder' => __('Enter Room No')]) }}
        </div>

        {{-- Rack No --}}
        <div class="form-group col-md-3">
            {{ Form::label('rack_no', __('Rack No'), ['class' => 'form-label']) }}
            {{ Form::text('rack_no', null, ['class' => 'form-control', 'placeholder' => __('Enter Rack No')]) }}
        </div>

        {{-- Shelf No --}}
        <div class="form-group col-md-3">
            {{ Form::label('shelf_no', __('Shelf No'), ['class' => 'form-label']) }}
            {{ Form::text('shelf_no', null, ['class' => 'form-control', 'placeholder' => __('Enter Shelf No')]) }}
        </div>

        {{-- Box No --}}
        <div class="form-group col-md-3">
            {{ Form::label('box_no', __('Box No'), ['class' => 'form-label']) }}
            {{ Form::text('box_no', null, ['class' => 'form-control', 'placeholder' => __('Enter Box No')]) }}
        </div>

        {{-- Document --}}
        <div class="form-group col-md-6">
            {{ Form::label('document', __('Document'), ['class' => 'form-label']) }}
            <div class="d-flex align-items-center gap-2">
                {{ Form::file('document', ['class' => 'form-control']) }}
                @if($bookAssign->document)
                    <a href="{{ asset('storage/' . $bookAssign->document) }}" target="_blank" class="btn btn-sm btn-outline-secondary">
                        {{ __('View') }}
                    </a>
                @endif
            </div>
        </div>

        {{-- Description --}}
        <div class="form-group col-md-12">
            {{ Form::label('description', __('Description'), ['class' => 'form-label']) }}
            {{ Form::textarea('description', null, ['class' => 'form-control', 'rows' => 3]) }}
        </div>
    </div>
</div>
<div class="modal-footer">
    {{ Form::submit(__('UPDATE'), ['class' => 'btn btn-secondary btn-rounded']) }}
</div>
{{ Form::close() }}
