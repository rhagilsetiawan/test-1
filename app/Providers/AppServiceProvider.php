<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;


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
        // Check if the APP_ENV is set to production
        if (config('app.env') === 'production') {
            // Force all URLs to be HTTPS
            URL::forceScheme('https');
        }

        Paginator::useBootstrapFive();

        Blade::directive('convert', function ($money) {
            return "<?php echo number_format($money, 2); ?>";
        });

        view()->composer('*', function ($view) {
            if (Auth::check()) {
                $user = User::find(Auth::user()->id);
                View::share([
                    'userId' => $user->id,
                    'userGlobal' => $user,
                    'userImage' => $user->getImage(),
                ]);
            } else {
                $user = User::find(1);
                View::share([
                    'userId' => $user->id,
                    'userGlobal' => $user,
                    'userImage' => $user->getImage(),
                ]);
            }
        });
    }
}
