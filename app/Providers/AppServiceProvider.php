<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //  $this->app->usePublicPath(base_path('public_html'));
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();

        Gate::define('is-admin', function ($user) {
            return $user->role === 'admin';
        });

        View::composer('*', function ($view) {



            if(Auth::guard('web')->check()){

                // $unreadSponsorCount = DatabaseNotification::where(function ($query) {
                //         $query->where('notifiable_type', 'App\Models\Sponsor')
                //             ->orWhere('notifiable_type', 'App\Models\User');
                //     })
                //     ->where('notifiable_id', Auth::guard('web')->id())
                //     ->whereNull('read_at')
                //     ->where('type' , 'App\Notifications\OrphanMessage')
                //     ->where('status' , 'active')
                //     ->count();

                $unreadCountNotification = Auth::user()->unreadNotifications->filter(function ($notification) {
                    return $notification->type === 'App\Notifications\SponsorshipEndingSoon'
                    || $notification->type === 'App\Notifications\SponsorshipEnded';
                })
                ->count();
            }
            else{
                // $unreadSponsorCount = 0;
                $unreadCountNotification = 0;
            }


            $view->with('unreadCountNotification' , $unreadCountNotification);
        });

    }
}
