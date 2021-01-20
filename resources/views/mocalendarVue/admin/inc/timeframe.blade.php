<!-- form-------------------------------------------->
<div class="form-group ">  
    <div class="row">                                                               
      <div class="col-md-3"> 
        <div> időkeret kezdete </div> 
      <input class="form-control" name="start" type="date" id="start">     
      </div> 
    
      <div class="col-md-3">   
        <div> időkeret vége </div>   
      <input class=" form-control" name="end" type="date" id="end">
      </div> 
      <div class="col-md-2"> 
        <div> munkanapok </div>     
      <input class=" form-control" type="checkbox" id="workday"  name="workday" checked="checked" value="workday">
      </div> 
      <div class="col-md-2"> 
        <div> óra/nap </div>      
        <input class=" form-control" type="number" name="norma"  value="8">
      </div> 
      <div class="col-md-2">  
        <div> - </div>   
        <button class="btn btn-primary" v-on:click="getTimeFrames()" name="kezd" value="Bike">Kezdés</button>
      </div> 
  </div>   
</div>  
  <!--összegzés---------------------------------->
  <div class=""> Időkeret kezdete:  @{{timeFrames.start}} </div>  
 <div class=""> Időkeret vége:  @{{timeFrames.end}} </div>  
    <div class=""> Összes nap:  @{{timeFrames.daysNum}} </div>  
    <div class="">Munka nap:   @{{timeFrames.workdaysNum}} </div>  
    <div class=""> Szamított napok: 
    <span v-if="timeFrames.justworkdays" > Csak munkanapok </span>
    <span v-else > Minden nap </span>
    </div>
    <div class="">Napi szorzo  @{{timeFrames.szorzo}} </div>
    <div class="">Időkeret @{{timeFrames.timeFrame}} </div>
<!--tblázat ----------------------------------------->   

  <div class="table-responsive">
    <table class="table table-borderless">
        <thead>
            <tr>
               <th>Dolgozó</th><th>Ledolgozott óra</th><th>Eltérés</th>
            </tr>
        </thead>
        <tbody>      
            <tr v-for="time in timeFrames.times">
                                     
                <td>@{{time.workername}}</td><td>@{{time.sumTime}}</td>
                <td>
                    <span  v-bind:class="time.class" > @{{time.dif}} </span>           
                </td>                          
            </tr>
              
     
        </tbody>
    </table>
    </div>  

