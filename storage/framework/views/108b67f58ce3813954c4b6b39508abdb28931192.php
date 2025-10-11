<?php echo e(Form::open(array('url'=>'assign','method'=>'post', 'id' => 'assignForm'))); ?>

<div class="modal-body">
    <div class="row">
        <div class="form-group col-md-12">
            <?php echo e(Form::label('client_id',__('Client'),array('class'=>'form-label'))); ?>

            <select class="form-control" name="client_id" id="client_id" required>
            </select>
        </div>
        <div class="form-group col-md-12">
            <?php echo e(Form::label('document_id',__('Document'),array('class'=>'form-label'))); ?>

            <select class="form-control" name="document_id" id="document_id" required>
            </select>
        </div>
        <div id="document_details" class="col-md-12">
            <!-- Document details will be loaded here -->
        </div>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('issue_date',__('Issue Date'),array('class'=>'form-label'))); ?>

            <input type="date" name="issue_date" id="issue_date" class="form-control" required
                   value="<?php echo e(date('Y-m-d')); ?>">
        </div>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('due_date',__('Due Date'),array('class'=>'form-label'))); ?>

            <input type="date" name="due_date" id="due_date" class="form-control" required>
        </div>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('quantity',__('Assign Copies'),array('class'=>'form-label'))); ?>

            <?php echo e(Form::number('quantity', 1, array('class'=>'form-control', 'required'=>'required', 'min'=>'1', 'id' => 'quantity'))); ?>

        </div>
    </div>
</div>
<div class="modal-footer">
    <div id="validation-feedback" class="text-danger mb-2 w-100" style="text-align: left;"></div>
    <?php echo e(Form::submit(__('Assign'),array('class'=>'btn btn-secondary btn-rounded', 'id' => 'assign-submit-btn'))); ?>

</div>
<?php echo e(Form::close()); ?>


<script>
$(document).ready(function() {
    let availableCopies = null;
    let validationFeedback = $('#validation-feedback');
    let submitButton = $('#assign-submit-btn');
    let issueDateInput = $('#issue_date');
    let dueDateInput = $('#due_date');

    function validateAssignForm() {
        let errors = [];

        // 1. Check required fields
        if (!$('#client_id').val() || $('#client_id').val().trim() === '') {
            errors.push('Client must be selected.');
        }
        if (!$('#document_id').val() || $('#document_id').val().trim() === '') {
            errors.push('Document must be selected.');
        }

        // FIX: Get date values directly from inputs with proper checking
        let issueDateVal = issueDateInput.val();
        let dueDateVal = dueDateInput.val();

        if (!issueDateVal || issueDateVal.trim() === '') {
            errors.push('Issue date is required.');
        }
        if (!dueDateVal || dueDateVal.trim() === '') {
            errors.push('Due date is required.');
        }

        // Check if due date is after or equal to issue date
        if (issueDateVal && dueDateVal) {
            if (new Date(dueDateVal) < new Date(issueDateVal)) {
                errors.push('Due date must be after or equal to issue date.');
            }
        }

        // 2. Check quantity
        let quantityVal = $('#quantity').val();
        let quantity = parseInt(quantityVal, 10);

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

    // Prevent form submission if validation fails
    $('#assignForm').on('submit', function(e) {
        let errors = [];

        if (!$('#client_id').val()) errors.push('Client');
        if (!$('#document_id').val()) errors.push('Document');
        if (!$('#issue_date').val()) errors.push('Issue Date');
        if (!$('#due_date').val()) errors.push('Due Date');

        if (errors.length > 0) {
            e.preventDefault();
            alert('Please fill in: ' + errors.join(', '));
            return false;
        }
    });

    // Add event listeners
    $('#client_id, #document_id').on('select2:select select2:unselect change', function() {
        validateAssignForm();
    });

    issueDateInput.on('change blur input', validateAssignForm);
    dueDateInput.on('change blur input', validateAssignForm);
    $('#quantity').on('change blur input keyup', validateAssignForm);

    // Initialize Select2 for Client
    $('#client_id').select2({
        placeholder: "<?php echo e(__('Search for a client')); ?>",
        dropdownParent: $('.modal'),
        allowClear: true,
        ajax: {
            url: "<?php echo e(route('assign.search.clients')); ?>",
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

    // Initialize Select2 for Document
    $('#document_id').select2({
        placeholder: "<?php echo e(__('Search for a document')); ?>",
        dropdownParent: $('.modal'),
        allowClear: true,
        ajax: {
            url: "<?php echo e(route('assign.search.documents')); ?>",
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
        let documentId = e.params.data.id;
        $.ajax({
            url: '/assign/document/' + documentId,
            type: 'GET',
            success: function(data) {
                let detailsHtml = '<h4><?php echo e(__("Document Details")); ?></h4>';
                if(data.essential) {
                    if (data.essential.copies_total !== null) {
                        availableCopies = data.essential.copies_available || 0;
                    } else {
                        availableCopies = null;
                    }

                    detailsHtml += '<p><strong><?php echo e(__("Total Copies")); ?>:</strong> ' + (data.essential.copies_total !== null ? data.essential.copies_total : 'N/A') + '</p>';
                    detailsHtml += '<p><strong><?php echo e(__("Available Copies")); ?>:</strong> ' + (data.essential.copies_available !== null ? data.essential.copies_available : 'N/A') + '</p>';
                    if(data.essential.rack) { detailsHtml += '<p><strong><?php echo e(__("Rack")); ?>:</strong> ' + data.essential.rack + '</p>'; }
                    if(data.essential.shelf) { detailsHtml += '<p><strong><?php echo e(__("Shelf")); ?>:</strong> ' + data.essential.shelf + '</p>'; }
                    if(data.essential.room) { detailsHtml += '<p><strong><?php echo e(__("Room")); ?>:</strong> ' + data.essential.room + '</p>'; }
                    if(data.essential.cabinet) { detailsHtml += '<p><strong><?php echo e(__("Cabinet")); ?>:</strong> ' + data.essential.cabinet + '</p>'; }
                }
                $('#document_details').html(detailsHtml);
                validateAssignForm();
            },
            error: function() {
                $('#document_details').html('');
                availableCopies = null;
                validateAssignForm();
            }
        });
    }).on('select2:unselect', function (e) {
        availableCopies = null;
        $('#document_details').html('');
        validateAssignForm();
    });

    // Initial validation check after a short delay to ensure form is loaded
    setTimeout(function() {
        validateAssignForm();
    }, 100);
});
</script>
<?php /**PATH /home/khalid/Documents/ldms/resources/views/assign/create.blade.php ENDPATH**/ ?>