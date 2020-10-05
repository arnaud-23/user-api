import { h, Fragment, Component } from 'preact';
import HomeAbout from '../components/HomeAbout';
import HomeBrands from '../components/HomeBrands';
import HomeCTA from '../components/HomeCTA';
import HomeFAQ from '../components/HomeFAQ';
import HomeFeatures from '../components/HomeFeatures';
import HomeFocus from '../components/HomeFocus';
import HomePricing from '../components/HomePricing';
import HomeWelcome from '../components/HomeWelcome';

export default class HomeScreen extends Component {
    render() {
        return (<Fragment>
            <HomeWelcome/>
            <HomeFeatures/>
            <HomeBrands/>
            <HomeAbout/>
            <HomeFocus/>
            <HomePricing/>
            <HomeFAQ/>
            <HomeCTA/>
        </Fragment>);
    };
}
