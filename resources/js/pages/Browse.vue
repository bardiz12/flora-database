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
        <template v-for="item in result">
          <span v-if="item.showed" v-bind:key="item.id" class="text-uppercase p-1">
            <a :href="'#'+item.alphabet">{{ item.alphabet }}</a>
          </span>
        </template>
      </span>
      <span class="p-1">
        <a href="#" @click="readData">[Refresh]</a>
      </span>
    </div>
    <hr />
    <b-row>
      <b-col>
        <input  @focus="$event.target.select()"
          type="text"
          class="form-control search-bar"
          v-model="search"
          placeholder="search something..."
        />
      </b-col>
    </b-row>
    <b-row v-if="results == false">
      <b-col class="text-center">
        <h1 class="display-3">
          <i class="fa fa-spinner fa-spin d-block"></i>

          Loading
        </h1>
        <h3 class="display-5">Try Refreshing this page if it takes time too long.</h3>
      </b-col>
    </b-row>
    <b-row v-else-if="results !== null">
      <template v-for="result in results">
        <b-col md="4" v-bind:key="result.alphabet" v-if="result != null">
        <div v-for="alpha in result" v-bind:key="alpha.id">
          <div v-bind:id="alpha.alphabet" v-if="alpha.showed">
            <h2 class="display-5 text-uppercase">{{alpha.alphabet}}</h2>
            <ul class="pl-4 list-anu">
              <li v-for="item in alpha.data" v-bind:key="item.id">
                <template v-if="item.showed">
                  <router-link :to="'/browse/' + item.name">
                    <strong>
                      <template v-for="(huruf,index) in item.name">
                        <font v-bind:key="index">
                          <font v-if="search.length !==  0 && item.name.toLowerCase().indexOf(search.toLowerCase()) >= 0 && index >= item.name.toLowerCase().indexOf(search.toLowerCase()) && index <= item.name.toLowerCase().indexOf(search.toLowerCase()) + search.length -1">
                            <font class="searched-term">{{huruf}}</font>
                          </font>
                          <font v-else>
                            <font>{{huruf}}</font>
                          </font>
                        </font>
                      </template>
                    </strong>
                  </router-link>
                </template>
              </li>
            </ul>
          </div>
        </div>
        </b-col>
      </template>
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
const url = window.api_url + "/families";
export default {
  data: () => {
    return {
      results: false,
      last: Math.floor(Date.now() / 1000),
      titiks: ["."],
      search: "",
      is_zero:false,
      anu: null
    };
  },
  methods: {
    readData() {
      console.log(this.results);
      axios.get(url).then(response => {
        this.search = "";
        this.results = response.data.is_ok ? response.data.result : null;
        this.initData();
      });
    },
    chunkArray: (myArray, chunk_size) =>{
        var index = 0;
        var arrayLength = myArray.length;
        var tempArray = [];
        
        for (index = 0; index < arrayLength; index += chunk_size) {
            var myChunk = myArray.slice(index, index+chunk_size);
            // Do something if you want with the group
            tempArray.push(myChunk);
        }

        return tempArray;
    },
    initData(){
      for (var part_ke in this.results) {
          for (var data_ke in this.results[part_ke]) {
            this.results[part_ke][data_ke].showed = true;
            for (var flora_ke in this.results[part_ke][data_ke].data) {
              this.results[part_ke][data_ke].data[flora_ke].showed = true;
            }
          }
        }
    },
    orderByName: (data) =>{
      for (let i = 0; i < data.length; i++) {
        for (let j = 0; j < data.length - i; j++) {
          if(data[i].alphabet.charCodeAt(0) < data[j].alphabet.charCodeAt(0)){
            var tmp = data[j];
            data[j] = data[i];
            data[i] = tmp;
          }
          
        }
        
      }
      return data;
    },
  },
  watch: {
    search: function(val) {
      this.initData();
      for (var part_ke in this.results) {
        for (var data_ke in this.results[part_ke]) {
          var tot = 0;
          for (var flora_ke in this.results[part_ke][data_ke].data) {
            this.results[part_ke][data_ke].data[flora_ke].showed =
              this.results[part_ke][data_ke].data[flora_ke].name
                .toLowerCase()
                .indexOf(this.search.toLowerCase()) >= 0;
            tot += this.results[part_ke][data_ke].data[flora_ke].showed ? 0 : 1;
          }
          this.results[part_ke][data_ke].showed = true;
          if (tot == this.results[part_ke][data_ke].data.length) {
            this.results[part_ke][data_ke].showed = false;
          }
        }
      }
    }
  },
  mounted() {
    //this.$swal('Hello Vue world!!!');
    this.readData();
    
  }
};
</script>