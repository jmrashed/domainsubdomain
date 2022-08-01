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
