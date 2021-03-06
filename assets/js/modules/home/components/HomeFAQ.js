import { h, Fragment } from 'preact';

export default function HomeFAQ() {
    return (<Fragment>
        <div class="position-relative mt-n15">
            <div class="shape shape-bottom shape-fluid-x svg-shim text-dark">
                <svg viewBox="0 0 2880 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0 48h2880V0h-720C1442.5 52 720 0 720 0H0v48z" fill="currentColor"></path>
                </svg>
            </div>
        </div>

        <section class="pt-15 bg-dark">
            <div class="container pt-8 pt-md-11">
                <div class="row">
                    <div class="col-12 col-md-6">

                        <div class="d-flex">

                            <div class="badge badge-lg badge-rounded-circle badge-success">
                                <span>?</span>
                            </div>

                            <div class="ml-5">

                                <h4 class="text-white">Can I use Landkit for my clients?</h4>

                                <p class="text-muted mb-6 mb-md-8">
                                    Absolutely. The Bootstrap Themes license allows you to build a website for personal use or for a client.
                                </p>

                            </div>

                        </div>

                        <div class="d-flex">

                            <div class="badge badge-lg badge-rounded-circle badge-success">
                                <span>?</span>
                            </div>

                            <div class="ml-5">

                                <h4 class="text-white">Do I get free updates?</h4>

                                <p class="text-muted mb-6 mb-md-0">
                                    Yes. We update all of our themes with each Bootstrap update, plus are constantly adding new components, pages, and features to our themes.
                                </p>

                            </div>

                        </div>

                    </div>
                    <div class="col-12 col-md-6">

                        <div class="d-flex">

                            <div class="badge badge-lg badge-rounded-circle badge-success">
                                <span>?</span>
                            </div>

                            <div class="ml-5">

                                <h4 class="text-white">Is there a money back guarantee?</h4>

                                <p class="text-muted mb-6 mb-md-8">
                                    Yup! Bootstrap Themes come with a satisfaction guarantee. Submit a return and get your money back.
                                </p>

                            </div>

                        </div>

                        <div class="d-flex">

                            <div class="badge badge-lg badge-rounded-circle badge-success">
                                <span>?</span>
                            </div>

                            <div class="ml-5">

                                <h4 class="text-white">Does it work with Rails? React? Laravel?</h4>

                                <p class="text-muted mb-6 mb-md-0">
                                    Yes. Landkit has basic CSS/JS files you can include. If you want to enable deeper customization, you can integrate it into your assets pipeline or build processes.
                                </p>

                            </div>

                        </div>

                    </div>
                </div>
                {/*.row*/}
            </div>
            {/*.container*/}
        </section>
    </Fragment>);
};
