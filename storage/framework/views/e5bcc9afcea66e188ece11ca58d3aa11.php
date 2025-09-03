<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ninja Network | Home</title>
</head>
<body>
    <h2>Currently Available Ninjas</h2>
    <p><?php echo e($greeting); ?></p>
    <ul>
        <li>
        <a href="/ninjas/<?php echo e($ninjas[0]['id']); ?>">
            <?php echo e($ninjas[0]['name']); ?>

        </a>
        </li>
        <li>
        <a href="/ninjas/<?php echo e($ninjas[1]['id']); ?>">
            <?php echo e($ninjas[1]['name']); ?>

        </a>
        </li>
        <li>
        <a href="/ninjas/<?php echo e($ninjas[2]['id']); ?>">
            <?php echo e($ninjas[2]['name']); ?>

        </a>
        </li>
    </ul>
</body>
</html><?php /**PATH C:\Users\User\Herd\ninja_network\resources\views/ninjas/index.blade.php ENDPATH**/ ?>