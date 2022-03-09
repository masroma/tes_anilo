@extends('layout')
@section('title') Data score @endsection
@section('content')

<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">score</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('score.index')}}">score</a></li>
            <li class="breadcrumb-item active">score</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
        <div class="row my-4">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="">Subject</label>
                    <select id='subject_id' name="subject_id" class="form-control">
                        <option value="">Subject</option>
                        @foreach ($subject as $p)
                            <option value="{{$p->id}}">{{$p->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Student</label>
                    <select id='student_id' name="student_id" class="form-control">
                        <option value="">Student</option>
                        @foreach ($student as $p)
                            <option value="{{$p->id}}">{{$p->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="row mb-4">
            <div class="col-md-12">
                <a href="{{route('score.create')}}" class="btn btn-primary">Tambah score</a>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <table id="table" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>student</th>
                                    <th>subject</th>
                                    <th>score</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@stop
@section('script')
<script>



    // ini vendor data
    (function() {
            loadDataTable();
        })();

        function loadDataTable() {
            $(document).ready(function () {
                var table = $('#table').DataTable({
                    "scrollX": true,
                    "autoWidth": true,
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: "{{ route('score.data') }}",
                        type: "GET",
                        data: function (d) {
                            d.student_id = $('#student_id').val(),
                            d.subject_id = $('#subject_id').val()
                        }
                    },

                    columns: [
                    {
                        data:"DT_RowIndex",
                        name:"DT_RowIndex"
                    },
                        {
                            data: 'student.name',
                            name: 'student.name'
                        },
                        {
                            data: 'subject.name',
                            name: 'subject.name'
                        },

                        {
                            data: 'score',
                            name: 'score'
                        },



                        {
                                    data: 'id',
                                    name: 'id',
                                    render: function(value, param, data) {
                                        return '<div class="btn-group">' +
                                            '<a class="btn btn-sm btn-primary" href="/score/' + value +
                                            '/edit"><i class="fas fa-edit"></i></a> ' +

                                            '<button class="btn btn-sm btn-danger" type="button" onClick="deleteConfirm(' +
                                            value + ')"><i class="fas fa-trash"></i></button>' +
                                            '</div> ';
                                    }
                                }

                    ],
                    order: [
                        [0, 'asc']
                    ]
                });

                $('#student_id').change(function(){
                    table.draw();
                });

                $('#subject_id').change(function(){
                    table.draw();
                });



            });
        }

   function deleteConfirm(id) {
            swal({
                    title: "Kamu Yakin ?",
                    text: "Ini juga akan menghapus data ini !",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((dt) => {
                    if (dt) {
                        window.location.href = "{{ url('score') }}/" + id + "/delete";
                    }
                });
        }
  </script>
  @endsection
