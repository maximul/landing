<?php

namespace App\Http\Controllers;

use App\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ServiceAddController extends Controller
{
    public function execute(Request $request) {

        if ($request->isMethod('post')) {

            $messages = [
                'required' => "Поле :attribute обязательно к заполнеию",
                'unique' => "Поле :attribute должно быть уникальным"
            ];

            $input = $request->except('_token');

            $validator = Validator::make($input, [
                'name' => 'required|unique:services|max:255',
                'text' => 'required',
                'icon' => 'required|unique:services|max:255',
            ], $messages);

            if ($validator->fails()) {
                return redirect()->route('serviceAdd')->withErrors($validator)->withInput();
            }

            $service = new Service();

//            $service->unguard();

            $service->fill($input);

            if ($service->save()) {
                return redirect('admin')->with('status', 'Сервис добавлен');
            }
        }

        if (view()->exists('admin.services_add')) {

            $data = [
                'title' => 'Новый cервис'
            ];

            return view('admin.services_add', $data);
        }

        abort(404);
    }
}
