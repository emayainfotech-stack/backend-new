<!DOCTYPE html>
<!--
Template Name: NobleUI - HTML Bootstrap 5 Admin Dashboard Template
Author: NobleUI
Website: https://nobleui.com
Contact: nobleui.team@gmail.com
Purchase: https://1.envato.market/nobleui_html
License: You must have a valid license to legally use this template for your project.
-->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Responsive HTML Admin Dashboard Template based on Bootstrap 5">
    <meta name="author" content="NobleUI">
    <meta name="keywords" content="nobleui, bootstrap, bootstrap 5, bootstrap5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

    <title>Form Validation - NobleUI Admin Template</title>

    <!-- color-modes:js -->
    <script src="{{ asset('Backend/assets/js/color-modes.js') }}"></script>
    <!-- endinject -->

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <!-- End fonts -->

    <!-- core:css -->
    <link rel="stylesheet" href="{{ asset('Backend/assets/vendors/core/core.css') }}">
    <!-- endinject -->

    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{ asset('Backend/assets/vendors/select2/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('Backend/assets/vendors/jquery-tags-input/jquery.tagsinput.min.css') }}">
    <link rel="stylesheet" href="{{ asset('Backend/assets/vendors/dropzone/dropzone.css') }}">
    <link rel="stylesheet" href="{{ asset('Backend/assets/vendors/dropify/dist/dropify.min.css') }}">
    <link rel="stylesheet" href="{{ asset('Backend/assets/vendors/pickr/themes/classic.min.css') }}">
    <link rel="stylesheet" href="{{ asset('Backend/assets/vendors/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('Backend/assets/vendors/flatpickr/flatpickr.min.css') }}">
    <!-- End plugin css for this page -->

    <!-- inject:css -->
    <!-- endinject -->

    <!-- Layout styles -->
    <link rel="stylesheet" href="{{ asset('Backend/assets/css/demo1/style.css') }}">
    <!-- End layout styles -->

    <link rel="shortcut icon" href="{{ asset('Backend/assets/images/favicon.png') }}" />
</head>
<body>
    <div class="main-wrapper">

        <!-- partial:partials/_sidebar.html -->
        @include('partials.sidebar')
        <!-- partial -->

        <div class="page-wrapper">

            <!-- partial:partials/_navbar.html -->
            @include('partials.header')
            <!-- partial -->

            <div class="page-content">

                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Forms</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Advanced Elements</li>
                    </ol>
                </nav>

                <div class="row">
                    <div class="col-lg-6 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Form Validation</h4>
                                <p class="text-secondary mb-3">Read <a href="https://jqueryvalidation.org/" target="_blank"> Official jQuery Validation Documentation </a>for a full list of instructions and other options.</p>
                                <form id="signupForm">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Name</label>
                                        <input id="name" class="form-control" name="name" type="text">
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input id="email" class="form-control" name="email" type="email">
                                    </div>
                                    <div class="mb-3">
                                        <label for="ageSelect" class="form-label">Age</label>
                                        <select class="form-select" name="age_select" id="ageSelect">
                                            <option selected disabled>Select your age</option>
                                            <option>12-18</option>
                                            <option>18-22</option>
                                            <option>22-30</option>
                                            <option>30-60</option>
                                            <option>Above 60</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Gender</label>
                                        <div>
                                            <div class="form-check form-check-inline">
                                                <input type="radio" class="form-check-input" name="gender_radio" id="gender1">
                                                <label class="form-check-label" for="gender1">
                                                    Male
                                                </label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input type="radio" class="form-check-input" name="gender_radio" id="gender2">
                                                <label class="form-check-label" for="gender2">
                                                    Female
                                                </label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input type="radio" class="form-check-input" name="gender_radio" id="gender3">
                                                <label class="form-check-label" for="gender3">
                                                    Other
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Skills</label>
                                        <div>
                                            <div class="form-check form-check-inline">
                                                <input type="checkbox" name="skill_check" class="form-check-input" id="checkInline1">
                                                <label class="form-check-label" for="checkInline1">
                                                    Angular
                                                </label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input type="checkbox" name="skill_check" class="form-check-input" id="checkInline2">
                                                <label class="form-check-label" for="checkInline2">
                                                    ReactJs
                                                </label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input type="checkbox" name="skill_check" class="form-check-input" id="checkInline3">
                                                <label class="form-check-label" for="checkInline3">
                                                    VueJs
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="password" class="form-label">Password</label>
                                        <input id="password" class="form-control" name="password" type="password">
                                    </div>
                                    <div class="mb-3">
                                        <label for="confirm_password" class="form-label">Confirm password</label>
                                        <input id="confirm_password" class="form-control" name="confirm_password" type="password">
                                    </div>
                                    <div class="mb-3">
                                        <div class="form-check">
                                            <label class="form-check-label" for="termsCheck">
                                                Agree to <a href="#"> terms and conditions </a>
                                            </label>
                                            <input type="checkbox" class="form-check-input" name="terms_agree" id="termsCheck">
                                        </div>
                                    </div>
                                    <input class="btn btn-primary" type="submit" value="Submit">
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Bootstrap MaxLength</h4>
                                <p class="text-secondary mb-3">Read <a href="https://github.com/mimo84/bootstrap-maxlength" target="_blank"> Official Bootstrap MaxLength Documentation </a>for a full list of instructions and other options.</p>
                                <div class="row mb-3">
                                    <div class="col-lg-3">
                                        <label for="defaultconfig" class="col-form-label">Default usage</label>
                                    </div>
                                    <div class="col-lg-8">
                                        <input class="form-control" maxlength="25" name="defaultconfig" id="defaultconfig" type="text" placeholder="Type Something..">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-lg-3">
                                        <label for="defaultconfig-2" class="col-form-label">Few options</label>
                                    </div>
                                    <div class="col-lg-8">
                                        <input class="form-control" maxlength="20" name="defaultconfig-2" id="defaultconfig-2" type="text" placeholder="Type Something..">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-lg-3">
                                        <label for="defaultconfig-3" class="col-form-label">All options</label>
                                    </div>
                                    <div class="col-lg-8">
                                        <input class="form-control" maxlength="10" name="defaultconfig-3" id="defaultconfig-3" type="text" placeholder="Type Something..">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3">
                                        <label for="defaultconfig-4" class="col-form-label">Text Area</label>
                                    </div>
                                    <div class="col-lg-8">
                                        <textarea id="maxlength-textarea" class="form-control" id="defaultconfig-4" maxlength="100" rows="8" placeholder="This textarea has a limit of 100 chars."></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 grid-margin">
                        <div class="card">
                            <div class="card-body">
                                <h6 class="card-title">Input Mask</h6>
                                <p class="text-secondary mb-3">Read <a href="https://github.com/RobinHerbots/Inputmask" target="_blank"> Official Inputmask Documentation </a>for a full list of instructions and other options.</p>
                                <form class="forms-sample">
                                    <div class="row mb-3">
                                        <div class="col">
                                            <label class="form-label">Date:</label>
                                            <input class="form-control mb-4 mb-md-0" data-inputmask="'alias': 'datetime'" data-inputmask-inputformat="dd/mm/yyyy"/>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Time (12 hour):</label>
                                            <input class="form-control" data-inputmask="'alias': 'datetime'" data-inputmask-inputformat="hh:mm tt" />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label class="form-label">Date time:</label>
                                            <input class="form-control mb-4 mb-md-0" data-inputmask="'alias': 'datetime'" data-inputmask-inputformat="dd/mm/yyyy HH:MM:ss" />
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Date with custom placeholder:</label>
                                            <input class="form-control" data-inputmask="'alias': 'datetime'" data-inputmask-placeholder="*" data-inputmask-inputformat="dd/mm/yyyy" />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label class="form-label">Phone:</label>
                                            <input class="form-control mb-4 mb-md-0" data-inputmask="'mask' : '(+99) 9999-9999'"/>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Credit card:</label>
                                            <input class="form-control" data-inputmask="'mask' : '9999-9999-9999-9999'"/>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label class="form-label">Currency:</label>
                                            <input class="form-control mb-4 mb-md-0" data-inputmask="'alias': 'currency', 'prefix':'$'"/>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Serial key:</label>
                                            <input class="form-control" data-inputmask="'mask' : '****-****-****-****'"/>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label class="form-label">Email:</label>
                                            <input class="form-control mb-4 mb-md-0" data-inputmask="'alias': 'email'"/>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Ip address:</label>
                                            <input class="form-control" data-inputmask="'alias': 'ip'"/>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Select 2</h4>
                                <p class="text-secondary mb-3">Read <a href="https://select2.org/" target="_blank"> Official Select2 Documentation </a>for a full list of instructions and other options.</p>
                                <div class="mb-3">
                                    <label class="form-label">Single select box using select 2</label>
                                    <select class="js-example-basic-single form-select" data-width="100%">
                                        <option value="TX">Texas</option>
                                        <option value="NY">New York</option>
                                        <option value="FL">Florida</option>
                                        <option value="KN">Kansas</option>
                                        <option value="HW">Hawaii</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="form-label">Multiple select using select 2</label>
                                    <select class="js-example-basic-multiple form-select" multiple="multiple" data-width="100%">
                                        <option value="TX">Texas</option>
                                        <option value="WY">Wyoming</option>
                                        <option value="NY">New York</option>
                                        <option value="FL">Florida</option>
                                        <option value="KN">Kansas</option>
                                        <option value="HW">Hawaii</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Typeahead</h4>
                                <p class="text-secondary mb-3">Read <a href="https://github.com/twitter/typeahead.js" target="_blank"> Official Typeahead.js Documentation </a>for a full list of instructions and other options.</p>
                                <div class="row">
                                    <div class="col-12 mb-3">
                                        <label class="form-label">Basic</label>
                                        <div id="the-basics" class="d-flex flex-column">
                                            <input class="typeahead" autocomplete="off" type="text" placeholder="States of USA">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label">Bloodhound</label>
                                        <div id="bloodhound" class="d-flex flex-column">
                                            <input class="typeahead" type="text" placeholder="States of USA">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h6 class="card-title">Tags input</h6>
                                <p class="text-secondary mb-3">Read <a href="https://www.npmjs.com/package/jquery-tags-input" target="_blank"> Official jQuery-tags-input Documentation </a>for a full list of instructions and other options.</p>
                                <p class="mb-2">Type something to add a new tag</p>
                                <div>
                                    <input name="tags" id="tags" value="New York,Texas,Florida,New Mexico" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h6 class="card-title">Color picker</h6>
                                <p class="text-secondary mb-3">Flat, simple, and responsive Color-Picker library. Read <a href="https://github.com/Simonwep/pickr" target="_blank"> Official @simonwep/pickr Documentation </a>for a full list of instructions and other options.</p>
                                <p class="mb-2">Click color square to activate Color Picker</p>
                                <div class="d-flex">
                                    <div class="me-2">
                                        <div id="pickr_1"></div>
                                    </div>
                                    <div class="me-2">
                                        <div id="pickr_2"></div>
                                    </div>
                                    <div class="me-2">
                                        <div id="pickr_3"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h6 class="card-title">Date picker</h6>
                                <p class="text-secondary mb-3">Read <a href="https://flatpickr.js.org/" target="_blank"> Official Flatpickr Documentation </a>for a full list of instructions and other options.</p>
                                <div class="input-group flatpickr" id="flatpickr-date">
                                    <input type="text" class="form-control" placeholder="Select date" data-input>
                                    <span class="input-group-text input-group-addon" data-toggle><i data-lucide="calendar"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h6 class="card-title">Time picker</h6>
                                <p class="text-secondary mb-3">Read <a href="https://flatpickr.js.org/" target="_blank"> Official Flatpickr Documentation </a>for a full list of instructions and other options.</p>
                                <div class="input-group flatpickr" id="flatpickr-time">
                                    <input type="text" class="form-control" placeholder="Select time" data-input>
                                    <span class="input-group-text input-group-addon" data-toggle><i data-lucide="clock"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 stretch-card grid-margin grid-margin-md-0">
                        <div class="card">
                            <div class="card-body">
                                <h6 class="card-title">Dropzone</h6>
                                <p class="text-secondary mb-3">Read <a href="https://www.dropzonejs.com/" target="_blank"> Official Dropzone.js Documentation </a>for a full list of instructions and other options.</p>

                                <form action="/file-upload" class="dropzone" id="exampleDropzone">
                                    <div class="dz-message ">
                                        Drop files here or click to upload.<BR>
                                        <SPAN class="note needsclick">(This is just a demo dropzone. Selected
                                        files are <STRONG>not</STRONG> actually uploaded.)</SPAN>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h6 class="card-title">Dropify</h6>
                                <p class="text-secondary mb-3">Read <a href="https://github.com/JeremyFagis/dropify" target="_blank"> Official Dropify Documentation </a>for a full list of instructions and other options.</p>
                                <input type="file" id="myDropify"/>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- partial:partials/_footer.html -->
            <footer class="footer d-flex flex-row align-items-center justify-content-between px-4 py-3 border-top small">
                <p class="text-secondary mb-1 mb-md-0">Copyright © 2026 <a href="https://nobleui.com" target="_blank">NobleUI</a>.</p>
                <p class="text-secondary">Handcrafted With <i class="mb-1 text-primary ms-1 icon-sm" data-lucide="heart"></i></p>
            </footer>
            <!-- partial -->

        </div>
    </div>

    <!-- core:js -->
    <script src="{{ asset('Backend/assets/vendors/core/core.js') }}"></script>
    <!-- endinject -->

    <!-- Plugin js for this page -->
    <script src="{{ asset('Backend/assets/vendors/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('Backend/assets/vendors/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('Backend/assets/vendors/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"></script>
    <script src="{{ asset('Backend/assets/vendors/inputmask/jquery.inputmask.min.js') }}"></script>
    <script src="{{ asset('Backend/assets/vendors/select2/select2.min.js') }}"></script>
    <script src="{{ asset('Backend/assets/vendors/typeahead.js/typeahead.bundle.min.js') }}"></script>
    <script src="{{ asset('Backend/assets/vendors/jquery-tags-input/jquery.tagsinput.min.js') }}"></script>
    <script src="{{ asset('Backend/assets/vendors/dropzone/dropzone-min.js') }}"></script>
    <script src="{{ asset('Backend/assets/vendors/dropify/dist/dropify.min.js') }}"></script>
    <script src="{{ asset('Backend/assets/vendors/pickr/pickr.min.js') }}"></script>
    <script src="{{ asset('Backend/assets/vendors/moment/moment.min.js') }}"></script>
    <script src="{{ asset('Backend/assets/vendors/flatpickr/flatpickr.min.js') }}"></script>
    <!-- End plugin js for this page -->

    <!-- inject:js -->
    <script src="{{ asset('Backend/assets/js/app.js') }}"></script>
    <!-- endinject -->

    <!-- Custom js for this page -->
    <script src="{{ asset('Backend/assets/js/form-validation.js') }}"></script>
    <script src="{{ asset('Backend/assets/js/bootstrap-maxlength.js') }}"></script>
    <script src="{{ asset('Backend/assets/js/inputmask.js') }}"></script>
    <script src="{{ asset('Backend/assets/js/select2.js') }}"></script>
    <script src="{{ asset('Backend/assets/js/typeahead.js') }}"></script>
    <script src="{{ asset('Backend/assets/js/tags-input.js') }}"></script>
    <script src="{{ asset('Backend/assets/js/dropzone.js') }}"></script>
    <script src="{{ asset('Backend/assets/js/dropify.js') }}"></script>
    <script src="{{ asset('Backend/assets/js/pickr.js') }}"></script>
    <script src="{{ asset('Backend/assets/js/flatpickr.js') }}"></script>
    <!-- End custom js for this page -->

</body>
</html>
