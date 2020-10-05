import { h, Component } from 'preact';
import LoginForm from '../components/LoginForm';
import WelcomeIllustration from '../../../../img/illustrations/illustration-2.png'
import { ROUTES } from '../hooks/routing';

export default class LoginScreen extends Component {
    render() {
        return (<section class="section-border border-primary">
            <div class="container d-flex flex-column">
                <div class="row align-items-center justify-content-center no-gutters min-vh-100">
                    <div class="col-8 col-md-6 col-lg-7 offset-md-1 order-md-2 mt-auto mt-md-0 pt-8 pb-4 py-md-11">
                        <img src={WelcomeIllustration} alt="..." class="img-fluid"/>
                    </div>
                    <div class="col-12 col-md-5 col-lg-4 order-md-1 mb-auto mb-md-0 pb-8 py-md-11">
                        <h1 class="mb-0 font-weight-bold text-center">Sign in</h1>

                        <p class="mb-6 text-center text-muted">Simplify your workflow in minutes.</p>

                        <LoginForm/>

                        <p class="mb-0 font-size-sm text-center text-muted">
                            Don't have an account yet? <a href={ROUTES.AUTHENTICATION.REGISTER}>Sign up</a>.
                        </p>

                    </div>
                </div>
                {/*.row*/}
            </div>
            {/*.container*/}
        </section>);
    };
}
