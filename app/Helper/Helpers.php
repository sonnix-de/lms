<?php

namespace App\Helper;

class Helpers
{

    /**
     * diese funktion gibt einen Navigationslink für Twitter Bootstrap 4 aus und 
     * prüft, ob diese Link aktiv ist.
     * <li class="nav-item"><a class="nav-link" href="{{route('lms-medien')}}">Medien</a></li>
     */
    public static function getNavigationLink($label, $NameOfTheRoute, $parameter = [])
    {
        $request = request();
        $active = "";
        $path = route($NameOfTheRoute,$parameter);
        //$active= ? $active : 'nicht aktiv';
        if (ends_with($path, $request->path()))
        {
            $active = "active";
        }
        $ausgabe = sprintf (
            '<li class="nav-item">
                <a class="nav-link %s" href="%s">%s</a>
            </li>',
            $active, route($NameOfTheRoute, $parameter),$label
        );
        return $ausgabe;
    }
}

