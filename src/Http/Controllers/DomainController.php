<?php

namespace Jmrashed\DomainSubdomain\Http\Controllers;

use App\Http\Controllers\Controller;
use Jmrashed\DomainSubdomain\Models\Domain;

class DomainController extends Controller
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
                'url' => route('domains.create'),
                'class' => 'btn-primary',
            ],
            // Export
            [
                'text' => 'Export',
                'url' => route('domains.export', 1),
                'class' => 'btn-success',
            ],

            // Import
            [
                'text' => 'Import',
                'url' => route('domains.import',1),
                'class' => 'btn-info',
            ],

        ];
        return view('domainsubdomain::domains.index', compact('domains'));
    }

    public function create()
    {
        dd('create');
    }

    public function show()
    {
        //
    }

    public function store()
    {
    }

    public function destroy()
    {
    }
}
