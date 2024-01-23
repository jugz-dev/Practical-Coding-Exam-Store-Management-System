<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <body class="antialiased">
    @include('components.navbar');

        <div class="container">
                <div class="row semi-header-row with-shadow">
                    <div class="col-sm-3 table-name">
                       <h5 class="slim-font">List of Registered Employees</h5> 
                    </div>
                    <div class="col-sm-1"></div>
                    <div class="col-sm-5 search-bar-div">
                        <form class="d-flex search-bar-parent" role="search">
                        <input class="form-control me-2 search-bar" id="search-bar" onkeyup="searchFunction()" type="search" placeholder="Type employee name ... " aria-label="Search">
                        <button class="btn search-btn disabled">Search</button>
                        </form>
                    </div>
                    <div class="col-sm-1"></div>
                    <div class="col-sm-2 d-flex justify-content-center">
                        <a href="{{route('employee.create')}}" class="btn custom-pill-register">Register an Employee</a>
                    </div>
                </div>

                <div class="row d-flex justify-content-center">
                    @if(session('message'))
                        <div class="alert alert-success alert-dismissible fade show col-6" role="alert">
                            <span class="font-weight-bold">Request Complete! </span>{{session('message')}}
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

                <div class="table-responsive with-shadow justify-content-end">
                    <table class="table table-sm table-hover" id="records-table">
                    
                    @if($employees->isEmpty())
                        <div class="d-flex justify-content-center">
                            <div class="col-sm-8 form-name no-record-info">
                                <h4>NO RECORDS FOUND</h4>
                                <p class="fw-lighter">Register an employee to utilize records view page.</p>
                                <p class="fw-lighter text-danger"><span class="font-weight-bold">Warning:</span> Employees cannot be registered unless there is at least one registered store in the database.</p>
                            </div>
                        </div>
                    @else
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Employee Name</th>
                                <th scope="col">Position</th>
                                <th scope="col">Phone No.</th>
                                <th scope="col">Email</th>
                                <th scope="col">Store Assignment</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($employees as $employee)
                            <tr>
                                <td>{{$employee->emp_id}}</td>
                                <td>{{$employee->first_name}} {{$employee->middle_name}} {{$employee->last_name}} {{$employee->suffix}}</td>
                                <td>{{$employee->position}}</td>
                                <td>{{$employee->emp_phone_number}}</td>
                                <td>{{$employee->emp_email}}</td>
                                <td>{{$employee->store->store_name}}</td>
                                <td>
                                    <div class="d-flex justify-content-center">
                                        <form method="POST" action="{{route('employee.edit', $employee->emp_id)}}" accept-charset="UTF-8">
                                            {{csrf_field()}}   
                                            <button type="Submit" class="btn custom-pill-edit">Edit</button>
                                        </form>
                                        <!-- <form method="POST" action="{{route('employee.delete', $employee->emp_id)}}" accept-charset="UTF-8">
                                            {{csrf_field()}}   
                                            <button type="Submit" class="btn custom-pill-delete">Delete</button>
                                        </form>    -->
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn custom-pill-delete" data-bs-toggle="modal" data-bs-target="#deleteModal{{$employee->emp_id}}">Delete</button>

                                    </div>
                                </td>
                            </tr>

                            <!-- Modal -->
                            <div class="modal fade" id="deleteModal{{$employee->emp_id}}" tabindex="-1" aria-labelledby="deleteModalLabel{{$employee->emp_id}}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Confirmation</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Are you sure you want to delete this employee record?<br><br>This action can not be undone.
                                    </div>
                                    <div class="modal-footer">
                                        <form method="POST" action="{{route('employee.delete', $employee->emp_id)}}" accept-charset="UTF-8">
                                        {{csrf_field()}}   
                                            <button type="submit" class="btn custom-pill-delete-modal">Delete</button>
                                        </form>
                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                    </div>
                                    </div>
                                </div>
                            </div> 
                            @endforeach
                        </tbody>
                    @endif
                    </table>

                </div>
                            
        </div>

                <!-- Search Function -->
                <script>
                    function searchFunction() {
                    // Get the input element with the id "myInput"
                    var input, filter, table, tr, td, i, txtValue;
                    input = document.getElementById("search-bar");

                    // Convert the input value to uppercase for case-insensitive filtering
                    filter = input.value.toUpperCase();

                    // Get the table element with the id "myTable"
                    table = document.getElementById("records-table");

                    // Get all the rows of the table
                    tr = table.getElementsByTagName("tr");

                        // Loop through each row of the table
                        for (i = 0; i < tr.length; i++) {
                            // Get the first cell (td) of each row //name column
                            td = tr[i].getElementsByTagName("td")[1];

                            // Check if a cell is found
                            if (td) {
                            // Get the text content of the cell, considering both textContent and innerText for browser compatibility
                            txtValue = td.textContent || td.innerText;

                            // Check if the text content of the cell contains the filter text
                            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                                // If it does, display the row
                                tr[i].style.display = "";
                            } else {
                                // If it doesn't, hide the row
                                tr[i].style.display = "none";
                            }
                            }
                        }
                    }
                </script>
    </body>
</html>
