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
        request: null
    };

    onInput = (statePath) => {
        return event => {
            let update = {};
            update[statePath] = event.target.value;
            this.setState(update);
        };
    }

    confirmPassword = event => {
        let isPasswordIdentique = event.target.value === this.state.password;
        this.setState({ 'confirmPassword': isPasswordIdentique });
    }

    onSubmit = async event => {
        event.preventDefault();
        this.setState({ loading: true })

        let args = {
            email: this.state.email,
            firstName: this.state.firstName,
            lastName: this.state.lastName,
            password: this.state.password,
        }

        const result = await UserClient.post(args);

        this.setState({ loading: false, request: JSON.stringify(result) })
    }

    render() {
        return (<form class="mb-6" onSubmit={this.onSubmit}>
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
                </div>

                <div class="form-group mb-5">
                    <input value={this.state.password} oninput={this.onInput('password')} type="password" class="form-control" id="password" placeholder="Enter your password" required/>
                    <br/>
                    <input oninput={this.confirmPassword} type="password" class="form-control" id="confirm-password" placeholder="Confirm your password" required/>
                    <div class="invalid-feedback">Must be the same than password</div>
                </div>

                <button class="btn btn-block btn-primary" type="submit">{this.state.loading ? 'loading...' : 'Sign up'}</button>
            </fieldset>
        </form>);
    }
};
