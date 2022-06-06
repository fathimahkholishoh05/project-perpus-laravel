@extends('layout.master')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('books.index') }}"> Back</a>
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
        
    <form action="{{ route('books.update',$books->id) }}" method="POST" enctype="multipart/form-data"> 
        @csrf
        @method('PUT')
        
        <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>ISBN</strong>
                <input type="text" name="isbn" class="form-control" placeholder="ISBN" value="{{ $books->isbn }}">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Judul Buku</strong>
                <input type="text" name="judul_buku" class="form-control" placeholder="Judul Buku" value="{{ $books->judul_buku }}">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Pengarang</strong>
                <input type="text" name="pengarang" class="form-control" placeholder="Pengarang" value="{{ $books->pengarang }}" >
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Penerbit</strong>
                <select class="form-control" name="penerbit">
                    <option>Select Penerbit</option>
                    @foreach($publishers as $publisher)
                    <option value="{{$publisher->penerbit}}">{{$publisher->penerbit}}</option>
                    @endforeach
                </select>
              </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
    </form>
@endsection