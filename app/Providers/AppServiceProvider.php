<?php

namespace App\Providers;

use App\Models\Connection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            if (! Auth::check()) {
                return;
            }

            $user = Auth::user();
            $respondedUserIds = Connection::where('sender_id', $user->id)->pluck('receiver_id');

            $incomingLikesCount = Connection::where('receiver_id', $user->id)
                ->where('status', 'liked')
                ->whereNotIn('sender_id', $respondedUserIds)
                ->count();

           $matchesCount = Connection::where('status', 'matched')
    ->where('sender_id', $user->id)
    ->count();

            $view->with([
                'navIncomingLikesCount' => $incomingLikesCount,
                'navMatchesCount' => $matchesCount,
            ]);
        });
    }
}
