@extends('layout.master')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Data Siswa</h2>
        </div>
        <div class="pull-right pt-3">
            <a class="btn btn-success btn-sm" href="{{ route('students.create') }}" style="width:100px;"> <i class="fas fa-plus-square"></i><span>&nbsp; Create</span></a>
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
                    <th width="10%" class=text-center>NIS</th>
                    <th width="20%" class=text-center>Nama</th>
                    <th width="15%" class=text-center>Rombel</th>
                    <th width="15%" class=text-center>Rayon</th>
                    <th width="15%" class=text-center>Jenis Kelamin</th>
                    <th width="20%" class=text-center>Action</th>
                </tr>
            </thead>
            @foreach ($students as $student)
            <tr>
                <td class="text-center">{{ ++$i }}</td>
                <td>{{ $student->nis}}</td>
                <td>{{ $student->nama }}</td>
                <td>{{ $student->rombel }}</td>
                <td>{{ $student->rayon }}</td>
                <td>@if($student->jk == "L") Laki-laki @else Perempuan @endif</td>
                <td>
                    <form onsubmit="return confirm ('Data akan dihapus, apa anda yakin?')" action="{{ route('students.destroy',$student->id) }}" method="POST">

                        <a class="btn btn-primary btn-sm" href="{{ route('students.edit',$student->id) }}" style="width:80px;"><i class="fas fa-edit"></i><span> Edit</span></a>

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

{!! $students->links() !!}

@endsection