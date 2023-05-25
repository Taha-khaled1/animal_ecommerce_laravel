@extends('email.layout')
@section('content')
    <section class="mail-seccess section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3 col-12">
                    <div class="success-inner">
                        <h1><i class="fa fa-envelope"></i><span>{{__('Register verification')}}</span></h1>
                        <p>{{__('Use this code to verify your account')}}</p>
                        <h4> {{$data->code}} </h4>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
