export default function RegisterForm() {
    return (<form style="display: block; width: 100%; max-width: 330px; padding: 15px; margin: auto;">
            <img class="mb-4" src="https://getbootstrap.com/docs/4.5/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72"/>
            <h1 class="h3 mb-3 font-weight-normal">Get started</h1>

            <label for="inputFirstName" class="sr-only">First name</label>
            <input type="text" id="inputFirstName" class="form-control" placeholder="Enter your first name" required autofocus style="cursor: auto;"/>

            <label for="inputEmail" class="sr-only">Email address</label>
            <input type="email" id="inputEmail" class="form-control" placeholder="Enter your email address" required/>

            <label for="inputPassword" class="sr-only">Password</label>
            <input type="password" id="inputPassword" class="form-control" placeholder="Enter your password" required style="margin-bottom: 10px;"/>
            <div class="mb-3">
                <label>
                    <input type="checkbox"/> I have read and I accept the Terms of Use and the Privacy Policy.
                </label>
            </div>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
        </form>);
};
