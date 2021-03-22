<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subscriber;

class SubscriberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return [
            'subscribers' => Subscriber::where('user_id', auth()->id())->paginate(10)
        ];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $subscriber = Subscriber::find($id);
        if (!$subscriber) {
            return abort(404, 'Абонент не найден');
        }
        if ($subscriber->user_id !== auth()->id()) {
            return abort(403, 'Это не ваш абонент');
        }
        return response()->json(
            [
                'form' => [
                    'title' => 'Изменить запись',
                    'button' => 'Сохранить',
                    'fields' => $subscriber->getFormFields()
                ],
                'subscriber' => $subscriber
            ],
            200
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $subscriber = Subscriber::find($id);
        if (!$subscriber) {
            return abort(404, 'Абонент не найден');
        }
        if ($subscriber->user_id !== auth()->id()) {
            return abort(403, 'Это не ваш абонент');
        }
        $subscriber->delete();
        return response()->json(null, 204);
    }
}
