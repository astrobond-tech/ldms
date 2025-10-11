<?php
    $routeName = \Request::route()->getName();
?>
<div class="col-lg-3">

    <ul class="nav flex-column nav-tabs account-tabs mb-3" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link <?php echo e(in_array($routeName, [$document_type_route.'.show', '']) ? ' active ' : ''); ?>"
                href="<?php echo e(route($document_type_route.'.show', \Illuminate\Support\Facades\Crypt::encrypt($document->id))); ?>"
                aria-selected="true">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0">
                        <i data-feather="list"></i>
                    </div>
                    <div class="flex-grow-1 ms-2">
                        <h5 class="mb-0"><?php echo e(__('Basic Details')); ?></h5>
                    </div>
                </div>
            </a>
        </li>
        <?php if(Gate::check('manage comment')): ?>
            <li class="nav-item">
                <a class="nav-link <?php echo e($routeName == $document_type_route.'.comment' ? ' active ' : ''); ?>"
                    href="<?php echo e(route($document_type_route.'.comment', \Illuminate\Support\Facades\Crypt::encrypt($document->id))); ?>"
                    aria-selected="true">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <i data-feather="message-circle"></i>
                        </div>
                        <div class="flex-grow-1 ms-2">
                            <h5 class="mb-0"><?php echo e(__('Comment')); ?></h5>
                        </div>
                    </div>
                </a>
            </li>
        <?php endif; ?>
        <?php if(Gate::check('manage reminder')): ?>
            <li class="nav-item">
                <a class="nav-link <?php echo e($routeName == $document_type_route.'.reminder' ? ' active ' : ''); ?>"
                    href="<?php echo e(route($document_type_route.'.reminder', \Illuminate\Support\Facades\Crypt::encrypt($document->id))); ?>"
                    aria-selected="true">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <i data-feather="user-check"></i>
                        </div>
                        <div class="flex-grow-1 ms-2">
                            <h5 class="mb-0"><?php echo e(__('Reminder')); ?></h5>
                        </div>
                    </div>
                </a>
            </li>
        <?php endif; ?>
        <?php if(Gate::check('manage version')): ?>
            <li class="nav-item">
                <a class="nav-link <?php echo e($routeName == $document_type_route.'.version.history' ? ' active ' : ''); ?>"
                    href="<?php echo e(route($document_type_route.'.version.history', \Illuminate\Support\Facades\Crypt::encrypt($document->id))); ?>"
                    aria-selected="true">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <i data-feather="briefcase"></i>
                        </div>
                        <div class="flex-grow-1 ms-2">
                            <h5 class="mb-0"><?php echo e(__('Version')); ?></h5>
                        </div>
                    </div>
                </a>
            </li>
        <?php endif; ?>
        <?php if(Gate::check('manage share document')): ?>
            <li class="nav-item">
                <a class="nav-link <?php echo e($routeName == $document_type_route.'.share' ? ' active ' : ''); ?>"
                    href="<?php echo e(route($document_type_route.'.share', \Illuminate\Support\Facades\Crypt::encrypt($document->id))); ?>"
                    aria-selected="true">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <i data-feather="share-2"></i>
                        </div>
                        <div class="flex-grow-1 ms-2">
                            <h5 class="mb-0"><?php echo e(__('Share')); ?></h5>
                        </div>
                    </div>
                </a>
            </li>
        <?php endif; ?>
        <?php if(Gate::check('manage mail')): ?>
            <li class="nav-item">
                <a class="nav-link <?php echo e($routeName == $document_type_route.'.send.email' ? ' active ' : ''); ?>"
                    href="<?php echo e(route($document_type_route.'.send.email', \Illuminate\Support\Facades\Crypt::encrypt($document->id))); ?>"
                    aria-selected="true">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <i data-feather="mail"></i>
                        </div>
                        <div class="flex-grow-1 ms-2">
                            <h5 class="mb-0"><?php echo e(__('Send Email')); ?></h5>
                        </div>
                    </div>
                </a>
            </li>
        <?php endif; ?>

    </ul>
</div><?php /**PATH /home/khalid/Documents/ldms/resources/views/document/main.blade.php ENDPATH**/ ?>