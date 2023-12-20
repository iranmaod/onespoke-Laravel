<?php

namespace App\Http\Livewire\Admin;

use App\Models\Manufacturer;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Livewire\Component;
use Livewire\WithPagination;

class Manufacturers extends Component
{
    use WithPagination;

    public $open = false;

    public $manufacturer;

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
        $this->resetManufacturer();
    }

    public function render()
    {
        $manufacturers = $this->reloadManufacturers();

        return view('livewire.admin.manufacturers', [
            'manufacturers' => $manufacturers,
        ]);
    }

    public function reloadManufacturers(): LengthAwarePaginator
    {
        $query = Manufacturer::query()->withTrashed();
        $search = $this->search;

        $query->when(!empty($search), function ($query) use ($search) {

            $query->where(function($query) use ($search) {
                return $query->where('manufacturers.name', 'like', '%' . $search . '%');
            });

        });

        $query->orderBy('name', 'asc');

        return $query->paginate($this->perPage);
    }

    public function resetManufacturer()
    {
        $this->manufacturer = null;

        $this->name = null;
        $this->active = 1;

    }

    public function addManufacturer()
    {
        $this->resetManufacturer();
        $this->open = true;
    }

    public function setManufacturer($id)
    {
        $manufacturer = Manufacturer::withTrashed()->findOrFail($id);
        $this->manufacturer = $manufacturer;

        $this->name = $this->manufacturer->name;
        $this->active = !$this->manufacturer->trashed();

        $this->open = true;
    }


    public function save()
    {

        $this->validate();

        if (empty($this->manufacturer)) {
            $this->manufacturer = new Manufacturer();
        }

        $this->manufacturer->name = $this->name;

        $this->manufacturer->save();

        if (!$this->active) {
            $this->manufacturer->delete();
        } else {
            $this->manufacturer->restore();
        }

        $this->emitSelf('notify-saved');
    }
}
