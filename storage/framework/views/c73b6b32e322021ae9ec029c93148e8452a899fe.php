<?php $__env->startSection('content'); ?>
<!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Sub Footer Cate
                            <small>Add</small>
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
                        <form action="admin/sub-footer/add" method="POST">
                            <div class="form-group">
                                <label>Footer</label>
                                <select class="form-control" name="Footer">
                                <?php $__currentLoopData = $footer; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $foo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo $foo->id; ?>"><?php echo $foo->ten; ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Sub Footer</label>
                                <input class="form-control" name="Ten" placeholder="Vui lòng đừng bỏ trống" />
                            </div>

                            <button type="submit" class="btn btn-success">Add SubFooter</button>
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