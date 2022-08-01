import App from './components/App.vue';
import Admin from './components/Admin.vue';
import DashBoard from './components/admin/Dashboard.vue';
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
        path: '/admin/dashboard',
        name: 'admin.dashboard',
        component: DashBoard,
        meta: {}
    },
    {
        path: '/admin/partidas',
        name: 'admin.partidas',
        component: Partidas,
        meta: {}
    },
    {
        path: '/admin/times',
        name: 'admin.times',
        component: Times,
        meta: {}
    }
]
