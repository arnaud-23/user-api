import { Fragment, h } from 'preact';

export default function HomeCTA() {
    return (<Fragment>
        <section class="py-8 py-md-11 bg-dark">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-md-10 col-lg-8 text-center">

                <span class="badge badge-pill badge-gray-700-soft mb-4">
                  <span class="h6 font-weight-bold text-uppercase">Get started</span>
                </span>

                        <h1 class="display-4 text-white">Get Landkit and save your time.</h1>

                        <p class="font-size-lg text-muted mb-6 mb-md-8">
                            Stop wasting time trying to do it the "right way" and build a site from scratch. Landkit is faster, easier, and you still have complete control.
                        </p>

                        <a href="https://themes.getbootstrap.com/product/landkit/" target="_blank" class="btn btn-success lift">
                            Buy it now <i class="fe fe-arrow-right"></i>
                        </a>

                    </div>
                </div>
                {/*.row*/}
            </div>
            {/*.container*/}
        </section>

        <div class="position-relative">
            <div class="shape shape-bottom shape-fluid-x svg-shim text-gray-200">
                <svg viewBox="0 0 2880 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0 48h2880V0h-720C1442.5 52 720 0 720 0H0v48z" fill="currentColor"></path>
                </svg>
            </div>
        </div>
    </Fragment>);
};
