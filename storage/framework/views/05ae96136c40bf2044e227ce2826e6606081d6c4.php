<!DOCTYPE html>
    <head>
        <title><?php echo $__env->yieldContent('title'); ?></title>
        <link rel="stylesheet" href="<?php echo e(url('css/common_style.css')); ?>" />
        <?php echo $__env->yieldContent('style'); ?>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php echo $__env->yieldContent('script'); ?>
        <script>
            const BASE_URL = "<?php echo e(url('/')); ?>";
        </script>
        <script src="<?php echo e(url('js/common_script.js')); ?>" defer></script>
        <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@1,200&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
    </head>
    <body>
        <article>
            <nav id="links">
                <a href="<?php echo e(url('/')); ?>">HOME</a> 
                <a href="<?php echo e(url('stagione')); ?>">STAGIONE</a>  
                <a href="<?php echo e(url('login/auth')); ?>">COMMUNITY</a>  
            </nav>
            <div id="menu" class="hidden">
                <div></div>
                <div></div>
                <div></div>
            </div>
            <div id="menu_view" class="hidden">
                <a href="<?php echo e(url('/')); ?>">HOME</a>
                <a href="<?php echo e(url('stagione')); ?>">STAGIONE</a>  
                <a href="<?php echo e(url('login/auth')); ?>">COMMUNITY</a> 
                <em>Chiudi menu</em>
            </div>
            <header id="upper_header">
                <div id="spazio_nero"></div>
                <img src=" <?php echo e(url('images/logo_pagina.png')); ?>" />
            </header>
    
            <?php echo $__env->yieldContent('contents'); ?>

            <footer>
                <img src=" <?php echo e(url('images/logo_milan.png')); ?>" />
                <p>
                    Universita' di Catania Web Programming 2022 </br>
                    Realizzato da Francesco Pennisi
                </p>
                <img src=" <?php echo e(url('images/nuovo-logo-unict.png')); ?>" />
            </footer>
        </article>
    </body>
</html><?php /**PATH C:\xampp\htdocs\hw2\resources\views/layouts/starter.blade.php ENDPATH**/ ?>