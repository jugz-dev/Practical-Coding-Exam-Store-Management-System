@include('components.navbar');

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<body>
    <div class="container d-flex justify-content-center">

        <div class="welcome with-shadow">
            <div class="row d-flex justify-content-center">
                <div class="col-sm-12">
                    <h1 class="font=weight-bold">Hello, there!</h1>
                    <p>How would you like to proceed?</p>
                </div>

                <div class="col-sm-6">
                    <div class="d-flex justify-content-center">
                        <a class="custom-pill-link welcome-pill" href="{{route('store.index')}}">Store Management</a>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="d-flex justify-content-center">
                        <a class="custom-pill-link welcome-pill" href="{{route('employee.index')}}">Employee Management</a>
                    </div>
                </div>
                <div class="col-sm-12">
                    <p class="text-center fst-italic welcome-nav-intro">For convenient navigation across the system, use the header navigation buttons.</p>
                </div>
            </div>
        </div>
    </div>

</body>

</body>
</html>