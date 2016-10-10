<?php

namespace App\Http\Traits;

use Request;
use Auth;

trait CustomResponses
{
    /**
     * Make Response with json or http.
     *
     * @param string $template
     * @param string $ajaxTemplate
     * @param array $objects
     * @return \Illuminate\Http\Response
     */
    public function makeResponse($template, $ajaxTemplate, $objects = [])
    {
        if (Request::ajax()) {
            $view = (String)view(is_null($ajaxTemplate) ? $template : $ajaxTemplate, $objects);
            $objects['view'] = $view;

            return response()->json($objects);
        }

        return view(is_null($template) ? $ajaxTemplate : $template, $objects);
    }

    /**
     * Update Active field in a table for an instace
     *
     * @param $instance
     * @return $instance
     */
    public function changeActive($instance)
    {
        $instance->active = !$instance->active;
        $instance->save();

        return $instance;
    }
}