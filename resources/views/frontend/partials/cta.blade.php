@extends('layouts.app2')
@section('content')
    <div id="kontak" class="contact">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 offset-lg-4">
                    <div class="section-heading text-center">
                        <h6>| Hubungi kami &</h6>
                        <h2 class="text-black">Kunjungi Kami Sekarang</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="contact-content">
        <div class="container">
            <div class="row">
                <div class="">
                    <div id="map">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.100803891854!2d110.43007209999999!3d-6.997408999999998!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e708d003bcc1edd%3A0x695f9cf4c83c7c91!2sKost%20Putra%20Wonodri%20Kebondalem!5e0!3m2!1sid!2sid!4v1735350700633!5m2!1sid!2sid"
                            width="100%" height="500px" frameborder="0"
                            style="border:0; border-radius: 10px; box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.15);"
                            allowfullscreen=""></iframe>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="item phone d-flex gap-4 align-items-center">
                                <i class="fa fa-phone"></i>
                                <h6>+62895359203353<br><span>Phone Number</span></h6>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="item email  d-flex gap-4 align-items-center ">
                                <i class="fa fa-voicemail "></i>
                                <h6>dylansyahp994@gmail.com<br><span>Business Email</span></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
