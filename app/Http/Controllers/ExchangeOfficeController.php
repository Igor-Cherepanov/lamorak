<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\ExchangeOffice;
use Illuminate\Http\Request;

class ExchangeOfficeController extends Controller
{
    /**
     * @var ExchangeOffice $exchangeOffices
     */
    protected $exchangeOffices;

    /**
     * exchangeOfficeController constructor.
     * @param ExchangeOffice $exchangeOffices
     */
    public function __construct(ExchangeOffice $exchangeOffices)
    {
        $this->exchangeOffices = $exchangeOffices;
        $banks = Bank::all()->pluck('name', 'id');
        \View::share('banks', $banks);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        $frd = $request->all();
        $exchangeOffices = $this->exchangeOffices->filter($frd)->orderBy($frd['ordering'] ?? 'id')->paginate(10);

        return view('exchange-offices.index', compact('exchangeOffices', 'frd'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create(Request $request)
    {
        $frd = $request->all();

        return view('exchange-offices.create', compact('frd'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $frd = $request->all();
        $exchangeOffice = $this->exchangeOffices->create($frd);

        $flashMessages = [['type' => 'success', 'text' => 'Валюта «' . $exchangeOffice->getName() . '» сохранена']];

        return redirect()->route('exchange-offices.edit', $exchangeOffice)->with(compact('flashMessages'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(Request $request)
    {
        $frd = $request->all();

        return view('exchange-offices.store', compact('frd'));
    }

    /**
     * @param Request $request
     * @param ExchangeOffice $exchangeOffice
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Request $request, ExchangeOffice $exchangeOffice)
    {
        $frd = $request->all();

        return view('exchange-offices.edit', compact('frd', 'exchangeOffice'));
    }

    /**
     * @param Request $request
     * @param ExchangeOffice $exchangeOffice
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, ExchangeOffice $exchangeOffice)
    {
        $frd = $request->all();
        $exchangeOffice->update($frd);

        $flashMessages = [['type' => 'success', 'text' => 'Валюта «' . $exchangeOffice->getName() . '» сохранена']];

        return redirect()->back()->with(compact('flashMessages', 'exchangeOffice', 'frd'));
    }

    /**
     * @param Request $request
     * @param ExchangeOffice $exchangeOffice
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Request $request, ExchangeOffice $exchangeOffice)
    {
        $frd = $request->all();
        $exchangeOffice->delete();

        $flashMessages = [['type' => 'success', 'text' => 'Валюта «' . $exchangeOffice->getName() . '» удалена']];

        return redirect()->route('exchange-offices.index')->with(compact('frd', 'flashMessages'));
    }
}
