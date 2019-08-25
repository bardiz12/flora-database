<template>
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary sticky-top nav-nya">
    <b-container>
      <router-link class="navbar-brand" to="/"><i class="fa fa-database"></i> Database Flora</router-link>
      <button
        class="navbar-toggler"
        type="button"
        data-toggle="collapse"
        data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <b-navbar-nav class="ml-auto menu-samping">
          <b-nav-item v-bind:active="$route.path === '/'" to="/" right>
            <i class="fa fa-home"></i> Home
          </b-nav-item>
          <b-nav-item v-bind:active="$route.name === 'browse' || $route.name === 'browse_taxa' || $route.name === 'browse_flora'" to="/browse" right>
            <i class="fa fa-search"></i> Browse Data
          </b-nav-item>
          <b-nav-item v-bind:active="$route.name === 'search'" to="/search" right>
            <i class="fa fa-search"></i> Search
          </b-nav-item>
          <!--<b-nav-item v-bind:active="tab === 2" v-on:click="tab = 2" to="/about" right>About</b-nav-item>-->
        </b-navbar-nav>
      </div>
    </b-container>
  </nav>
</template>

<script>
export default {
  data: () => {
    return { tab: null };
  }
};
</script>

<style scoped>
.nav-nya {
  /*    border-bottom:1px solid #ddd;*/
  padding-top: 5px;
  padding-bottom: 5px;
}

.menu-samping li a.active {
  background-color: #fff;
  color: #000000 !important;
  border-radius: 10px;
}

.menu-samping li a {
  padding: 10px;
  font-size: 12pt;
}

.menu-samping {
  margin-top: 0px;
}
</style>

