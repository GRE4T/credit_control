<?php

namespace App\View\Components\PaymentsMade;

use App\Models\Agreement;
use App\Models\Headquarter;
use Illuminate\View\Component;

class Filter extends Component
{
    public $callback;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $callback)
    {
        $this->callback = $callback;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $agreements= Agreement::all();
        $headquarters = Headquarter::all();

        return view('pages.paymentsmade.components.filter', [
            'agreements' => $agreements,
            'headquarters' => $headquarters
        ]);
    }
}
