<template>
  <b-container>
    <div class="mt-1"></div>
    <div class="pt-5 mt-5">
      <h2 class="display-4 text-center">Search Flora</h2>
      <hr />
      <b-row>
        <b-col md="8" offset-md="2" class="search-container">
          <input
            @focus="$event.target.select()"
            type="text"
            class="form-control search-bar big-search-bar"
            v-model="search"
            placeholder="search something..." debounce="560"
          />

          <a class="btn-search">
            <i class="fa fa-search fa-2x"></i>
          </a>
        </b-col>
      </b-row>
      <b-row>
        <b-col md="12">
          <div class="text-center">
            <span class="text-muted">search result for : <b>{{search}}</b></span>
          </div>
        </b-col>
        <!---->
        <b-col md="8" offset-md="2" v-if="data !== null && msg !== 'Loading..'">
          <template v-if="data.data.length > 0">
            <template v-for="item in data.data">
              <div class="card result-item" v-bind:key="item.id" @click="goToItem(item)">
                <div class="card-body">
                  <div class="d-flex justify-content-start">
                    <img :src="(item.images[0] == null ? '/assets/images/no_picture_hd.jpg' : item.images[0])" class="thumbnail">
                    <div>
                      <h5 class="d-block"><i class="scientific_name">{{item.scientific_name}}</i> - <span>{{item.locale_name}}</span></h5>
                      <p class="text-left">
                        <span class="text-muted">Kategori: </span> {{item.kategori}}, 
                        <span class="text-muted">Endemik: </span> {{item.endemik}},
                        <span class="text-muted">Family: </span> {{item.family}},<br/>
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            </template>
            <div class="d-flex justify-content-between align-items-center mt-2 navigation" v-if="data.total !== 0">
              <template v-if="data.prev_page_url !== null">
                <button class="btn btn-primary back" @click="back">Back</button>
              </template>
              <template v-else>
                <span></span>
              </template>
              <span>Page {{page}} of {{data.last_page}}</span>
              <template v-if="page < data.last_page">
                <button class="btn btn-primary next" @click="next">Next</button>
              </template>
              <template v-else>
                  <span></span>
              </template>
            </div>
          </template>
          <template>
            <h3>{{msg}}</h3>    
          </template>
        </b-col>
      </b-row>
    </div>
  </b-container>
</template>

<style>
.big-search-bar {
  border-bottom: 10px solid #ddd !important;
  height: 50pt;
  font-size: 20px;
}

.big-search-bar:focus {
  border-bottom: 10px solid #4352aa !important;
  font-size: 20px;
}

.search-container .btn-search {
  position: absolute;
  transition: all 0.01s ease-in-out;
  right: 20px;
  top: 20pt;
  cursor: pointer;
}

.search-container .btn-search:active {
  top: 25pt;
  color: #4352aa;
}

.search-container .btn-search:active i {
  color: #4352aa;
}

.result-item .thumbnail{
  width: 64px;
  height: 64px;
  padding-right: 10px;
}

.result-item {
  border-radius: 0px !important;
}

.result-item:hover{
  background: #b8b8b8;
  cursor: pointer;
}

.result-item .scientific_name{
  background: #4352aa;
  padding-left: 5px;
  padding-right: 5px;
  color: #fff;
}

.navigation back {
  border-radius: 0px !important;
}
</style>

<script>
const url = window.api_url + "/search";
export default {
  data: () => {
    return {
      search: "",
      firstLoad:true,
      page: 1,
      data:null,
      timer: null,
      msg: "Loading.."
    };
  },
  methods: {
    goToItem(val){
      this.$router.push({ name: 'browse_flora', params: { name: val.family, scientific_name: val.scientific_name }});
    },
    back() {
      this.page--
    },
    next(){
      this.page++
    },
    readData() {
      if(this.search.length > 0){
        this.msg = "Loading..";
      axios
        .post(url, { q: this.search, page: this.page })
        .then((response) => {
          this.firstLoad = false;
          console.log(response);
          this.data = response.data;
          if(this.data.data.length == 0){
            this.msg = "Data not found for term " + this.search;
          }else{
            this.msg = "";
          }
        });
      }
    },
    searchDelay3Second(){
      if(this.timer !== null){
        clearInterval(this.timer);
      }else{
        
      }
      this.timer = setInterval(()=>{
        this.readData();
        clearInterval(this.timer);
      },500);
    }
  },
  mounted() {
      this.search =
        this.$route.query.q === undefined ? this.search : this.$route.query.q;
      this.page =
        this.$route.query.page === undefined ? this.page : this.$route.query.page;
      if (this.search !== "") {
        this.readData();
      }
      if(this.search == ""){
        this.firstLoad = false;
      }
//      document.title += this.$route.params.scientific_name + " ("+this.$route.params.name+" Family)"
    
  },
  watch: {
    search: function(val) {
        if(!this.firstLoad){
            if(val !== "" && val !== this.$route.query.q){
            this.$router.replace({
              name: "search",
              query: {
                q: val,
                page: this.page
              }
            });
            this.readData();
          }else{
            this.msg = "";
          }
        }
    },
    page: function(val){
      this.readData();
      this.$router.push({ path: 'search', query: { page: this.page, q: this.search }});
    }
  }
};
</script>