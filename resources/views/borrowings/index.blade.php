@extends('layout.master')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Borrowing Books</h2>
        </div>
        <div class="pull-right pt-3">
            <a class="btn btn-success btn-sm" href="{{ route('borrowings.create') }}" style="width:100px;"> <i class="fas fa-plus-square"></i><span>&nbsp; Create</span></a>
        </div>
    </div>
</div>
@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif
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
                @foreach ($borrowings as $borrowing)
                <tr>
                    <td>{{ $borrowing->nis }}</td>
                    <td>{{ $borrowing->nama_peminjam }}</td>
                    <td>{{ $borrowing->judul_buku }}</td>
                    <td>{{ $borrowing->tgl_pinjam }}</td>
                    <td>{{ $borrowing->tgl_kembali }}</td>
                    <td>{{ $borrowing->petugas }}</td>
                    <td>
                        <form onsubmit="return confirm('Data akan dihapus, apakah anda yakin?')"  action="{{ route('borrowings.destroy',$borrowing->id) }}" method="POST">

                            <a class="btn btn-primary btn-sm" href="{{ route('borrowings.edit',$borrowing->id) }}" style="width:100px;"><i class="fas fa-edit"></i><span> Edit</span></a>

                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
{!! $borrowings->links() !!}

@endsection