
<a class="btn btn-primary float-right" v-bind:href="host+'pdf/'+storedid" >Letöltés </a>

<div>munkanapok : @{{solver.sumWorkerdays}}  </div>  
<div class="" v-for="(wday, dkey) in solver.days">  
     @{{dkey}}:  @{{wday.days}} , összesen: @{{wday.sumdays}}
</div>
<div class="" v-for="(wtime, tkey) in solver.times">  
 @{{tkey}}:  @{{wtime.hours}} , összesen: @{{wtime.sumhours}}
</div>

        <section class="th">
                        
            <span>Hétfő</span>
            <span>Kedd</span>
            <span>Szerda</span>
            <span>Csütörtök</span>
            <span>Péntek</span>
            <span>Szombat</span>
            <span>Vasárnap</span>
        </section>
        <div class="week" v-for="(week, weekindex) in storedToShow.calendar">      
            <div  v-bind:class="item.class" v-for="(item, datum) in week" v-bind:data-date="item.day"> 
                <div  class="dayheader" v-if="item.name !== 'empty'">
                   
                    <span v-if="typeof basedays[datum] !== 'undefined'" class="dayhead" > 
                        @{{basedays[datum]}}
                    </span>
                </div>    
            <div class="daynumber" > @{{item.day}} </div>                 
            <div v-if="typeof(storedToShow.workerdays.datekey[workerid])  !== 'undefined'" >
                <div  v-bind:class="[workerdays.class]" v-for="workerdays in storedToShow.workerdays.datekey[workerid][datum]" >
                    @{{workerdays.daytype.name}} 
                         
                </div> 
            </div>  
            <div  v-if="typeof(storedToShow.times.datekey[workerid]) !== 'undefined'" >      
                <div  v-bind:class="[time.class]"  v-for="(time) in storedToShow.times.datekey[workerid][datum]" >
                    @{{time.start.substring(0,5)}}- @{{time.end.substring(0,5)}}         
                   
                </div>
            </div> 
            </div> 
    </div> 