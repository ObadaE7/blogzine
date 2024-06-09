<?php

namespace App\Traits;

use Livewire\Attributes\Url;

trait FilterTrait
{
    #[Url(history: true)]
    public $search = '';

    #[Url(as: 'search-by', history: true)]
    public $searchBy = 'id';

    #[Url(as: 'per-page', history: true)]
    public $perPage = 5;

    #[Url(as: 'order-by', history: true)]
    public $orderBy = 'id';

    #[Url(as: 'dir', history: true)]
    public $orderDir = 'desc';

    public function setOrderBy($column)
    {
        if ($this->orderBy === $column) {
            $this->orderDir = $this->orderDir === 'desc' ? 'asc' : 'desc';
        } else {
            $this->orderBy = $column;
            $this->orderDir = 'desc';
        }
    }
}
