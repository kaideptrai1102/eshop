    
    
        
        <!-- Page Content -->
    <?php $__env->startSection('content'); ?>
<!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Category
                            <small>Đang sửa: <?php echo $category->ten; ?></small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-7" style="padding-bottom:120px">
                    
                    <?php if(count($errors)>0): ?>
                        <div class="alert alert-danger">
                            
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $loi): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php echo e($loi); ?><br>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    <?php endif; ?>
                    
                    <?php if(session('thongbao')): ?>
                        <div class="alert alert-success">
                            <?php echo e(session('thongbao')); ?>

                        </div>
                    <?php endif; ?>
                    
                        <form action="<?php echo e(url('admin/category/edit/'.$category->id)); ?>" method="POST">
                            <div class="form-group">
                                <label>Category</label>
                                <input class="form-control" name="Ten" placeholder="Điền tên thể loại" value="<?php if(old('Ten')): ?> <?php echo old('Ten'); ?> <?php else: ?> <?php echo $category->ten; ?> <?php endif; ?>"/>
                            </div>
                            <button type="submit" class="btn btn-success">Edit Category</button>
                            <button type="reset" class="btn btn-warning">Reset</button>
                            
                            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
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