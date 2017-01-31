@extends('adminlte::layouts.app')

@section('contentheader_title')
    My outlets
@endsection

@section('contentheader_breadcrumb')
    <li class="active">Outlets</li>
@endsection

@push('page-stylesheet')
    <link href="{{ asset('/plugins/datatables/dataTables.bootstrap.css') }}" rel="stylesheet" type="text/css" />
@endpush

@section('main-content')

    <div class='row'>

        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if(Session::has('flash_message'))
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                {{ Session::get('flash_message') }}
            </div>
        @endif

        <div class="col-sm-6">
            <div class="box box-info">
                <div class="box-header">
                    <h3 class="box-title">Outlets</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        <table id="outlets_table_datatable" class="table table-hover table-condensed">
                            <thead>
                            <tr>
                                <th class="col-md-1"></th>
                                <th class="col-md-1">ID</th>
                                <th class="col-md-2">Code</th>
                                <th>Name</th>
                                <th class="col-md-3">Actions</th>

                            </tr>
                            </thead>
                        </table>
                    </div><!--/table-response-->
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->

        <div class="col-sm-6">
            <div class="box box-info">
                <div class="box-header">
                    <h3 class="box-title">Events</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">

                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->

    </div><!-- /.row -->



@endsection

@push('page-script')
<script src="{{ asset('/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ asset('/vendor/datatables/buttons.server-side.js') }}"></script>

<script type="text/javascript">
    $(document).ready(function() {
        oTable = $('#outlets_table_datatable').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": "/outlet/dataTableData",
            "oTableTools": {
                "aButtons": [
                    "copy",
                    "print",
                    {
                        "sExtends": "collection",
                        "sButtonText": "Save",
                        "aButtons": [ "csv", "xls", "pdf" ]
                    }
                ]
            },
            "columns": [
                {data: 'checkmark', name: 'outlet_id', searchable: false, orderable: false},
                {data: 'id', name: 'id'},
                {data: 'code', name: 'code'},
                {data: 'name', name: 'name'},
                {data: 'actions', name: 'actions', searchable: false, orderable: false}
            ]
        });
    });
</script>
@endpush