<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Registered;

class CreateDefaultCategories
{

    public $categories = [
        'Salario',
        'Arriendo',
        'Alimentacion',
        'Transporte',
        'Ocio',
        'Otros'
    ];

    /**
     * Handle the event.
     *
     * @param    $event
     * @return void
     */
    public function handle(Registered $event)
    {
        $user = $event->user;
        collect($this->categories)->each(function($category) use ($user) {
            $user->categories()->create([
                'name' => $category
            ]);
        });
    }
}
