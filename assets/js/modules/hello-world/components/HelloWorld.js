import { Component } from 'preact';

export default class HelloWorld extends Component {
    state = { value: '', name: 'toto' };

    onInput = ev => {
        this.setState({ value: ev.target.value });
    }

    onSubmit = ev => {
        ev.preventDefault();

        this.setState({ name: this.state.value });
    }

    render() {
        return <div>
            <h1>Hello, {this.state.name}!</h1>
            <form onSubmit={this.onSubmit}>
                <input type="text" value={this.state.value} onInput={this.onInput}/>
                <button type="submit">Update</button>
            </form>
        </div>
    };
}
