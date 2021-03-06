<?php $__env->startSection('content'); ?>
<!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Comment Blog
                            <small>Edit Comment</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-7" style="padding-bottom:120px">
                    
                        <?php if(count($errors) > 0 ): ?>
                            <div class="alert alert-danger">
                                
                                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $loi): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php echo $loi; ?><br>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        <?php endif; ?>

                        
                        <?php if(session('thongbao')): ?>
                            <div class="alert alert-success">
                                <?php echo session('thongbao'); ?>

                            </div>
                        <?php endif; ?>
                        
                        <form action="<?php echo e(url('admin/comment-blog/edit/'.$comBlog->id)); ?>" method="POST">
                            <div class="form-group">
                                <label>User</label>
                                <select class="form-control" name="User">
                                <?php $__currentLoopData = $user; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ur): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo $ur->id; ?>"
                                        <?php if($comBlog->idUser==$ur->id): ?>
                                            <?php echo e("selected"); ?>

                                        <?php endif; ?>
                                    ><?php echo $ur->name; ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Blog</label>
                                <select class="form-control" name="Blog">
                                <?php $__currentLoopData = $blog; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option  value="<?php echo $bl->id; ?>"
                                        <?php if($comBlog->idBlog==$bl->id): ?>
                                            <?php echo e("selected"); ?>

                                        <?php endif; ?>

                                    ><?php echo $bl->tieude; ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Comment</label>
                                <textarea id="demo" class="form-control ckeditor" name="NoiDung"><?php if(old('NoiDung')): ?> <?php echo old('NoiDung'); ?> <?php else: ?> <?php echo e($comBlog->noidung); ?> <?php endif; ?></textarea>
                            </div>

                            <button type="submit" class="btn btn-success">Edit</button>
                            <button type="reset" class="btn btn-warning">Reset</button>
                             
                            <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                        <form>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.index', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>