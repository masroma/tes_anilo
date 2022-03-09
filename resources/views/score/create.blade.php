@extends('layout')
@section("title") Tambah score @endsection
@section('content')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">score</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">

                        <li class="breadcrumb-item"><a href="{{ route('score.index') }}">Data score</a>
                        </li>
                        <li class="breadcrumb-item active">Tambah</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('score.store') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf

                                <div class="form-group">
                                    <label for="nama_kategori">student</label>
                                    <select name="student_id" class="form-control js-example-basic-single @error('student_id') is-invalid @enderror">
                                        <option value="">Pilih</option>
                                        @foreach ($student as $row)
                                            <option value="{{$row->id}}"  @if (old('student_id')== $row->id) selected="selected" @endif>{{$row->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('student_id')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="nama_kategori">subject</label>
                                    <select name="subject_id" class="form-control js-example-basic-single @error('subject_id') is-invalid @enderror">
                                        <option value="">Pilih</option>
                                        @foreach ($subject as $row)
                                            <option value="{{$row->id}}" @if (old('subject_id')== $row->id) selected="selected" @endif>{{$row->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('subject_id')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="nama_kategori">score</label>

                                      <input type="number" name="score" class="form-control  @error('score') is-invalid @enderror">
                                    @error('subject_id')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <button class="btn btn-primary" type="submit">Simpan</button>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /.col-md-6 -->

                <!-- /.col-md-6 -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
@endsection
