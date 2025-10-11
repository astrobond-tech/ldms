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
            {{Form::label('due_date',__('Due Date'),array('class'=>'form-label'))}}
            {{Form::date('due_date', null, array('class'=>'form-control', 'required'=>'required'))}}
        </div>

        <div class="form-group col-md-6">
            {{Form::label('quantity',__('Assign Copies'),array('class'=>'form-label'))}}
            {{Form::number('quantity', 1, array('class'=>'form-control', 'required'=>'required', 'min'=>'1'))}}
        </div>
    </div>
</div>
<div class="modal-footer">
    <div id="validation-feedback" class="text-danger mb-2 w-100" style="text-align: left;"></div>
    {{Form::submit(__('Assign'),array('class'=>'btn btn-secondary btn-rounded', 'id' => 'assign-submit-btn'))}}
</div>
{{ Form::close() }}

<script>
$(document).ready(function() {
    let availableCopies = null;
    let validationFeedback = $('#validation-feedback');
    let submitButton = $('#assign-submit-btn');

    function validateAssignForm() {
        let errors = [];

        // 1. Check required fields
        if (!$('#client_id').val()) {
            errors.push('Client must be selected.');
        }
        if (!$('#document_id').val()) {
            errors.push('Document must be selected.');
        }
        if (!$('input[name="issue_date"]').val()) {
            errors.push('Issue date is required.');
        }
        if (!$('input[name="due_date"]').val()) {
            errors.push('Due date is required.');
        }

        // 2. Check quantity
        let quantity = parseInt($('input[name="quantity"]').val(), 10);
        if (isNaN(quantity) || quantity < 1) {
            errors.push('Assign copies must be at least 1.');
        }

        if (availableCopies !== null && quantity > availableCopies) {
            errors.push('Assign copies cannot exceed available copies (' + availableCopies + ').');
        }

        // 3. Update UI
        if (errors.length > 0) {
            submitButton.prop('disabled', true);
            validationFeedback.html('<strong>To enable assign, please fix the following:</strong><br>' + errors.join('<br>'));
        } else {
            submitButton.prop('disabled', false);
            validationFeedback.html('');
        }
    }

    // Add event listeners
    $('#client_id, #document_id, input[name="issue_date"], input[name="due_date"], input[name="quantity"]').on('change keyup select2:select select2:unselect', validateAssignForm);

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
            url: '/assign/document/' + documentId,
            type: 'GET',
            success: function(data) {
                var detailsHtml = '<h4>{{__("Document Details")}}</h4>';
                if(data.essential) {
                    if (data.essential.copies_total !== null) {
                        availableCopies = data.essential.copies_available || 0;
                    } else {
                        availableCopies = null; // Represents infinite copies
                    }

                    detailsHtml += '<p><strong>{{__("Total Copies")}}:</strong> ' + (data.essential.copies_total !== null ? data.essential.copies_total : 'N/A') + '</p>';
                    detailsHtml += '<p><strong>{{__("Available Copies")}}:</strong> ' + (data.essential.copies_available !== null ? data.essential.copies_available : 'N/A') + '</p>';
                    if(data.essential.rack) { detailsHtml += '<p><strong>{{__("Rack")}}:</strong> ' + data.essential.rack + '</p>'; }
                    if(data.essential.shelf) { detailsHtml += '<p><strong>{{__("Shelf")}}:</strong> ' + data.essential.shelf + '</p>'; }
                    if(data.essential.room) { detailsHtml += '<p><strong>{{__("Room")}}:</strong> ' + data.essential.room + '</p>'; }
                    if(data.essential.cabinet) { detailsHtml += '<p><strong>{{__("Cabinet")}}:</strong> ' + data.essential.cabinet + '</p>'; }
                }
                $('#document_details').html(detailsHtml);
                validateAssignForm();
            }
        });
    }).on('select2:unselect', function (e) {
        availableCopies = null;
        $('#document_details').html('');
        validateAssignForm();
    });

    // Initial validation check
    validateAssignForm();
});
</script>