

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Data Rayon</h2>
        </div>
        <div class="pull-right pt-3">
            <a class="btn btn-success btn-sm" href="<?php echo e(route('rayons.create')); ?>" style="width:100px;"> <i class="fas fa-plus-square"></i><span>&nbsp; Create</span></a>
        </div>
    </div>
</div>
<?php if($message = Session::get('success')): ?>
<div class="alert alert-success">
    <p><?php echo e($message); ?></p>
</div>
<?php endif; ?>
<div class="card shadow mt-2">
    <div class="table-responsive p-3">
        <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
            <thead class="table-dark">
                <tr>
                    <th width="5%" class=text-center>No</th>
                    <th width="10%" class=text-center>Rayon</th>
                    <th width="25%" class=text-center>Pembimbing Rayon</th>
                    <th width="15%" class=text-center>No_HP</th>
                    <th width="20%" class=text-center>Action</th>
                </tr>
            </thead>
            <?php $__currentLoopData = $rayons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rayon): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td class="text-center"><?php echo e(++$i); ?></td>
                <td><?php echo e($rayon->rayon); ?></td>
                <td><?php echo e($rayon->pembimbing_rayon); ?></td>
                <td><?php echo e($rayon->no_hp); ?></td>
                <td class="text-center">
                    <form onsubmit="return confirm('Data akan dihapus, apakah anda yakin?')" action="<?php echo e(route('rayons.destroy',$rayon->id)); ?>" method="POST">

                        <a class="btn btn-primary btn-sm" href="<?php echo e(route('rayons.edit',$rayon->id)); ?>" style="width:100px;"><i class="fas fa-edit"></i><span> Edit</span></a>

                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>

                        <button type="submit" class="btn btn-danger btn-sm" style="width:100px;"><i class="fas fa-trash-alt"></i><span> Delete</span></button>
                    </form>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </table>
    </div>
</div>

<?php echo $rayons->links(); ?>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\perpustakaan\resources\views/rayons/index.blade.php ENDPATH**/ ?>