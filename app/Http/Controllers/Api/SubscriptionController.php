<?php

namespace App\Http\Controllers\Api;

use App\Helpers\SubscriptionType;
use App\Http\Controllers\Controller;
use App\Http\Resources\SubscriptionResource;
use App\Http\Resources\UserSubscriptionResource;
use App\Models\Subscription;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function subscribe(Request $request) {
        $this->validate($request, [
            'subscription_id' => 'required|exists:subscriptions,id'
        ]);

        $subscription = Subscription::query()->find($request->subscription_id);
        $newSub = $request->user()->userSubscription()->create([
            'subscription_id'   => $subscription->id,
            'visits_remain'     => $subscription->visits_per_week,
            'expires_at'        => $subscription->type == SubscriptionType::YEARLY ?
                Carbon::now()->addYear() : Carbon::now()->addMonth()
        ]);

        return new UserSubscriptionResource($newSub);
    }

    public function list() {
        return SubscriptionResource::collection(Subscription::query()->get());
    }
}
