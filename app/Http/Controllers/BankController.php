<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\City;
use Illuminate\Http\Request;

class BankController extends Controller
{
    /**
     * @var Bank $banks
     */
    protected $banks;

    /**
     * bankController constructor.
     * @param Bank $banks
     */
    public function __construct(Bank $banks)
    {
        $this->banks = $banks;
        $cities = City::all()->pluck('name', 'id');
        \View::share('cities', $cities);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        $frd = $request->all();
        $banks = $this->banks->filter($frd)->orderBy($frd['ordering'] ?? 'id')->paginate(10);

        return view('banks.index', compact('banks', 'frd'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create(Request $request)
    {
        $frd = $request->all();

        return view('banks.create', compact('frd'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $frd = $request->all();
        $bank = $this->banks->create($frd);

        $flashMessages = [['type' => 'success', 'text' => 'Город «' . $bank->getName() . '» сохранен']];

        return redirect()->route('banks.edit', $bank)->with(compact('flashMessages'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(Request $request)
    {
        $frd = $request->all();

        return view('banks.store', compact('frd'));
    }

    /**
     * @param Request $request
     * @param Bank $bank
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Request $request, Bank $bank)
    {
        $frd = $request->all();

        return view('banks.edit', compact('frd', 'bank'));
    }

    /**
     * @param Request $request
     * @param Bank $bank
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Bank $bank)
    {
        $frd = $request->all();
        $bank->update($frd);

        $flashMessages = [['type' => 'success', 'text' => 'Город «' . $bank->getName() . '» сохранен']];

        return redirect()->back()->with(compact('flashMessages', 'bank', 'frd'));
    }

    /**
     * @param Request $request
     * @param Bank $bank
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Request $request, Bank $bank)
    {
        $frd = $request->all();
        $bank->delete();

        $flashMessages = [['type' => 'success', 'text' => 'Город «' . $bank->getName() . '» удалена']];

        return redirect()->route('banks.index')->with(compact('frd', 'flashMessages'));
    }
}
