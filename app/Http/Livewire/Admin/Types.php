<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use App\Models\FrameType;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Livewire\Component;
use Livewire\WithPagination;

class Types extends Component
{
    use WithPagination;

    public $open = false;

    public $type;

    public $categories;

    public $name;
    public $categoryId;
    public $active;

    // Filters
    public $search;
    public $perPage;

    protected $rules = [
        'name' => 'required|max:255',
        'categoryId' => 'required|exists:categories,id',
        'active' => ''
    ];

    public function mount()
    {
        $this->resetType();
        $this->loadCategories();
    }

    public function render()
    {
        $types = $this->reloadTypes();

        return view('livewire.admin.types', [
            'types' => $types,
        ]);
    }

    public function loadCategories()
    {
        $this->categories = Category::orderBy('name', 'asc')->get();
    }

    public function reloadTypes(): LengthAwarePaginator
    {
        $query = FrameType::query()->with('category')->withTrashed();
        $search = $this->search;

        $query->when(!empty($search), function ($query) use ($search) {

            $query->where(function($query) use ($search) {
                return $query->where('types.name', 'like', '%' . $search . '%')
                    ->orWhereHas('category', function ($query) use ($search) {
                        $query->where('categories.name', 'like', '%' . $search . '%');
                    });
            });

        });

        $query->orderBy('name', 'asc');

        return $query->paginate($this->perPage);
    }

    public function resetType()
    {
        $this->type = null;

        $this->name = null;
        $this->categoryId = null;
        $this->active = 1;
    }

    public function addType()
    {
        $this->resetType();
        $this->open = true;
    }

    public function setType($id)
    {
        $type = FrameType::withTrashed()->findOrFail($id);
        $this->type = $type;

        $this->name = $this->type->name;
        $this->categoryId = $this->type->category_id;
        $this->active = !$this->type->trashed();

        $this->open = true;
    }


    public function save()
    {

        $this->validate();

        if (empty($this->type)) {
            $this->type = new FrameType();
        }

        $this->type->name = $this->name;
        $this->type->category_id = $this->categoryId;

        $this->type->save();

        if (!$this->active) {
            $this->type->delete();
        } else {
            $this->type->restore();
        }

        $this->emitSelf('notify-saved');
    }
}
