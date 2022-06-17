

<?php $__env->startSection('title', 'MilanWeb24: quotidiano sportivo dedicato al Milan'); ?>

<?php $__env->startSection('style'); ?>
<link rel="stylesheet" href="<?php echo e(url('css/home.css')); ?>" />
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script src="<?php echo e(url('js/home.js')); ?>" defer></script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contents'); ?>
<div id="home_comm">
                <div id="overlay"></div>
                <p>Accedi alla <a href="<?php echo e(url('login/auth')); ?>">Sezione Community</a> in cui potrai condividere le tue idee con altri tifosi del Milan!</p>
            </div>
            <!-- inserisco un form con un input csrf che  a ogni click su un certa notizia viene modificato e inviato al server lato js -->
            <form id="form_news" class="hidden">
                <?php echo csrf_field(); ?>
            </form>
            <h1>
                NEWS IN PRIMO PIANO
            </h1>
            <section id="main">
                <!-- qui dentro ci saranno le notizie prelevate dal database all'inizio-->
            </section>
            <p id="testo_ricerca">
                All'interno del riquadro in alto sono contenute solo le notizie piu' recenti...
                non perderti alcuna notizia con la sezione ricerca!
            </p>
            <form name="search">
                <?php echo csrf_field(); ?>  <!-- serve ad evitare attacchi cross-site request forgery -->
                <label>Cerca per <select name="modalita">
                    <option value="author">Fonte o giornalista</option>
                    <option value="generic">Ricerca generica</option>
                </select></label>
                <input type='text' name='object'>
                <input type="submit" name="invio" value="Cerca">
            </form>
            <span id="errore" class="errore" class="hidden"></span>
            <h1 id="titolo_ric" class="hidden">
                RICERCA NEWS
            </h1>
            <!-- mostrato solo se il json ritornato ha lunghezza 0 (è vuoto)-->
            <span id="ric_null" class="errore" class="hidden"></span>
            <section id="sez_notizie_trovate">
                <!-- qui dentro ci saranno le notizie prelevate dal database durante la ricerca-->
            </section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.starter', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\hw2\resources\views/home.blade.php ENDPATH**/ ?>