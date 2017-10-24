<?php

namespace App\Http\Controllers;

use App\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ServiceEditController extends Controller
{
    public function execute(Service $service, Request $request) {

//        $service = Service::find($id);

        if ($request->isMethod('delete')) {
            $service->delete();
            return redirect('admin')->with('status', 'Страница удалена');
        }

        if ($request->isMethod('post')) {

            $messages = [
                'required' => "Поле :attribute обязательно к заполнеию",
                'unique' => "Поле :attribute должно быть уникальным"
            ];

            $input = $request->except('_token');

            $validator = Validator::make($input, [
                'name' => 'required|max:255|unique:services,name,'.$input['id'],
                'text' => 'required',
                'icon' => 'required|max:255|unique:services,icon,'.$input['id'],
            ], $messages);

            if ($validator->fails()) {
                return redirect()
                    ->route('serviceEdit', ['service' => $input['id']])
                    ->withErrors($validator);
            }

//            $service->unguard();

            $service->fill($input);

            if ($service->update()) {
                return redirect('admin')->with('status', 'Сервис обновлен');
            }
        }

        $old = $service->toArray();

        if (view()->exists('admin.services_edit')) {

            $data = [
                'title' => 'Редактирование сервиса - '.$old['name'],
                'data'  => $old
            ];

            return view('admin.services_edit', $data);
        }

        abort(404);
    }
}
