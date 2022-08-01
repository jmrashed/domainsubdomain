@extends('domainsubdomain::layouts.app')
@section('content')
    <!--Domain Page Start -->
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Domains</h3>
                        <div class="card-tools">
                            <a href="{{ route('domains.create') }}" class="btn btn-primary btn-sm">Add New</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Domain Name</th>
                                    <th>Domain Type</th>
                                    <th>Domain Status</th>
                                    <th>Domain Expiry Date</th>
                                    <th>Domain Price</th>
                                    <th>Domain Description</th>
                                    <th>Domain Image</th>
                                    <th>Domain Created At</th>
                                    <th>Domain Updated At</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($domains as $domain)
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Domain Page End -->
@endsection
