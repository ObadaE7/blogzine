<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TableFilter extends Component
{
    public $columns;
    public $searchBy;
    public $perPages;
    public bool $optCreate;

    /**
     * Create a new component instance.
     */
    public function __construct($columns, $searchBy, $perPages, $optCreate = false)
    {
        $this->columns = $columns;
        $this->searchBy = $searchBy;
        $this->perPages = $perPages;
        $this->optCreate = $optCreate;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.table-filter');
    }
}
