<?php

namespace App\Http\Controllers;

use App\Http\Requests\MessageStoreRequest;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\CityResource;
use App\Http\Resources\CountryResource;
use App\Http\Resources\MessageResource;
use App\Http\Resources\StateResource;
use App\Http\Resources\UserResource;
use App\Models\Category;
use App\Models\Country;
use App\Models\Message;
use App\Models\State;
use App\Models\User;
use App\Notifications\NewMessageNotification;

class ApiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getCategoryById(Category $category)
    {
        return response()->success(CategoryResource::collection($category->categories()->get(['id', 'name'])));
    }

    public function getStatesByCountryId(Country $country)
    {
        return response()->success(StateResource::collection($country->states()->get(['id', 'name'])));
    }

    public function getCitiesByStateId(State $state)
    {
        return response()->success(CityResource::collection($state->cities()->get(['id', 'name'])));
    }

    public function store(MessageStoreRequest $request)
    {
        $message = Message::query()->create($request->validated())->loadMissing(['sender', 'receiver', 'advertisement']);
        $receiver = $message->receiver;
        $receiver->notify(new NewMessageNotification($message));
        return response()->success(MessageResource::make($message), 'Your message has been sent!');
    }

    public function getConversations()
    {
        $userid = auth()->id();
        $conversations = Message::conversations($userid)->with(['receiver', 'sender'])->get();

        $chatUsers = $conversations->map(function ($con) use ($userid) {
//           if ($con->receiver_id === $userid)  {
               return $con->receiver_id === $userid ? $con->sender : $con->receiver;
//           }
        })->filter()->unique('id');

//        $receivers = $conversations->map(function ($con) use ($userid) {
//           if ($con->user_id === $userid)  {
//               return $con->receiver;
//           }
//        })->filter();
        return response()->success(UserResource::collection($chatUsers));
    }

    public function getConversationsByUserId($userId)
    {
        return response()->success(MessageResource::collection(Message::conversationsWithUser(null, $userId)->with(['sender', 'receiver', 'advertisement'])->get()));
    }
}
