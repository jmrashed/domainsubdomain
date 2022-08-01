<?php

namespace Jmrashed\DomainSubdomain\View\Components;

use Illuminate\View\Component;

class Alert extends Component
{
    public $message;

    public function __construct($message)
    {
        $this->message = $message;
    }

    public function render()
    {
        return view('domainsubdomain::domains.components.alert');
    }
}
