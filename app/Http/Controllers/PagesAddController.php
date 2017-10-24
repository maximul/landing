<?php

namespace App\Http\Controllers;

use App\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PagesAddController extends Controller
{
    public function execute(Request $request) {

        if ($request->isMethod('post')) {

            $messages = [
                'required' => "Поле :attribute обязательно к заполнеию",
                'unique' => "Поле :attribute должно быть уникальным"
            ];

            $input = $request->except('_token');

            $validator = Validator::make($input, [
                'name' => 'required|max:255',
                'alias' => 'required|unique:pages|max:255',
                'text' => 'required'
            ], $messages);

            if ($validator->fails()) {
                return redirect()->route('pagesAdd')->withErrors($validator)->withInput();
            }

            if ($request->hasFile('images')) {

                $file = $request->file('images');

                $input['images'] = $file->getClientOriginalName();

                $file->move(public_path().'/assets/img', $input['images']);
            }

            $page = new Page();

//            $page->unguard();

            $page->fill($input);

            if ($page->save()) {
                return redirect('admin')->with('status', 'Страница добавлена');
            }
        }

        if (view()->exists('admin.pages_add')) {

            $data = [
                'title' => 'Новая страница'
            ];

            return view('admin.pages_add', $data);
        }

        abort(404);
    }
}