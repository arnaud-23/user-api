import '../css/theme.min.css';
import '../css/app.scss';
import { h } from 'preact';
import 'bootstrap';
import bsCustomFileInput from 'bs-custom-file-input';
import { Component, Fragment, render } from 'preact';
import Router from 'preact-router';
import LoginScreen from './modules/authentication/screens/LoginScreen';
import RegisterScreen from './modules/authentication/screens/RegisterScreen';
import Clock from './modules/clock/components/Clock';
import Example from './modules/example/components/Example';
import Footer from './modules/footer/components/Footer';
import HelloWorld from './modules/hello-world/components/HelloWorld';
import HomeScreen from './modules/home/screens/HomeScreen';
import NavBar from './modules/navigation/components/NavBar';
import { ROUTES } from './modules/routing';

bsCustomFileInput.init();

class App extends Component {
    render() {
        return (<Fragment>
            <NavBar/>
            <Router>
                <HomeScreen path={ROUTES.HOME}/>
                <LoginScreen path={ROUTES.AUTHENTICATION.LOGIN}/>
                <RegisterScreen path={ROUTES.AUTHENTICATION.REGISTER}/>
                <HelloWorld path={ROUTES.TEST.HELLO_WORLD}/>
                <Clock path={ROUTES.TEST.CLOCK}/>
                <Example path={ROUTES.TEST.EXAMPLE}/>
            </Router>
            <Footer/>
        </Fragment>)
    }
}

render(<App/>, document.getElementById('app'));
