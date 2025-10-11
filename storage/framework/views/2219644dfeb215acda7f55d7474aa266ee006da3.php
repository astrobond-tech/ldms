<?php
    $document_type_title = ucwords(str_replace('_', ' ', $document_type ?? 'document'));
    $document_type_route = str_replace('_', '-', $document_type ?? 'document');
?>


<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Document Details')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <ul class="breadcrumb mb-0">
        <li class="breadcrumb-item">
            <a href="<?php echo e(route('dashboard')); ?>">
                <?php echo e(__('Dashboard')); ?>

            </a>
        </li>
        <li class="breadcrumb-item">
            <a href="<?php echo e(route($document_type_route.'.index')); ?>"><?php echo e(__($document_type_title)); ?></a>
        </li>
        <li class="breadcrumb-item active">
            <a href="#"><?php echo e(__('Details')); ?></a>
        </li>
    </ul>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <?php echo $__env->make('document.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <div class="col-lg-9">
                            <div class="email-body">

                                <div class="row align-items-center g-2">
                                    <div class="col">
                                        <h5><?php echo e(__('Send Email')); ?></h5>
                                    </div>
                                </div>
                                <?php echo e(Form::open(['route' => [$document_type_route.'.send.email', \Illuminate\Support\Facades\Crypt::encrypt($document->id)], 'method' => 'post'])); ?>

                                <?php echo e(Form::hidden('document_id', $document->id, ['class' => 'form-control'])); ?>

                                <div class="row">
                                    <div class="form-group  col-md-12">
                                        <?php echo e(Form::label('email', __('Email'), ['class' => 'form-label'])); ?>

                                        <?php echo e(Form::text('email', null, ['class' => 'form-control', 'placeholder' => __('Enter email')])); ?>

                                    </div>
                                    <div class="form-group  col-md-12">
                                        <?php echo e(Form::label('subject', __('Subject'), ['class' => 'form-label'])); ?>

                                        <?php echo e(Form::text('subject', null, ['class' => 'form-control', 'placeholder' => __('Enter subject')])); ?>

                                    </div>
                                    <div class="form-group  col-md-12">
                                        <?php echo e(Form::label('message', __('Message'), ['class' => 'form-label'])); ?>

                                        <?php echo e(Form::textarea('message', null, ['class' => 'form-control', 'placeholder' => __('Enter message'), 'rows' => 10])); ?>

                                    </div>
                                    <?php if(Gate::check('send mail')): ?>
                                        <div class="form-group  col-md-12 text-end">
                                            <?php echo e(Form::submit(__('Send'), ['class' => 'btn btn-secondary btn-rounded'])); ?>

                                        </div>
                                    <?php endif; ?>
                                </div>
                                <?php echo e(Form::close()); ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/khalid/Documents/ldms/resources/views/document/send_email.blade.php ENDPATH**/ ?>