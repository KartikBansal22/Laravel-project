<?php

namespace App\Policies;

use App\Models\Order;
use App\Models\User;

class OrderPolicy
{
    public function view(User $user, Order $order): bool
    {
        return $user->role === 'admin'
            || $user->role === 'staff'
            || $user->id === $order->user_id;
    }

    public function updateStatus(User $user): bool
    {
        return in_array($user->role, ['admin', 'staff']);
    }
}