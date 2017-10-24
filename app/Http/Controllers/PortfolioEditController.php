<?php

namespace App\Http\Controllers;

use App\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PortfolioEditController extends Controller
{
    public function execute(Portfolio $portfolio, Request $request) {

//        $portfolio = Portfolio::find($id);

        if ($request->isMethod('delete')) {
            $portfolio->delete();
            return redirect('admin')->with('status', 'Страница удалена');
        }

        if ($request->isMethod('post')) {

            $messages = [
                'required' => "Поле :attribute обязательно к заполнеию",
                'unique' => "Поле :attribute должно быть уникальным"
            ];

            $input = $request->except('_token');

            $validator = Validator::make($input, [
                'name' => 'required|max:255|unique:portfolios,name,'.$input['id'],
                'filter' => 'required'
            ], $messages);

            if ($validator->fails()) {
                return redirect()
                    ->route('portfolioEdit', ['portfolio' => $input['id']])
                    ->withErrors($validator);
            }

            if ($request->hasFile('images')) {

                $file = $request->file('images');

                $input['images'] = $file->getClientOriginalName();

                $file->move(public_path().'/assets/img', $input['images']);
            } else {
                $input['images'] = $input['old_images'];
            }

            unset($input['old_images']);

//            $portfolio->unguard();

            $portfolio->fill($input);

            if ($portfolio->update()) {
                return redirect('admin')->with('status', 'Портфолио обновлено');
            }
        }

        $old = $portfolio->toArray();

        if (view()->exists('admin.portfolios_edit')) {

            $data = [
                'title' => 'Редактирование портфолио - '.$old['name'],
                'data'  => $old
            ];

            return view('admin.portfolios_edit', $data);
        }

        abort(404);
    }
}
