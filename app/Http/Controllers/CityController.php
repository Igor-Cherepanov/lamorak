<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    /**
     * @var City $cities
     */
    protected $cities;

    /**
     * cityController constructor.
     * @param City $cities
     */
    public function __construct(City $cities)
    {
        $this->cities = $cities;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        $frd = $request->all();
        $cities = $this->cities->filter($frd)->orderBy($frd['ordering'] ?? 'id')->paginate(10);

        return view('cities.index', compact('cities', 'frd'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create(Request $request)
    {
        $frd = $request->all();

        return view('cities.create', compact('frd'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $frd = $request->all();
        $city = $this->cities->create($frd);

        $flashMessages = [['type' => 'success', 'text' => 'Город «' . $city->getName() . '» сохранен']];

        return redirect()->route('cities.edit', $city)->with(compact('flashMessages'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(Request $request)
    {
        $frd = $request->all();

        return view('cities.store', compact('frd'));
    }

    /**
     * @param Request $request
     * @param City $city
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Request $request, City $city)
    {
        $frd = $request->all();

        return view('cities.edit', compact('frd', 'city'));
    }

    /**
     * @param Request $request
     * @param City $city
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, City $city)
    {
        $frd = $request->all();
        $city->update($frd);

        $flashMessages = [['type' => 'success', 'text' => 'Город «' . $city->getName() . '» сохранен']];

        return redirect()->back()->with(compact('flashMessages', 'city', 'frd'));
    }

    /**
     * @param Request $request
     * @param City $city
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Request $request, City $city)
    {
        $frd = $request->all();
        $city->delete();

        $flashMessages = [['type' => 'success', 'text' => 'Город «' . $city->getName() . '» удалена']];

        return redirect()->route('cities.index')->with(compact('frd', 'flashMessages'));
    }
}
