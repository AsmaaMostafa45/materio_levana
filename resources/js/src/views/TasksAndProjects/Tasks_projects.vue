<template> 
    <div id="app">
        <v-app id="inspire">
            <v-card>
            <v-toolbar
                flat
               
            >
                <v-toolbar-title>Tasks and Projects</v-toolbar-title>
                <v-spacer></v-spacer>
             <!-- new Deal start  -->
                <v-dialog
                v-model="dialog"
                max-width="850px"
                persistent
                >

                <template v-slot:activator="{ on, attrs }">
                    <v-btn
                    color="primary"
                    dark
                    class="mb-2"
                    v-bind="attrs"
                    v-on="on"
                    >
                    New 
                    </v-btn>
                </template>
                <v-card>
                    <v-toolbar
                    dark
                    color="primary"
                    > 
                    <v-toolbar-title>New task</v-toolbar-title>
                    <v-spacer></v-spacer>
                    </v-toolbar>
                    <v-card-text>
                    <v-form @submit.prevent="submit"
                    ref="form"
                    v-model="valid"
                    lazy-validation>
                        <!-- <v-subheader>Name</v-subheader> -->
                        <br>
                        <v-text-field
                            v-model="editedItem.task_name"
                            label=" Task Name" 
                            outlined
                            shaped
                        ></v-text-field>
                        <br>
                        <v-select
                            v-model="editedItem.responsible_person"
                            :items="responsible_person_items"
                            :rules="resPerRules"
                            item-text="locale.en.title"
                            item-value="id"
                            label="Responsible Person *"
                            data-vv-name="status"
                            outlined
                            shaped
                        >
                        <template v-slot:append>
                        <v-icon class="red_color">*</v-icon>
                        </template> 
                        </v-select>
                        <br> 
                        <v-select
                            v-model="editedItem.mention_person"
                            :items="mention_person_items"
                            item-text="locale.en.title"
                            item-value="id"
                            label="Mention"
                            data-vv-name="status"
                            outlined
                            shaped
                        >
                        <template v-slot:append>
                        <v-icon>{{icons.mdiAt}}</v-icon>
                        </template>
                        </v-select>
                        <br>
                        <v-text-field
                            v-model="editedItem.start_date"
                            :rules="startDateRules"
                            label=" Start Date" 
                            type="Date"
                            :max="editedItem.end_date"
                            outlined
                            shaped
                        ></v-text-field>
                        <br>
                        <v-text-field
                            v-model="editedItem.end_date"
                            :rules="endDateRules"
                            label="Deadline" 
                            type="Date"
                            :min="editedItem.start_date"
                            outlined
                            shaped
                        ></v-text-field>
                        <br>
                        <v-textarea
                        v-model="editedItem.summery"       
                        label="Summery"
                        rows="4"
                        row-height="30"
                        outlined
                        shaped
                        ></v-textarea>
                        <br>
                        <v-select
                            v-model="editedItem.sub_task"
                            :items="sub_task_items"
                            item-text="locale.en.title"
                            item-value="id"
                            label="Sub Task Of"
                            data-vv-name="status"
                            outlined
                            shaped
                        ></v-select>
                        <v-icon class="red_color">*</v-icon> Required
                    </v-form>
                    </v-card-text>
                    <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn
                        color="error"
                        @click="close"
                    >
                        Cancel
                    </v-btn>
                    <v-btn
                        color="primary"
                        class="mr-4"
                        @click="save"
                    >
                        Save
                    </v-btn>
                    </v-card-actions>
                </v-card> 
        </v-dialog>
        </v-toolbar>
        <v-divider></v-divider>
        <!-- new Deal end  -->
        <!-- view Deal start  -->
        <v-dialog
        v-model="dialogview"
        hide-overlay
        max-width="850px"
        persistent
        >
          <v-card>
            <v-toolbar
              dark
              color="primary"
            >
              <v-btn
                icon
                dark
                @click="dialogview = false"
              >
                <v-icon
                small
                >
                {{icons.mdiCloseThick}}
                </v-icon>
              </v-btn>
              <v-toolbar-title>{{list_deal_view.deal_name}} details </v-toolbar-title>
              <v-spacer></v-spacer>
            </v-toolbar>
            <v-list
              three-line
              subheader
            >
              <v-list-item>
                <v-list-item-content>
                  <v-list-item-title class="tile">Name</v-list-item-title>
                  <v-list-item-subtitle>{{list_deal_view.deal_name}}</v-list-item-subtitle>
                </v-list-item-content>
              </v-list-item>
              <v-divider></v-divider>
              <v-list-item>
                <v-list-item-content>
                  <v-list-item-title class="tile">Status</v-list-item-title>
                  <v-list-item-subtitle>{{list_deal_view.deal_status}}</v-list-item-subtitle>
                </v-list-item-content>
              </v-list-item>
              <v-divider></v-divider>
              <v-list-item>
                <v-list-item-content>
                  <v-list-item-title class="tile">Amount</v-list-item-title>
                  <v-list-item-subtitle>{{list_deal_view.deal_amount}}</v-list-item-subtitle>
                </v-list-item-content>
              </v-list-item>
              <v-divider></v-divider>
              <v-list-item>
                <v-list-item-content>
                  <v-list-item-title class="tile">Currency</v-list-item-title>
                  <v-list-item-subtitle>{{list_deal_view.deal_currency}}</v-list-item-subtitle>
                </v-list-item-content>
              </v-list-item>
              <v-divider></v-divider>
              <v-list-item>
                <v-list-item-content>
                  <v-list-item-title class="tile">Date</v-list-item-title>
                  <v-list-item-subtitle>{{list_deal_view.deal_date}}</v-list-item-subtitle>
                </v-list-item-content>
              </v-list-item>
              <v-divider></v-divider>
              <v-list-item>
                <v-list-item-content>
                  <v-list-item-title class="tile">Contact</v-list-item-title>
                  <v-list-item-subtitle>{{list_deal_view.deal_contact}}</v-list-item-subtitle>
                </v-list-item-content>
              </v-list-item>
              <v-divider></v-divider>
              <v-list-item>
                <v-list-item-content>
                  <v-list-item-title class="tile">Source</v-list-item-title>
                  <v-list-item-subtitle>{{list_deal_view.deal_source}}</v-list-item-subtitle>
                </v-list-item-content>
              </v-list-item>
              <v-divider></v-divider>
              <v-list-item>
                <v-list-item-content>
                  <v-list-item-title class="tile">Source Information & Notes</v-list-item-title>
                  <v-list-item-subtitle>{{list_deal_view.deal_info_notes}}</v-list-item-subtitle>
                </v-list-item-content>
              </v-list-item> 
            </v-list>
          </v-card>
        </v-dialog>
        <!-- view Deal end  -->
        <div id="app">
          <v-app id="inspire">
            <div>
              <v-sheet
                tile
                height="54"
                class="d-flex"
              >
                <v-btn
                  icon
                  class="ma-2"
                  @click="$refs.calendar.prev()"
                >
                  <v-icon>{{icons.mdiChevronLeft}}</v-icon>
                </v-btn>
                <v-select
                  v-model="type"
                  :items="types"
                  dense
                  outlined
                  hide-details
                  class="ma-2"
                  label="type"
                ></v-select>
                <!-- <v-select
                  v-model="mode"
                  :items="modes"
                  dense
                  outlined
                  hide-details
                  label="event-overlap-mode"
                  class="ma-2"
                ></v-select> -->
                <v-select
                  v-model="weekday"
                  :items="weekdays"
                  dense
                  outlined
                  hide-details
                  label="weekdays"
                  class="ma-2"
                ></v-select>
                <v-spacer></v-spacer>
                <v-btn
                  icon
                  class="ma-2"
                  @click="$refs.calendar.next()"
                >
                  <v-icon>{{icons.mdiChevronRight}}</v-icon>
                </v-btn>
              </v-sheet>
              <v-sheet height="600">
                <v-calendar
                  ref="calendar"
                  v-model="value"
                  event-more-text="{0} tasks hidden" 
                  :weekdays="weekday"
                  :type="type"
                  :events="events"
                  event-overlap-mode="stack"
                  :event-overlap-threshold="30"
                  :event-color="getEventColor"
                  @click:event="showEvent"
                  @click:more="viewDay"
                ></v-calendar>
                <v-menu
                v-model="selectedOpen"
                :close-on-content-click="false"
                :activator="selectedElement"
                offset-x
                >
                <v-card
                color="grey lighten-4"
                min-width="350px"
                flat
                >
                <v-toolbar
                    :color="selectedEvent.color"
                    dark
                >   
                    <!-- <v-btn icon @click="editTask()">
                    <v-icon>{{icons.mdiPencil}}</v-icon>
                    </v-btn> -->
                    <v-toolbar-title v-html="selectedEvent.name"></v-toolbar-title>
                    <v-spacer></v-spacer>
                    <!-- <v-btn icon>
                    <v-icon>{{icons.mdiHeart}}</v-icon>
                    </v-btn> -->
                </v-toolbar>
                <br>
                <v-card-text>
                    <p> Responsible Person : {{selectedEvent.taskRespPerson}}</p>
                    <p>Start Date : {{selectedEvent.start}}</p>
                    <p>Deadline : {{selectedEvent.end}}</p>
                    <p>Summery : {{selectedEvent.taskSummery}}</p>

                </v-card-text>
                <v-card-actions>
                    <v-btn
                    color="secondary"
                    @click="selectedOpen = false"
                    >
                    Cancel
                    </v-btn>
                </v-card-actions>
                </v-card>
              </v-menu>
              </v-sheet>
            </div>
          </v-app>
        </div>
            <v-tabs  vertical>
                <v-tab  class="indigo3">
                    New
                </v-tab>
                <v-icon
                >
                    {{icons.mdiArrowDownThick}}
                    
                </v-icon>
                <!-- <v-icon
                >
                    {{icons.mdiArrowBottomLeftThick}}   
                    
                </v-icon> -->
                <v-tab  class="indigo3">
                    In progress
                </v-tab>
                <!-- <v-icon
                >
                    {{icons.mdiArrowDownBoldOutline}}
                </v-icon> -->
                <v-icon
                >
                    {{icons.mdiArrowDownThick}}
                    
                </v-icon>
                <v-tab  class="indigo3">
                    Final
                </v-tab>
                <v-tab-item>
                    <v-timeline
                         align-top
                        :dense="$vuetify.breakpoint.smAndDown" 
                        >
                        <v-timeline-item
                            fill-dot
                            color="indigo3"
                            v-for="item in list_deal_new" :key="item.deal_id"
                        >
                            <v-card
                            color="indigo3"
                            dark
                            class="justify-center"
                            >
                            <v-card-title class="text-h6" >
                                 {{item.deal_name}} 
                            </v-card-title>
                            <v-card-text class="white text--primary">
                                <h3>
                                   Contact :  {{item.deal_contact}}
                                </h3>
                                <p >
                                   Date : {{item.deal_date}}
                                </p>
                                <h3>
                                   Amount : {{item.deal_amount}} {{item.deal_currency}}
                                </h3>
                            </v-card-text>
                            
                            <v-card-actions class="d-flex justify-center">
                                <v-btn  color="primary" 
                                @click="viewItem(item.deal_id)">
                                 View Details
                                 </v-btn>
                            </v-card-actions>
                            </v-card>
                        </v-timeline-item>
                    </v-timeline>
                </v-tab-item>
                <v-tab-item>
                    <v-timeline
                         align-top
                        :dense="$vuetify.breakpoint.smAndDown" 
                        >
                        <v-timeline-item
                            fill-dot
                            color="indigo3"
                            v-for="item in list_deal_in_progress" :key="item.deal_id"
                        >
                            <v-card
                            color="indigo3"
                            dark
                            class="justify-center"
                            >
                            <v-card-title class="text-h6" >
                                 {{item.deal_name}} 
                            </v-card-title>
                            <v-card-text class="white text--primary">
                                <h3>
                                   Contact :  {{item.deal_contact}}
                                </h3>
                                <p >
                                   Date : {{item.deal_date}}
                                </p>
                                <h3>
                                   Amount : {{item.deal_amount}} {{item.deal_currency}}
                                </h3>
                            </v-card-text>
                            
                            <v-card-actions class="d-flex justify-center">
                                <v-btn  color="primary" 
                                @click="viewItem(item.deal_id)">
                                 View Details
                                 </v-btn>
                            </v-card-actions>
                            </v-card>
                        </v-timeline-item>
                    </v-timeline>
                </v-tab-item>
                <v-tab-item>
                    <v-timeline
                         align-top
                        :dense="$vuetify.breakpoint.smAndDown" 
                        >
                        <v-timeline-item
                            fill-dot
                            color="indigo3"
                            v-for="item in list_deal_final" :key="item.deal_id"
                        >
                            <v-card
                            color="indigo3"
                            dark
                            class="justify-center"
                            >
                            <v-card-title class="text-h6" >
                                 {{item.deal_name}} 
                            </v-card-title>
                            <v-card-text class="white text--primary">
                                <h3>
                                   Contact :  {{item.deal_contact}}
                                </h3>
                                <p >
                                   Date : {{item.deal_date}}
                                </p>
                                <h3>
                                   Amount : {{item.deal_amount}} {{item.deal_currency}}
                                </h3>
                            </v-card-text>
                            
                            <v-card-actions class="d-flex justify-center">
                                <v-btn  color="primary" 
                                @click="viewItem(item.deal_id)">
                                 View Details
                                 </v-btn>
                            </v-card-actions>
                            </v-card>
                        </v-timeline-item>
                    </v-timeline>
                </v-tab-item>   
            </v-tabs>
          </v-card>
        </v-app>  
        <!-- <div  v-for="(item,index,key) in list_deal" :key="item.deal_id">
             {{item}}
             index : {{index}} <br>

             key : {{key}} 
        </div> -->
    </div>
</template>

<script>
import axios from "axios";
import {
  mdiNewBox,
  mdiMenuDown,
  mdiArrowDownDropCircle,
  mdiArrowDownBold,
  mdiArrowDownBoldOutline,
  mdiArrowDownBoldBox,
  mdiCloseThick,
  mdiArrowBottomRightThick,
  mdiArrowBottomLeftThick,
  mdiArrowDownThick,
  mdiAt,
  mdiChevronLeft,
  mdiChevronRight,
  mdiHeart,
  mdiPencil,
} from '@mdi/js'
    export default {
    data() {
        return {
            editedIndex: -1,
            id:'',
            desserts: [],
            list_deal:[],
            list_deal_view:[],
            list_deal_new:[],
            list_deal_in_progress:[],
            list_deal_final:[],
            icons: {
               mdiNewBox,
               mdiMenuDown,
               mdiArrowDownDropCircle,
               mdiArrowDownBold,
               mdiArrowDownBoldOutline,
               mdiArrowDownBoldBox,
               mdiCloseThick,
               mdiArrowBottomRightThick,
               mdiArrowBottomLeftThick,
               mdiArrowDownThick,
               mdiAt,
               mdiChevronLeft,
               mdiChevronRight,
               mdiHeart,
               mdiPencil,
            },
            editedItem: {
                id:'',
                task_name: '',
                responsible_person: '',
                mention_person: '',
                start_date:'',
                end_date:'',
                summery:'',
                sub_task: '',
            },
            dialog: false,
            valid:true,
            resPerRules: [
              v => !!v || 'Responsible Person is required',
            ],
            startDateRules :  [
              v => !!v || 'Start Date is required',
            ],
            endDateRules : [
              v => !!v || 'Deadline is required',
            ],
            responsible_person_items:[],
            mention_person_items:[],
            sub_task_items:[],
            dialogview : false,
            type: 'month',
            types: ['month', 'week', 'day', '4day'],
            mode: 'stack',
            modes: ['stack', 'column'],
            weekday: [0, 1, 2, 3, 4, 5, 6],
            weekdays: [
              { text: 'Sun - Sat', value: [0, 1, 2, 3, 4, 5, 6] },
              { text: 'Mon - Sun', value: [1, 2, 3, 4, 5, 6, 0] },
              { text: 'Mon - Fri', value: [1, 2, 3, 4, 5] },
              { text: 'Mon, Wed, Fri', value: [1, 3, 5] },
            ],
            value: '',
            events: [],
            colors: ['blue', 'indigo','cyan', 'green', 'orange', 'deeppurple1', 'brown4', 'bluegrey1', 'indigo1'],
            names: [],
            selectedOpen: false,
            selectedElement: null,
            detailshtml:'detailshtml',
            namehtml:'namehtml',
            selectedEvent: {},
            list_tasks : [],
         
            
        }
    },
    // computed  start
    computed: {
      
    },
    // computed  end
    // watch  start
    watch: {
      dialog (val) {
        val || this.close()
        this.$refs.form.reset()
      },
      
    },
   // watch  end
    methods: {
        save () {
          // start axios of insert cst to database
              var that=this;
              var notif_case = that.$refs.form.validate();
              if (  notif_case ) {  
                          axios.get('saveTask/', {
                          params: {
                              name_task: this.editedItem.task_name,
                              responsible_person_task: this.editedItem.responsible_person,
                              mention_person_task:this.editedItem.mention_person,
                              date_start_task:this.editedItem.start_date,
                              date_end_task:this.editedItem.end_date,
                              summery_task:this.editedItem.summery,
                              sub_task:this.editedItem.sub_task,
                                  }  
                            }).then(() => {
                                  window.location.reload();
                                  that.$notify({
                                  title:'Congratulation',
                                  text: 'Data Saved Succefully',
                                  type: 'success',
                                  speed: 1000,
                                  duration: 1000,
                                  position:'top center',
                                  })  
                                            
                                  })
                              .catch((error) => 
                              console.log(getError(error))
                              (this.error = getError(error)));
            if (this.editedIndex > -1) {
              Object.assign(this.events[this.editedIndex], this.editedItem)
            } else {
              this.events.push(this.editedItem)
            }
                            
           // end axios of insert cst to database            
            if (  this.$refs.form.validate() ) {
              console.log('test validate from close', this.$refs.form.validate())
                      this.close()
            } 
              }
          },
         initialize () {
          var tasks_all = []
                axios.get('/fetchUsersTask')
                    .then((response)=>{
                        // this.mention_person_items = response.data.list_users 
                        // this.list_tasks = JSON.parse(JSON.stringify(response.data.list_tasks));
               
                        this.name  = response.data.list_sub_tasks.map(function (obj) {
                        return obj.task_name;
                        });
                        this.responsible_person_items  = response.data.list_users.map(function (obj) {
                        return obj.name;
                        });
                        this.mention_person_items  = response.data.list_users.map(function (obj) {
                        return obj.name;
                        });
                        this.sub_task_items  = response.data.list_sub_tasks.map(function (obj) {
                        return obj.task_name;
                        });

                        // this.list_tasks = response.data.list_tasks[Object.keys(response.data.list_tasks)[0]]
                        this.list_tasks = response.data.list_tasks
                        console.log('inside the axios response',  this.list_tasks )
                        for (let i = 0; i < this.list_tasks.length ; i++) {
                        this.events.push({
                            name : this.list_tasks[i].task_name,
                            // start: '2022-07-05 00:00:01',
                            // end: '2022-07-06 00:00:01',
                            start : this.list_tasks[i].task_date,
                            end :  this.list_tasks[i].task_end_date,
                            // color: this.colors[i],
                            color: this.colors[this.rnd(i-1, i)],
                            taskRespPerson : this.list_tasks[i].task_resp_person,
                            taskMention1Person : this.list_tasks[i].task_mention_person,
                            taskSummery : this.list_tasks[i].task_summery,
                            timed: true,
                          })
                        }
                        
                        console.log('date format', this.events[3].start)
                                     });
                        //  this.list_tasks = JSON.parse(JSON.stringify(response.data.list_tasks));
                        //  this.list_tasks = response.data.list_tasks
                      //  this.list_tasks  = JSON.parse(JSON.stringify(tasks_all));
                      //  this.list_tasks = Object.tasks_all(data.map(e => e.split(":")))
                      //  this.list_tasks = Object.assign(tasks_all);
                        // this.list_tasks.push(tasks_all)
                        console.log('outside the axios response',  this.sub_task_items )
                
        },
        close () {
              this.dialog = false
              this.$nextTick(() => {
              this.editedItem = Object.assign({}, this.defaultItem)
              this.editedIndex = -1
            })
        },
        editTask (item) {
          console.log('welcome from edit function')
          this.editedIndex = this.desserts.indexOf(item)
          this.editedItem = Object.assign({}, item)
          this.dialog = true
        },
        rnd (a, b) {
          return Math.floor((b - a + 1) * Math.random()) + a
        },
         viewDay ({ date }) {
          this.value = date
          this.type = 'day'
        },
      //   getEvents ({ start, end }) {
      //   const events = []

      //   const min = new Date(`${start.date}T00:00:00`)
      //   const max = new Date(`${end.date}T23:59:59`)
      //   const days = (max.getTime() - min.getTime()) / 86400000
      //   // const eventCount = this.rnd(days, days + 20)

       
      //     const allDay = 4
      //     // const firstTimestamp = this.rnd(min.getTime(), max.getTime())
      //     // const first = new Date(firstTimestamp - (firstTimestamp % 900000))
      //     // const secondTimestamp = this.rnd(2, allDay ? 288 : 8) * 900000
      //     // const second = new Date(first.getTime() + secondTimestamp)
      //     const firstTimestamp =min
      //     const first = new Date(firstTimestamp - (firstTimestamp % 900000))
      //     const secondTimestamp = max
      //     const second = new Date(first.getTime() + secondTimestamp)
         
      //     console.log('this.list_tasks', this.list_tasks)
        
          
      //     // events.push({
      //     //   name:   'this.list_tasks[0][0].task_name',
      //     //   start: '2022-07-05 00:00:01',
      //     //   // end: 'Fri Jul 04 2022 00:00:00',
      //     //   // end: '2022-07-05 00:00:01',

      //     //   color: this.colors[1],
      //     //   details:'some test details',
      //     //   timed: true,
      //     // })
        

      //   // this.events = events
      //   // console.log('events',this.events)
      // },
      getEventColor (event) {
        return event.color
      },
      // rnd (a, b) {
      //   return Math.floor((b - a + 1) * Math.random()) + a
      // },
        // viewItem (item) {
        //     this.editedIndex = this.list_deal.indexOf(item)
        //     this.editedItem = Object.assign({}, item)
        //     this.dialogview = true
        // }, 
        showEvent ({ nativeEvent, event }) {
        const open = () => {
            this.selectedEvent = event
            this.selectedElement = nativeEvent.target
            requestAnimationFrame(() => requestAnimationFrame(() => this.selectedOpen = true))
        }

        if (this.selectedOpen) {
            this.selectedOpen = false
            requestAnimationFrame(() => requestAnimationFrame(() => open()))
        } else {
            open()
        }

        nativeEvent.stopPropagation()
        },
        viewItem (item1) {
          console.log('item1',item1)
            this.list_deal.forEach((item2) => {
            if (item1 === item2.deal_id){
                this.list_deal_view = item2 ;
                console.log('item2',this.list_deal_view )
                
            }
            });
            this.dialogview = true

        }, 

      
    },
    // computed: 
    // {
    //    p1 ()  {
    //    return this.list_tasks[0] ? this.list_tasks[0].value : 'Loading'
    //   } 
    // } ,
    mounted() {
         
    },
    // created  start
    created () {
      this.initialize()
    
    },
    // created  end
}

</script>

<style scoped>
.v-tab {
    align-items: center;
    cursor: pointer;
    display: flex;
    flex: 0 1 auto;
    font-size: 0.875rem;
    font-weight: 500;
    justify-content: left!important;
    letter-spacing: 0.0892857143em;
    line-height: normal;
    min-width: 90px;
    max-width: 360px;
    outline: none;
    padding: 0 16px;
    position: relative;
    text-align: center;
    text-decoration: none;
    text-transform: uppercase;
    transition: none;
    user-select: none;
    font-weight:900!important;
    font-size:15px!important;
    color:black;
    /* background-color:rgb(190, 180, 206)!important; */
    /* margin-top: 10px; */
    
}

.red_color{
  color:red;
}
.text_color{
   color: red!important;
}

.theme--dark.v-sheet h1, 
.theme--dark.v-sheet h2, 
.theme--dark.v-sheet h3, 
.theme--dark.v-sheet h4,
.theme--dark.v-sheet h5, 
.theme--dark.v-sheet h6 {
    color: var(--v-primary-base)  !important;
}

.tile{
  color:var(--v-primary-base);
  font-weight:700;
}

</style>