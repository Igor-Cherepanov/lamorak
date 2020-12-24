<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use App\Models\ExchangeCurrency;
use App\Models\ExchangeOffice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class ExchangeCurrencyController extends Controller
{
    /**
     * @var ExchangeCurrency $exchangeCurrency
     */
    protected $exchangeCurrencies;

    /**
     * @var Currency $currencies
     */
    protected $currencies;

    /**
     * ExchangeCurrencyController constructor.
     * @param ExchangeCurrency $exchangeCurrencies
     * @param Currency $currencies
     * @param ExchangeOffice $exchangeOffices
     */
    public function __construct(ExchangeCurrency $exchangeCurrencies, Currency $currencies, ExchangeOffice $exchangeOffices)
    {
        $this->exchangeCurrencies = $exchangeCurrencies;
        $this->currencies = $currencies;
        $currencyList = $currencies->pluck('name', 'id');
        $exchangeOfficeList = $exchangeOffices->pluck('name', 'id');
        View::share('currencyList', $currencyList);
        View::share('exchangeOfficeList', $exchangeOfficeList);

    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        $frd = $request->all();
        $exchangeCurrencies = $this->exchangeCurrencies->filter($frd)->orderBy($frd['ordering'] ?? 'id')->paginate(10);

        return view('exchange-currencies.index', compact('exchangeCurrencies', 'frd'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create(Request $request)
    {
        $frd = $request->all();

        return view('exchange-currencies.create', compact('frd'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $frd = $request->all();
        $exType = $frd['action_id'] ?? 1;
        $frd['sold_currency_count'] = $frd['sold_currency_count'] ?? 0;
        $frd['bought_currency_count'] = $frd['bought_currency_count'] ?? 0;
        $frd['sold_rub_count'] = $frd['sold_rub_count'] ?? 0;
        $frd['bought_rub_count'] = $frd['bought_rub_count'] ?? 0;

        $exchangeCurrency = $this->exchangeCurrencies->create($frd);

        $flashMessages = [['type' => 'success', 'text' => 'Обмен проведен']];

        return redirect()->route('exchange-currencies.index', $exchangeCurrency)->with(compact('flashMessages'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(Request $request)
    {
        $frd = $request->all();

        return view('exchange-currencies.store', compact('frd'));
    }

    /**
     * @param Request $request
     * @param ExchangeCurrency $exchangeCurrency
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Request $request, ExchangeCurrency $exchangeCurrency)
    {
        $frd = $request->all();

        return view('exchange-currencies.edit', compact('frd', 'exchangeCurrency'));
    }

    /**
     * @param Request $request
     * @param ExchangeCurrency $exchangeCurrency
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, ExchangeCurrency $exchangeCurrency)
    {
        $frd = $request->all();
        $exchangeCurrency->update($frd);

        $flashMessages = [['type' => 'success', 'text' => 'Валюта «' . $exchangeCurrency->getName() . '» сохранена']];

        return redirect()->back()->with(compact('flashMessages', 'exchangeCurrency', 'frd'));
    }

    /**
     * @param Request $request
     * @param ExchangeCurrency $exchangeCurrency
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Request $request, ExchangeCurrency $exchangeCurrency)
    {
        $frd = $request->all();
        $exchangeCurrency->delete();

        $flashMessages = [['type' => 'success', 'text' => 'Валюта «' . $exchangeCurrency->getName() . '» удалена']];

        return redirect()->route('exchange-currencies.index')->with(compact('frd', 'flashMessages'));
    }

    public function selectAction(){
        return \view('exchange-currencies.select-action');
    }

    public function selectCurrency(int $action_id){
        $currencies = $this->currencies->where('id', '<>', 13)->get();

        return \view('exchange-currencies.select-currency', compact('currencies','action_id'));
    }

    public function exchange(int $action_id, Currency $currency){

        return \view('exchange-currencies.exchange', compact('currency','action_id'));
    }

}
