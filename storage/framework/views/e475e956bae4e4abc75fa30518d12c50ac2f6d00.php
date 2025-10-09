<?php
    $routeName = \Request::route()->getName();
?>
<div class="col-lg-3">

    <ul class="nav flex-column nav-tabs account-tabs mb-3" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link <?php echo e(empty($routeName) || $routeName == 'document.show' ? ' active ' : ''); ?>"
                href="<?php echo e(route('document.show', \Illuminate\Support\Facades\Crypt::encrypt($document->id))); ?>"
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
                <a class="nav-link <?php echo e(empty($routeName) || $routeName == 'document.comment' ? ' active ' : ''); ?>"
                    href="<?php echo e(route('document.comment', \Illuminate\Support\Facades\Crypt::encrypt($document->id))); ?>"
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
                <a class="nav-link <?php echo e(empty($routeName) || $routeName == 'document.reminder' ? ' active ' : ''); ?>"
                    href="<?php echo e(route('document.reminder', \Illuminate\Support\Facades\Crypt::encrypt($document->id))); ?>"
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
                <a class="nav-link <?php echo e(empty($routeName) || $routeName == 'document.version.history' ? ' active ' : ''); ?>"
                    href="<?php echo e(route('document.version.history', \Illuminate\Support\Facades\Crypt::encrypt($document->id))); ?>"
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
                <a class="nav-link <?php echo e(empty($routeName) || $routeName == 'document.share' ? ' active ' : ''); ?>"
                    href="<?php echo e(route('document.share', \Illuminate\Support\Facades\Crypt::encrypt($document->id))); ?>"
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
                <a class="nav-link <?php echo e(empty($routeName) || $routeName == 'document.send.email' ? ' active ' : ''); ?>"
                    href="<?php echo e(route('document.send.email', \Illuminate\Support\Facades\Crypt::encrypt($document->id))); ?>"
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
</div>
<?php /**PATH /home/khalid/Desktop/codecanyon-49249517-digital-document-saas-addon/main_file/resources/views/document/main.blade.php ENDPATH**/ ?>