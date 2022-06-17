

<?php $__env->startSection('title', 'MilanWeb24: Iscriviti alla Community'); ?>

<?php $__env->startSection('style'); ?>
<link rel="stylesheet" href="<?php echo e(url('css/signup_login.css')); ?>" />
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script src="<?php echo e(url('js/signup.js')); ?>" defer></script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contents'); ?>

<h1> Registrati alla community MilanWeb24</h1>

            <main>

                <div>
                   <img src=" <?php echo e(url('images/coreografia.jpg')); ?>" />
                </div>

                <form method = "post" action = " <?php echo e(url('register')); ?>" >   <!--spedisco i dati al SignUpController, che li valida opportunamente-->
                    <?php echo csrf_field(); ?> <!-- per evitare attacchi cross-site request forgery -->

                    <p>
                        <label>Nome<input type="text" name="nome"></label>
                        <span class="hidden">
                    </p>

                    <p>
                        <label>Cognome<input type="text" name="cognome"></label>
                        <span class="hidden">
                    </p>

                    <p>
                        <label>Email<input type="text" name="email"></label>
                        <span class="hidden">
                    </p>

                    <p>
                        <label>Username<input type="text" name="username"></label>
                        <span class="hidden">
                    </p>

                    <p>
                        <label>Password<input type="password" name="password"></label>
                        <span class="hidden">
                    </p>

                    <p>
                        <label>Conferma password<input type="password" name="conferma_password"></label>
                        <span class="hidden">
                    </p>

                    <p>
                        <label>Acconsento al trattamento dei dati personali<input type="checkbox" name="allow" value="confermed"></label>
                        <span class="hidden">
                    </p>

                    <p>
                        <label>&nbsp;<input type="submit" value="Registrati"></label>
                    </p>

                    <div id="link">
                        <!-- faccio spazio tra il punto interrogativo ed il link-->   <!--SISTEMARE IL LINK-->
                        <div>Hai già un account? &nbsp; <a href="<?php echo e(url('login')); ?>"> Accedi</a></div>
                    </div>            

                </form>

            </main>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.starter', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\hw2\resources\views/signup.blade.php ENDPATH**/ ?>