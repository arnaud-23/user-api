import { h } from 'preact';

export default function HomePricing() {
    return (<section class="pt-9 pt-md-12 bg-gray-200">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-10 col-lg-8 text-center">

                    <h1>Fair, simple pricing for all.</h1>

                    <p class="lead text-gray-700">
                        All types of businesses need access to development resources, so we give you the option to decide how much you need to use.
                    </p>

                    <form class="d-flex align-items-center justify-content-center mb-7 mb-md-9">
                        <span class="text-muted">Annual</span>
                        <div class="custom-control custom-switch mx-3">
                            <input type="checkbox" class="custom-control-input" id="billingSwitch" data-toggle="price" data-target=".price"/>
                            <label class="custom-control-label" for="billingSwitch"></label>
                        </div>
                        <span class="text-muted">Monthly</span>
                    </form>

                </div>
            </div>
            {/*.row*/}
            <div class="row align-items-center no-gutters">
                <div class="col-12 col-md-6">

                    <div class="card rounded-lg shadow-lg mb-6 mb-md-0 aos-init aos-animate" style="z-index: 1;" data-aos="fade-up">

                        <div class="card-body py-6 py-md-8">
                            <div class="row justify-content-center">
                                <div class="col-12 col-xl-9">

                                    <div class="text-center mb-5">
                                        <span class="badge badge-pill badge-primary-soft">
                                        <span class="h6 font-weight-bold text-uppercase">Standard</span>
                                        </span>
                                    </div>

                                    <div class="d-flex justify-content-center">
                                        <span class="h2 mb-0 mt-2">$</span>
                                        <span class="price display-2 mb-0" data-annual="29" data-monthly="49">29</span>
                                        <span class="h2 align-self-end mb-1">/mo</span>
                                    </div>

                                    <p class="text-center text-muted mb-6 mb-md-8">per seat</p>

                                    <div class="d-flex">

                                        <div class="badge badge-rounded-circle badge-success-soft mt-1 mr-4">
                                            <i class="fe fe-check"></i>
                                        </div>

                                        <p>Rich, responsive landing pages</p>

                                    </div>
                                    <div class="d-flex">

                                        <div class="badge badge-rounded-circle badge-success-soft mt-1 mr-4">
                                            <i class="fe fe-check"></i>
                                        </div>

                                        <p>100+ styled components</p>

                                    </div>
                                    <div class="d-flex">

                                        <div class="badge badge-rounded-circle badge-success-soft mt-1 mr-4">
                                            <i class="fe fe-check"></i>
                                        </div>

                                        <p>Flexible, simple license</p>

                                    </div>
                                    <div class="d-flex">

                                        <div class="badge badge-rounded-circle badge-success-soft mt-1 mr-4">
                                            <i class="fe fe-check"></i>
                                        </div>

                                        <p>Speedy build tooling</p>

                                    </div>
                                    <div class="d-flex">

                                        <div class="badge badge-rounded-circle badge-success-soft mt-1 mr-4">
                                            <i class="fe fe-check"></i>
                                        </div>

                                        <p class="mb-0">6 months free support included</p>

                                    </div>

                                </div>
                            </div>
                            {/*.row*/}
                        </div>

                        <a href="#!" class="card-btn btn btn-block btn-lg btn-primary">
                            Get it now
                        </a>

                    </div>

                </div>
                <div class="col-12 col-md-6 ml-md-n3">

                    <div class="card rounded-lg shadow-lg aos-init aos-animate" data-aos="fade-up" data-aos-delay="200">

                        <div class="card-body py-6 py-md-8">
                            <div class="row justify-content-center">
                                <div class="col-12 col-xl-10">

                                    <p class="text-center mb-8 mb-md-11">
                                        <span class="badge badge-pill badge-primary-soft">
                                        <span class="h6 font-weight-bold text-uppercase">Enterprise</span>
                                        </span>
                                    </p>

                                    <p class="lead text-center text-muted mb-0 mb-md-10">
                                        We offer variable pricing with discounts for larger organizations. Get in touch with us and we’ll figure out something that works for everyone.
                                    </p>

                                </div>
                            </div>
                            {/*.row*/}
                        </div>

                        <a href="#!" class="card-btn btn btn-block btn-lg btn-light bg-gray-300 text-gray-700">
                            Contact us
                        </a>

                    </div>

                </div>
            </div>
            {/*.row*/}
        </div>
        {/*.container*/}
    </section>);
};
