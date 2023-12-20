<?php

namespace App\Http\Livewire\Admin;

use App\Models\Condition;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Livewire\Component;
use Livewire\WithPagination;

class Conditions extends Component
{
    use WithPagination;

    public $open = false;

    public $condition;

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
        $this->resetCondition();
    }

    public function render()
    {
        $conditions = $this->reloadConditions();

        return view('livewire.admin.conditions', [
            'conditions' => $conditions,
        ]);
    }

    public function reloadConditions(): LengthAwarePaginator
    {
        $query = Condition::query()->withTrashed();
        $search = $this->search;

        $query->when(!empty($search), function ($query) use ($search) {

            $query->where(function($query) use ($search) {
                return $query->where('conditions.name', 'like', '%' . $search . '%');
            });

        });

        $query->orderBy('name', 'asc');

        return $query->paginate($this->perPage);
    }

    public function resetCondition()
    {
        $this->condition = null;

        $this->name = null;
        $this->active = 1;
    }

    public function addCondition()
    {
        $this->resetCondition();
        $this->open = true;
    }

    public function setCondition($id)
    {
        $condition = Condition::withTrashed()->findOrFail($id);
        $this->condition = $condition;

        $this->name = $this->condition->name;
        $this->active = !$this->condition->trashed();

        $this->open = true;
    }


    public function save()
    {

        $this->validate();

        if (empty($this->condition)) {
            $this->condition = new Condition();
        }

        $this->condition->name = $this->name;

        $this->condition->save();

        if (!$this->active) {
            $this->condition->delete();
        } else {
            $this->condition->restore();
        }

        $this->emitSelf('notify-saved');
    }
}
