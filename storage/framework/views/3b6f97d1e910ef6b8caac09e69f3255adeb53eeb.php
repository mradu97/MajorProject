<div style=" display:flex;">
    <ul class="friend-list" style="color: blue; width : 100%; list-style : none; box-shadow : 0 0 10px 1px blue;">
        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <li>
            <div class="d-flex justify-content-between" style="padding:10px">
                <div>
                    <?php if(!empty($user->user_profile->profile_photo)): ?>
                    <img src="/storage/insta_images/<?php echo e($user->user_profile->profile_photo); ?>" height="60px" width="60px" style="border-radius : 50%;">                
                    <?php else: ?>
                    <img src="/storage/insta_images/noimage.jpg" height="60px" width="60px" style="border-radius : 50%;">       
                    <?php endif; ?>
                    <h3 style="display : inline;">&nbsp <?php echo e($user->name); ?></h3>
                </div>
                <?php echo Form::open(['action' => 'Insta\InstaController@sendRequest', 'method'=>'POST']); ?>

            <input type="text" style="display : none" name="receiver_id" value="<?php echo e($user->id); ?>">
                <input type="button" class ="btn btn-primary" onclick="sendRequest(<?php echo e($user->id); ?>, this)" value="Send Request">
            <?php echo Form::close(); ?>

            </div>
        </li>  
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>       
    </ul>
</div>