<?php

namespace App\Http\Controllers;

use App\Models\Facilitie;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class FacilitieController extends Controller
{
    public function index(): View
    {
        Gate::authorize('admin');
        return view('facilities.index', ['facilities' => Facilitie::all()]);
    }

    public function showFormCreate(): View
    {
        Gate::authorize('admin');
        return view('facilities.create');
    }

    public function create(Request $request): RedirectResponse
    {
        Gate::authorize('admin');
        if($request->input('title')){
            $newFacility = new Facilitie();
            $newFacility->title = $request->input('title');
            $newFacility->save();
        }
        return redirect()->route('facilities.index')->with('resultMessage', "Добавлено новое удобство с id - $newFacility->id");
    }

    public function showFormUpdate($id): View
    {
        Gate::authorize('admin');
        $facility = Facilitie::find($id);
        return view('facilities.update', ['facility'=>$facility]);
    }

    public function update(int $id, Request $request): RedirectResponse
    {
        Gate::authorize('admin');
        if($request->input('title')){
            $facility = Facilitie::find($id);
            $facility->title = $request->input('title');
            $facility->save();
        }
        return redirect()->route('facilities.index')->with('resultMessage', "Обновлена запись с id - $id");
    }

    public function delete(int $id): RedirectResponse
    {
        Gate::authorize('admin');
        $facility = Facilitie::find($id);
        $facility->delete();
        return redirect()->route('facilities.index')->with('resultMessage', 'Запись удалена!');
    }
}
