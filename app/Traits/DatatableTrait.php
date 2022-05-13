<?php

namespace App\Traits;

trait DatatableTrait

{

    public function status($isYes, $id, $url, $item = NULL)
    {

        if ($isYes !== NULL) {

            $isYes =    '<div class="custom-control custom-switch">
            <input type="checkbox" class="change-status custom-control-input" id="status_' . $id . '" name="status_' . $id . '" data-url="' . $url . '" value="' . $id . '">
            <label class="custom-control-label" for="status_' . $id . '"></label>
          </div>';
        } else {
            $isYes =     '<div class="custom-control custom-switch">
            <input type="checkbox" class="change-status custom-control-input" id="status_' . $id . '" name="status_' . $id . '" data-url="' . $url . '" value="' . $id . '" checked>
            <label class="custom-control-label" for="status_' . $id . '"></label>
          </div>';
        }

        return $isYes;
    }

    public function action($data)
    {
        return view('components.admin.ui.action')->with('list_item', array_filter($data))->render();
    }
}