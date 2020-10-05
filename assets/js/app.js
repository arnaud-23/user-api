import 'bootstrap';
import bsCustomFileInput from 'bs-custom-file-input';
import { Component, Fragment, render } from 'preact';
import '../css/app.scss';
import NavBar from './modules/navigation/components/NavBar';

bsCustomFileInput.init();

class App extends Component {
    render() {
        return (<Fragment>
            <NavBar/>
            {/*<Router>*/}
            {/*<HomeScreen path={ROUTES.HOME}/>*/}
            {/*<LoginScreen path={ROUTES.AUTHENTICATION.LOGIN}/>*/}
            {/*<RegisterScreen path={ROUTES.AUTHENTICATION.REGISTER}/>*/}
            {/*<HelloWorld path={ROUTES.TEST.HELLO_WORLD}/>*/}
            {/*<Clock path={ROUTES.TEST.CLOCK}/>*/}
            {/*<Example path={ROUTES.TEST.EXAMPLE}/>*/}
            {/*</Router>*/}
            {/*<Footer/>*/}
        </Fragment>)
    }
}

render(<App/>, document.getElementById('app'));
