<?php

namespace Modules\User\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Inertia\Response;
use Modules\User\Http\Requests\StoreRequest;
use Modules\User\Http\Requests\UpdateRequest;
use Modules\User\Models\User;

class UserController extends Controller
{
    public function index(): Response
    {
        /** @var LengthAwarePaginator */
        $query = User::query()
            ->when(request('search'), function ($query) {
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

        return Inertia::render('Users/Index', [
            'users'   => $query->withQueryString(),
            'filters' => request()->only(['search', 'sort', 'sortBy', 'page']),
            'message' => Session::get('message'),
            'error'   => Session::get('error'),
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('Users/Create');
    }

    public function store(StoreRequest $request): RedirectResponse
    {
        User::create($request->validated() + ['password' => bcrypt(Str::random(16))]);

        Session::flash('message', 'User created successfully.');

        return to_route('users.index');
    }

    public function edit(User $user): Response
    {
        return Inertia::render('Users/Edit', [
            'user' => $user,
        ]);
    }

    public function update(User $user, UpdateRequest $request): RedirectResponse
    {
        $user->update($request->validated());

        return back();
    }

    public function destroy(User $user): RedirectResponse
    {
        $user->delete();

        Session::flash('message', 'User deleted successfully.');

        return to_route('users.index');
    }
}
