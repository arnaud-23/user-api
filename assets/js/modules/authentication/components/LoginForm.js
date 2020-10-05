export default function LoginForm() {
    return (<form style="display: block; width: 100%; max-width: 330px; padding: 15px; margin: auto;">
            <img class="mb-4" src="https://getbootstrap.com/docs/4.5/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72"/>
            <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>

            <label for="inputEmail" class="sr-only">Email address</label>
            <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus style="cursor: auto;"/>

            <label for="inputPassword" class="sr-only">Password</label>
            <input type="password" id="inputPassword" class="form-control" placeholder="Password" required style="margin-bottom: 10px;"/>
            <div class="mb-3">
                <label>
                    <input type="checkbox"/> Remember me
                </label>
            </div>
            {/*<label>*/}
            {/*    <input type="checkbox"/>*/}
            {/*    <span>I have read and I accept the Terms of Use and the Privacy Policy.</span>*/}
            {/*</label>*/}
            <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
        </form>);
};
