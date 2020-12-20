<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Currency;
use App\Models\User;
use App\Models\UserCurrencyBalance;
use Illuminate\Http\Request;

class CurrencyBalanceController extends Controller
{
    /**
     * @var UserCurrencyBalance $userCurrencyBalances
     */
    protected $userCurrencyBalances;

    /**
     * userCurrencyBalanceController constructor.
     * @param UserCurrencyBalance $userCurrencyBalances
     */
    public function __construct(UserCurrencyBalance $userCurrencyBalances)
    {
        $this->userCurrencyBalances = $userCurrencyBalances;
        $currencies = Currency::all()->pluck('name', 'id');
        \View::share('currencyList', $currencies);
    }

    /**
     * @param Request $request
     * @param User $user
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request, User $user)
    {
        $frd = $request->all();
        $currencyBalances = auth()->user()->getCurrencyBalances();

        return view('users.currency-balances.index', compact('currencyBalances', 'user', 'frd'));
    }

    /**
     * @param Request $request
     * @param User $user
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create(Request $request, User $user)
    {
        $frd = $request->all();

        return view('users.currency-balances.create', compact('frd', 'user'));
    }

    /**
     * @param Request $request
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, User $user)
    {
        $frd = $request->all();
        $frd['user_id'] = auth()->id();

        $currency_balance = $this->userCurrencyBalances->create($frd);

        $flashMessages = [['type' => 'success', 'text' => 'Счет сохранен']];

        return redirect()->route('users.currency-balances.edit', compact('flashMessages', 'user', 'currency_balance'));
    }

    /**
     * @param Request $request
     * @param User $user
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(Request $request, User $user)
    {
        $frd = $request->all();

        return view('users.currency-balances.store', compact('frd'));
    }

    /**
     * @param Request $request
     * @param User $user
     * @param UserCurrencyBalance $currency_balance
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Request $request, User $user, UserCurrencyBalance $currency_balance)
    {
        $frd = $request->all();

        return view('users.currency-balances.edit', compact('frd', 'currency_balance', 'user'));
    }

    /**
     * @param Request $request
     * @param User $user
     * @param UserCurrencyBalance $currency_balance
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, User $user, UserCurrencyBalance $currency_balance)
    {
        $frd = $request->all();
        $frd['balance'] = (int)$frd['balance'];

        $currency_balance->update($frd);

        $flashMessages = [['type' => 'success', 'text' => 'Счет сохранен']];

        return redirect()->back()->with(compact('flashMessages', 'currency_balance', 'frd', 'user'));
    }

    /**
     * @param Request $request
     * @param User $user
     * @param UserCurrencyBalance $currency_balance
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Request $request, User $user, UserCurrencyBalance $currency_balance)
    {
        $frd = $request->all();
        $currency_balance->delete();

        $flashMessages = [['type' => 'success', 'text' => 'Счет удалена']];

        return redirect()->route('users.currency-balances.index', compact('frd', 'flashMessages', 'user'));
    }
}
