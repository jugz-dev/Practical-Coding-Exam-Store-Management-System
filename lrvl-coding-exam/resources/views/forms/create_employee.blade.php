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
                        <div class="col-sm-6 form-name">
                            <h4>Employee Registration Form</h4>
                            <p class="form-instruction fw-lighter">Please input form fields accordingly.</p>
                        </div>
                    </div>

                    <form class="row g-3" method="POST" action="{{route('employee.save')}}"accept-charset="UTF-8"> 
                    {{csrf_field()}}

                    <div class="col-12">
                        <label for="first-name">First Name</label>
                            <input class="form-control" id="first-name" name="first_name"  type="text" pattern="^(?!['\s-])[A-Za-z\s'-]+(?<!['-])$" min="" max="255" title="Please input valid characters only." placeholder="Input first name (e.g Marc Xander)"required>
                    </div>

                    <div class="col-md-6">
                        <label for="middle-name">Middle Name</label>
                        <input class="form-control" id="middle-name" name="middle_name"  type="text" pattern="^(?!['\s-])[A-Za-z\s'-]+(?<!['-])$" min="" max="255" title="Please input valid characters only." placeholder="Input middle name (e.g Dela Rosa)">
                    </div>

                    <div class="col-md-6">
                        <label for="last_name">Last Name</label>
                        <input class="form-control" id="last-name" name="last_name"  type="text" pattern="^(?!['\s-])[A-Za-z\s'-]+(?<!['-])$" min="" max="255" title="Please input valid characters only." placeholder="Input last name (e.g Dela Rosa)"required>
                    </div>

                        
                    <div class="col-md-2">
                        <label for="suffix">Suffix</label>
                        <input class="form-control" id="suffix" name="suffix"  type="text" pattern="^(?i)(?!\.)([JSRIVXLCDM.]+)$"max="5" title="Please input valid characters only." placeholder="(e.g Jr, Sr,...)">
                    </div>

                    <div class="col-md-10">
                        <label for="position">Job Position</label>
                        <input class="form-control" id="position" name="position"  type="text" pattern="^[A-Za-z][A-Za-z'\s.,&\/-]*[A-Za-z]$" min="" max="255" title="Please input valid characters only." placeholder="Input Job Position(e.g Cashier, Manager, ...)"required>
                    </div>

                    <div class="col-md-6">
                        <label for="employee-phone-num">Phone Number</label>
                        <input class="form-control" id="employee-phone-num" name="emp_phone_number" pattern="^09\d{9}$" min="11" max="11" type="text" placeholder="Input store phone number (e.g 09XXXXXXXXX)" required>
                    </div>   

                    <div class="col-md-6">
                        <label for="employee-email">Email Address</label>    
                        <input class="form-control" id="employee-email" name="emp_email" min="3" max="320" type="email" placeholder="Input email (e.g storeemail@storeemail.com)" required>
                    </div>   

                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <label for="employee_store">Assign Employee to Store:</label>
                        <select class="form-select"name="employee_store" id="employee_store" required>
                            <option value="" disabled selected>Select a store</option>
                            @foreach($stores as $store)
                                <option value="{{$store->id}}">{{$store->store_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2"></div>

                    <div class="d-flex justify-content-center">
                        @if($stores->isEmpty())
                            <div class="col-sm-8 ">  
                                <p class="fw-lighter text-danger"><span class="font-weight-bold">Warning:</span> Employees cannot be registered unless there is at least one registered store in the database.</p>
                            </div>
                        @else
                            <button class="btn-submit" id="submit" type="submit" name="submit" value="Submit"> Submit </button>                   
                        @endif
                    </div>   

                                           
                    </form>
                </div>
   
        </div>
    </body>
</html>
