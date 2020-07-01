<?php $__env->startSection('content'); ?>
        <center><h1><?php echo e($num1); ?>  <?php echo e($num2); ?></h1></center>
<?php $__env->stopSection(); ?>  

<?php echo $__env->make('layout.layout1', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>