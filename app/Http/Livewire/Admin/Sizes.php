<?php

namespace App\Http\Livewire\Admin;

use App\Models\FrameSize;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Livewire\Component;
use Livewire\WithPagination;

class Sizes extends Component
{
    use WithPagination;

    public $open = false;

    public $size;

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
        $this->resetSize();
    }

    public function render()
    {
        $sizes = $this->reloadSizes();

        return view('livewire.admin.sizes', [
            'sizes' => $sizes,
        ]);
    }

    public function reloadSizes(): LengthAwarePaginator
    {
        $query = FrameSize::query()->withTrashed();
        $search = $this->search;

        $query->when(!empty($search), function ($query) use ($search) {

            $query->where(function($query) use ($search) {
                return $query->where('sizes.name', 'like', '%' . $search . '%');
            });

        });

        $query->orderBy('name', 'asc');

        return $query->paginate($this->perPage);
    }

    public function resetSize()
    {
        $this->size = null;

        $this->name = null;
        $this->active = 1;
    }

    public function addSize()
    {
        $this->resetSize();
        $this->open = true;
    }

    public function setSize($id)
    {
        $size = FrameSize::withTrashed()->findOrFail($id);
        $this->size = $size;

        $this->name = $this->size->name;
        $this->active = !$this->size->trashed();

        $this->open = true;
    }


    public function save()
    {

        $this->validate();

        if (empty($this->size)) {
            $this->size = new FrameSize();
        }

        $this->size->name = $this->name;

        $this->size->save();

        if (!$this->active) {
            $this->size->delete();
        } else {
            $this->size->restore();
        }

        $this->emitSelf('notify-saved');
    }
}
