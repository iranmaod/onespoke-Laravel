<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Livewire\Component;
use Livewire\WithPagination;

class Categories extends Component
{
    use WithPagination;

    public $open = false;

    public $category;

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
        $this->resetCategory();
    }

    public function render()
    {
        $categories = $this->reloadCategories();

        return view('livewire.admin.categories', [
            'categories' => $categories,
        ]);
    }

    public function reloadCategories(): LengthAwarePaginator
    {
        $query = Category::query()->withTrashed();
        $search = $this->search;

        $query->when(!empty($search), function ($query) use ($search) {

            $query->where(function($query) use ($search) {
                return $query->where('categories.name', 'like', '%' . $search . '%');
            });

        });

        $query->orderBy('name', 'asc');

        return $query->paginate($this->perPage);
    }

    public function resetCategory()
    {
        $this->category = null;

        $this->name = null;
        $this->active = 1;
    }

    public function addCategory()
    {
        $this->resetCategory();
        $this->open = true;
    }

    public function setCategory($id)
    {
        $category = Category::withTrashed()->findOrFail($id);
        $this->category = $category;

        $this->name = $this->category->name;
        $this->active = !$this->category->trashed();

        $this->open = true;
    }


    public function save()
    {

        $this->validate();

        if (empty($this->category)) {
            $this->category = new Category();
        }

        $this->category->name = $this->name;

        $this->category->save();

        if (!$this->active) {
            $this->category->delete();
        } else {
            $this->category->restore();
        }

        $this->emitSelf('notify-saved');
    }
}
