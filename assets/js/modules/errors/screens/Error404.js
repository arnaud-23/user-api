import { h, render, Component } from 'preact';
import Error404Illustration from '../../../../img/illustrations/illustration-1.png';
import { ROUTES } from '../hooks/routing';

export default class Error404 extends Component {
    render() {
        return (<section class="section-border border-primary">
            <div class="container d-flex flex-column">
                <div class="row align-items-center justify-content-center no-gutters min-vh-100">
                    <div class="col-8 col-md-6 col-lg-7 offset-md-1 order-md-2 mt-auto mt-md-0 pt-8 pb-4 py-md-11">
                        <img src={Error404Illustration} alt="..." class="img-fluid"/>
                    </div>
                    <div class="col-12 col-md-5 col-lg-4 order-md-1 mb-auto mb-md-0 pb-8 py-md-11">
                        <h1 class="display-3 font-weight-bold text-center">Uh Oh.</h1>
                        <p class="mb-5 text-center text-muted">
                            We ran into an issue, but don’t worry, we’ll take care of it for sure.
                        </p>
                        <div class="text-center">
                            <a class="btn btn-primary" href={ROUTES.HOME}>Back to safety</a>
                        </div>
                    </div>
                </div>
                {/*.row*/}
            </div>
            {/*.container*/}
        </section>);
    };
}
