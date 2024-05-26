<?php

namespace App\Traits;

trait ModalTrait
{
    public function openModal(string $id)
    {
        $this->dispatch('closeModal', modalId: $id);
    }

    public function closeModal(string $id)
    {
        $this->dispatch('closeModal', modalId: $id);
    }
}
