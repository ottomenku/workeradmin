<div id="calendar">
    <div   id="usercalendar"> 
<!-- calendar---------------------------------------------------------------->        
        <div >             
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
                    <div v-bind:id="datum"  style="width:100%;" class="dayheader" v-if="item.name !== 'empty'">
                         
                                <label class="checkcontainer" >
                                 <input id="datum"  v-bind:class="{workdaycheckbox: item.munkanap}"  class="daycheckbox" v-model="datums" type="checkbox" name="datum[]" v-bind:value="datum">
                                 <span class="checkmarkcheckbox2" style="width:100%;height:25px;font-size:0.6em;border-bottom-style: solid;border-width: 1px;overflow:hidden;" >  
                                    <span v-if="datums.includes(datum)" style="color:white;"> <i class="fa fa-check-square"></i> kijelölve  </span>
                                    <span style="color:grey;"v-else><i class="fa fa-minus-square"></i>  kijelölés</span> 
                                   <div class="daynumber" > @{{item.day}} </div> 
                                 </span>
                                </label>
                            
                          
                    </div>    
                
                <div style="margin-top:6px;">  
                    <div style="margin-top:1px;" v-if="typeof(workerdays.datekey[calworkerid])  !== 'undefined' && typeof(workerdays.datekey[calworkerid][datum])  !== 'undefined'" >
                        <div v-for="workerdayv in workerdays.datekey[calworkerid][datum]" >
                            <div v-if="typeof(workerdayv.id)  !== 'undefined'" v-bind:class="[workerdayv.class]" >
                            @{{workerdayv.daytype.name}} 
                            <i v-if="level >= workerdayv.pub"  v-on:click="delday(workerdayv.id)" style="color:red;" class="fa fa-times-circle"></i>       
                        </div>
                        </div> 
                    </div> 
                    <div style="margin-top:1px;" v-if="typeof(times.datekey[calworkerid]) !== 'undefined' && typeof(times.datekey[calworkerid][datum]) !== 'undefined'  "  >      
                        <div v-if="typeof(timev.start) !== 'undefined'" v-bind:class="[timev.class]"  v-for="timev in times.datekey[calworkerid][datum]" >
                            @{{timev.start}}- @{{timev.end}}         
                            <i v-if="level >= timev.pub"  v-on:click="deltime(timev.id)" style="color:red;" class="fa fa-times-circle"></i> 
                        </div>
                    </div> 
                </div> 
                </div> 
            </div> 
        </div> 
    </div>     
    
</div>