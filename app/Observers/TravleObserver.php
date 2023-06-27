<?php

namespace App\Observers;

use App\Models\Travel;

class TravleObserver
{
    /**
     * Handle the Travel "creating" event.
     */
    public function creating(Travel $travel): void
    {
        // make slug unique
        $slug = str($travel->name)->slug();

        // check the uniqueness of the slug
        $counter = 1;
        $originalSlug = $slug;
        while (Travel::where('slug',$slug)->exists()){
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }
        $travel->slug = $slug;
        
    }
}
