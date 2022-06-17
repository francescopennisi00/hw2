

<?php $__env->startSection('title', 'MilanWeb24: Stagione'); ?>

<?php $__env->startSection('style'); ?>
<link rel="stylesheet" href="<?php echo e(url('css/stagione.css')); ?>" />
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script src="<?php echo e(url('js/stagione.js')); ?>" defer></script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contents'); ?>
<section id="classifica">
                <h1>Classifica Serie A 2021-2022</h1>
                    <header>
                        <span>Squadra</span>
                        <span>
                            <a>PG</a>
                            <a>V</a>
                            <a>S</a>
                            <a>P</a>
                            <a>GF</a> 
                            <a>GS</a>
                            <a>DG</a>
                            <a>Pti</a>
                        </span>
                    </header>
            </section>
            <section id="calendario">
                <h1>Risultati Stagione 2021-2022</h1>
            </section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.starter', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\hw2\resources\views/stagione.blade.php ENDPATH**/ ?>