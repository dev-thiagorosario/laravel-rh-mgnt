<?php

namespace App\Policies;

use App\Models\User;
use App\View\Models\HomeViewModel;
use Illuminate\Auth\Access\HandlesAuthorization;

class HomeViewModelPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {

    }

    public function view(User $user, HomeViewModel $homeViewModel): bool
    {
    }

    public function create(User $user): bool
    {
    }

    public function update(User $user, HomeViewModel $homeViewModel): bool
    {
    }

    public function delete(User $user, HomeViewModel $homeViewModel): bool
    {
    }

    public function restore(User $user, HomeViewModel $homeViewModel): bool
    {
    }

    public function forceDelete(User $user, HomeViewModel $homeViewModel): bool
    {
    }
}
