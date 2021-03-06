<?php $__env->startSection('title'); ?>
	<?php echo e("Category"); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
	<?php echo $__env->make('layouts.ads', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<section>
		<div class="container">
			<div class="row">
				<div class="col-sm-3 col-md-3">
					<?php echo $__env->make('layouts.left-sidebar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
				</div>
				<div class="col-sm-9 col-md-9 padding-right">
					<div class="features_items"><!--features_items-->
						<h2 class="title text-center">Features Items</h2>
						<?php if(count($product3)==0): ?>
							<h1 class="text-warning text-center">Sản phẩm hiện chưa có</h1>
							<h3 class="text-center">Ấn vào <a href="javascript:history.back()">đây</a> để quay lại</h3>
						<?php endif; ?>
						<div id="load-category">
							<?php $__currentLoopData = $product3; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prod): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<div class="col-sm-4 col-md-4">
								<div class="product-image-wrapper">
									<div class="single-products">
										<div class="productinfo text-center">
											<img src="upload/product/<?php echo e($prod->hinh); ?>" alt="" />
											<h2>$<?php echo e($prod->gia); ?></h2>
											<p><?php echo e($prod->ten); ?></p>
											<a href="product-detail/<?php echo e($prod->tenkodau); ?>-<?php echo e($prod->id); ?>.html" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
										</div>
										<div class="product-overlay">
											<div class="overlay-content">
												<h2>$<?php echo e($prod->gia); ?></h2>
												<p><?php echo e($prod->ten); ?></p>
												<a href="product-detail/<?php echo e($prod->tenkodau); ?>-<?php echo e($prod->id); ?>.html" class="btn btn-default add-to-cart"><i class="fa fa-info"></i>View Detail</a>
													<br>
												<a href="buy/<?php echo e($prod->tenkodau); ?>-<?php echo e($prod->id); ?>.html" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
											</div>

											<?php if($prod->noibat==1 && $prod->soluong > 50): ?>
													<img src="images/home/new.png" class="new" alt="" />
											<?php endif; ?>
											<?php if($prod->soluong <=50 && $prod->noibat==0): ?>
													<img src="images/home/sale.png" class="new" alt="" />
											<?php endif; ?>
											
										</div>
									</div>
									<div class="choose">
										<ul class="nav nav-pills nav-justified">
											<li><a href=""><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
											<li><a href=""><i class="fa fa-plus-square"></i>Add to compare</a></li>
										</ul>
									</div>
								</div>
							</div>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</div>
						<?php if(count($product3)>0): ?>
							<?php $__currentLoopData = $product3->take(1); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prod): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<input type="hidden" name="idSubCate" value="<?php echo e($prod->subcate->id); ?>">
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						<?php endif; ?>
						<div class="col-sm-12 col-md-12 text-center">
							<?php echo e($product3->render()); ?>

						</div>
					</div><!--features_items-->
				</div>
			</div>
		</div>
	</section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
	<script type="text/javascript">
	$(document).ready(function() {
		$("#sl2").slider()
			.on('slideStop', function(event, ui) {
			var price_range=this.value;
			var token= $("input[name='_token']").val();
			var idSubCate= $("input[name='idSubCate']").val();
			$.ajax({
				url:'category.html',
				method:'post',
				data: {
					"price_range":price_range,
					"_token":token,
					"idSubCate":idSubCate
				},
				success:function(data){
					//load
					$("#load-category").html(data);
				}
			});
		});
	});
	</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.index', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>