import { h } from 'preact';

export default function RegisterForm() {
    return (<form class="mb-6">
        <div class="form-group">
            <label for="email">Email Address</label>
            <input type="email" class="form-control" id="email" placeholder="name@address.com"/>
        </div>

        <div class="form-group mb-5">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" placeholder="Enter your password" style="cursor: auto; background-size: 20px 20px !important; background-position: 98% 50% !important; background-repeat: no-repeat !important; background-image: url(&quot;chrome-extension://ehpbfbahieociaeckccnklpdcmfaeegd/Icon-20@2x.png&quot;) !important;"/>
        </div>

        <button class="btn btn-block btn-primary" type="submit">Sign up</button>
    </form>);
};
