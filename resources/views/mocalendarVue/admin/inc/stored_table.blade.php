
<div class="table-responsive">
    <table class="table table-borderless">
        <thead>
            <tr>
               <th>Dolgozó</th><th>Zárás név</th><th>zárva</th><th>készült</th><th>frissítve</th><th>Action</th>
            </tr>
        </thead>
        <tbody>      
            <tr  v-for="(stored, key) in storeds"  v-if="typeof(stored.worker) !== 'undefined'" >
                                     
                <td>@{{stored.worker.workername}}</td><td>@{{stored.name}}</td>
                <td>
                    <i v-if="stored.lezarva==0" style="color:blue;font-size:1.3rem;" 
                        @if(Auth::user()->hasRole('admin'))
                        v-on:click="zarStored(key)"
                        @endif
                     class="fa fa-unlock-alt"></i>
                    <i v-if="stored.lezarva==1" style="color:gray;font-size:1.3rem;" 
                        @if(Auth::user()->hasRole('admin'))
                        v-on:click="nyitStored(key)"
                        @endif
                    class="fa fa-lock"></i>
                </td>
                <td> @{{stored.created_at}} </td><td> @{{stored.updated_at}} </td>
                <td>
                @if ( Auth::user()->hasRole('manager'))  
                <i  style="color:red;font-size:1.3rem;"  v-on:click="delStored(key)"class="fa fa-times-circle"></i>
                @endif
                 <i style="color:blue;font-size:1.3rem;"  v-on:click="showStored(key)"class="fa fa-eye"></i> 
                </td>                 
           
            </tr>
              
     
        </tbody>
    </table>
    </div>                      
