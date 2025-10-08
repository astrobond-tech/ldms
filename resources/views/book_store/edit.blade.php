{{ Form::model($book, ['route' => ['book-store.update', $book->id], 'method' => 'PUT', 'enctype' => 'multipart/form-data']) }}
<div class="modal-body">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row">
        <div class="form-group col-md-6">
            {{ Form::label('book_name', __('Book Name'), ['class' => 'form-label']) }}
            {{ Form::text('book_name', null, ['class' => 'form-control', 'placeholder' => __('Enter Book Name')]) }}
        </div>
        <!-- Availability Type -->
        <div class="form-group col-md-12">
            {{ Form::label('availability_type', __('Availability Type'), ['class' => 'form-label']) }}
            {{ Form::select('availability_type', ['offline' => __('Offline Only'), 'online' => __('Online Only'), 'both' => __('Both (Offline & Online)')], null, ['class' => 'form-control', 'id' => 'availabilityType', 'required']) }}
            <small class="form-text text-muted d-block mt-2">
                <strong>Offline:</strong> Book in physical location (Room, Rack, Shelf, Box)<br>
                <strong>Online:</strong> PDF file only<br>
                <strong>Both:</strong> Physical location + PDF file
            </small>
        </div>
        <div class="form-group col-md-6">
            {{ Form::label('book_file', __('Book File'), ['class' => 'form-label']) }}
            {{ Form::file('book_file', ['class' => 'form-control']) }}
            @if(!empty($book->book_file))
                <small>Current file: <a href="{{ asset('uploads/books/'.$book->book_file) }}" target="_blank">{{ $book->book_file }}</a></small>
            @endif
        </div>
        <div class="form-group col-md-3">
            {{ Form::label('room_no', __('Room No'), ['class' => 'form-label']) }}
            {{ Form::text('room_no', null, ['class' => 'form-control', 'placeholder' => __('Enter Room No')]) }}
        </div>
        <div class="form-group col-md-3">
            {{ Form::label('rack_no', __('Rack No'), ['class' => 'form-label']) }}
            {{ Form::text('rack_no', null, ['class' => 'form-control', 'placeholder' => __('Enter Rack No')]) }}
        </div>
        <div class="form-group col-md-3">
            {{ Form::label('shelf_no', __('Shelf No'), ['class' => 'form-label']) }}
            {{ Form::text('shelf_no', null, ['class' => 'form-control', 'placeholder' => __('Enter Shelf No')]) }}
        </div>
        <div class="form-group col-md-3">
            {{ Form::label('box_no', __('Box No'), ['class' => 'form-label']) }}
            {{ Form::text('box_no', null, ['class' => 'form-control', 'placeholder' => __('Enter Box No')]) }}
        </div>
        <div class="form-group col-md-12">
            {{ Form::label('description', __('Description'), ['class' => 'form-label']) }}
            {{ Form::textarea('description', null, ['class' => 'form-control', 'rows' => 3, 'placeholder' => __('Enter Description')]) }}
        </div>
    </div>
</div>

<div class="modal-footer">
    {{ Form::submit(__('Update Book'), ['class' => 'btn btn-secondary btn-rounded']) }}
    <button type="button" class="btn btn-light btn-rounded" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
</div>
{{ Form::close() }}
