import HttpClient from './HttpClient';

export default class OAuth2Client {
    static authorizeUrl = '/authorize';
    static tokenUrl = '/oauth2/token';

    // static authorize({
    //                      response_type,
    //                      client_id,
    //                      redirect_uri,
    //                      scope,
    //                      state,
    //                  }) {
    //     let parameters = {
    //         response_type: response_type,
    //         client_id: client_id,
    //         redirect_uri: redirect_uri,
    //         scope: scope,
    //         state: state,
    //     };
    //
    //     let queryStringParameters = '?' + parameters.join('&');
    //
    //     return HttpClient.get(this.authorizeUrl + queryStringParameters)
    // }

    static async token({
                           grant_type,
                           client_id,
                           client_secret,
                           redirect_uri,
                           scope,
                           code,
                       }) {
        let credentials = JSON.parse(localStorage.getItem(grant_type));

        if (null !== credentials && credentials.expiredAt > Date.now()) {
            return credentials;
        }

        let result = await HttpClient.POST(this.tokenUrl, {
            body: {
                grant_type: grant_type,
                client_id: client_id,
                client_secret: client_secret,
                redirect_uri: redirect_uri,
                scope: scope,
                code: code,
            }
        });

        credentials = {
            tokenType: result.token_type,
            accessToken: result.access_token,
            expiredAt: Date.now() + result.expires_in * 1000
        }

        localStorage.removeItem(grant_type);
        localStorage.setItem(grant_type, JSON.stringify(credentials));

        return JSON.parse(localStorage.getItem(grant_type));
    }
}
