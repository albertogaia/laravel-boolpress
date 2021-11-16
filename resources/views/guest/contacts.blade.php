@extends('layouts.app')
@section('title', 'Contatti')
    
@section('content')
<div class="container">

    <section class="mb-4">
    
        <!--Section heading-->
        <h2 class="h1-responsive font-weight-bold text-center my-4">Contattaci</h2>
        <!--Section description-->
        <p class="text-center w-responsive mx-auto mb-5">Hai qualche domanda da farci? Non esitare di contattarci direttamente. Il nostro team ti ricontatterà il prima possibile</p>
    
        <div class="row">
    
            <!--Grid column-->
            <div class="col-md-12 mb-md-0 mb-5">
                <form id="contact-form" name="contact-form" action="{{route('contacts.send')}}" method="POST">
                    @csrf
    
                    <!--Grid row-->
                    <div class="row">
    
                        <!--Grid column-->
                        <div class="col-md-6">
                            <div class="md-form mb-0">
                                <input type="text" id="name" name="name" class="form-control" required>
                                <label for="name" class="">Your name</label>
                            </div>
                        </div>
                        <!--Grid column-->
    
                        <!--Grid column-->
                        <div class="col-md-6">
                            <div class="md-form mb-0">
                                <input type="email" id="email" name="email" class="form-control" required>
                                <label for="email" class="">Your email</label>
                            </div>
                        </div>
                        <!--Grid column-->
    
                    </div>
                    <!--Grid row-->
    
                    <!--Grid row-->
                    <div class="row">
    
                        <!--Grid column-->
                        <div class="col-md-12">
    
                            <div class="md-form">
                                <textarea type="text" id="message" name="message" rows="2" class="form-control md-textarea" required></textarea>
                                <label for="message">Your message</label>
                            </div>
    
                        </div>
                    </div>
                    <!--Grid row-->
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="Invia">
                    </div>
                </form>
            </div>
            <!--Grid column-->
    
        </div>
    
    </section>
</div>
    <!--Section: Contact v.2-->
@endsection