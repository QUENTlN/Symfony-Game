import { startStimulusApp } from '@symfony/stimulus-bridge';
const $ = require('jquery');
import Util from 'bootstrap/js/src/util'
import Modal from 'bootstrap/js/src/modal'
// Registers Stimulus controllers from controllers.json and in the controllers/ directory
export const app = startStimulusApp(require.context(
    '@symfony/stimulus-bridge/lazy-controller-loader!./controllers',
    true,
    /\.(j|t)sx?$/
));
