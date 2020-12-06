import { h, Component } from 'preact';
import UserClient from '../hooks/UserClient';

export default class RegisterForm extends Component {
    state = {
        firstName: null,
        lastName: null,
        email: null,
        password: null,
        confirmPassword: false,
        loading: false,
    };

    onInput = (statePath) => {
        return event => {
            let update = {};
            update[statePath] = event.target.value;
            this.setState(update);
        };
    }

    confirmPassword = event => {
        let isPasswordEqual = event.target.value === this.state.password;
        this.setState({ confirmPassword: isPasswordEqual });
    }

    onSubmit = async event => {
        event.preventDefault();
        this.setState({ loading: true })

        let fields = ['email', 'password', 'confirm-password'];

        fields.forEach(field => {
            document.getElementById(field).classList.remove('is-invalid')
            document.querySelector(`.${field}.invalid-feedback`).textContent = '';
        })

        if (!this.state.confirmPassword) {
            document.getElementById('confirm-password').classList.add('is-invalid')
            document.querySelector('.confirm-password.invalid-feedback').textContent = 'Passwords should not be different';
            this.setState({ loading: false })

            return;
        }

        let args = {
            email: this.state.email,
            firstName: this.state.firstName,
            lastName: this.state.lastName,
            password: this.state.password,
        }

        let result = await UserClient.post(args);

        if (result.hasOwnProperty('errors')) {
            result.errors.forEach(error => {
                document.getElementById(error.field).classList.add('is-invalid')
                document.querySelector(`.${error.field}.invalid-feedback`).textContent = error.message;
            });
        }

        this.setState({ loading: false })
    }

    render() {
        return (<form class="mb- needs-validation" onSubmit={this.onSubmit}>
            <fieldset disabled={this.state.loading}>
                <div class="form-group form-row">
                    <div class="col">
                        <input value={this.state.firstName} oninput={this.onInput('firstName')} type="text" class="form-control" placeholder="First name" autofocus required/>
                    </div>
                    <div class="col">
                        <input value={this.state.lastName} oninput={this.onInput('lastName')} type="text" class="form-control" placeholder="Last name" required/>
                    </div>
                </div>
                <div class="form-group">
                    <input value={this.state.email} oninput={this.onInput('email')} type="email" class="form-control" id="email" placeholder="name@address.com" required/>
                    <div class="email invalid-feedback"></div>
                </div>

                <div class="form-group mb-5">
                    <input value={this.state.password} oninput={this.onInput('password')} type="password" class="form-control" id="password" placeholder="Enter your password" required/>
                    <div class="password invalid-feedback"></div>
                    <br/>
                    <input oninput={this.confirmPassword} type="password" class="form-control" id="confirm-password" placeholder="Confirm your password" required/>
                    <div class="confirm-password invalid-feedback"></div>
                </div>

                <button class="btn btn-block btn-primary" type="submit">{this.state.loading ? 'loading...' : 'Sign up'}</button>
            </fieldset>
        </form>);
    }
};
