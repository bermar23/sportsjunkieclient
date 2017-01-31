@extends('adminlte::layouts.app')

@section('contentheader_title')
    Outlet
@endsection

@section('htmlheader_title')
    {{ trans('adminlte_lang::message.outlet') }}
@endsection


@push('page-stylesheet')

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

        <div class="col-xs-12">
            <div class="col-sm-6">
                <div class="box box-info">

                    <div class="box-header with-border">
                        <h3 class="box-title">New</h3>
                    </div>
                    <!-- /.box-header -->
                    <form role="form" class="form-horizontal" method="post" action="{{ url('outlet/store') }}">
                        <div class="box-body">

                            {{ csrf_field() }}

                            <!-- name -->
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Name</label>
                                <div class="col-sm-10">
                                    <input name="name" type="text" class="form-control" placeholder="Name" required>
                                </div>
                            </div>

                            <!-- description -->
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Description</label>
                                <div class="col-sm-10">
                                    <textarea name="description" class="form-control" rows="3" placeholder="Description"></textarea>
                                </div>
                            </div>

                            <!-- coordinates -->
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Coordinates</label>
                                <div class="col-sm-10">
                                    <input name="coordinates" type="text" class="form-control" placeholder="Coordinates">
                                </div>
                            </div>
                        </div><!-- /.box-body -->
                        <div class="box-footer">
                            <button type="reset" class="btn btn-default">Reset</button>
                            <button type="submit" class="btn btn-info pull-right">Save</button>
                        </div><!-- /.box-footer -->
                    </form>

                </div>
                <!-- /.box -->
            </div>
        </div>
        <!-- /.col -->

    </div><!-- /.row -->


@endsection

@push('page-script')

<script type="text/javascript">
    $(document).ready(function() {

    });
</script>
@endpush