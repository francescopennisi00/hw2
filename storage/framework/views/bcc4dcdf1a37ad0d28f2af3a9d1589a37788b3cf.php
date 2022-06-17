

<?php $__env->startSection('title', 'MilanWeb24'); ?>  <!-- questo titolo verrà poi modificato lato client (grazie ai dati prelevati dal json) -->

<?php $__env->startSection('style'); ?>
<link rel="stylesheet" href="<?php echo e(url('css/news.css')); ?>" />
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script src="<?php echo e(url('js/news.js')); ?>" defer></script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contents'); ?>
<!-- qui troviamo la sezione principale della pagina -->
<section id = "main" data-id-notizia = "<?php echo e($id_notizia); ?>" >
</section>
<?php $__env->stopSection(); ?>  
<?php echo $__env->make('layouts.starter', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\hw2\resources\views/news.blade.php ENDPATH**/ ?>