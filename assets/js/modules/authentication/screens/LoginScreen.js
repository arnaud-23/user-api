import { h, Component } from 'preact';
import LoginForm from '../components/LoginForm';

export default class LoginScreen extends Component {
    render() {
        return (<div class="text-center">
                <LoginForm/>
            </div>)
    };
}
