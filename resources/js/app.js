require('./bootstrap');

window.Vue = require('vue');

import VueRouter from 'vue-router';
Vue.use(VueRouter);

import VueAxios from 'vue-axios';
import axios from 'axios';
Vue.use(VueAxios, axios);

//Vue.component('example-component', require('./components/ExampleComponent.vue'));
Vue.component('modal', {template: '#modal-template'});
const router = new VueRouter({ mode: 'history' });

var app = new Vue({
  el: '#app',
  created() {
    this.PandFwitId('getbasedata'); 

   // this.PandFwitId('freshdata'); 
  },
  data: {
  
//paraméterek---------------------------------
    viewpar:window.viewpar,
    viewparid:window.viewparid,
    level:10,  //jogosultság alapból worker
    baseroute: window.viewpar.baseroute,
    host: window.viewpar.host,   
//actuális értékek (kijelölt kiválasztott)-------------
    showModal: false,  
    showInfo: false, 
    actTimetype: 2, //timetypetype selectlist actuális értéke
    actDaytype: 2,  //daytype selectlist actuális értéke
    activeTab: 'home',
    activeAdminTab: 'stored',
    actchecklist: '',
    select_action: 'nothing',
    workerid: 0, // a stored modal használja
    calworkerid: 0, // az aktuális worker azonosítója akinek a kalendár adatai megjelennek
    calworker: [],  //az aktuális worker  adatai 
   // calworkers: [],  // a kiválasztott dolgozók
    user:[], 
    ceg:[],
 
//base adatok  a post kérésekkor alapból automatikusan elküldve és frissítve------------------------
    year: window.year,
    month: window.month,
    cegid:0,
    daycheckbox:$('input:checkbox.daycheckbox'),
    datums: [], //kivállasztott napok dátumai idők napok felviteléhez
    workerids: [],//kivállasztott dolgozók azonosítói
    workers: [], // full worker adatok
    plusdata:{}, //post kérésben plusz adatok küldése a base adatokon kivül
    formdata:null, //post kérésben form adatok küldése a base adatokon kivül
    justdata:null, //ha nem üres a post kérésben csak ezek adatok lesznek elküldve plusz az id ha van a paraméterben

 //select tömbök --------------------------------  
    timetypes:[],
    actTimetype:0,
    daytypes: [],
    actDaytype:0,

    months: [{ value: 1, text: 'Január' }, { value: 2, text: 'Február' }, { value: 3, text: 'Március' },
    { value: 4, text: 'Április' }, { value: 5, text: 'Május' }, { value: 6, text: 'Június' }, { value: 7, text: 'Július' },
    { value: 8, text: 'Augusztus' }, { value: 9, text: 'Szeptember' }, { value: 10, text: 'Október' },
    { value: 11, text: 'November' }, { value: 12, text: 'Decenber' }],
    checklist: {'all':'Mind','workday':'Munkanapok','nothing':'egyiksem','inverse':'fordított'},
  
  //calaendar adatok-----------------------    
    calendar:[], 
    calendarbase:[], 
    times: [],
    workerdays: [],
    basedays:[], 
  //stored-------------------------------
    storeds:[], 
    storedToShow:[],
    solver:[],
    timeFrames:[],
  },


methods: 
{  
  faClass(icon) {
    return `fa fa-${icon}`;
  },

   onfileInputChange(e) {
    let files = e.target.files || e.dataTransfer.files;
    if (!files.length){
      this.formdata.files =files;
    }

},

//adatok PandFwitId-nek és a child funkcüknak-------------------------------------
  getBaseDataWitId: function (pardata=0) {
    return { id:pardata, month: this.month, year: this.year, cegid: this.cegid, workerids: this.workerids,
        datums: this.datums, formdata: this.formdata , plusdata: this.plusdata, viewparid: this.viewparid}; 
  },
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
if(task=='getbasedata'){
  this.calworkerid=this.workers[0].id; 
  this.calworker=this.workers[0];
  this.workerids=[this.workers[0].id];  
}
       // this.calworkerid=this.workers[0].id;
      //  this.calworker=this.workers[0];
       }).catch(function (error) {
         alert(error);
     });
    },

  showModalInfo: function () { this.showInfo=true;},


     DataRefresh: function (value, key, response) {
     //  alert(key);
      this[value[0]]=value[1];
    },
setCalworkerid: function(worker) {
    this.calworkerid=worker.id; 
   this.calworker=worker;
   this.workerids=[worker.id];  
},
//selectChange: function () {alert('ttt');},
selectDays: function () {
  //  alert(this.select_action); this.rows.push('');
  if(this.select_action=='all'){
   this.datums=$('input:checkbox.daycheckbox').map(
     function () {return this.value;}).get();
  }
  else if(this.select_action=='workday'){
    this.datums=$('input:checkbox.workdaycheckbox').map(
      function () {return this.value;}).get();
  }
  else if(this.select_action=='inverse'){ 
    let list=$('input:checkbox.daycheckbox').map(
    function () {return this.value;}).get();
    let temp=[];
    list.forEach((value, index) => {
    //if(!$('#'+value).prop('checked')) {temp.push(value);} 
     if(!this.datums.includes(value)) {temp.push(value);}   
    });
    this.datums=[];this.datums=temp;
  }
  else if(this.select_action=='nothing'){ this.datums=[];}
},
// PandFwitId  childek-----------------------------

PandFwitId: function (task='calendar/',id=0) {
  this.postAndFresh(task,this.getBaseDataWitId(id));


},

// zárások-----PandFwitId taskok: storeStoreds,'delStored(id),zarStored(cegid),nyitStored(cegid)-----

showStored: function(id) {
        this.storedToShow=JSON.parse(this.storeds[id]['fulldata']);
        this.workerid=this.storeds[id]['worker_id'];
        this.solver=JSON.parse(this.storeds[id]['solverdata']);
        this.storedid=id;
        this.showModal= true; 
},
delStored: function(id) {
  this.PandFwitId('delstored',id);
},
storeStoreds: function() {
  this.PandFwitId('storestored');
}
,nyitStored: function(id) {
  this.PandFwitId('nyitstored',id);
},
zarStored: function(id) {
  this.PandFwitId('zarstored',id);
},
//timeframes------------------------------------------

  getTimeFrames: function () {
    this.formdata = {
      start: $("input[name=start]").val(),
      end: $("input[name=end]").val(),
      szorzo: $("input[name=norma]").val(),
      justworkdays:'all',
    }  ;
    if ($("#workday").is(':checked')) {this.formdata.justworkdays='workdays';}
  this.PandFwitId('timeframes'); 
  },

// idők -----------taskok:'deltime(id),-----------------

  timesreset: function() {
      if(confirm("A kijelölt dolgozók és napok idő bejegyzései végleg törlődni fognak. Biztos hogy ezt akarja?")){
           this.PandFwitId('resettimes'); 
      };  
    },

    deltime: function(id) {
    this.PandFwitId('deltime',id); 
    },
  storetimes: function() {

      this.formdata= {
        end : $("input[name=end]").val(),
        start: $("input[name=start]").val(),
        timetype_id:  $("select[name=timetype_id]").val(),
        hour : $("input[name=hour]").val(),
        pubbase: $('input[name="pubtime"]:checked').val(),
      };
     /*   this.formdata.end = $("input[name=end]").val();
        this.formdata.timetype_id=  $("select[name=timetype_id]").val();
        this.formdata.hour = $("input[name=hour]").val();
        this.formdata.pubbase=  $('input[name="pubtime"]:checked').val();
     **/
      this.PandFwitId('storetimes');
    },
// napok------taskok:'delday(id),---------------------------------------  

  daysreset: function() {
    if(confirm("A kijelölt dolgozók és napok napbejegyzései végleg törlődni fognak. Biztos hogy ezt akarja?")){
        this.PandFwitId('resetdays');
    };  
  },
  delday: function(id) {
    this.PandFwitId('delday',id); 
    },
  storedays: function() {
    this.formdata = {
        workernote: $("input[name=workernote]").val(),
      //  daytype_id: $("select[name=daytype_id]").val(),
      daytype_id: $('input[name=daytype_id]:checked').val(),
        pubbase: $('input[name="pubday"]:checked').val(),
      }
      this.PandFwitId('storedays');
      },
// file-----------------------------------
filesreset: function() {
  if(confirm("A kijelölt napok file bejegyzései végleg törlődni fognak. Biztos hogy ezt akarja?")){
      this.PandFwitId('filesreset');
  };  
},

storefiles: function() { 
  this.PandFwitId('storefiles');
  this.formdatas ={};  
    },

//év hó----------------------------------------------
    minusyear: function (task=null) {
      this.year--;
      this.PandFwitId(task);
    },
    addyear: function (task=null) {
      this.year++;
      this.PandFwitId(task);
    },

   changeEv: function (task=null) {
      this.year = event.target.value;
      this.calendarFresh(task);
    },
    changeHo: function (task=null) {
      //ho = rowId ;
      this.PandFwitId(task);
    },

//kijelölések------------------------------------ 
     uncheckday: function (dayid) {
      this.dayids.splice(this.dayids.indexOf(dayid), 1);
    },

//felső tabok váltása----------------------------------------------
    isAdminActive: function (menuItem) { 
      return this.activeTab === menuItem;
    },
    setAdminActive: function (menuItem) {  
      this.activeTab = menuItem;
    },  
     isActive: function (menuItem) { 
      return this.activeTab === menuItem;
    },
    setActive: function (menuItem) {  
      this.activeTab = menuItem;
    },
//worker tab kinyitás összecsukás-----------------------------
    toggleWorker: function (workerid) {
      $("#"+workerid).toggle();
    },

  }
});