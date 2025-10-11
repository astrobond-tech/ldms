<div class="modal-body">
    <div class="row">
        <div class="form-group col-md-12">
            <?php echo e(Form::label('clients',__('Clients'),array('class'=>'form-label'))); ?>

            <?php echo e(Form::select('clients[]', $clients, null, array('class'=>'form-control hidesearch','multiple'=>'multiple', 'id'=>'clients'))); ?>

        </div>
        <hr>
        <div class="form-group col-md-12">
            <div class="form-check form-switch">
                <?php echo Form::checkbox('exp_date_status', 1, null, [
                    'class' => 'form-check-input scsh',
                    'id' => 'flexSwitchCheckChecked',
                    'role' => 'switch',
                ]); ?>

                <?php echo Form::label('flexSwitchCheckChecked', __('Link expiration'), ['class' => 'form-check-label h4']); ?>

            </div>
            <?php echo e(Form::date('exp_date', null, ['class' => 'form-control sse d-none'])); ?>

        </div>
        <hr>
        <div class="form-group col-md-12">
            <div class="form-check form-switch">
                <input class="form-check-input scsh" type="checkbox" role="switch" id="flexSwitchCheckChecked"
                    name="password_status" value="1">
                <label class="form-check-label h4" for="flexSwitchCheckChecked"><?php echo e(__('Password Protection')); ?></label>
            </div>
            <?php echo e(Form::text('password', null, ['class' => 'form-control sse d-none', 'placeholder' => __('Enter Password')])); ?>

        </div>
        <hr>
        <div class="form-group col-md-12">
            <div class="input-group mb-3">
                <input type="text" class="form-control" id="shareableLinkInput" value="">
                <span class="input-group-text pointer" id="copyButton" onclick="copyToClipboard('')"><i
                        data-feather="copy"></i></span>
            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    <?php echo e(Form::button(__('Genarate Link'), ['class' => 'btn btn-secondary btn-rounded genarate_link'])); ?>

    <button type="button" class="btn btn-primary btn-rounded d-none" id="send-link-btn"><?php echo e(__('Send Link')); ?></button>
</div>


<script>
    $(document).on('change keyup', '.scsh, .sse', function() {
        $('#shareableLinkInput').val('');
        $('.scsh').each(function() {
            const $wrapper = $(this).closest('.form-group');
            const $relatedInput = $wrapper.find('.sse');
            if ($(this).is(':checked')) {
                $relatedInput.removeClass('d-none');
            } else {
                $relatedInput.addClass('d-none');
            }
        });
    });


    $(document).on('click', '.genarate_link', function() {
        $.ajax({
            url: '<?php echo e(route($document_type_route . '.generate.shareable.link')); ?>',
            type: 'GET',
            data: {
                exp_date: $('input[name="exp_date_status"]').is(':checked') ? $(
                    'input[name="exp_date"]').val() : '',
                password: $('input[name="password_status"]').is(':checked') ? $(
                    'input[name="password"]').val() : '',
                did: '<?php echo e($id); ?>',
            },
            success: function(response) {
                if (response.url) {
                    $('#shareableLinkInput').val(response.url);
                    $('#copyButton').attr('onclick', "copyToClipboard('" + response.url + "')");
                    $('#send-link-btn').removeClass('d-none'); // Show the send button
                }
            },
            error: function() {
                alert('Failed to generate link.');
            }
        });
    });

    $('#send-link-btn').on('click', function() {
        var clients = $('#clients').val();
        if (!clients || clients.length === 0) {
            alert('Please select at least one client.');
            return;
        }

        var url = $('#shareableLinkInput').val();
        var password = $('input[name="password_status"]').is(':checked') ? $('input[name="password"]').val() : '';
        var exp_date = $('input[name="exp_date_status"]').is(':checked') ? $('input[name="exp_date"]').val() : '';

        $(this).prop('disabled', true).text('Sending...');

        $.ajax({
            url: '<?php echo e(route("document.send-share-link")); ?>',
            type: 'POST',
            data: {
                _token: '<?php echo e(csrf_token()); ?>',
                clients: clients,
                url: url,
                password: password,
                exp_date: exp_date,
            },
            success: function(response) {
                alert(response.success);
                $('#send-link-btn').prop('disabled', false).text('Send Link');
                $('.customModal').modal('hide');
            },
            error: function(xhr) {
                alert(xhr.responseJSON.error || 'An error occurred while sending emails.');
                $('#send-link-btn').prop('disabled', false).text('Send Link');
            }
        });
    });
</script>
<?php /**PATH /home/khalid/Documents/ldms/resources/views/document/Sharelink.blade.php ENDPATH**/ ?>