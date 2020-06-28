@extends('layouts.app')

@section('content')
<div class="row justify-content-center jumbotron">
    <div class="col-md-8 col-lg-6 form-wrapper" data-form-type="formoid">          
        <div class="form-head">
            <h3 class="mbr-section-subtitle form-subtitle mbr-fonts-style align-center pb-3 display-4" style="text-align: center">
                {{$title}}
            </h3>
        </div>
        <div class="form1" data-form-type="formoid">
            <div data-form-alert="" hidden="">thanks for filling out the form! we will contact you soon!</div>
            <form class="mbr-form" action="" method="get" data-form-title="Support Form">
                <div class="input-wrap" data-for="title">
                    <label class="form-label-outside mbr-lighter" for="form-1-title" style="text-align: center !important;">Title</label>
                    <input type="text" class="form-control" placeholder="Contact Us Title" style="text-align: center !important;" name="title" data-form-field="First Name" required="" id="title-form4-1">
                    @error('title')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                
            
                <div class="input-wrap" data-for="email">
                    <label class="form-label-outside mbr-lighter" for="form-1-email">Email</label>
                    <input type="email" class="form-control" placeholder="email@support.com" style="text-align: center !important;" name="email" data-form-field="Email" required="" id="email-form4-1">
                    @error('email')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            
                
            
                <div class="form-group" data-for="message">
                    <label class="form-label-outside mbr-lighter" for="form-1-message">Message</label>
                    <textarea type="text" class="form-control" placeholder="Input your message here!" name="message" rows="4" data-form-field="Message" id="message-form4-1"></textarea>
                    @error('message')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            
                <span class="input-group-btn"><button type="submit" class="btn btn-lg btn-form btn-info display-4">Submit</button></span>
            </form>
        </div>
    </div>
</div>
@endsection