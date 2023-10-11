<?php

namespace App\View\Components\Invoices;

use App\Models\Agreement;
use App\Models\Headquarter;
use App\Models\InvoiceState;
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
        $states = InvoiceState::all();

        return view('pages.invoices.components.filter', [
            'agreements' => $agreements,
            'headquarters' => $headquarters,
            'states' => $states
        ]);
    }
}
