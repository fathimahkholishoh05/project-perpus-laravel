@extends('layout.master')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Data Buku</h2>
        </div>
        <div class="pull-right pt-3">
            <a class="btn btn-success btn-sm" href="{{ route('books.create') }}" style="width:100px;"> <i class="fas fa-plus-square"></i><span>&nbsp; Create</span></a>
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
                    <th width="5%" class=text-center>No</th>
                    <th width="15%" class=text-center>ISBN</th>
                    <th width="25%" class=text-center>Judul Buku</th>
                    <th width="20%" class=text-center>Pengarang</th>
                    <th width="15%" class=text-center>Penerbit</th>
                    <th width="20%" class=text-center>Action</th>
                </tr>
            </thead>
            @foreach ($books as $book)
            <tr>
                <td class="text-center">{{ ++$i }}</td>
                <td>{{ $book->isbn}}</td>
                <td>{{ $book->judul_buku }}</td>
                <td>{{ $book->pengarang }}</td>
                <td class="text-center">{{ $book->penerbit }}</td>
                <td class="text-center">
                    <form onsubmit="return confirm ('Data akan dihapus, apa anda yakin?')" action="{{ route('books.destroy',$book->id) }}" method="POST">

                        <a class="btn btn-primary btn-sm" href="{{ route('books.edit',$book->id) }}" style="width:80px;"><i class="fas fa-edit"></i><span> Edit</span></a>

                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-danger btn-sm" style="width:80px;"><i class="fas fa-trash-alt"></i><span> Delete</span></button>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
</div>

{!! $books->links() !!}

@endsection