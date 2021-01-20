<div id="calendar">
    <div v-for="worker in workers"  id="usercalendar"> 
        <hr>
<!-- worker fejlec adminoknak ---------------------------------------------------------------->           
        <div v-if="level>20"  id="calendar_admin_head"> 
            <i v-on:click="toggleWorker(worker.id)" class="fa fa-chevron-up"></i>  <span>@{{worker.fullname}}  </span>
            <input  v-model="workerids"  type="checkbox" name="workerid[]" v-bind:value="worker.id">
        </div>
<!-- calendar---------------------------------------------------------------->       
     <hr>  
        <div v-bind:id="worker.id">             
                 <section class="th">
                         
                         <span>Hétfő</span>
                         <span>Kedd</span>
                         <span>Szerda</span>
                         <span>Csütörtök</span>
                         <span>Péntek</span>
                         <span>Szombat</span>
                         <span>Vasárnap</span>
                     </section>
                     <div class="week" v-for="(week, weekindex) in calendar">      
                         <div  v-bind:class="item.class" v-for="(item, datum) in week" v-bind:data-date="item.day"> 
                             <div v-bind:id="datum" v-on:click="setActive('form')" class="dayheader" v-if="item.name !== 'empty'">
                                 <span class="" > 
                                     <input class="{ workday: item.munkanap }" v-model="datums" type="checkbox" name="datum[]" v-bind:value="datum"> 
                                  
                                     <span v-if="typeof basedays[datum] !== 'undefined'" class="dayhead" > 
                                     @{{basedays[datum].note}}
                                    </span>
                                </span> 
                             </div>    
                         <div class="daynumber" > @{{item.day}} </div>                 
                         <div v-if="typeof(workerdays.datekey[worker.id])  !== 'undefined'" v-if="typeof(workerdays.datekey[worker.id][datum])  !== 'undefined'" >
                             <div  v-on:click="setActive('dayform')" v-bind:class="[workerdays.class]" v-for="workerdays in workerdays.datekey[worker.id][datum]" >
                                 @{{workerdays.daytype.name}} 
                                 <i v-on:click="delday(workerdays.id)" style="color:red;" class="fa fa-times-circle"></i>       
                             </div> 
                         </div> 
                         <div  v-if="typeof(times.datekey[worker.id]) !== 'undefined'"  v-if="typeof(times.datekey[worker.id][datum]) !== 'undefined'" >      
                             <div v-on:click="setActive('timeform')" v-bind:class="[time.class]"  v-for="(time) in times.datekey[worker.id][datum]" >
                                 @{{time.start.substring(0,5)}}- @{{time.end.substring(0,5)}}         
                                 <i v-on:click="deltime(time.id)" style="color:red;" class="fa fa-times-circle"></i> 
                             </div>
                         </div> 
                         </div> 
                     </div> 
             </div>     
         </div> 
</div>