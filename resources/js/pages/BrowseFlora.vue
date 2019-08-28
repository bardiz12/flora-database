<template>
  <b-container>
    <div class="mt-1"></div>
    <div class="d-flex justify-content-start">
      <h2 class="display-4">{{$route.params.scientific_name}}</h2>
    </div>
    <Breadcrumb
      :items="[{text:'Families',to:{name:'browse'}},{text:$route.params.name,to:'/browse/'+$route.params.name},{text:$route.params.scientific_name,active:true}]"
    ></Breadcrumb>
    

    <b-row v-if="results == false">
        <b-col class="text-center">
          <h1 class="display-3"><i class="fa fa-spinner fa-spin d-block"></i>
            Loading
              
          </h1>
          <h3 class="display-5">Try Refreshing this page if it takes time too long.</h3>
        </b-col>
    </b-row>
    <b-row v-else-if="results !== null">
      <b-col md="4">
        <carousel :perPage="1" :autoplay="true">
            <template v-if="imgCount > 0">
                <template v-for="(image,index) in results.images" >
                <slide v-if="image !== null" v-bind:key="index">
                    <img preview-title-enable="true"
                          preview-nav-enable="true" 
                          v-preview="image" 
                          data-name="MySlideName"
                          text="wkwkwland"
                          :key="index" 
                          :src="image" 
                          class="img" 
                          style="width:100%!important" />
                    <template v-if="results.alt_text[index] !== null">
                      <div class="alt-text d-flex justify-content-center">
                        <span class="text">{{results.alt_text[index]}}</span>
                      </div>
                    </template>
                </slide>
                
                </template>
            </template>
            <template v-else>
            <slide>
                <img preview-title-enable="true"
                          preview-nav-enable="true" alt="Image not available" v-preview="'/assets/images/no_picture_hd.jpg'"  src="/assets/images/no_picture_hd.jpg" class="img" style="width:100%!important" />
            </slide>
            </template>

            
            
        </carousel>
      </b-col>
      <b-col md="8">
          <h4><i class="fa fa-info"></i> Information</h4>
          <div class="table-responsive">
              <table class="table table-hover table-stripped">
                  <tbody>
                      <tr>
                            <td>Nama Ilmiah</td>
                            <td style="width:10px">:</td>
                            <td><i><strong>{{results.scientific_name}}</strong></i></td>
                      </tr>
                      
                      <tr>
                            <td>Nama Lokal</td>
                            <td>:</td>
                            <td><strong>{{results.locale_name}}</strong></td>
                      </tr>
                      
                      <tr>
                            <td>Family</td>
                            <td>:</td>
                            <td><i>{{results.family_name}}</i></td>
                      </tr>
                      
                      <tr>
                            <td>Endemik</td>
                            <td>:</td>
                            <td>{{results.endemik}}</td>
                      </tr>

                      <tr>
                            <td>Kategori</td>
                            <td>:</td>
                            <td>{{results.kategori}}</td>
                      </tr>
                      
                      <tr>
                            <td>Status</td>
                            <td>:</td>
                            <td><ul style="list-style:none">
                                    <li>Undang - Undang : <strong>{{results.status.uu}}</strong></li>
                                    <li>IUCN : <strong>{{results.status.iucn}}</strong></li>
                                    <li>CITES : <strong>{{results.status.cites}}</strong></li>
                                </ul></td>
                      </tr>
                      
                      <tr>
                            <td>Tanggal Data</td>
                            <td>:</td>
                            <td>{{results.tanggal}}</td>
                      </tr>
                      
                      
                      
                  </tbody>
              </table>
          </div>
      </b-col>

      <b-col md="12">
        <h3>Another Species</h3>
        <div class="row">
          <div class="col">
              <span v-for="(flora,index) in results.others" v-bind:key="index">
                <router-link :key="flora.id" :to="{name: 'browse_flora',params:{ name: flora.family, scientific_name: flora.scientific_name }}" >{{flora.scientific_name}}</router-link> <span v-if="index < results.others.length - 1">| </span> 
              </span>
          </div>
        </div>
      </b-col>
    </b-row>
    <b-row v-else>
        <h4 class="text-center">Data Tidak tersedia</h4>
    </b-row>
  </b-container>
</template>

<style scoped>
.alt-text {
  position: relative;
  bottom: 40px;
  left: 0; 
  right: 0; 
  margin-left: auto; 
  margin-right: auto; 
}
.alt-text .text{
  background: rgba(44, 44, 44, 0.637);
  padding: 5px 10px;
  color: #fff;
  border-radius: 10px;
  text-align: center;
}
.alt-text .text:hover{
  background: rgba(0, 0, 0, 0.637);
}
</style>

<script>
import { Carousel, Slide } from 'vue-carousel';
const url = window.api_url + "/family/";

export default {
  data: () => {
    return { results: false ,imgCount:0};
  },
  components: {
    Carousel,
    Slide
  },
  methods: {
    readData() {
      //console.log(this.$route);
      axios.get(url + this.$route.params.name + "/flora/" + this.$route.params.scientific_name).then(response => {
        console.log(response.data);
        if(response.data.is_ok){  
          this.results = response.data.data;
          this.imgCount = 0;
          for(var i in this.results.images){
            this.imgCount += this.results.images[i] == null ? 0 : 1;
          }
        }else{
          this.results = null;
          this.$swal(response.data.msg);
        }
        
      });
    }
  },
  mounted() {
    this.readData();
    //this.initData();
  },created(){
    document.title += this.$route.params.scientific_name + " ("+this.$route.params.name+" Family)"
  }
};
</script>