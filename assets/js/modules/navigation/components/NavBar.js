import { h } from 'preact';
import logo from '../../../../img/brand.svg';
import { ROUTES } from '../hooks/routing'

export default function NavBar() {
    return (<nav class="navbar navbar-expand-lg navbar-light bg-white">
        <div class="container">
            <a class="navbar-brand" href={ROUTES.HOME}>
                <img src={logo} class="navbar-brand-img" alt="..."/>
            </a>

            <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarCollapse">
                <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fe fe-x"></i>
                </button>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item"><a class="nav-link" href="#">Landings</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Pages</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Account</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Documentation</a></li>
                </ul>

                <a class="navbar-btn btn btn-sm btn-secondary-soft lift ml-auto" href={ROUTES.AUTHENTICATION.LOGIN}>Sign in</a>
                <a class="navbar-btn btn btn-sm btn-primary lift" href={ROUTES.AUTHENTICATION.REGISTER}>Sign up</a>

            </div>

        </div>
    </nav>);
};
