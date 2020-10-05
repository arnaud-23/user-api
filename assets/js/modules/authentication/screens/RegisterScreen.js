import { Component } from 'preact';
import RegisterForm from '../components/RegisterForm';

export default class RegisterScreen extends Component {
    render() {
        return (<div class="text-center">
                <RegisterForm/>
            </div>)
    };
}
