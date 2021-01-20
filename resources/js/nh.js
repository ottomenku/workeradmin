require('./bootstrap');

window.Vue = require('vue');

import VueRouter from 'vue-router';
Vue.use(VueRouter);

import VueAxios from 'vue-axios';
import axios from 'axios';
Vue.use(VueAxios, axios);

//Vue.component('example-component', require('./components/ExampleComponent.vue'));

const router = new VueRouter({ mode: 'history'});

var nh = new Vue({
    el: '#nh',

    data: { 
 
    },
    methods: {

      checkit: function(event) {
          this.activeItem = 'form';    
        if(this.datums.includes(event.target.id)) {
               let index = this.datums.indexOf(event.target.id);
              this.datums.splice(index, 1);
            event.target.classList.remove('checkeddiv');
          }else{
              this.datums.push(event.target.id);
              event.target.classList.add('checkeddiv'); 
              //alert(this.ids.length);
          }
         if(this.datums.length>1) {
           this.aktivDayDatas=[];
          }else{this.aktivDayDatas= this.calendarbase[this.datums[0]];}
        },



       sendpost  : function(){    
            var data= {name: "abc", rank: "MID RANGE"}; 
          //  this.$http.post('http://localhost:8000/m/ad.wor.time/calendar/2012/1',JSON.stringify(data))
            axios.post('http://localhost:8000/m/ad.wor.time/calendar/2012/1',data)
            .then((response) => {
                console.log(response);
              this.vp=response.data.req  
              });
          },        
  
  })