<?php

namespace App\DataTables;

use App\Models\Category;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Barryvdh\Debugbar\Facade as DebugBar;
use Illuminate\Support\Collection;


class CategoryDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->collection($query)
            ->addColumn('image', function ($category) {
                return '<img src="' . asset('storage/images/' . $category->image) . '" alt="' . $category->name . '" class="h-16">';
            })
            ->addColumn('action', function ($row) {
                if($row -> deleted_at ==! null) {
                    $actionBtn = '  <td><i class="fas fa-edit" style="color:gray"></i></td>
                    <td>
                      <i class="fa-solid fa-trash" style="color:gray"></i></td>
                      <td><a href="' .route('categories.restore', $row->item_id) .'">
                      <i class="fas fa-undo"></i></a></td>';
        
                   }
                   else{
                    $actionBtn = '<td><a href="' .route('categories.edit', $row->item_id) .'">
                    <i class="fas fa-edit"></i></a></td>
                    <td>
                      <a href="' .
                      route('categories.delete', $row->item_id) .
                      '"> <i class="fas fa-trash" style="color:red"></i></a>
        
                  </td>';
                   }
    
                    return $actionBtn; 
            })
            ->rawColumns(['image', 'action']);
            
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Category $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Category $model)
    {
        // $cat = Category::all();

        // return $cat;

        return $model->newQuery();

    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('categories-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Blrtip')
            ->orderBy(0)
            ->buttons([
                Button::make('export'),
                Button::make('print'),
                Button::make('reset'),
                Button::make('reload'),
            ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('category_id'),
            Column::make('name'),
            Column::make('slug'),
            Column::make('description'),
            Column::make('image'),
            Column::make('created_at'),
            Column::make('updated_at'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'Categories_' . date('YmdHis');
    }
}