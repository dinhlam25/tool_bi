import './bootstrap';
import '../css/app.css';
import '@fortawesome/fontawesome-free/css/all.css';

import { createApp, h, DefineComponent } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';
import router from './router';

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: async (name) => {
        const pages = import.meta.glob<DefineComponent>('./Pages/**/*.vue');
        const match = Object.keys(pages).find(key => key.endsWith(`${name}.vue`));
        if (!match) {
            throw new Error(`Page not found: ${name}`);
        }
        return (await pages[match]()).default;
    },
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .use(router)
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});
