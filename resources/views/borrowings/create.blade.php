@extends('layout.master')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Tambah</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('borrowings.index') }}"> Back</a>
        </div>
    </div>
</div>
<br>
@if ($errors->any())
<div class="alert alert-danger">
    <strong>Whoops!</strong> There were some problems with your input.<br><br>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="{{ route('borrowings.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>NIS</strong>
                <select class="form-control" name="nis">
                    <option>Select NIS Siswa</option>
                    @foreach($students as $students)
                    <option value="{{$students->nis}}">{{$students->nis}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Nama Peminjam</strong>
                <input type="text" name="nama_peminjam" class="form-control" placeholder="Peminjam">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Judul buku</strong>
                <select class="form-control" name="judul_buku">
                    <option>Select Buku</option>
                    @foreach($books as $books)
                    <option value="{{$books->judul_buku}}">{{$books->judul_buku}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Tanggal Pinjam</strong>
                <input type="date" name="tgl_pinjam" class="form-control" placeholder="Tanggal Pinjam">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Tanggal Kembali</strong>
                <input type="date" name="tgl_kembali" class="form-control" placeholder="Tanggal Kembali">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Petugas</strong>
                <input type="text" name="petugas" class="form-control" placeholder="Petugas">
            </div>
        </div>
        
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
</form>
@endsection