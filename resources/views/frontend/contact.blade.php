@extends('frontend.master')
@section('title', 'Contact-Us')
@section('content')

    <section class="contact_area pt-lg-5 pt-sm-5">
        <div class="contact-inner">
            <div class="container">
                <div class="contact-title text-center">
                    <h2 class="text-uppercase"><strong>WE'RE HERE</strong> TO HELP</h2>
                </div>
                <div class="row my-5">
                    <div class="col-md-6">
                        <div class="contact-form">
                            <div class="contact-title text-center my-4 pb-2">
                                <h3 class="text-uppercase">Contact <strong>US</strong></h3>
                            </div>
                            @if (Session::has('success'))
                                <div class="alert alert-success">
                                    {{ Session::get('success') }}
                                    @php
                                        Session::forget('success');
                                    @endphp
                                </div>
                            @endif
                            <form id="contact-form" action="{{ route('contact.store') }}" method="POST">
                                @csrf
                                <div class="contactform-design">
                                    <div class="row">
                                        <div class="col-md-12 my-3">
                                            <div class="form-group">
                                                <input type="text" class="form-control form-control-border" name="name"
                                                    value="{{ old('name') }}" id="name" placeholder="Name">
                                                @if ($errors->has('name'))
                                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-12 my-3">
                                            <div class="form-group">
                                                <input type="text" class="form-control form-control-border" name="email"
                                                    value="{{ old('email') }}" id="email" placeholder="Email">
                                                @if ($errors->has('email'))
                                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-12 my-3">
                                            <div class="form-group">
                                                <textarea class="form-control form-control-border" id="message" placeholder="Message" name="message"
                                                    rows="3">{{ old('message') }}</textarea>
                                                @if ($errors->has('message'))
                                                    <span class="text-danger">{{ $errors->first('message') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group button text-center">
                                        <button type="submit" name="submit" class="form-button">
                                            Submit
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-4 contact-logo text-center my-5">
                        <ul class="list-unstyled mb-0">
                            <li>
                                <div class="design">
                                    <span class="ti-location-pin"></span>
                                </div>
                                <p>227, raj ratna complex , near maruti suzuki showroom , tagor road , rajkot 360002
                                </p>
                            </li>
                            <li>
                                <div class="design">
                                    <span class="ti-email"></span>
                                </div>
                                <p>codesense.infotech@gmail.com</p>
                            </li>
                            <li>
                                <div class="design">
                                    <span class=""><i class="fas fa-phone-alt"></i></span>
                                </div>
                                <p>San Francisco, CA 94126, USA</p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <section>

        @endsection
