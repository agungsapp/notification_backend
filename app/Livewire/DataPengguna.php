<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class DataPengguna extends Component
{
    use WithPagination;

    public $name;
    public $email;
    public $password;
    public $role = 'employee';
    public $position = 'staff';
    public $supervisor_id;
    public $userId;
    public $isEdit = false;
    public $search = '';
    public $filterPosition = '';

    protected $paginationTheme = 'bootstrap';

    protected function rules()
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:8',
            'role' => 'required|in:admin,manager,employee',
            'position' => 'required|in:owner,hrd,manager,pic,staff',
            'supervisor_id' => 'nullable|exists:users,id',
        ];

        if ($this->isEdit) {
            $rules['email'] = 'required|email|max:255|unique:users,email,' . $this->userId;
            $rules['password'] = 'nullable|string|min:8';
        }

        return $rules;
    }

    public function render()
    {
        $query = User::with('supervisor')
            ->when($this->search, fn($q) => $q->where(function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('email', 'like', '%' . $this->search . '%');
            }))
            ->when($this->filterPosition, fn($q) => $q->where('position', $this->filterPosition));

        $users = $query->latest('created_at')->paginate(10);
        $supervisors = User::select('id', 'name')->whereNotIn('role', ['employee'])->get();

        return view('livewire.data-pengguna', compact('users', 'supervisors'));
    }

    public function filterByPosition($position)
    {
        $this->filterPosition = $position;
        $this->resetPage();
    }

    public function resetFilter()
    {
        $this->filterPosition = '';
        $this->resetPage();
    }

    public function resetForm()
    {
        $this->reset(['name', 'email', 'password', 'role', 'position', 'supervisor_id', 'userId', 'isEdit']);
        $this->resetValidation();
    }

    public function store()
    {
        $this->validate();

        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => bcrypt($this->password),
            'role' => $this->role,
            'position' => $this->position,
            'supervisor_id' => $this->supervisor_id,
        ]);

        session()->flash('success', 'Pengguna berhasil dibuat.');
        $this->resetForm();
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $this->userId = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->role = $user->role;
        $this->position = $user->position;
        $this->supervisor_id = $user->supervisor_id;
        $this->isEdit = true;
    }

    public function update()
    {
        $this->validate();

        $user = User::findOrFail($this->userId);
        $user->update([
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password ? bcrypt($this->password) : $user->password,
            'role' => $this->role,
            'position' => $this->position,
            'supervisor_id' => $this->supervisor_id,
        ]);

        session()->flash('success', 'Pengguna berhasil diperbarui.');
        $this->resetForm();
    }

    public function delete($id)
    {
        User::destroy($id);
        session()->flash('success', 'Pengguna dihapus.');
    }
}
