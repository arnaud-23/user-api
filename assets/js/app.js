// import '../css/app.scss';
// import 'bootstrap';
// import bsCustomFileInput from 'bs-custom-file-input';
import { h } from 'preact';
import { Component, Fragment, render } from 'preact';
import Router from 'preact-router';
import LoginScreen from './modules/authentication/screens/LoginScreen';
import RegisterScreen from './modules/authentication/screens/RegisterScreen';
import ResetPasswordScreen from './modules/authentication/screens/ResetPasswordScreen';
import Error404 from './modules/errors/screens/Error404';
import Footer from './modules/footer/components/Footer';
import HomeScreen from './modules/home/screens/HomeScreen';
import NavBar from './modules/navigation/components/NavBar';
import { ROUTES } from './modules/routing';

// bsCustomFileInput.init();

class App extends Component {
    render() {
        return (<Fragment>
            <NavBar/>
            <Router>
                <Error404 path={ROUTES.ERRORS.ERROR404}/>
                <HomeScreen path={ROUTES.HOME}/>
                <LoginScreen path={ROUTES.AUTHENTICATION.LOGIN}/>
                <RegisterScreen path={ROUTES.AUTHENTICATION.REGISTER}/>
                <ResetPasswordScreen path={ROUTES.SECURITY.RESET_PASSWORD}/>
            </Router>
            <Footer/>
        </Fragment>)
    }
}

render(<App/>, document.getElementById('app'));
