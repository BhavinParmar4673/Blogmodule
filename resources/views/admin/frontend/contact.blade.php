@extends('admin.frontend.master')
@section('title', 'Contact-Us')
@section('content')

<section class="contact_area">
    <div class="contact-inner my-0">
        <div class="container">
            <div class="contact-title text-center">
                <h2 class="text-uppercase text-white">WE'RE HERE <span class="h6">TO HELP</span></h2>
            </div>
            <div class="row my-4">
                    <div class="col-md-6">
                            <div class="contact-form">
                                <div class="contact-title text-center my-4">
                                    <h2 class="text-uppercase text-white"><span class="h6">Contact </span>Us</h2>
                                </div>
                                <form>
                                    <div class="contactform-design">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-border" id="name">
                                            <label class="form-control-placeholder" for="name">Name</label>
                                        </div>
                                        <div class="form-group">
                                                <input type="email" class="form-control form-control-border" id="email">
                                                <label class="form-control-placeholder" for="name">Email</label>
                                        </div>
                                        <div class="form-group">
                                            <textarea class="form-control form-control-border" id="message" rows="3"></textarea>
                                            <label class="form-control-placeholder" for="name">Message</label>
                                        </div>
                                        <div class="button text-center">
                                            <button type="submit" name="submit" class="form-button">
                                                Submit
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                    </div>
                    <div class="col-md-6">
                        <div class="contact-logo my-4">
                                <div class="contact-location my-2">
                                    <div class="design">
                                        <span class="ti-location-pin"></span>
                                    </div>
                                    <p>227, raj ratna complex , near maruti suzuki showroom , tagor road , rajkot 360002
                                    </p>
                                </div>
                                <div class="contact-email my-2">
                                    <div class="design">
                                        <span class="ti-email"></span>
                                    </div>
                                    <p>codesense.infotech@gmail.com</p>
                                </div>
                                <div class="contact-phone my-2">
                                    <div class="design">
                                        <span class="ti-mobile"></span>
                                    </div>
                                </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
<section>

@endsection
