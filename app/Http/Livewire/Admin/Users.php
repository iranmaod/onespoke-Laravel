<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Livewire\Component;
use Livewire\WithPagination;

class Users extends Component
{
    use WithPagination;

    public $open = false;

    public $user;

    public $first_name;
    public $last_name;
    public $business_name;
    public $email;
    public $active;
    public $verified;

    // Filters
    public $search;
    public $perPage;

    protected $rules = [
        'first_name' => 'required|max:255',
        'last_name' => 'nullable|max:255',
        'business_name' => 'nullable|max:255',
        'email' => 'required|email|max:255',
        'active' => 'boolean',
        'verified' => 'boolean',
    ];

    public function mount()
    {
        $this->resetUser();
    }

    public function render()
    {
        $users = $this->reloadUsers();

        return view('livewire.admin.users', [
            'users' => $users,
        ]);
    }

    public function reloadUsers(): LengthAwarePaginator
    {
        $query = User::query()->withTrashed();
        $search = $this->search;

        $query->when(!empty($search), function ($query) use ($search) {

            $query->where(function($query) use ($search) {
                return $query->where('users.first_name', 'like', '%' . $search . '%')
                    ->orWhere('users.last_name', 'like', '%' . $search . '%')
                    ->orWhere('users.email', 'like', '%' . $search . '%')
                    ->orWhere('users.business_name', 'like', '%' . $search . '%');
            });

        });

        $query->orderBy('created_at', 'desc');
        $query->orderBy('last_name', 'asc');
        $query->orderBy('first_name', 'asc');

        return $query->paginate($this->perPage);
    }

    public function resetUser()
    {
        $this->user = null;

        $this->first_name = null;
        $this->last_name = null;
        $this->business_name = null;
        $this->email = null;
        $this->active = 1;
        $this->verified = 0;
    }

    public function addUser()
    {
        $this->resetUser();
        $this->open = true;
    }

    public function setUser($id)
    {
        $user = User::withTrashed()->findOrFail($id);
        $this->user = $user;

        $this->first_name = $this->user->first_name;
        $this->last_name = $this->user->last_name;
        $this->business_name = $this->user->business_name;
        $this->email = $this->user->email;
        $this->active = !$this->user->trashed();
        $this->verified = $this->user->is_verified;

        $this->open = true;
    }


    public function save()
    {

        $this->validate();

        if (empty($this->user)) {
            $this->user = new User();
        }

        $this->user->first_name = $this->first_name;
        $this->user->last_name = $this->last_name;
        $this->user->business_name = $this->business_name;
        $this->user->email = $this->email;
        $this->user->is_verified = $this->verified;

        $this->user->save();

        if (!$this->active) {
            $this->user->delete();
        } else {
            $this->user->restore();
        }

        $this->emitSelf('notify-saved');
    }
}
