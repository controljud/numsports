<template>
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <span class="brand-text font-weight-light">Numsports</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <!-- <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image"> -->
        </div>
        <div class="info">
          <a href="#" class="d-block">Isaias Lima dos Santos</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <router-link :to="{name: 'partidas'}" class="nav-link" exact>
              <i class="nav-icon fas fa-th"></i>
              Partidas
            </router-link>
          </li>
          <li class="nav-item">
            <router-link :to="{name: 'times'}" class="nav-link" exact>
              <i class="nav-icon fas fa-flag"></i>
              Times
            </router-link>
          </li>
          <li class="nav-item">
            <a href="pages/widgets.html" class="nav-link">
              <i class="nav-icon fas fa-trophy"></i>
              <p>Campeonatos</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="pages/widgets.html" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>Usuários</p>
            </a>
          </li>
        </ul>
      </nav>
    </div>
  </aside>
</template>

<script>
    export default {
        props: [
            'userName'
        ],

        data() {
            return {
                app_url: process.env.APP_URL
            }
        },

        created() {
            console.log(this.app_url);
        }
    }
</script>