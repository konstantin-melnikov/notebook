<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SubscriberRequest;
use App\Models\Subscriber;
use App\Http\Resources\SubscriberResource;
use App\Http\Resources\Forms\SubscriberEditCollection;

class SubscriberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /**
         * @todo Fix pagination issue with SubscriberCollection
         * @example return [
         *   'data' => new SubscriberCollection(
         *       Subscriber::where('user_id', auth()->id())->paginate(10)
         *   )
         * ];
         */ 
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
        $subscriber = new Subscriber;
        return response()->json(
            [
                'form' => [
                    'type'  => 'create',
                    'title' => 'Новая запись',
                    'button' => 'Добавить',
                    'fields' => $subscriber->getFormFields()
                ],
                'subscriber' => new SubscriberResource($subscriber)
            ],
            200
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SubscriberRequest $request)
    {
        $subscriber = auth()->user()->subscribers()->create($request->validated());
        return $subscriber;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $subscriber = $this->_getSubscriberOrReturnFailed($id);
        return response()->json(
            [
                'form' => [
                    'type'  => 'edit',
                    'title' => 'Изменить запись',
                    'button' => 'Сохранить',
                    'fields' => $subscriber->getFormFields()
                ],
                'subscriber' => new SubscriberResource($subscriber)
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
    public function update(SubscriberRequest $request, $id)
    {
        $subscriber = $this->_getSubscriberOrReturnFailed($id);
        $subscriber->update($request->validated());
        return $subscriber;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $subscriber = $this->_getSubscriberOrReturnFailed($id);
        $subscriber->delete();
        return response()->json(null, 204);
    }

    private function _getSubscriberOrReturnFailed($id)
    {
        $subscriber = Subscriber::find($id);
        if (!$subscriber) {
            return abort(404, 'Абонент не найден');
        }
        if ($subscriber->user_id !== auth()->id()) {
            return abort(403, 'Это не ваш абонент');
        }
        return $subscriber;
    }
}
