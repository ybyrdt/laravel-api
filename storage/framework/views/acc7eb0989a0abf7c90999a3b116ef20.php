<?php $__env->startSection('title', 'Daftar Produk'); ?>

<?php $__env->startSection('content'); ?>
    <div class="page-header">
        <h1>Daftar Produk</h1>
        <a href="<?php echo e(route('produk.create')); ?>" class="btn btn-primary">+ Tambah Produk</a>
    </div>

    <div class="card">
        <?php if($products->isEmpty()): ?>
            <p style="text-align:center; color:#6c757d; padding:2rem 0;">
                Belum ada produk. <a href="<?php echo e(route('produk.create')); ?>">Tambah sekarang</a>.
            </p>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Produk</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($products->firstItem() + $index); ?></td>
                            <td><?php echo e($product->nama); ?></td>
                            <td>
                                <?php if($product->category): ?>
                                    <span class="badge badge-info"><?php echo e($product->category->nama); ?></span>
                                <?php else: ?>
                                    <span style="color:#aaa;">—</span>
                                <?php endif; ?>
                            </td>
                            <td>Rp <?php echo e(number_format($product->harga, 0, ',', '.')); ?></td>
                            <td>
                                <span class="badge <?php echo e($product->stok > 10 ? 'badge-info' : 'badge-warning'); ?>">
                                    <?php echo e($product->stok); ?>

                                </span>
                            </td>
                            <td style="display:flex; gap:.4rem; flex-wrap:wrap;">
                                <a href="<?php echo e(route('produk.edit', $product)); ?>" class="btn btn-warning">Edit</a>

                                
                                <form action="<?php echo e(route('produk.destroy', $product)); ?>"
                                      method="POST"
                                      onsubmit="return confirm('Yakin ingin menghapus produk \"<?php echo e(addslashes($product->nama)); ?>\"?')">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>

            
            <div class="pagination">
                <?php echo e($products->links()); ?>

            </div>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\laravel-api\resources\views/produk/index.blade.php ENDPATH**/ ?>