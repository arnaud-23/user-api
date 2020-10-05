import { h } from 'preact';
import { Link } from 'preact-router';
import { ROUTES } from '../hooks/routing'
import logo from '../../../../img/brand.svg';

export default function NavBar() {
    return (<nav class="navbar navbar-expand-lg navbar-light bg-white">
        <div class="container">

            <a class="navbar-brand" href={ROUTES.HOME}>
                <img src={logo} class="navbar-brand-img" alt="..."/>
            </a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarCollapse">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fe fe-x"></i>
                </button>

                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarLandings" data-toggle="dropdown" href="#" aria-haspopup="true" aria-expanded="false">Landings</a>

                        <div class="dropdown-menu dropdown-menu-xl p-0" aria-labelledby="navbarLandings">
                            <div class="row no-gutters">
                                <div class="col-12 col-lg-6">
                                    <div class="dropdown-img-left" style="background-image: url(./assets/img/photos/photo-3.jpg);">
                                        <h4 class="font-weight-bold text-white mb-0">Want to see an overview?</h4>

                                        <p class="font-size-sm text-white">See all the pages at once.</p>

                                        <a href="./overview.html" class="btn btn-sm btn-white shadow-dark fonFt-size-sm">View all pages</a>

                                    </div>
                                </div>

                                <div class="col-12 col-lg-6">
                                    <div class="dropdown-body">
                                        <div class="row no-gutters">
                                            <div class="col-6">

                                                <h6 class="dropdown-header">Services</h6>
                                                <a class="dropdown-item" href="./coworking.html">Coworking</a>
                                                <a class="dropdown-item" href="./rental.html">Rental</a>
                                                <a class="dropdown-item mb-5" href="./job.html">Job Listing</a>

                                                <h6 class="dropdown-header">Apps</h6>
                                                <a class="dropdown-item" href="./desktop-app.html">Desktop</a>
                                                <a class="dropdown-item" href="./mobile-app.html">Mobile</a>
                                            </div>

                                            <div class="col-6">
                                                <h6 class="dropdown-header">Web</h6>
                                                <a class="dropdown-item" href="./index.html">Basic</a>
                                                <a class="dropdown-item" href="./startup.html">Startup</a>
                                                <a class="dropdown-item" href="./enterprise.html">Enterprise</a>
                                                <a class="dropdown-item" href="./service.html">Service</a>
                                                <a class="dropdown-item" href="./cloud.html">Cloud Hosting</a>
                                                <a class="dropdown-item" href="./agency.html">Agency</a>
                                            </div>
                                        </div>
                                        {/*.row*/}

                                    </div>
                                </div>
                            </div>
                            {/*.row*/}

                        </div>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarPages" data-toggle="dropdown" href="#" aria-haspopup="true" aria-expanded="false">Pages</a>
                        <div class="dropdown-menu dropdown-menu-lg" aria-labelledby="navbarPages">
                            <div class="row no-gutters">
                                <div class="col-6">
                                    <div class="row no-gutters">
                                        <div class="col-12 col-lg-6">
                                            <h6 class="dropdown-header">Career</h6>
                                            <a class="dropdown-item" href="./careers.html">Listing</a>
                                            <a class="dropdown-item mb-5" href="./career-single.html">Opening</a>

                                            <h6 class="dropdown-header">Company</h6>
                                            <a class="dropdown-item" href="./about.html">About</a>
                                            <a class="dropdown-item" href="./pricing.html">Pricing</a>
                                            <a class="dropdown-item mb-5 mb-lg-0" href="./terms-of-service.html">Terms</a>
                                        </div>

                                        <div class="col-12 col-lg-6">
                                            <h6 class="dropdown-header">Help center</h6>
                                            <a class="dropdown-item" href="./help-center.html">Overview</a>
                                            <a class="dropdown-item mb-5" href="./help-center-article.html">Article</a>

                                            <h6 class="dropdown-header">Contact</h6>
                                            <a class="dropdown-item" href="./contact.html">Basic</a>
                                            <a class="dropdown-item" href="./contact-alt.html">Cover</a>
                                        </div>
                                    </div>
                                    {/*.row*/}
                                </div>

                                <div class="col-6">
                                    <div class="row no-gutters">

                                        <div class="col-12 col-lg-6">
                                            <h6 class="dropdown-header">Blog</h6>
                                            <a class="dropdown-item" href="./blog.html">Rich View</a>
                                            <a class="dropdown-item" href="./blog-post.html">Article</a>
                                            <a class="dropdown-item" href="./blog-showcase.html">Showcase</a>
                                            <a class="dropdown-item mb-5 mb-lg-0" href="./blog-search.html">Search</a>
                                        </div>

                                        <div class="col-12 col-lg-6">
                                            <h6 class="dropdown-header">Portfolio</h6>
                                            <a class="dropdown-item" href="./portfolio-masonry.html">Masonry</a>
                                            <a class="dropdown-item" href="./portfolio-grid-rows.html">Grid Rows</a>
                                            <a class="dropdown-item" href="./portfolio-parallax.html">Parallax</a>
                                            <a class="dropdown-item" href="./portfolio-case-study.html">Case Study</a>
                                            <a class="dropdown-item" href="./portfolio-sidebar.html">Sidebar</a>
                                            <a class="dropdown-item" href="./portfolio-sidebar-fluid.html">Sidebar: Fluid</a>
                                            <a class="dropdown-item" href="./portfolio-grid.html">Basic Grid</a>
                                        </div>

                                    </div>
                                    {/*.row*/}
                                </div>
                            </div>
                            {/*.row*/}
                        </div>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarAccount" data-toggle="dropdown" href="#" aria-haspopup="true" aria-expanded="false">Account</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarAccount">

                            <li class="dropdown-item dropright">
                                <a class="dropdown-link dropdown-toggle" data-toggle="dropdown" href="#">Settings</a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="./account-general.html">General</a>
                                    <a class="dropdown-item" href="./account-security.html">Security</a>
                                    <a class="dropdown-item" href="./account-notifications.html">Notifications</a>
                                    <a class="dropdown-item" href="./billing-plans-and-payment.html">Plans &amp; Payment</a>
                                    <a class="dropdown-item" href="./billing-users.html">Users</a>
                                </div>
                            </li>

                            <li class="dropdown-item dropright">
                                <a class="dropdown-link dropdown-toggle" data-toggle="dropdown" href="#">Sign In</a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="./signin-cover.html">Side Cover</a>
                                    <a class="dropdown-item" href="./signin-illustration.html">Illustration</a>
                                    <a class="dropdown-item" href="./signin.html">Basic</a>
                                    <a class="dropdown-item" data-toggle="modal" href="#modalSigninHorizontal">Modal Horizontal</a>
                                    <a class="dropdown-item" data-toggle="modal" href="#modalSigninVertical">Modal Vertical</a>
                                </div>
                            </li>

                            <li class="dropdown-item dropright">
                                <a class="dropdown-link dropdown-toggle" data-toggle="dropdown" href="#">Sign Up</a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="./signup-cover.html">Side Cover</a>
                                    <a class="dropdown-item" href="./signup-illustration.html">Illustration</a>
                                    <a class="dropdown-item" href="./signup.html">Basic</a>
                                    <a class="dropdown-item" data-toggle="modal" href="#modalSignupHorizontal">Modal Horizontal</a>
                                    <a class="dropdown-item" data-toggle="modal" href="#modalSignupVertical">Modal Vertical</a>
                                </div>
                            </li>

                            <li class="dropdown-item dropright">
                                <a class="dropdown-link dropdown-toggle" data-toggle="dropdown" href="#">Password Reset</a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="./password-reset-cover.html">Side Cover</a>
                                    <a class="dropdown-item" href="./password-reset-illustration.html">Illustration</a>
                                    <a class="dropdown-item" href="./password-reset.html">Basic</a>
                                </div>
                            </li>

                            <li class="dropdown-item dropright">
                                <a class="dropdown-link dropdown-toggle" data-toggle="dropdown" href="#">Error</a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="./error-cover.html">Side Cover</a>
                                    <a class="dropdown-item" href="./error-illustration.html">Illustration</a>
                                    <a class="dropdown-item" href="./error.html">Basic</a>
                                </div>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarDocumentation" data-toggle="dropdown" href="#" aria-haspopup="true" aria-expanded="false">Documentation</a>

                        <div class="dropdown-menu dropdown-menu-md" aria-labelledby="navbarDocumentation">
                            <div class="list-group list-group-flush">

                                <a class="list-group-item" href="./docs/index.html">
                                    <div class="icon icon-sm text-primary">
                                        <svg width="24" height="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <g fill="none" fill-rule="evenodd">
                                                <path d="M0 0h24v24H0z"></path>
                                                <path d="M8 3v.5A1.5 1.5 0 009.5 5h5A1.5 1.5 0 0016 3.5V3h2a2 2 0 012 2v16a2 2 0 01-2 2H6a2 2 0 01-2-2V5a2 2 0 012-2h2z" fill="#335EEA" opacity=".3"></path>
                                                <path d="M11 2a1 1 0 012 0h1.5a.5.5 0 01.5.5v1a.5.5 0 01-.5.5h-5a.5.5 0 01-.5-.5v-1a.5.5 0 01.5-.5H11z" fill="#335EEA"></path>
                                                <rect fill="#335EEA" opacity=".3" x="7" y="10" width="5" height="2" rx="1"></rect>
                                                <rect fill="#335EEA" opacity=".3" x="7" y="14" width="9" height="2" rx="1"></rect>
                                            </g>
                                        </svg>
                                    </div>

                                    <div class="ml-4">
                                        <h6 class="font-weight-bold text-uppercase text-primary mb-0">Documentation</h6>
                                        <p class="font-size-sm text-gray-700 mb-0">Customizing and building</p>
                                    </div>
                                </a>

                                <a class="list-group-item" href="./docs/alerts.html">
                                    <div class="icon icon-sm text-primary">
                                        <svg width="24" height="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <g fill="none" fill-rule="evenodd">
                                                <path d="M0 0h24v24H0z"></path>
                                                <rect fill="#335EEA" x="4" y="4" width="7" height="7" rx="1.5"></rect>
                                                <path d="M5.5 13h4a1.5 1.5 0 011.5 1.5v4A1.5 1.5 0 019.5 20h-4A1.5 1.5 0 014 18.5v-4A1.5 1.5 0 015.5 13zm9-9h4A1.5 1.5 0 0120 5.5v4a1.5 1.5 0 01-1.5 1.5h-4A1.5 1.5 0 0113 9.5v-4A1.5 1.5 0 0114.5 4zm0 9h4a1.5 1.5 0 011.5 1.5v4a1.5 1.5 0 01-1.5 1.5h-4a1.5 1.5 0 01-1.5-1.5v-4a1.5 1.5 0 011.5-1.5z" fill="#335EEA" opacity=".3"></path>
                                            </g>
                                        </svg>
                                    </div>

                                    <div class="ml-4">
                                        <h6 class="font-weight-bold text-uppercase text-primary mb-0">Components</h6>
                                        <p class="font-size-sm text-gray-700 mb-0">Full list of components</p>
                                    </div>
                                </a>

                                <a class="list-group-item" href="./docs/changelog.html">
                                    <div class="icon icon-sm text-primary">
                                        <svg width="24" height="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <g fill="none" fill-rule="evenodd">
                                                <path d="M0 0h24v24H0z"></path>
                                                <path d="M5.857 2h7.88a1.5 1.5 0 01.968.355l4.764 4.029A1.5 1.5 0 0120 7.529v12.554c0 1.79-.02 1.917-1.857 1.917H5.857C4.02 22 4 21.874 4 20.083V3.917C4 2.127 4.02 2 5.857 2z" fill="#335EEA" opacity=".3"></path>
                                                <rect fill="#335EEA" x="6" y="11" width="9" height="2" rx="1"></rect>
                                                <rect fill="#335EEA" x="6" y="15" width="5" height="2" rx="1"></rect>
                                            </g>
                                        </svg>
                                    </div>

                                    <div class="ml-4">
                                        <h6 class="font-weight-bold text-uppercase text-primary mb-0">Changelog</h6>
                                        <p class="font-size-sm text-gray-700 mb-0">Keep track of changes</p>
                                    </div>

                                    <span class="badge badge-pill badge-primary-soft ml-auto">1.2.1</span>
                                </a>
                            </div>
                        </div>
                    </li>
                </ul>

                <a class="navbar-btn btn btn-sm btn-primary lift ml-auto" href={ROUTES.AUTHENTICATION.LOGIN}>Sign in</a>

            </div>

        </div>
    </nav>);
};
