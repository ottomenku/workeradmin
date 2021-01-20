
                   <div class="row">    
                    <div class="col-xs-4"> 
                    <div class="input-group">  
                        <span  v-on:click="minusyear('{{$refreshTask}}')" style="cursor: pointer;" class="btn btn-outline-secondary input-sm"><</span>
                        <input id="year" size="2"  name="year" type="text" v-on:change="reFresh('{{$refreshTask}}')" v-bind:value="year" class="form-control input-sm ">
                        <span v-on:click="addyear('{{$refreshTask}}')" style="cursor: pointer;" class="btn btn-outline-secondary input-sm">></span>
                    </div>
                    </div> 

                    <div class="col-xs-2"> 
                        <select class="form-control input-sm " name="month" v-on:change="changeHo('{{$refreshTask}}')" v-model="month">
                            <option v-for="month in months" :value="month.value">@{{ month.text }}</option>
                        </select>
                    </div>
                    <div class="col-xs-2"> 
                    <select class="form-control input-sm " v-on:change="kijelol('{{$refreshTask}}')" name="timetype_id"  v-model="actchecklist">
                        <option v-for="(val, index) in checklist" :value="index">@{{val}}</option>
                    </select>
                    </div>
                    </div>  
