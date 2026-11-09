<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public const ROLES = ['admin', 'pengurus', 'bendahara', 'petugas'];

    public function index()
    {
        $users = User::orderBy('name')->paginate(10);

        return view('users.index', ['users' => $users, 'roles' => self::ROLES]);
    }

    public function update(Request $request, User $user)
    {
        abort_if($user->id === $request->user()->id, 403,
            'Anda tidak dapat mengubah role akun sendiri.');

        $validated = $request->validate([
            'role' => ['required', Rule::in(self::ROLES)],
        ]);

        $user->forceFill(['role' => $validated['role']])->save();

        return redirect()
            ->route('users.index')
            ->with('success', "Role {$user->name} diubah menjadi {$validated['role']}.");
    }
}
