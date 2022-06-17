

<?php $__env->startSection('title', 'MilanWeb24: Community'); ?>

<?php $__env->startSection('style'); ?>
<link rel="stylesheet" href="<?php echo e(url('css/community.css')); ?>" />
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script src="<?php echo e(url('js/community.js')); ?>" defer></script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contents'); ?>

<h1>MILANWEB24: COMMUNITY</h1>

            <header id="navbar_user_logout">
                <div>
                    <!-- l'attributo dataset serve per generare la pagina dinamica dell'utente al click sullo username-->
                    <a id = "user_button" class="gold" data-id-user = "<?php echo e($userid); ?>">@ <?php echo e($username); ?></a>
                    <a class="gold" href="<?php echo e(url('logout')); ?>">Logout</a>
                </div>
                <a id="button_new_post" href="<?php echo e(url('community/create_post')); ?>">Nuovo Post</a>
            </header>

            <section id="main">
                <!-- qui dentro ci saranno i post prelevati dal database (al massimo i 100 post più recenti)-->     
            </section>
            <!-- form invisibile per la creazione della pagina dell'utente al click sullo username -->
            <form id="form_user_page" class="hidden">
                <?php echo csrf_field(); ?>
            </form>

<?php $__env->stopSection(); ?>             
<?php echo $__env->make('layouts.starter', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\hw2\resources\views/community.blade.php ENDPATH**/ ?>