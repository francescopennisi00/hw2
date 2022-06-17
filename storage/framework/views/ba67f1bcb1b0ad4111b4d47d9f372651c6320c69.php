

<?php $__env->startSection('title', 'MilanWeb24 - Community: Crea post'); ?>

<?php $__env->startSection('style'); ?>
<link rel="stylesheet" href="<?php echo e(url('css/create_post.css')); ?>" />
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script src="<?php echo e(url('js/create_post.js')); ?>" defer></script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contents'); ?>

<main>

<header>
    <a href= "<?php echo e(url('login/auth')); ?>" >
         <img src = "<?php echo e(url('images/esci.png')); ?>" />
     </a>
    <h3> Crea un post </h3> 
    <button> Pubblica </button>
</header>

<section> <!-- questa sezione racchiude i dati dell'utente loggato (ottenuti tramite fetch) seguiti dalla textarea-->
     
     <div></div>
 
     <form id = "textarea" method="post">
         <?php echo csrf_field(); ?>
     </form>
     <textarea form="textarea" name = "content" placeholder="A cosa stai pensando?"></textarea>

 </section>

</main>

<?php $__env->stopSection(); ?>       
<?php echo $__env->make('layouts.starter', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\hw2\resources\views/create_post.blade.php ENDPATH**/ ?>