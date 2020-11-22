import HttpClient from './HttpClient';
import OAuth2Client from './OAuth2Client';

export default class UserClient {
    static apiKey = process.env.API_KEY;
    static apiSecret = process.env.API_SECRET;
    static endPoint = '/users';

    static async post({ email, firstName, lastName, password }) {
        let credentials = await this.getClientCredentials();

        const options = {
            headers: {
                'Authorization': credentials.tokenType + ' ' + credentials.accessToken
            },
            body: {
                'email': email,
                'firstName': firstName,
                'lastName': lastName,
                'password': password,
            }
        };

        let result = await HttpClient.POST(this.endPoint, options);
        console.log(result);
        // return result;
    }

    static getClientCredentials() {
        return OAuth2Client.token(
            {
                grant_type: 'client_credentials',
                client_id: this.apiKey,
                client_secret: this.apiSecret,
                scope: 'user_creation',
            }
        );
    }
}
