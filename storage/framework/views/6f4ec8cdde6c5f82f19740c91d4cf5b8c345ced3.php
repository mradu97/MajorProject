<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    <?php if(session('status')): ?>
                        <div class="alert alert-success" role="alert">
                            <?php echo e(session('status')); ?>

                        </div>
                    <?php endif; ?>
                    Welcome <?php echo e(auth()->user()->name); ?> ! You are logged in. <br><br> 
                <?php if(count($posts)>0): ?>
                 <table class="table table-striped">
                     <th>Title</th>
                     <th></th>
                <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                    <td><a href="/posts/<?php echo e($item->id); ?>"><?php echo e($item->title); ?></a></td>
                    <td><a href="/posts/<?php echo e($item->id); ?>/edit" class="btn btn-link">Edit</a>
                    <?php echo Form::open(['action'=>['PostsController@destroy',$item->id],'method'=>'POST']); ?>

                    <?php echo e(Form::hidden('.method','DELETE')); ?>

                    <?php echo e(Form::submit('Delete',['class'=>'btn btn-link'])); ?>

                    <?php echo Form::close(); ?>                    
                    </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>     
                </table>                    
                <?php endif; ?>
                <a href="/posts/create" class="btn btn-primary" style="float:right"> Create Post</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>