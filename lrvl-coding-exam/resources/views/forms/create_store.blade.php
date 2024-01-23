<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <body class="antialiased">
    @include('components.navbar');

        <div class="container container-small">


                
                    <div class="row d-flex justify-content-center">
                        @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show col-8" role="alert">
                            <span class="font-weight-bold">Oops!</span> You may have invalid inputs. Please review and try again.
                            <ul>
                                @foreach($errors->all() as $error)
                                <li class="text-danger">
                                    {{ $error }}
                                </li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif

                        @if(session('warning'))
                        <div class="alert alert-danger alert-dismissible fade show col-6"  role="alert">
                            <span class="font-weight-bold">Oops! </span>{{ session('warning') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif
                    </div>
                

                <div class="form-body with-shadow">
                    <div class=" d-flex justify-content-center">
                        <div class="col-sm-5 form-name">
                            <h4>Store Registration Form</h4>
                            <p class="form-instruction fw-lighter">Please input form fields accordingly.</p>
                        </div>
                    </div>

                    <form class="row g-3" method="POST" action="{{ route('store.save')}}" accept-charset="UTF-8">
                    {{csrf_field()}}   

                    <div class="col-12">
                        <label for="store-name" class="form-label">Store Name</label>
                        <input class="form-control" id="store-name" name="store_name"  type="text" pattern="^(?![.'&, -])[A-Za-z'\d.,&\/-][A-Za-z'\d.,&\/ -]*$" min="" max="255" title="Please input valid characters only." placeholder="Input name (e.g Store Name 1)" required>
                    </div>
                    <div class="col-12">
                        <label for="store-address" class="form-label">Store Address</label>
                        <input type="text" class="form-control" id="store-address" name="store_address" pattern="^(?![.',-])[A-Za-z'\d., -]+$" min="3" max="255" placeholder="Input address (e.g Street, City, Province)" required>
                    </div>
                    <div class="col-md-6">
                        <label for="store-phone-num" class="form-label">Store Phone Number </label>
                        <input class="form-control" id="store-phone-num" name="store_phone_number" pattern="^09\d{9}$" min="11" max="11" type="text" placeholder="Input store phone number (e.g 09XXXXXXXXX)" required>
                    </div>
                    <div class="col-md-6">
                        <label for="store-email" class="form-label">Store Email</label>
                        <input class="form-control" id="store-email" name="store_email" min="3" max="320" type="email" placeholder="Input email (e.g storeemail@storeemail.com)" required>
                    </div>             
                    <div class="d-flex justify-content-center">
                        <input type="submit" class="btn-submit" name="Submit" value="Submit">
                    </div>
                    </form>
                </div>
        </div>

    </body>
</html>
