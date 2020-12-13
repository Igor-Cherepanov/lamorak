<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    /**
     * @var Currency $currencies
     */
    protected $currencies;

    /**
     * CurrencyController constructor.
     * @param Currency $currencies
     */
    public function __construct(Currency $currencies)
    {
        $this->currencies = $currencies;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        $frd = $request->all();
        $currencies = $this->currencies->filter($frd)->orderBy($frd['ordering'] ?? 'id')->paginate(10);

        return view('currencies.index', compact('currencies', 'frd'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create(Request $request)
    {
        $frd = $request->all();

        return view('currencies.create', compact('frd'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $frd = $request->all();
        $currency = $this->currencies->create($frd);

        $flashMessages = [['type' => 'success', 'text' => 'Валюта «' . $currency->getName() . '» сохранена']];

        return redirect()->route('currencies.edit', $currency)->with(compact('flashMessages'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(Request $request)
    {
        $frd = $request->all();

        return view('currencies.store', compact('frd'));
    }

    /**
     * @param Request $request
     * @param Currency $currency
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Request $request, Currency $currency)
    {
        $frd = $request->all();

        return view('currencies.edit', compact('frd', 'currency'));
    }

    /**
     * @param Request $request
     * @param Currency $currency
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Currency $currency)
    {
        $frd = $request->all();
        $currency->update($frd);

        $flashMessages = [['type' => 'success', 'text' => 'Валюта «' . $currency->getName() . '» сохранена']];

        return redirect()->back()->with(compact('flashMessages', 'currency', 'frd'));
    }

    /**
     * @param Request $request
     * @param Currency $currency
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Request $request, Currency $currency)
    {
        $frd = $request->all();
        $currency->delete();

        $flashMessages = [['type' => 'success', 'text' => 'Валюта «' . $currency->getName() . '» удалена']];

        return redirect()->route('currencies.index')->with(compact('frd', 'flashMessages'));
    }
}
