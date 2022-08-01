@extends('domainsubdomain::layouts.app')
@section('content')
    <!--Domain Page Start -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Domains</h3>
            <div class="card-tools">
                <a href="{{ route('domains.create') }}" class="btn btn-primary btn-sm">Add New</a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>


                            <th>Name</th>
                            <th>Domain</th>
                            <th>Description</th>
                            <th>Domain Type</th>
                            {{-- <th>Domain Status</th> --}}
                            <th>Domain Created</th>
                            <th>Registrar Name</th>
                            <th>Registrar Url</th>
                            <th>Registrar Whois Server</th>
                            <th>Registrar Referral Url</th>
                            <th>Registrant Name</th>
                            <th>Registrant Organization</th>
                            <th>Registrant Street</th>
                            <th>Registrant City</th>
                            <th>Registrant State Province</th>
                            <th>Billing Name</th>
                            <th>Billing Organization</th>
                            <th>Billing Street</th>
                            <th>Billing City</th>
                            <th>Billing State Province</th>
                            <th>Nameserver</th>
                            <th>Dnssec</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($domains as $domain)
                            <tr>
                                <td>{{ $domain->name }}</td>
                                <td>{{ $domain->domain }}</td>
                                <td>{{ $domain->description }}</td>
                                <td>{{ $domain->domain_type }}</td>
                                {{-- <td>{{ $domain->domain_status }}</td> --}}
                                <td>{{ $domain->domain_created }}</td>
                                <td>{{ $domain->registrar_name }}</td>
                                <td>{{ $domain->registrar_url }}</td>
                                <td>{{ $domain->registrar_whois_server }}</td>
                                <td>{{ $domain->registrar_referral_url }}</td>
                                <td>{{ $domain->registrant_name }}</td>
                                <td>{{ $domain->registrant_organization }}</td>
                                <td>{{ $domain->registrant_street }}</td>
                                <td>{{ $domain->registrant_city }}</td>
                                <td>{{ $domain->registrant_state_province }}</td>
                                <td>{{ $domain->billing_name }}</td>
                                <td>{{ $domain->billing_organization }}</td>
                                <td>{{ $domain->billing_street }}</td>
                                <td>{{ $domain->billing_city }}</td>
                                <td>{{ $domain->billing_state_province }}</td>
                                <td>{{ $domain->nameserver }}</td>
                                <td>{{ $domain->dnssec }}</td>
                                <td>
                                    <a href="{{ route('domains.show', $domain->id) }}" class="btn btn-info btn-sm">Show</a>
                                    <a href="{{ route('domains.edit', $domain->id) }}"
                                        class="btn btn-primary btn-sm">Edit</a>
                                    <form action="{{ route('domains.destroy', $domain->id) }}" method="POST"
                                        style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </td>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!--Domain Page End -->
@endsection
