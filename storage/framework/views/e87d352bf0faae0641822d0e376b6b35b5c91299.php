<?php echo e(Form::open(array('url'=>'document','method'=>'post', 'enctype' => "multipart/form-data"))); ?>

<div class="modal-body">
    <div class="row">
        <div class="form-group col-md-6">
            <?php echo e(Form::label('assign_to',__('Assign To'),array('class'=>'form-label'))); ?>

            <?php echo e(Form::select('assign_to',$client,null,array('class'=>'form-control hidesearch'))); ?>

        </div>
        <div class="form-group  col-md-6">
            <?php echo e(Form::label('name',__('Name'),array('class'=>'form-label'))); ?>

            <?php echo e(Form::text('name',null,array('class'=>'form-control','placeholder'=>__('Enter document name')))); ?>

        </div>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('category_id',__('Category'),array('class'=>'form-label'))); ?>

            <?php echo e(Form::select('category_id',$category,null,array('class'=>'form-control hidesearch','id'=>'category'))); ?>

        </div>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('sub_category_id',__('Sub Category'),array('class'=>'form-label'))); ?>

            <div class="sc_div">
                <select class="form-control hidesearch sub_category_id" id="sub_category_id" name="sub_category_id">
                    <option value=""><?php echo e(__('Select Sub Category')); ?></option>
                </select>
            </div>
        </div>
        <div class="form-group  col-md-4">
            <?php echo e(Form::label('document',__('Document'),array('class'=>'form-label'))); ?>

            <?php echo e(Form::file('document',array('class'=>'form-control'))); ?>

        </div>
        <div class="form-group col-md-4">
            <?php echo e(Form::label('tages',__('Tages'),array('class'=>'form-label'))); ?>

            <?php echo e(Form::select('tages[]',$tages,null,array('class'=>'form-control hidesearch','multiple'))); ?>

        </div>
        <div class="form-group col-md-4">
            <?php echo e(Form::label('stage_id',__('Stage'),array('class'=>'form-label'))); ?>

            <?php echo e(Form::select('stage_id',$stage_id,null,array('class'=>'form-control hidesearch'))); ?>

        </div>
        <div class="form-group  col-md-12">
            <?php echo e(Form::label('description',__('Description'),array('class'=>'form-label'))); ?>

            <?php echo e(Form::textarea('description',null,array('class'=>'form-control','rows'=>3))); ?>

        </div>
    </div>
</div>
<div class="modal-footer">

    <?php echo e(Form::submit(__('Create'),array('class'=>'btn btn-secondary btn-rounded'))); ?>

</div>
<?php echo e(Form::close()); ?>

<script>
      var baseUrl = "<?php echo e(route('category.sub-category', ':id')); ?>";
</script>
<script src="<?php echo e(asset('js/custom/document.js?')); ?><?php echo e(time()); ?>"></script>
<?php /**PATH /home/khalid/Desktop/codecanyon-49249517-digital-document-saas-addon/main_file/resources/views/document/create.blade.php ENDPATH**/ ?>