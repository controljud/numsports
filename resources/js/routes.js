import App from './components/App.vue';
import Admin from './components/Admin.vue';
import Partidas from './components/admin/pages/Partidas.vue';

export default [
    {
        path: '/numsports/public',
        name: 'app',
        component: App,
        meta: {}
    },
    {
        path: '/numsports/public/admin',
        name: 'admin',
        component: Admin,
        meta: {}
    },
    {
        path: '/numsports/public/admin/partidas',
        name: 'partidas',
        component: Partidas,
        meta: {}
    }
]