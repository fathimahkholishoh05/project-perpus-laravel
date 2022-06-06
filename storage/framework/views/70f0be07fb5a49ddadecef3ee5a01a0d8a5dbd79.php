

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Borrowing Books</h2>
        </div>
        <div class="pull-right pt-3">
            <a class="btn btn-success btn-sm" href="<?php echo e(route('borrowings.create')); ?>" style="width:100px;"> <i class="fas fa-plus-square"></i><span>&nbsp; Create</span></a>
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
                    <th width="10%" class=text-center>NIS</th>
                    <th width="20%" class=text-center>Peminjam</th>
                    <th width="15%" class=text-center>Judul Buku</th>
                    <th width="20%" class=text-center>Tanggal Pinjam</th>
                    <th width="20%" class=text-center>Tanggal Kembali</th>
                    <th width="10%" class=text-center>Petugas</th>
                    <th width="15%">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $borrowings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $borrowing): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($borrowing->nis); ?></td>
                    <td><?php echo e($borrowing->nama_peminjam); ?></td>
                    <td><?php echo e($borrowing->judul_buku); ?></td>
                    <td><?php echo e($borrowing->tgl_pinjam); ?></td>
                    <td><?php echo e($borrowing->tgl_kembali); ?></td>
                    <td><?php echo e($borrowing->petugas); ?></td>
                    <td>
                        <form onsubmit="return confirm('Data akan dihapus, apakah anda yakin?')"  action="<?php echo e(route('borrowings.destroy',$borrowing->id)); ?>" method="POST">

                            <a class="btn btn-primary btn-sm" href="<?php echo e(route('borrowings.edit',$borrowing->id)); ?>" style="width:100px;"><i class="fas fa-edit"></i><span> Edit</span></a>

                        </form>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
</div>
<?php echo $borrowings->links(); ?>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\perpustakaan\resources\views/borrowings/index.blade.php ENDPATH**/ ?>