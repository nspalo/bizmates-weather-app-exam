import './bootstrap';

import '../sass/app.scss';


import { sendMessage } from './weather-app.js'

window.sendMessage = sendMessage;
