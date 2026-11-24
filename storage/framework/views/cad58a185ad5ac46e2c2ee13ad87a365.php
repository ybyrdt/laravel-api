<?php $__env->startSection('title', 'Edit Produk'); ?>

<?php $__env->startSection('content'); ?>
    <div class="page-header">
        <h1>Edit Produk</h1>
        <a href="<?php echo e(route('produk.index')); ?>" class="btn btn-secondary">← Kembali</a>
    </div>

    <div class="card" style="max-width:580px;">
        <form action="<?php echo e(route('produk.update', $produk)); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            
            <div class="form-group">
                <label for="nama">Nama Produk</label>
                <input type="text"
                       id="nama"
                       name="nama"
                       value="<?php echo e(old('nama', $produk->nama)); ?>"
                       placeholder="Contoh: Ayam Geprek"
                       class="<?php echo e($errors->has('nama') ? 'is-invalid' : ''); ?>">
                <?php $__errorArgs = ['nama'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            
            <div class="form-group">
                <label for="category_id">Kategori</label>
                <select id="category_id"
                        name="category_id"
                        class="<?php echo e($errors->has('category_id') ? 'is-invalid' : ''); ?>">
                    <option value="">-- Pilih Kategori --</option>
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($category->id); ?>"
                            <?php echo e(old('category_id', $produk->category_id) == $category->id ? 'selected' : ''); ?>>
                            <?php echo e($category->nama); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <?php $__errorArgs = ['category_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            
            <div class="form-group">
                <label for="harga">Harga (Rp)</label>
                <input type="number"
                       id="harga"
                       name="harga"
                       value="<?php echo e(old('harga', $produk->harga)); ?>"
                       min="0"
                       placeholder="Contoh: 12000"
                       class="<?php echo e($errors->has('harga') ? 'is-invalid' : ''); ?>">
                <?php $__errorArgs = ['harga'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            
            <div class="form-group">
                <label for="stok">Stok</label>
                <input type="number"
                       id="stok"
                       name="stok"
                       value="<?php echo e(old('stok', $produk->stok)); ?>"
                       min="0"
                       placeholder="Contoh: 50"
                       class="<?php echo e($errors->has('stok') ? 'is-invalid' : ''); ?>">
                <?php $__errorArgs = ['stok'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div style="display:flex; gap:.6rem; margin-top:1.4rem;">
                <button type="submit" class="btn btn-primary">Perbarui Produk</button>
                <a href="<?php echo e(route('produk.index')); ?>" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\laravel-api\resources\views/produk/edit.blade.php ENDPATH**/ ?>