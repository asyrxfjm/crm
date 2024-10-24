<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;
use Inertia\Response;

class UserController extends Controller
{
    public function index(): Response
    {
        /** @var LengthAwarePaginator */
        $query = User::query()
            ->when(request('search'), function ($query, $search) {
                return $query->where(function ($q) {
                    $q->where('name', 'like', '%'.request('search').'%')
                        ->orWhere('email', 'like', '%'.request('search').'%')
                        ->orWhere('id', request('search'));
                });
            })
            ->when(request('sort'), function ($query) {
                return $query->orderBy(request('sortBy'), request('sort'));
            })
            ->where('email', '!=', Auth::user()->email)
            ->paginate();

        Log::info(request()->all());

        return Inertia::render('Users/Index', [
            'users' => $query->withQueryString(),
            'filters' => request()->only(['search', 'sort', 'sortBy']),
        ]);
    }

    public function edit(User $user): Response
    {
        return Inertia::render('Users/Edit', [
            'user' => $user,
        ]);
    }

    public function update(User $user, Request $request): RedirectResponse
    {
        $user->update($request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$user->id],
        ]));

        return back();
    }
}
