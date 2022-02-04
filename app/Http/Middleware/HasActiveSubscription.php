<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;

class HasActiveSubscription
{
    public function handle(Request $request, Closure $next) {
        $subscription = $request->user()->userSubscription()?->first();

        if (! $subscription) {
            return response()->json([
                'success' => false,
                'message' => 'You have to purchase subscription.'
            ]);
        }

        if ($subscription->visits_remain <= 0) {
            return response()->json([
                'success' => false,
                'message' => 'No visits remain for this week.'
            ]);
        }

        if ($subscription->expires_at < Carbon::now()) {
            return response()->json([
                'success' => false,
                'message' => 'Your subscription is expired.'
            ]);
        }

        return $next($request);
    }
}
