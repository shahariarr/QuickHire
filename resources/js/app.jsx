import './bootstrap';
import React from 'react';
import { createRoot } from 'react-dom/client';
import { createInertiaApp } from '@inertiajs/react';
import { router } from '@inertiajs/react';

// NProgress for the slim loading bar at the very top
import NProgress from 'nprogress';
import 'nprogress/nprogress.css';

NProgress.configure({ showSpinner: false, speed: 400, minimum: 0.08 });

router.on('start',  () => NProgress.start());
router.on('finish', () => NProgress.done());

createInertiaApp({
    // Resolve page components from Pages/ directory
    resolve: name => {
        const pages = import.meta.glob('./Pages/**/*.jsx', { eager: true });
        const page  = pages[`./Pages/${name}.jsx`];
        if (!page) throw new Error(`Inertia page not found: ./Pages/${name}.jsx`);
        return page;
    },

    // Title on each page
    title: title => title ? `${title} – QuickHire` : 'QuickHire',

    setup({ el, App, props }) {
        createRoot(el).render(<App {...props} />);
    },
});
