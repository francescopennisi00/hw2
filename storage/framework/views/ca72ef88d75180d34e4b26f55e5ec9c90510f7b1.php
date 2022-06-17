

<?php $__env->startSection('title', 'MilanWeb24: Accedi alla Community'); ?>

<?php $__env->startSection('style'); ?>
<link rel="stylesheet" href="<?php echo e(url('css/signup_login.css')); ?>" />
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contents'); ?>

<h1> Accedi alla community MilanWeb24</h1>

            <main>

                <div>
                    <img src="<?php echo e(url('images/coreografia.jpg')); ?>" />
                </div>

                <form method = "post" action = "<?php echo e(url('login')); ?>"> 
                    <?php echo csrf_field(); ?>  
                    
                    <?php echo $__env->yieldContent('errore'); ?> <!--conterrà gli eventuali messaggi di errore (immessi dalla view che estende questa) -->

                    <p>
                        <label>Username<input type="text" name="username"></label>
                        <span class="hidden">
                    </p>

                    <p>
                        <label>Password<input type="password" name="password"></label>
                        <span class="hidden">
                    </p>

                    <p>
                        <!-- se al momento del submit il checkbox è cliccato il value viene trasmesso al server, altrimenti no-->
                        <label>Ricorda l'accesso<input type="checkbox" name="remember" value="ok"></label>
                    </p>

                    <p>
                        <label>&nbsp;<input type="submit" value="Accedi"></label>
                    </p>


                    <div id="link">
                        <!-- faccio spazio tra il punto interrogativo ed il link-->
                        <div>Non hai ancora un account? &nbsp; <a href="<?php echo e(url('signup')); ?>"> Registrati</a></div>
                    </div>

                </form>


            </main>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.starter', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\hw2\resources\views/login.blade.php ENDPATH**/ ?>