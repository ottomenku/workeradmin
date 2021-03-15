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
                                 <input v-bind:id="{datum}"  v-bind:class="{workdaycheckbox: item.munkanap}"  class="daycheckbox" v-model="datums" type="checkbox" name="datum[]" v-bind:value="datum">
                                 <span class="checkmarkcheckbox2" style="width:100%;height:25px;font-size:0.6em;border-bottom-style: solid;border-width: 1px;overflow:hidden;" >  
                                    <span v-if="datums.includes(datum)" style="color:white;"> <i class="fa fa-check-square"></i>  </span>
                                    <span style="color:grey;"v-else><i class="fa fa-minus-square"></i> </span> 
 
                                        <span style="margin-top:1px;" v-if="typeof(workerdays.datekey[calworkerid])  !== 'undefined' && typeof(workerdays.datekey[calworkerid][datum])  !== 'undefined'" >                          
                                        <i v-if="typeof(workerdays.datekey[calworkerid])  !== 'undefined'"
                                         v-for="workerdayv in workerdays.datekey[calworkerid][datum]"
                                         v-bind:class="[faClass(workerdayv.daytype.icon)]" aria-hidden="true"
                                         v-bind:style="  [{'font-size':'1.5em'}, {'color': workerdayv.daytype.color},{'background-color': workerdayv.daytype.background}]">
                                         </i>                                                                                                   
                                        </span> 
                                     
                                   <div class="daynumber" > 

                                    
                                    @{{item.day}}
                                       
                                
                                </div> 
                                 </span>
                                </label>
                            
                          
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