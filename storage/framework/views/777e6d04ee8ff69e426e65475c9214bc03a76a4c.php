<?php $__env->startSection('title', 'Instapic: Home'); ?>

<?php $__env->startPush('head'); ?>
<link rel="stylesheet" href="<?php echo e(asset('/css/insta.css')); ?>">
<script src="<?php echo e(asset('/js/insta.js')); ?>">
</script>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>

<a href="#" class="btn btn-success btn-lg top-navigation_button"><span>&#8593</span> </a>
<ul style="position: fixed; z-index:50; left:0; list-style-type:none; top:40%">
    <li> <a class="btn btn-primary btn-lg side-button text-left" id = "sidebutton_posts" onmouseover="changetext(this)" onmouseout="reseticon(this)" href="/insta"><span class="glyphicon glyphicon-globe"></span></a></li>
    <br>
    <li> <a class="btn btn-primary btn-lg side-button text-left" id = "sidebutton_friends" onmouseover="changetext(this)" onmouseout="reseticon(this)" href="<?php echo e(route('friends',['id'=> Auth::id()])); ?>"><span class="glyphicon glyphicon-user"></span></a></li>
    </ul>
<div class="container" id = "fixme" style="z-index : 1">    
    <div class="row" style="padding:2%; box-shadow: 3px 3px 20px 8px blue;">
    <div class="col-md-4" style="text-align: center">
    <img class="img-circle" src="/storage/insta_images/<?php echo e($profile_image); ?>" width="150" height="120">
    </div>
    <div class="col-md-8"> 
    
        <?php if(!Auth::guest()): ?>
        <h3><?php echo e(Auth::user()->name); ?></h3><br>
        <?php endif; ?>
    <!--upload profile -->       
    <input type="button" value="Upload ProfilePhoto" class="btn btn-primary btn-lg" onclick="func(this)" />
    <?php echo Form::open(['name'=>'myform','action'=>'Insta\InstaController@upload_profile','method'=> 'POST','enctype'=>'multipart/form-data','style'=>'display:none']); ?>

    <?php echo e(Form::file('insta_image')); ?>

    <br>
    <?php echo e(Form::submit('Upload Photo',['class'=>'btn btn-primary btn-lg'])); ?>

    <?php echo Form::close(); ?>

    <!--uplaod post --
    <input type="file" id="post_image" style="display:none;"/> -->
    <input type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target=".www"
        value="Post Your Pic" />
            
    </div>
    </div>
    </div>
    <br>
    <div class="d-flex justify-content-around">
       
    <div class='container'>
    <?php if(count($photos)>0): ?>
    <?php $__currentLoopData = $photos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div style="padding:2%;box-shadow: 3px 3px 20px 8px green;">
    <font size=3>
    <div class='d-flex justify-content-between'>
    <div>
        <?php if(!empty($item->user->user_profile->profile_photo)): ?>
        <img src="/storage/insta_images/<?php echo e($item->user->user_profile->profile_photo); ?>" class="img-circle" style="position:relative; width:5%; height:auto;">
        <?php else: ?>
        <img src="/storage/insta_images/noimage.jpg" class="img-circle" style="position:relative; width:5%; height:auto;">
        <?php endif; ?>
           
        <b> <?php echo e($item->user->name); ?> </b> has posted a image =><br>
    <code> Uploaded at : <?php echo e($item->created_at); ?></code>
    </div>
    <div>
        <?php if(Auth::user()->id == $item->user->id): ?>
        <a href="/insta/delete/<?php echo e($item->id); ?>" class="btn btn-success btn-lg "><i class="glyphicon glyphicon-trash"></i>    Delete</a>
        <?php endif; ?>
    </div>
    </div>
    <p><?php echo e($item->description); ?></p>
    <div style="text-align: center">
    <img src="/storage/insta_images/<?php echo e($item->image_name); ?>" class="img-rounded" width="50%" height="auto">
    </div>
    <br>
    </font>
    <div class="comments" style="border: 1px solid lightblue;">
        <button class="btn btn-link" onclick="load_comments(<?php echo e($item->id); ?>,this)"> View Comments</button><br>
        <?php echo $__env->make('Insta\ajax_comments', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php if($item->latest_comment): ?>
        <img src="/storage/insta_images/wolf.jpg" class="img-circle" style="width=30px; height:20px;">
        <b> <?php echo e($item->latest_comment->user->name); ?> : </b><?php echo e($item->latest_comment->message); ?> <br>
        <?php endif; ?>
        </div>
    <!-- Post Comment -->
    <div><?php echo Form::open(['action'=>'Insta\InstaController@post_comment','method'=>'POST']); ?>

        <div class="row">
            <div class="col-md-10">
                <?php echo e(Form::text('photo_comment','',['class'=>'form-control','placeholder'=>'Post a comment..'])); ?>

                <?php echo e(Form::text('photo_id',$item->id,['style'=>'display:none;'])); ?>

            </div>
            <div class="=col-md-2">
                <input type="button" class="btn btn-primary" onclick="post_comment(this)" value="Post comment">
            </div>
        </div>
        <?php echo Form::close(); ?>

    </div>
    </div>
    <br>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>
</div>
    </div>
    <?php echo e($photos->links()); ?>





<!-- modal -->
<div class="modal fade www" id="post_modal" role="dialog">
    <div class="modal-dialog modal-lg">
            <?php echo Form::open(['action'=>'Insta\InstaController@upload_post','method' => 'POST', 'enctype'=>'multipart/form-data']); ?>

             
        <div class="modal-content" style="padding:8px; box-shadow: 3px 3px 10px 8px pink;">
            <div class="modal-header">
              <?php echo e(Form::file('post_image',['id'=>'post_image','onchange'=>'preview_image(this)'])); ?>  
             <img src="" id="modal_image" class="img-rounded" style="width:60%; margin:auto;">
               <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <?php echo e(Form::textarea('post_description',null,['class'=>'form-control','placeholder'=>'Say Something about the pic..'])); ?>

               </div>
            <div class=:modal-footer style="text-align:right;">
                <?php echo e(Form::submit('Post it !',['class'=>'btn btn-primary btn-lg'])); ?>

                <?php echo Form::close(); ?>

               </div>
        </div>
    </div>
</div>

 
    
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>