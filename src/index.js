import App from './App';
import {render} from '@wordpress/element';

/**
 * Import the stylesheet for thr plugin.
 */
import './style/main.scss';

// Render the App component in the div with id 'rankmath'.
render(<App />, document.getElementById('rankmath'));