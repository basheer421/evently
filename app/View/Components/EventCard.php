<?php

namespace App\View\Components;

use App\Models\Xevent;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class EventCard extends Component
{
    public Xevent $event;
    public string $containerClass;

    /**
     * Create a new component instance.
     */
    public function __construct(Xevent $event, string $containerClass = 'w-80')
    {
        $this->event = $event;
        $this->containerClass = $containerClass;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.event-card');
    }
}
