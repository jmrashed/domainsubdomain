<?php

namespace Jmrashed\DomainSubdomain\Http\Controllers;

use App\Http\Controllers\Controller;
use Jmrashed\DomainSubdomain\Models\Domain;

class SubDomainController extends Controller
{


    public function __construct()
    {
        $this->middleware('domain');
    }

    public function index()
    {
        $domains = Domain::latest()->paginate(25);
        $buttons = [
            // Create
            [
                'text' => 'Create',
                'url' => route('subdomains.create'),
                'class' => 'btn-primary',
            ],
            // Export
            [
                'text' => 'Export',
                'url' => route('subdomains.export', 1),
                'class' => 'btn-success',
            ],

            // Import
            [
                'text' => 'Import',
                'url' => route('subdomains.import',1),
                'class' => 'btn-info',
            ],

        ];
        return view('domainsubdomain::subdomains.index', compact('domains','buttons'));
    }
 
}
