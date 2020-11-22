export default class HttpClient {
    static baseUri = process.env.API_ENDPOINT;
    static headers = { 'Content-Type': 'application/json' };

    static async request(method, path, options = { headers: '', body: '' }) {
        const url = this.baseUri + path;
        const requestOptions = {
            method: method,
            body: JSON.stringify(options.body),
            headers: { ...this.headers, ...options.headers },
        }

        console.log(url);
        console.log(requestOptions);

        let promise = await fetch(url, requestOptions)
        return promise.json();
    }

    static async DELETE(path, data) {
        return this.request('DELETE', path, data);
    }

    static async GET(path, options = {}) {
        return this.request('GET', path, options);
    }

    static async PATCH(path, data) {
        return this.request('PATCH', path, data);
    }

    static async POST(path, data) {
        return this.request('POST', path, data);
    }
}
