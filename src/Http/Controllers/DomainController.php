<?php

namespace Jmrashed\DomainSubdomain\Http\Controllers;

use Jmrashed\DomainSubdomain\Models\Domain;

class DomainController extends Controller
{


    public function __construct()
    {
        $this->middleware('domaincheck');
    }

    public function index()
    {
        $domains = Domain::latest()->paginate(25);
        return view('domainsubdomain::domains.index', compact('domains'));
    }

    public function show()
    {
        //
    }

    public function store()
    {
        
    }
}
