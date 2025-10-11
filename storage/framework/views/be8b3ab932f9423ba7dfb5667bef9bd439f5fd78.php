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
            <a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a>
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
                            <?php if(Gate::check('create comment')): ?>
                                <div class="row align-items-center g-2">
                                    <div class="col">
                                        <h5><?php echo e(__('Comment')); ?></h5>
                                    </div>
                                </div>

                                <div class="row">
                                    <?php echo e(Form::open(['route' => [$document_type_route.'.comment', \Illuminate\Support\Facades\Crypt::encrypt($document->id)], 'method' => 'post'])); ?>

                                    <div class="form-group">
                                        <?php echo e(Form::textarea('comment', null, ['class' => 'form-control', 'rows' => 3, 'placeholder' => __('Write a comment')])); ?>

                                    </div>
                                    <div class="form-group col-md-12 text-end">
                                        <?php echo e(Form::submit(__('Add'), ['class' => 'btn btn-secondary'])); ?>

                                    </div>
                                    <?php echo e(Form::close()); ?>

                                </div>
                            <?php endif; ?>
                            <div class="row">
                                <ul class="list-group list-group-flush">
                                    <?php $__currentLoopData = $comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li class="list-group-item px-0">
                                            <div class="row align-items-center">
                                                <div class="col-md-3 mb-3 mb-md-0">
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-shrink-0">
                                                            <img class="img-radius img-fluid wid-40"
                                                                src="<?php echo e(!empty($comment->user) ? asset(Storage::url('upload/profile/')) . '/' . $comment->user->profile : asset(Storage::url('upload/profile')) . '/avatar.png'); ?>"
                                                                alt="User image">
                                                        </div>
                                                        <div class="flex-grow-1 ms-3">
                                                            <h5 class="mb-1">
                                                                <?php echo e(!empty($comment->user) ? $comment->user->name : '-'); ?>

                                                                <i
                                                                    class="material-icons-two-tone text-success f-16">verified_user</i>
                                                            </h5>
                                                            <h6 class="text-muted mb-0">
                                                                <?php echo e(!empty($comment) ? dateFormat($comment->created_at) : '-'); ?>

                                                            </h6>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-grow-1 me-3">
                                                             
                                                            <p class="mb-0 text-muted mt-2">
                                                                <?php echo e(!empty($comment) ? $comment->comment : '-'); ?>

                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/khalid/Documents/ldms/resources/views/document/comment.blade.php ENDPATH**/ ?>