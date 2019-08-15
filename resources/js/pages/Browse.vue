<template>
  <b-container>
    <div class="mt-1"></div>
    <div class="d-flex justify-content-start">
      <h2 class="display-4">Families</h2>
      
    </div>
    <Breadcrumb :items="['Families']"></Breadcrumb>
    <div>
      Alphabet :
      <span v-for="result in results" v-bind:key="result.alphabet">
        <span v-for="item in result" class="text-uppercase p-1" v-bind:key="item.id">
          <a :href="'#'+item.alphabet">{{ item.alphabet }}</a>
        </span>
      </span>
      <span class="p-1">
        <a href="#" @click="readData">[Refresh]</a>
      </span>
    </div>
    <hr />
    <b-row v-if="results == false">
        <b-col class="text-center">
          <h1 class="display-3"><i class="fa fa-spinner fa-spin d-block"></i>
            Loading
              
          </h1>
          <h3 class="display-5">Try Refreshing this page if it takes time too long.</h3>
        </b-col>
    </b-row>
    <b-row v-else-if="results !== null">
      <b-col md="4" sm="6" v-for="result in results" v-bind:key="result.alphabet">
        <div v-for="alpha in result" v-bind:key="alpha.id">
          <div v-bind:id="alpha.alphabet">
            <h2 class="display-5 text-uppercase">{{alpha.alphabet}}</h2>
            <ul class="pl-4 list-anu">
              <li v-for="item in alpha.data" v-bind:key="item.id">
                <router-link :to="'/browse/' + item.name">{{ item.name }}</router-link>
              </li>
            </ul>
          </div>
        </div>
      </b-col>
    </b-row>
    
    <b-row v-else>
        <b-col>
          <h1 class="display-3">Data Unavailable</h1>
          <h3 class="display-5">Try Refreshing this page.</h3>
        </b-col>
    </b-row>
  </b-container>
</template>



<script>
import { clearInterval } from 'timers';
const url = window.api_url + "/families";
export default {
  data: () => {
    return {
      results: false,
      last: Math.floor(Date.now() / 1000),
      titiks:['.'],
      anu : null
    };
  },
  methods: {
      readData(){
          console.log(this.results);
          axios.get(url).then(response => {
            
            this.results = response.data.is_ok ? response.data.result : null;
        });
      }
  },
  mounted() {
    //this.$swal('Hello Vue world!!!');
    this.readData();
    
  }
};
</script>
