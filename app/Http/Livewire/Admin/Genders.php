<?php

namespace App\Http\Livewire\Admin;

use App\Models\Gender;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Livewire\Component;
use Livewire\WithPagination;

class Genders extends Component
{
    use WithPagination;

    public $open = false;

    public $gender;

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
        $this->resetGender();
    }

    public function render()
    {
        $genders = $this->reloadGenders();

        return view('livewire.admin.genders', [
            'genders' => $genders,
        ]);
    }

    public function reloadGenders(): LengthAwarePaginator
    {
        $query = Gender::query()->withTrashed();
        $search = $this->search;

        $query->when(!empty($search), function ($query) use ($search) {

            $query->where(function($query) use ($search) {
                return $query->where('genders.name', 'like', '%' . $search . '%');
            });

        });

        $query->orderBy('name', 'asc');

        return $query->paginate($this->perPage);
    }

    public function resetGender()
    {
        $this->gender = null;

        $this->name = null;
        $this->active = 1;

    }

    public function addGender()
    {
        $this->resetGender();
        $this->open = true;
    }

    public function setGender($id)
    {
        $gender = Gender::withTrashed()->findOrFail($id);
        $this->gender = $gender;

        $this->name = $this->gender->name;
        $this->active = !$this->gender->trashed();

        $this->open = true;
    }


    public function save()
    {

        $this->validate();

        if (empty($this->gender)) {
            $this->gender = new Gender();
        }

        $this->gender->name = $this->name;

        $this->gender->save();

        if (!$this->active) {
            $this->gender->delete();
        } else {
            $this->gender->restore();
        }

        $this->emitSelf('notify-saved');
    }
}
