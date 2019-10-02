<template>
       <div class="col-md-8 col-sm-12 " id="grid">
                <div class="parking-grid">
                    <div class="row">
                        <div class="col-1"></div>
                        <div class="col-1 "></div>
                        <!-- <div class="col-md-1 parkingslot-booked-right parkingslot-border-left-top " id="1"><img class="parking-car-right" src="img/car.png" width="100%" alt=""></div> -->
                        <div class="col-1 parkingslot-available-right parkingslot-border-left-top " @click="displayModal(1)" id="1">1</div>
                        <div class="col-1 parkingslot-available-right parkingslot-border-left-top " @click="displayModal(2)" id="2">2</div>
                        <div class="col-1 parkingslot-available-right parkingslot-border-left-top " @click="displayModal(3)" id="3">3</div>
                        <div class="col-1 parkingslot-available-right parkingslot-border-left-top " @click="displayModal(4)" id="4">4</div>
                        <div class="col-1 parkingslot-available-right parkingslot-border-left-top " @click="displayModal(5)" id="5">5</div>
                        <div class="col-1 parkingslot-available-right parkingslot-border-left-top " @click="displayModal(6)" id="6">6</div>
                        <div class="col-1 parkingslot-available-right parkingslot-border-left-top " @click="displayModal(7)" id="7">7</div>
                        <div class="col-1 parkingslot-available-right parkingslot-border-left-top parkingslot-border-right " @click="displayModal(8)" id="8">8
                        </div>
                        <div class="col-md-1 "></div>
                        <div class="col-md-1 "></div>
                    </div>
                    <div class="row ">
                        <div class="col-md-12 path ">

                        </div>
                    </div>
                    <div class="row ">
                        <div class="col-md-1 "></div>
                        <div class="col-md-1 "></div>
                        <div class="col-md-1 parkingslot-available-left parkingslot-border-left " @click="displayModal(9)" id="9">9</div>
                        <div class="col-md-1 parkingslot-available-left parkingslot-border-left " @click="displayModal(10)" id="10">10</div>
                        <!-- <div class="col-md-1 parkingslot-booked-left parkingslot-border-left "><img class="parking-car-left" src="img/car.png" width="100%" alt=""></div> -->
                        <div class="col-md-1 parkingslot-available-left parkingslot-border-left " @click="displayModal(11)" id="11">11</div>
                        <div class="col-md-1 parkingslot-available-left parkingslot-border-left " @click="displayModal(12)" id="12">12</div>
                        <div class="col-md-1 parkingslot-available-left parkingslot-border-left " @click="displayModal(13)" id="13">13</div>
                        <div class="col-md-1 parkingslot-available-left parkingslot-border-left " @click="displayModal(14)" id="14">14</div>
                        <div class="col-md-1 parkingslot-available-left parkingslot-border-left " @click="displayModal(15)" id="15"> 15</div>
                        <div class="col-md-1 parkingslot-available-left parkingslot-border-left parkingslot-border-right " @click="displayModal(16)" id="16">16</div>
                        <div class="col-md-1 "></div>
                        <div class="col-md-1 "></div>
                        <div class="col-md-1 "></div>
                        <div class="col-md-1 "></div>
                        <div class="col-md-1 parkingslot-available-right parkingslot-border-left-top " @click="displayModal(17)" id="17">17</div>
                        <div class="col-md-1 parkingslot-available-right parkingslot-border-left-top " @click="displayModal(18)" id="18">18</div>
                        <div class="col-md-1 parkingslot-available-right parkingslot-border-left-top " @click="displayModal(19)" id="19">19</div>
                        <div class="col-md-1 parkingslot-available-right parkingslot-border-left-top " @click="displayModal(20)" id="20">20</div>
                        <div class="col-md-1 parkingslot-available-right parkingslot-border-left-top " @click="displayModal(21)" id="21">21</div>
                        <div class="col-md-1 parkingslot-available-right parkingslot-border-left-top " @click="displayModal(22)" id="22">22</div>
                        <div class="col-md-1 parkingslot-available-right parkingslot-border-left-top " @click="displayModal(23)" id="23">23</div>
                        <div class="col-md-1 parkingslot-available-right parkingslot-border-left-top parkingslot-border-right " @click="displayModal(24)" id="24">24
                        </div>
                        <div class="col-md-1 "></div>
                        <div class="col-md-1 "></div>
                    </div>
                    <div class="row ">
                        <div class="col-md-12 path ">

                        </div>
                    </div>
                    <div class="row justify-content-around ">
                        <div class="col-md-1 entrance "><i class="material-icons">arrow_upward</i> Entrance</div>
                        <div class="col-md-5 "><img src="img/hospital.png" width="100% " alt=" "></div>
                        <div class="col-md-1 entrance ">Exit &nbsp; <i class="material-icons">arrow_downward</i></div>
                    </div>
                </div>



            <div class="modal fade" tabindex="-1" role="dialog" id="enterReservationId">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Send Message</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent="sendMessage()" @keydown="form.onKeydown($event)">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="type">Staff Type</label>
                            <select v-model="form.message_id" type="text" name="message_id"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('message_id') }" id="message_id">
                                    <option value="" >Select message type</option>
                                    <option  v-for="template in templates" :key="template.id" :value="template.id">{{ template.title }}</option>
                                </select>
                            <has-error :form="form" field="type"></has-error>
                            </div>
                        </div>
                            <div class="container mb-3">
                                <button type="submit" v-show="!processing" class="btn btn-success mb-2 w-100">Proceed</button>
                                <button type="button" class="btn btn-secondary w-100" data-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
                </div>

            </div>
</template>

<script>
    export default {
        components: { VueTimepicker },
        data() {
            return {
                b_name : 'Block 1',
                parked_slots : '',
                reserved_slots : '',
                isReserved : false,
                time: null,
                parking_id: '',
                slot_id: '',
                processing: false,
                templates: {},
                form: new Form({
                    slot_id: '',
                    message_id: ''
                }),
            }
        },
        computed : {
            blockName() {
                return this.b_name;
            }
        },
        mounted() {
            this.loadTempates();
            this.refreshGrid();
                this.$on('updateGrid', () => {
                    this.refreshGrid()
                })
            setInterval(() => {
                this.checkExpireReservations();
            }, 50000);
        },
        methods: {
            checkExpireReservations() {
                axios.get('api/reserve/expire')
                .then(({ data }) => {
                    this.refreshGrid();
                })
                .catch((err) => {
                    console.log(err);
                })
            },
            loadTempates() {
                  this.$Progress.start();
                  axios.get('api/message')
                  .then(({ data }) => {
                      this.templates = data;
                      this.$Progress.finish();
                      })
          },
            sendMessage() {
                this.$Progress.start();
                this.processing = true;
                let park_type;
                    if (this.parked_slots.includes(this.slot_id)) {
                        park_type = 'paraked';
                    } else {
                        park_type = 'reserved';
                    }
                axios.post('api/message/send', { message_id: this.form.message_id, slot_id: this.slot_id, type: park_type }).then(({ data }) => {
                    if (data.status == 200) {
                        $('#enterReservationId').modal('hide');
                        this.$Progress.finish();
                        this.processing = false;
                        swal("Success!", "Message sent successfully!", "success", { timer: 2000 });
                    } else {
                        $('#enterReservationId').modal('hide');
                        this.$Progress.fail();
                        this.processing = false;
                        swal("Error!", data.message, "error", { timer: 5000 });
                    }
                }).catch((err) => {

                })
            },
            setTrue() {
                this.onlyTime = true;
            },
            displayModal(id) {
                if (this.parked_slots.includes(id) || this.reserved_slots.includes(id)) {
                    this.slot_id = id;
                   $('#enterReservationId').modal('show');
                }
            },
            refreshGrid() {
                axios.get('api/parking').then(({ data }) => {
                this.parked_slots = data.parked.map(slot => {
                    return slot.id;
                });
                this.reserved_slots = data.reserved.map(slot => {
                    return slot.id;
                });
                data.reserved.forEach(slot => {
                    let ls = [9, 10, 11, 12, 13, 14, 15, 16];
                    if (ls.includes(slot.id)) {
                        $('#' + slot.id).removeClass('parkingslot-available-left');
                        $('#' + slot.id).addClass('parkingslot-reserved-left');
                    } else {
                        $('#' + slot.id).removeClass('parkingslot-available-right');
                        $('#' + slot.id).addClass('parkingslot-reserved-right');
                    }
                });
                data.parked.forEach(slot => {
                    let ls = [9, 10, 11, 12, 13, 14, 15, 16];
                    if (ls.includes(slot.id)) {
                        $('#' + slot.id).removeClass('parkingslot-reserved-left');
                        $('#' + slot.id).removeClass('parkingslot-available-left');
                        $('#' + slot.id).addClass('parkingslot-booked-left');
                        $('#' + slot.id).html('<img class="parking-car-left" src="img/car.png" width="100%" alt="">');
                    } else {
                        $('#' + slot.id).removeClass('parkingslot-reserved-right');
                        $('#' + slot.id).removeClass('parkingslot-available-right');
                        $('#' + slot.id).addClass('parkingslot-booked-right');
                        $('#' + slot.id).html('<img class="parking-car-right" src="img/car.png" width="100%" alt="">');
                    }
                });
                data.free.forEach(slot => {
                    let ls = [9, 10, 11, 12, 13, 14, 15, 16];
                    if (ls.includes(slot.id)) {
                        $('#' + slot.id).removeClass('parkingslot-booked-left');
                        $('#' + slot.id).removeClass('parkingslot-reserved-left');
                        $('#' + slot.id).addClass('parkingslot-available-left');
                        $('#' + slot.id).html(slot.id);
                    } else {
                        $('#' + slot.id).removeClass('parkingslot-booked-right');
                        $('#' + slot.id).removeClass('parkingslot-reserved-right');
                        $('#' + slot.id).addClass('parkingslot-available-right');
                        $('#' + slot.id).html(slot.id);
                    }
                });
            }).catch(err => console.log(err));
            },
        }
    }
</script>
