<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(): View
    {
        $users = User::query()->where('id', '!=', Auth::user()->id)->paginate(10);

        return view('admin.user.index')->with('users', $users);
    }

    public function updateIsAdmin(User $user): RedirectResponse
    {
        $user->is_admin = !$user->is_admin;

        try {
            $user->save();

            return redirect(route('admin.users.index', ))->with('success', 'User admin rights successfully updated');
        } catch (QueryException) {
            return back()->with('error', 'User admin rights were not updated! Please try again.');
        }
    }
}
