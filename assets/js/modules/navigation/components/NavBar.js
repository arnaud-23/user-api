import { Link } from 'preact-router';
import { ROUTES } from '../hooks/routing'

export default function NavBar() {
    return (<header class="sticky-top">
        <nav className="navbar navbar-expand-lg navbar-dark bg-dark">
            <Link className="navbar-brand" href="/">GetUsers</Link>

            <div className="collapse navbar-collapse" id="navbarSupportedContent">
                <ul className="navbar-nav mr-auto">
                    <li className="nav-item active">
                        <Link className="nav-link" href={ROUTES.TEST.HELLO_WORLD}>Hello World <span className="sr-only">(current)</span></Link>
                    </li>
                    <li className="nav-item">
                        <Link className="nav-link" href={ROUTES.TEST.CLOCK}>Clock</Link>
                    </li>
                    <li className="nav-item">
                        <Link className="nav-link" href={ROUTES.TEST.EXAMPLE}>Toto</Link>
                    </li>
                </ul>

                <Link className="btn btn-outline-secondary my-2 my-sm-0" href={ROUTES.AUTHENTICATION.LOGIN} role="button">Sign in</Link>
                <Link className="btn btn-outline-success my-2 my-sm-0" href={ROUTES.AUTHENTICATION.REGISTER} role="button">Sign up</Link>
            </div>
        </nav>
    </header>);
};
