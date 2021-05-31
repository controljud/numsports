import App from './components/App.vue';
import Admin from './components/Admin.vue';
import Partidas from './components/admin/pages/Partidas/Partidas.vue';
import Times from './components/admin/pages/Times/Index.vue';

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
    },
    {
        path: '/admin/partidas',
        name: 'partidas',
        component: Partidas,
        meta: {}
    },
    {
        path: '/admin/times',
        name: 'times',
        component: Times,
        meta: {}
    }
]