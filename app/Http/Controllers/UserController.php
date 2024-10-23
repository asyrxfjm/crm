<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;
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
            ->where('email', '!=', auth()->user()->email)
            ->paginate(10);

        return Inertia::render('Users/Index', [
            'users' => $query->withQueryString(),
            'filters' => request()->only('search'),
        ]);
    }
}
