<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;
//    protected static $unguarded = true;
    protected $guarded = [];

    public function scopeConversations(Builder $builder, $userid = null)
    {
        $userId = $userid ?? auth()->id();
        $builder->where('user_id', $userId)
            ->orWhere('receiver_id', $userId);
    }

    public function scopeConversationsWithUser(Builder $builder, $userid = null, $withUserId = null)
    {
        $userId = $userid ?? auth()->id();
        $builder->sendToUser($userId, $withUserId)
              ->orWhere(function ($builder) use ($userId, $withUserId){
                  $builder->receiveFromUser($userId, $withUserId);
              })
            ->oldest();
    }

    public function scopeSendToUser(Builder $builder, $userId, $toUserId)
    {
        $builder->where('user_id', $userId)->where('receiver_id', $toUserId);
    }

    public function scopeReceiveFromUser(Builder $builder, $userId, $fromUserId)
    {
        $builder->where('receiver_id', $userId)->where('user_id', $fromUserId);
    }

    public function sender()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }

    public function advertisement()
    {
        return $this->belongsTo(Advertisement::class, 'ad_id');
    }


}
