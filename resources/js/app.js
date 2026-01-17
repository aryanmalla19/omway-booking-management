import './bootstrap';

import Alpine from 'alpinejs';
import ToasterUi from 'toaster-ui';

window.Alpine = Alpine;
window.toaster = new ToasterUi();

Alpine.start();
