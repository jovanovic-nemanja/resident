<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Category;
use App\GeneralSetting;
use App\LocalizationSetting;
use App\Order;
use Cart;
use App;
use App\User;
use App\Unit;
use App\Product;
use Illuminate\Support\Facades\DB;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
            
        \View::composer('*', function($view){
            if ($view->getName() != 'admin.category.index') {
                $userid = auth()->id();
                $query = DB::table('users')
                            ->Join('role_user', 'users.id', '=', 'role_user.user_id')
                            ->Join('roles', 'roles.id', '=', 'role_user.role_id')
                            ->where('users.id', $userid)
                            ->select('roles.name')
                            ->get();

                $marks = User::getMarks($userid);

                if (@$userid) {
                    $user = User::where('id', $userid)->get();
                    $user_status = $user[0]['block'];
                }else{
                    $user_status = 0;
                }

                $categorys = Category::all();

                $view->with(
                    [
                        'units' => Unit::all(),
                        'marks' => $marks,
                        'categorys' => $categorys,
                        'roles' => $query,
                        'user_status' => $user_status,
                        'm_products' => Product::all(),
                        'general_setting' => GeneralSetting::first(),
                        'localization_setting' => LocalizationSetting::first(),
                        // 'ordercount' => Order::salescount(auth()->id()) + Order::transactioncount(auth()->id()),
                    ]
                );
            }

            $localization_setting = LocalizationSetting::first();
            App::setLocale($localization_setting->language);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
