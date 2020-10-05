import { h, render, Component } from 'preact';
import ResetPasswordIllustration from '../../../../img/illustrations/illustration-4.png'
import { ROUTES } from '../hooks/routing';

export default class ResetPasswordScreen extends Component {
    render() {
        return (<section class="section-border border-primary">
            <div class="container d-flex flex-column">
                <div class="row align-items-center justify-content-center no-gutters min-vh-100">
                    <div class="col-8 col-md-6 col-lg-7 offset-md-1 order-md-2 mt-auto mt-md-0 pt-8 pb-4 py-md-11">
                        <img src={ResetPasswordIllustration} alt="..." class="img-fluid"/>
                    </div>
                    <div class="col-12 col-md-5 col-lg-4 order-md-1 mb-auto mb-md-0 pb-8 py-md-11">
                        <h1 class="mb-0 font-weight-bold text-center">Password reset</h1>
                        <p class="mb-6 text-center text-muted">Enter your email to reset your password.</p>

                        <form class="mb-6">
                            <div class="form-group">
                                <label for="email">Email Address</label>
                                <input type="email" class="form-control" id="email" placeholder="name@address.com" style="cursor: auto; background-size: 20px 20px !important; background-position: 98% 50% !important; background-repeat: no-repeat !important; background-image: url(&quot;chrome-extension://ehpbfbahieociaeckccnklpdcmfaeegd/Icon-20@2x.png&quot;) !important;"/>
                            </div>

                            <button class="btn btn-block btn-primary" type="submit">Reset Password</button>
                        </form>

                        <p class="mb-0 font-size-sm text-center text-muted">
                            Remember your password? <a href={ROUTES.AUTHENTICATION.LOGIN}>Log in</a>.
                        </p>

                    </div>
                </div>
                {/*.row*/}
            </div>
            {/*.container*/}
        </section>);
    };
}
