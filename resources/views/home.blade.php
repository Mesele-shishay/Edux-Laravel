<x-app-layout>
    <x-links>
        <link href="{{ asset('css/home.css') }}" rel="stylesheet">
    </x-links>
    <body id="page-top">
         {{-- Navigation --}}
        <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
            <div class="container">
                <a class="navbar-brand" href="{{ url('home') }}">
                    <img src="{{ asset('favicon.png') }}" width="30px">
                    {{ config('app.name') }}
                </a>
                <button class="navbar-toggler"
                        type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#navbarResponsive">
                    Menu
                    <i class="fas fa-bars ms-1"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav text-uppercase ms-auto py-4 py-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('dashboard') }}">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#services">Services</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#about">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#team">Team</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#contact">Contact</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

         {{-- Masthead --}}
        <header class="masthead">
            <div class="container">
                <div class="masthead-subheading">Welcome To Our  App!</div>
                <div class="masthead-heading text-uppercase">It's Nice To Meet You</div>
                <a class="btn btn-primary btn-xl text-uppercase" href="{{ url('/') }}#services">Tell Me More</a>
            </div>
        </header>

         {{-- Services --}}
        <section class="page-section" id="services">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase">Services</h2>
                    <h3 class="section-subheading text-muted">A service that you'll love.</h3>
                </div>
                <div class="row text-center">
                    <div class="col-md-4">
                        <span class="fa-stack fa-4x">
                            <i class="fas fa-circle fa-stack-2x text-primary"></i>
                            <i class="fas fa-school fa-stack-1x fa-inverse"></i>
                        </span>
                        <h4 class="my-3">Dashboard</h4>
                        <p class="text-muted">
                            with our website, you can use our dashboard system to easily manage your and track all your schooling activity.
                        </p>
                    </div>
                    <div class="col-md-4">
                        <span class="fa-stack fa-4x">
                            <i class="fas fa-circle fa-stack-2x text-primary"></i>
                            <i class="fas fa-laptop fa-stack-1x fa-inverse"></i>
                        </span>
                        <h4 class="my-3">Responsive Design</h4>
                        <p class="text-muted">
                            Our website is developed using responsive device to support mobile device users.
                        </p>
                    </div>
                    <div class="col-md-4">
                        <span class="fa-stack fa-4x">
                            <i class="fas fa-circle fa-stack-2x text-primary"></i>
                            <i class="fas fa-lock fa-stack-1x fa-inverse"></i>
                        </span>
                        <h4 class="my-3">Web Security</h4>
                        <p class="text-muted">
                            Our web site is 99 % Secure.
                        </p>
                    </div>
                </div>
            </div>
        </section>

         {{-- About --}}
        <section class="page-section pt-2" id="about">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase">About</h2>
                    <h3 class="section-subheading text-muted">Who are we.</h3>
                </div>
                <ul class="timeline mb-0">
                    <li>
                        <div class="timeline-image">
                            <img class="rounded-circle img-fluid" src="{{ asset('img/about/1.jpg') }}" alt="..." />
                        </div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4>2013-2014 E.C</h4>
                                <h4 class="subheading">Our Humble Beginnings</h4>
                            </div>
                            <div class="timeline-body">
                                <p class="text-muted">
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                    tempor incididunt ut l.
                                </p>
                            </div>
                        </div>
                    </li>
                    <li class="timeline-inverted">
                        <div class="timeline-image">
                            <img class="rounded-circle img-fluid"
                                src="{{ asset('img/about/2.jpg') }}"  alt="..." />
                        </div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4>March 2014 E.C</h4>
                                <h4 class="subheading">An Agency is Born</h4>
                            </div>
                            <div class="timeline-body">
                                <p class="text-muted">
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit.  recusandae sit vero unde, sed, incidunt et ea quo dolore laudantium consectetur!
                                </p>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="timeline-image">
                            <img class="rounded-circle img-fluid" src="{{ asset('img/about/3.jpg') }}" alt="..." />
                        </div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4>December 2015 E.C</h4>
                                <h4 class="subheading">Transition to Full Service</h4>
                            </div>
                            <div class="timeline-body">
                                <p class="text-muted">
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt ut voluptatum eius sapiente, totam reiciendis temporibus qui quibusdam, recusandae sit vero unde, sed, incidunt et ea quo dolore laudantium consectetur!
                                </p>
                            </div>
                        </div>
                    </li>
                    <li class="timeline-inverted">
                        <div class="timeline-image bg-primary">
                            <h4>
                                Be Part
                                <br />
                                Of Our
                                <br />
                                Web App!
                            </h4>
                        </div>
                    </li>
                </ul>
            </div>
        </section>

         {{-- Team --}}
        <section class="page-section pt-2 bg-light" id="team">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase">Our Amazing Team</h2>
                    <h3 class="section-subheading text-muted">Our website is maintained by.</h3>
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="team-member">
                            <img class="mx-auto rounded-circle" src="{{ asset('img/team/1.jpg') }}" alt="..." />
                            <h4>Mesele Shishay</h4>
                            <p class="text-muted">
                                Lead Developer
                            </p>
                            <a class="btn btn-dark btn-social mx-2" href="#!">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a class="btn btn-dark btn-social mx-2" href="#!">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a class="btn btn-dark btn-social mx-2" href="#!">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="team-member">
                            <img class="mx-auto rounded-circle" src="{{ asset('img/team/1.jpg') }}" alt="..." />
                            <h4>Mesele Shishay</h4>
                            <p class="text-muted">Lead Marketer</p>
                            <a class="btn btn-dark btn-social mx-2" href="#!">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a class="btn btn-dark btn-social mx-2" href="#!">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a class="btn btn-dark btn-social mx-2" href="#!">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="team-member">
                            <img class="mx-auto rounded-circle" src="{{ asset('img/team/1.jpg') }}" alt="..." />
                            <h4>Mesele Shishay</h4>
                            <p class="text-muted">
                                Lead Designer
                            </p>
                            <a class="btn btn-dark btn-social mx-2" href="#!" aria-label="Larry Parker Twitter Profile">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a class="btn btn-dark btn-social mx-2" href="#!" aria-label="Larry Parker Facebook Profile">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a class="btn btn-dark btn-social mx-2" href="#!" aria-label="Larry Parker LinkedIn Profile">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 mx-auto text-center">
                        <p class="large text-muted">
                            You can follow and our developer using social link buttons.
                        </p>
                    </div>
                </div>
            </div>
        </section>

         {{-- Contact --}}
        <section class="page-section" id="contact">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase">Contact Us</h2>
                    <h3 class="section-subheading text-muted">We had like to hear your feedback.</h3>
                </div>
                <form id="contactForm" method="POST" action="{{ route('contact') }}">
                    @csrf
                    <div class="row align-items-stretch mb-5">
                        <div class="col-md-6">
                            <div class="form-group">
                                 {{-- Name input --}}
                                <input class="form-control"
                                        id="name"
                                        name="name"
                                        type="text"
                                        placeholder="Your Name *"
                                        required
                                        value="{{ old('name') }}" />

                                @error('name')
                                    <span class="error font-18 text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror

                            </div>
                            <div class="form-group">
                                 {{-- Email address input --}}
                                <input class="form-control"
                                        id="email"
                                        name="email"
                                        type="email"
                                        placeholder="Your Email *"
                                        required
                                        value="{{ old('email') }}"/>

                                @error('email')
                                    <span class="error font-18 text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-group-textarea mb-md-0">
                                 {{-- Comment input --}}
                                <textarea class="form-control"
                                            id="comment"
                                            name="comment"
                                            placeholder="Your Comment *"
                                            required
                                            >{{ old('comment') }}</textarea>

                                @error('comment')
                                    <span class="error font-18 text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror

                            </div>
                        </div>
                    </div>
                     {{-- Submit Button --}}
                    <div class="text-center">
                        <button class="btn btn-primary btn-xl text-uppercase"
                                id="contactBtn"
                                value="contactBtn"
                                type="submit">Send Message
                        </button>
                    </div>
                </form>
            </div>
        </section>
        <x-footer/>
    </body>
</x-app-layout>
