<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;
use Symfony\Component\Translation\Translator;
use Symfony\Component\Translation\Loader\ArrayLoader;

class CarbonServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(Translator::class, function () {
            $translator = new Translator('es');
            $translator->addLoader('array', new ArrayLoader());
            $translator->addResource('array', [
                'Sunday' => 'Domingo',
                'Monday' => 'Lunes',
                'Tuesday' => 'Martes',
                'Wednesday' => 'Miércoles',
                'Thursday' => 'Jueves',
                'Friday' => 'Viernes',
                'Saturday' => 'Sábado',
            ], 'es');
            $translator->setLocale('es');
            return $translator;
        });

        Carbon::setTranslator($this->app->make(Translator::class));
    }
}