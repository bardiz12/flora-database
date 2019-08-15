<template>
  <b-container style="min-height:1vh">
    <div class="mt-1"></div>
    <div class="d-flex justify-content-start">
      <h2 class="display-4">{{$route.params.name}}</h2>
    </div>
    <Breadcrumb
      :items="[{text:'Families',to:{name:'browse'}},{text:$route.params.name,active:true}]"
    ></Breadcrumb>
    <div>
      Alphabet :
      <span v-for="result in results" v-bind:key="result.id">
        <span v-if="result.data !== null">
          <span v-for="item in result.data" class="text-uppercase p-1" v-bind:key="item.id">
            <a :href="'#'+item.alphabet">{{ item.alphabet }}</a>
          </span>
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
      <b-col v-for="result in results" v-bind:key="result.id">
        <div v-if="result.data !== null">
          <div v-for="alpha in result.data" v-bind:key="alpha.id">
            <div v-bind:id="alpha.alphabet">
              <h2 class="display-5 text-uppercase">{{alpha.alphabet}}</h2>
              <ul class="pl-4 list-anu">
                <li v-for="item in alpha.data" v-bind:key="item.id">
                  <router-link :to="'/browse/' + $route.params.name + '/' + item.scientific_name" v-b-tooltip.html
        :title="'<div class=\'text-center\'><img src=\''+(item.image ? item.image : '/assets/images/no_picture_hd.jpg')+'\' class=\'d-block img img-thumbnail\'>Nama lokal : <strong>'+item.locale_name+'</strong></div>'">{{ item.scientific_name }}</router-link>
                </li>
              </ul>
            </div>
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
const url = window.api_url + "/family/";

export default {
  data: () => {
    return { results: false };
  },
  methods: {
    readData() {
      //console.log(this.$route);
      axios.get(url + this.$route.params.name).then(response => {
        this.results = response.data.is_ok ? response.data.result : null;
      });
    }
  },
  mounted() {
    this.readData();
  }
};
</script>