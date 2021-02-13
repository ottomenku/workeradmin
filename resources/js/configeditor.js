//require('./bootstrap');

window.Vue = require('vue');

import VueRouter from 'vue-router';
Vue.use(VueRouter);

import VueAxios from 'vue-axios';
import axios from 'axios';
Vue.use(VueAxios, axios);

//Vue.component('example-component', require('./components/ExampleComponent.vue'));
Vue.component('modal', {template: '#modal-template'});
const router = new VueRouter({ mode: 'history' });



let tree = {
  label: 'root',
  nodes: [
    {
      label: 'item1',
      nodes: [
        {
          label: 'item1.1'
        },
        {
          label: 'item1.2',
          nodes: [
            {
              label: 'item1.2.1'
            }
          ]
        }
      ]
    }, 
    {
      label: 'item2'  
    }
  ]
}

Vue.component('tree-menu', { 
  template: '#tree-menu',
  props: [ 'nodes', 'label', 'depth' ],
  data() {
     return {
       showChildren: false
     }
  },
  computed: {
    iconClasses() {
      return {
        'fa-plus-square-o': !this.showChildren,
        'fa-minus-square-o': this.showChildren
      }
    },
    labelClasses() {
      return { 'has-children': this.nodes }
    },
    indent() {
      return { transform: `translate(${this.depth * 50}px)` }
    }
  },
  methods: {
    toggleChildren() {
       this.showChildren = !this.showChildren;
    }
  }
});






var app = new Vue({
  el: '#app',
  created() {
    this.PandFwitId('getbasedata'); 
   // this.PandFwitId('freshdata'); 
  },
  data: {
   // baseroute: window.viewpar.baseroute,
    //host: window.viewpar.host,  
    baseroute: 'config',
    task: 'index',
    host: 'http://localhost:8000/',
    tree,
  },


methods: 
{  

/**
 * elküldi az alap adatokat és a responsból frissíti a this paramétereket
 * ha formadatokat akarun küldeni a this.formdatas ba kell írni 
 * Ha a pardataType= 'id' akkor a pardatas értéke  id kulcsal bekerül a databa
 * Ha a pardataType= 'justpardata' akkor csak a pardata-t küldi el a data-t nem
 * egyébként  'justpardata'
 * @param  route //host nem kell alapból hozzáteszi
 */
postAndFresh: function (task='calendar/',data=null) {

      axios.post(this.host+this.baseroute+task, data)
      .then(response => {
        this.storeds=[];
        Object.entries(response.data).forEach(this.DataRefresh);
       // this.calworkerid=this.workers[0].id;
      //  this.calworker=this.workers[0];
       }).catch(function (error) {
         alert(error);
     });
    },


  
},

});