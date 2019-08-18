<template>
    <div>
        
        <div class="pembatas"></div>
        <Navbar/>
        <main role="main" class="content-nya">
            <router-view :key="($route.fullPath.split('#')[0])"></router-view>
        </main>
        <lg-preview></lg-preview>
        <Footer />
    </div>
    <!-- <v-app>
        <v-navigation-drawer app></v-navigation-drawer>
        <v-toolbar app></v-toolbar>
        <v-content>
            <v-container fluid>
                <router-link tag='li' to='/'>Home</router-link>
                <router-link tag='li' to='/about'>About</router-link>
            <router-view></router-view>
            </v-container>
        </v-content>
        <v-footer app></v-footer>
    </v-app>-->

</template>

<script>

</script>

<style>
.content-nya{
    flex: 1 0 auto;
    min-height: 700px;
}
</style>



