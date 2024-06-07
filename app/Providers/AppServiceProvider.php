<?php

namespace App\Providers;

use App\Helper\LanguageHelper;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
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
            $view->with('languagesArr', LanguageHelper::get());

            if (Auth::check()) {
                $route = Route::currentRouteName();
                $aliases = explode('.', $route);

                if (count($aliases) > 1) {
                    $parent_menu = $aliases[0];
                    $menu = $aliases[1];
                    $module = $aliases[2];

                    $header = __('label.navigation.menu.' . $menu);
                    $active_parent = $parent_menu;
                    $active_menu = $menu;

                    if ($module == 'add') {
                        $header = __('label.module.create') . ' ' . $header;
                        $breadcrumb = [
                            [
                                'label' => __('label.navigation.parent_menu.' . $parent_menu),
                                'active' => false,
                            ],
                            [
                                'label' => __('label.navigation.menu.' . $menu),
                                'active' => false,
                            ],
                            [
                                'label' => __('label.module.create'),
                                'active' => true,
                            ],
                        ];
                    } elseif ($module == 'edit') {
                        $header = __('label.module.update') . ' ' . $header;
                        $breadcrumb = [
                            [
                                'label' => __('label.navigation.parent_menu.' . $parent_menu),
                                'active' => false,
                            ],
                            [
                                'label' => __('label.navigation.menu.' . $menu),
                                'active' => false,
                            ],
                            [
                                'label' => __('label.module.update'),
                                'active' => true,
                            ],
                        ];
                    } elseif ($module == 'view') {
                        $header = __('label.module.readid') . ' ' . $header;
                        $breadcrumb = [
                            [
                                'label' => __('label.navigation.parent_menu.' . $parent_menu),
                                'active' => false,
                            ],
                            [
                                'label' => __('label.navigation.menu.' . $menu),
                                'active' => false,
                            ],
                            [
                                'label' => __('label.module.readid'),
                                'active' => true,
                            ],
                        ];
                    } else {
                        $breadcrumb = [
                            [
                                'label' => __('label.navigation.parent_menu.' . $parent_menu),
                                'active' => false,
                            ],
                            [
                                'label' => __('label.navigation.menu.' . $menu),
                                'active' => true,
                            ],
                        ];
                    }
                } else {
                    $header = __('label.navigation.' . $aliases[0]);
                    $active_parent = $aliases[0];
                    $active_menu = null;
                    $breadcrumb = [
                        [
                            'label' => __('label.navigation.' . $aliases[0]),
                            'active' => true,
                        ]
                    ];
                }

                $view->with('header', $header);
                $view->with('breadcrumb', $breadcrumb);
                $view->with('activeParent', $active_parent);
                $view->with('activeMenu', $active_menu);
            }
        });
    }
}
