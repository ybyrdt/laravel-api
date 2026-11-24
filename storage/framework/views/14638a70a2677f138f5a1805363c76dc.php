<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title', 'Manajemen Produk'); ?></title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0f2f5;
            color: #333;
        }

        /* ---- Navbar ---- */
        nav {
            background-color: #2c3e50;
            padding: 0 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 56px;
            box-shadow: 0 2px 6px rgba(0,0,0,.3);
        }

        nav .brand {
            color: #ecf0f1;
            font-size: 1.2rem;
            font-weight: 700;
            text-decoration: none;
            letter-spacing: .5px;
        }

        nav ul {
            list-style: none;
            display: flex;
            gap: 1.5rem;
        }

        nav ul a {
            color: #bdc3c7;
            text-decoration: none;
            font-size: .95rem;
            transition: color .2s;
        }

        nav ul a:hover, nav ul a.active {
            color: #fff;
        }

        /* ---- Container ---- */
        .container {
            max-width: 1100px;
            margin: 2rem auto;
            padding: 0 1.5rem;
        }

        /* ---- Flash messages ---- */
        .alert {
            padding: .85rem 1.2rem;
            border-radius: 6px;
            margin-bottom: 1.2rem;
            font-size: .95rem;
            display: flex;
            align-items: center;
            gap: .6rem;
        }

        .alert-success {
            background-color: #d4edda;
            border: 1px solid #c3e6cb;
            color: #155724;
        }

        .alert-error {
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
            color: #721c24;
        }

        /* ---- Card ---- */
        .card {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,.08);
            padding: 1.5rem;
        }

        /* ---- Table ---- */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: .75rem 1rem;
            text-align: left;
            border-bottom: 1px solid #e9ecef;
        }

        th {
            background-color: #f8f9fa;
            font-weight: 600;
            font-size: .88rem;
            text-transform: uppercase;
            letter-spacing: .5px;
            color: #6c757d;
        }

        tr:hover td { background-color: #f8f9fa; }

        /* ---- Buttons ---- */
        .btn {
            display: inline-block;
            padding: .45rem .9rem;
            border-radius: 5px;
            font-size: .88rem;
            font-weight: 500;
            cursor: pointer;
            border: none;
            text-decoration: none;
            transition: opacity .2s;
        }

        .btn:hover { opacity: .85; }
        .btn-primary { background-color: #3498db; color: #fff; }
        .btn-warning { background-color: #f39c12; color: #fff; }
        .btn-danger  { background-color: #e74c3c; color: #fff; }
        .btn-secondary { background-color: #95a5a6; color: #fff; }

        /* ---- Forms ---- */
        .form-group {
            margin-bottom: 1.1rem;
        }

        label {
            display: block;
            font-weight: 600;
            margin-bottom: .35rem;
            font-size: .92rem;
        }

        input[type="text"],
        input[type="number"],
        select {
            width: 100%;
            padding: .55rem .8rem;
            border: 1px solid #ced4da;
            border-radius: 5px;
            font-size: .95rem;
            transition: border-color .2s, box-shadow .2s;
        }

        input:focus, select:focus {
            outline: none;
            border-color: #3498db;
            box-shadow: 0 0 0 3px rgba(52,152,219,.15);
        }

        .invalid-feedback {
            color: #e74c3c;
            font-size: .82rem;
            margin-top: .3rem;
        }

        input.is-invalid, select.is-invalid {
            border-color: #e74c3c;
        }

        /* ---- Pagination ---- */
        .pagination {
            display: flex;
            gap: .4rem;
            margin-top: 1.2rem;
            justify-content: flex-end;
        }

        .pagination a, .pagination span {
            padding: .4rem .75rem;
            border: 1px solid #dee2e6;
            border-radius: 4px;
            font-size: .88rem;
            color: #3498db;
            text-decoration: none;
        }

        .pagination .active span {
            background-color: #3498db;
            border-color: #3498db;
            color: #fff;
        }

        /* ---- Page header ---- */
        .page-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1.2rem;
        }

        .page-header h1 {
            font-size: 1.4rem;
            font-weight: 700;
            color: #2c3e50;
        }

        /* ---- Badge ---- */
        .badge {
            display: inline-block;
            padding: .25rem .55rem;
            border-radius: 20px;
            font-size: .78rem;
            font-weight: 600;
        }

        .badge-info { background-color: #d6eaf8; color: #1a5276; }
        .badge-warning { background-color: #fef9e7; color: #9a7d0a; }
    </style>
</head>
<body>

    <nav>
        <a href="<?php echo e(url('/')); ?>" class="brand">🛒 Manajemen Produk</a>
        <ul>
            <li><a href="<?php echo e(route('produk.index')); ?>" class="<?php echo e(request()->routeIs('produk.*') ? 'active' : ''); ?>">Produk</a></li>
            <li><a href="<?php echo e(url('/categories')); ?>">Kategori (API)</a></li>
            <li><a href="<?php echo e(url('/about')); ?>">About</a></li>
        </ul>
    </nav>

    <div class="container">

        
        <?php if(session('success')): ?>
            <div class="alert alert-success">
                ✅ <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>

        
        <?php if(session('error')): ?>
            <div class="alert alert-error">
                ⚠️ <?php echo e(session('error')); ?>

            </div>
        <?php endif; ?>

        <?php echo $__env->yieldContent('content'); ?>

    </div>

</body>
</html>
<?php /**PATH C:\laragon\www\laravel-api\resources\views/layouts/app.blade.php ENDPATH**/ ?>