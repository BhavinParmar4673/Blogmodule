<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Support\Facades\View;
use App\Models\Setting;

class ThemeAppLayout extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $title = null;

    public function __construct($title = null)
    {
        $this->title = $title;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $setting = Setting::where('name', 'general_settings')->first();
        if (!is_null($setting)) {
            $response = $setting->response;
            View::share(['setting' => $setting, 'response' => $response]);
        }
        return view('theme.layouts.app');
    }
}