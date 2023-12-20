<?php

namespace App\Http\Livewire\Admin;

use App\Models\WheelSize;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Livewire\Component;
use Livewire\WithPagination;

class WheelSizes extends Component
{
    use WithPagination;

    public $open = false;

    public $wheelSize;

    public $name;
    public $active;

    // Filters
    public $search;
    public $perPage;

    protected $rules = [
        'name' => 'required|max:255',
        'active' => ''
    ];

    public function mount()
    {
        $this->resetWheelSize();
    }

    public function render()
    {
        $wheelSizes = $this->reloadWheelSizes();

        return view('livewire.admin.wheel-sizes', [
            'wheelSizes' => $wheelSizes,
        ]);
    }

    public function reloadWheelSizes(): LengthAwarePaginator
    {
        $query = WheelSize::query()->withTrashed();
        $search = $this->search;

        $query->when(!empty($search), function ($query) use ($search) {

            $query->where(function($query) use ($search) {
                return $query->where('wheel_sizes.name', 'like', '%' . $search . '%');
            });

        });

        $query->orderBy('name', 'asc');

        return $query->paginate($this->perPage);
    }

    public function resetWheelSize()
    {
        $this->wheelSize = null;

        $this->name = null;
        $this->active = 1;
    }

    public function addWheelSize()
    {
        $this->resetWheelSize();
        $this->open = true;
    }

    public function setWheelSize($id)
    {
        $wheelSize = WheelSize::withTrashed()->findOrFail($id);
        $this->wheelSize = $wheelSize;

        $this->name = $this->wheelSize->name;
        $this->active = !$this->wheelSize->trashed();

        $this->open = true;
    }


    public function save()
    {

        $this->validate();

        if (empty($this->wheelSize)) {
            $this->wheelSize = new WheelSize();
        }

        $this->wheelSize->name = $this->name;

        $this->wheelSize->save();

        if (!$this->active) {
            $this->wheelSize->delete();
        } else {
            $this->wheelSize->restore();
        }

        $this->emitSelf('notify-saved');
    }
}
