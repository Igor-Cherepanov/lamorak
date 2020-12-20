<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Currency;
use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * @var User
     */
    protected $users;

    /**
     * userCurrencyBalanceController constructor.
     * @param User $users
     */
    public function __construct(User $users)
    {
        $this->users = $users;
        $currencies = Currency::all()->pluck('name', 'id');
        \View::share('currencyList', $currencies);
    }

    /**
     * @param User $user
     */
    public function index(User $user)
    {
        //
    }

    /**
     * @param User $user
     */
    public function create(User $user)
    {
        //
    }

    /**
     * @param Request $request
     * @param User $user
     */
    public function store(Request $request, User $user)
    {
        //
    }

    /**
     * @param User $user
     */
    public function show(User $user)
    {
        //
    }

    /**
     * @param User $user
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * @param Request $request
     * @param User $user
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * @param User $user
     */
    public function destroy(User $user)
    {
        //
    }


}
