{{Form::open(array('url'=>'assign','method'=>'post'))}}
<div class="modal-body">
    <div class="row">
        <div class="form-group col-md-12">
            {{Form::label('client_id',__('Client'),array('class'=>'form-label'))}}
            <select class="form-control" name="client_id" id="client_id" required>
            </select>
        </div>

        <div class="form-group col-md-12">
            {{Form::label('document_id',__('Document'),array('class'=>'form-label'))}}
            <select class="form-control" name="document_id" id="document_id" required>
            </select>
        </div>

        <div id="document_details" class="col-md-12">
            <!-- Document details will be loaded here -->
        </div>

        <div class="form-group col-md-6">
            {{Form::label('issue_date',__('Issue Date'),array('class'=>'form-label'))}}
            {{Form::date('issue_date', \Carbon\Carbon::now(), array('class'=>'form-control', 'required'=>'required'))}}
        </div>
        <div class="form-group col-md-6">
            {{Form::label('due_date',__('Return Date'),array('class'=>'form-label'))}}
            {{Form::date('due_date', null, array('class'=>'form-control'))}}
        </div>

        <div class="form-group col-md-6">
            {{Form::label('quantity',__('Assign Copies'),array('class'=>'form-label'))}}
            {{Form::number('quantity', 1, array('class'=>'form-control', 'required'=>'required', 'min'=>'1'))}}
        </div>
    </div>
</div>
<div class="modal-footer">
    {{Form::submit(__('Assign'),array('class'=>'btn btn-secondary btn-rounded'))}}
</div>
{{ Form::close() }}

<script>
$(document).ready(function() {
    $('#client_id').select2({
        placeholder: "{{__('Search for a client')}}",
        dropdownParent: $('.modal'),
        ajax: {
            url: "{{ route('assign.search.clients') }}",
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    search: params.term
                };
            },
            processResults: function (data) {
                return {
                    results: data
                };
            },
            cache: true
        }
    });

    $('#document_id').select2({
        placeholder: "{{__('Search for a document')}}",
        dropdownParent: $('.modal'),
        ajax: {
            url: "{{ route('assign.search.documents') }}",
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    search: params.term
                };
            },
            processResults: function (data) {
                return {
                    results: data
                };
            },
            cache: true
        }
    }).on('select2:select', function (e) {
        var documentId = e.params.data.id;
        $.ajax({
            url: '/assign/document/' + documentId, // Using direct url to avoid route issues in JS
            type: 'GET',
            success: function(data) {
                var detailsHtml = '<h4>{{__("Document Details")}}</h4>';
                var availableCopies = 0;
                if(data.essential) {
                    availableCopies = data.essential.copies_available || 0;
                    detailsHtml += '<p><strong>{{__("Total Copies")}}:</strong> ' + (data.essential.copies_total !== null ? data.essential.copies_total : 'N/A') + '</p>';
                    detailsHtml += '<p><strong>{{__("Available Copies")}}:</strong> ' + (availableCopies) + '</p>';
                    if(data.essential.rack) {
                        detailsHtml += '<p><strong>{{__("Rack")}}:</strong> ' + data.essential.rack + '</p>';
                    }
                    if(data.essential.shelf) {
                        detailsHtml += '<p><strong>{{__("Shelf")}}:</strong> ' + data.essential.shelf + '</p>';
                    }
                    if(data.essential.room) {
                        detailsHtml += '<p><strong>{{__("Room")}}:</strong> ' + data.essential.room + '</p>';
                    }
                    if(data.essential.cabinet) {
                        detailsHtml += '<p><strong>{{__("Cabinet")}}:</strong> ' + data.essential.cabinet + '</p>';
                    }
                }
                $('#document_details').html(detailsHtml);

                var quantityInput = $('input[name="quantity"]');
                var submitButton = $('input[type="submit"]');

                if (data.essential && data.essential.copies_total !== null) {
                    quantityInput.attr('max', availableCopies);
                    if(availableCopies <= 0) {
                        quantityInput.prop('disabled', true);
                        submitButton.prop('disabled', true);
                        detailsHtml += '<div class="alert alert-danger mt-2">{{__("No copies available to assign.")}}</div>';
                        $('#document_details').html(detailsHtml);
                    } else {
                        quantityInput.prop('disabled', false);
                        submitButton.prop('disabled', false);
                    }
                } else {
                    quantityInput.removeAttr('max');
                    quantityInput.prop('disabled', false);
                    submitButton.prop('disabled', false);
                }
            }
        });
    });
});
</script>
