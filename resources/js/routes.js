import App from './components/App.vue';
import Admin from './components/Admin.vue';

export default [
    {
        path: '/',
        name: 'app',
        component: App,
        meta: {}
    },
    {
        path: '/admin',
        name: 'admin',
        component: Admin,
        meta: {}
    }
]