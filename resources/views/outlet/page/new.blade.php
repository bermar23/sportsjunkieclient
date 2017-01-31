@extends('adminlte::layouts.app')

@section('contentheader_title')
    Outlet
@endsection

@section('contentheader_breadcrumb')
    <li><a href="{{ url('/outlet/show/'.$show_id) }}">Outlet {{$show_id}}</a></li>
    <li class="active">New page</li>
@endsection

@section('htmlheader_title')
    {{ trans('adminlte_lang::message.outlet') }}
@endsection


@push('page-stylesheet')

@endpush

@section('main-content')
    <div class='row'>
        <div class="col-md-2">
            <div class="box box-default">
                <div class="box-header">
                    <h3 class="box-title">Pages
                        <small>Existing pages</small>
                    </h3>
                    <!-- tools box -->
                    <div class="pull-right box-tools">
                        <!--<button type="button" class="btn btn-info btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                            <i class="fa fa-minus"></i></button>-->
                    </div>
                    <!-- /. tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body">

                </div>
                <div class="box-footer">
                    <button type="button" class="btn btn-default">New</button>
                </div>
                <!-- /.box-footer -->
            </div>
            <!-- /.box -->
        </div>
        <div class="col-md-10">

            <div class="box box-success">
                <div class="box-header">
                    <h3 class="box-title">Outlet Pages
                        <small>Outlet details in html pages</small>
                    </h3>
                    <!-- tools box -->
                    <div class="pull-right box-tools">
                        <!--<button type="button" class="btn btn-info btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                            <i class="fa fa-minus"></i></button>-->
                    </div>
                    <!-- /. tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body pad">
                    <form role="form" class="form-horizontal" method="post" action="{{ url('outlet/page/store') }}">
                        {{ csrf_field() }}
                        <input type="hidden" name="show_id" value="{{$show_id}}"/>
                        <textarea id="editor1" name="editor1" rows="10" cols="80">
                                                Place HTML details of the outlet
                        </textarea>
                    </form>
                </div>
                <div class="box-footer">
                    <button type="button" class="btn btn-default">View pages</button>
                </div>
                <!-- /.box-footer -->
            </div>
            <!-- /.box -->

        </div><!-- /.col -->

    </div><!-- /.row -->
@endsection

@push('page-script')
<script src="{{ asset('/plugins/ckeditor_4.6.2_full/ckeditor.js') }}"></script>

<script type="text/javascript">
    $(function () {
        // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
        CKEDITOR.replace('editor1', {
            extraPlugins: 'colordialog,colorbutton'
        });
    });
</script>
@endpush