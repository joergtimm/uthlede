import { startStimulusApp } from '@symfony/stimulus-bridge';
import { Autocomplete } from '@symfony/stimulus-bridge/lazy-controller-loader?lazy=true&export=Autocomplete!stimulus-autocomplete';
import Notification from "stimulus-notification"
import Lightbox from "stimulus-lightbox";



// Registers Stimulus controllers from controllers.json and in the controllers/ directory
export const app = startStimulusApp(require.context(
    '@symfony/stimulus-bridge/lazy-controller-loader!./controllers',
    true,
    /\.(j|t)sx?$/
));
app.register('autocomplete', Autocomplete);
app.register('notification', Notification);
app.register("lightbox", Lightbox);