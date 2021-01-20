<div id="calendar">
    <div v-for="worker in workers"  id="usercalendar"> 
        <hr>
<!-- worker fejlec adminoknak ---------------------------------------------------------------->           
      
<div v-if="level>20"  id="calendar_admin_head"> 
            <i v-on:click="toggleWorker(worker.id)" class="fa fa-chevron-up"></i>  <span>@{{worker.fullname}}  </span>
            <input  v-model="workerids"  type="checkbox"  v-bind:value="worker.id">
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
                            <span class="" >  </span>
                            <span v-if="typeof basedays[datum] !== 'undefined'" class="dayhead" > 
                            @{{basedays[datum].note}} @{{times.datekey[worker.id][datum]}}
                            </span>
                    </div>    
                    <div class="daynumber" > @{{item.day}} </div>   
                    <div  v-if="typeof(workerdays.datekey[worker.id])  !== 'undefined' && typeof(workerdays.datekey[worker.id][datum])  !== 'undefined'" >
                        <div v-for="workerdayv in workerdays.datekey[worker.id][datum]" >
                            <div v-if="typeof(workerdayv.id)  !== 'undefined'" v-bind:class="[workerdayv.class]" >
                            @{{workerdayv.daytype.name}} 
                            <i v-if="level >= workerdayv.pub"  v-on:click="delday(workerdayv.id)" style="color:red;" class="fa fa-times-circle"></i>       
                        </div>
                        </div> 
                    </div> 
                    <div  v-if="typeof(times.datekey[worker.id]) !== 'undefined' && typeof(times.datekey[worker.id][datum]) !== 'undefined'  "  >      
                        <div v-if="typeof(timev.start) !== 'undefined'" v-bind:class="[timev.class]"  v-for="timev in times.datekey[worker.id][datum]" >
                            @{{timev.start}}- @{{timev.end}}         
                            <i v-if="level >= timev.pub"  v-on:click="deltime(timev.id)" style="color:red;" class="fa fa-times-circle"></i> 
                        </div>
                    </div> 
               
                </div> 
            </div> 
        </div> 
    </div>     
    
</div>