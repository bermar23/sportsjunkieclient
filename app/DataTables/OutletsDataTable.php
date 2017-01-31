<?php

namespace App\DataTables;

use App\Outlet;
use Yajra\Datatables\Services\DataTable;

class OutletsDataTable extends DataTable
{
    /**
     * Display ajax response.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajax()
    {
        return $this->datatables
            ->eloquent($this->query())
            ->addColumn('actions', function($data){
                return '<a type="button" class="btn btn-xs btn-default" href="'.url('outlet/show/'.$data->id).'">show</a>';
            })->addColumn('checkmark', function($data){
                return '<input type="checkbox" name="outlet_id" value='. $data->id .'>';
            })
            ->make(true);
    }

    /**
     * Get the query object to be processed by dataTables.
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder|\Illuminate\Support\Collection
     */
    public function query()
    {
        $query = Outlet::query();

        return $this->applyScopes($query);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\Datatables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->columns($this->getColumns())
                    ->ajax('')
                    ->addAction(['width' => '80px'])
                    ->parameters($this->getBuilderParameters());
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            'id',
            'code',
            'name',
            'description',
            'coordinates',
            'created_by',
            'created_at',
            'updated_at',
            'updated_by',
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'outletsdatatables_' . time();
    }
}
