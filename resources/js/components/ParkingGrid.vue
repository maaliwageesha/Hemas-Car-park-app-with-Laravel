<template>
       <div class="col-md-8 col-sm-12" style="margin-top:100px" id="grid">
                <div class="parking-grid ">
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

            <div class="modal fade" id="addnewuser" tabindex="-1" role="dialog" aria-labelledby="addnewuser" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 v-text="b_name"></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                            <div class="container">
                            <ul class="nav nav-pills mt-2 d-flex justify-content-between" >
                            <li class="nav-item w-50">
                                <a class="nav-link active" href="#parkNow" role="tab" data-toggle="tab">Park Now</a>
                            </li>
                            <li class="nav-item w-50">
                                <a class="nav-link" href="#reserve" role="tab" data-toggle="tab">Reserve</a>
                            </li>
                        </ul>
                            </div>
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="parkNow">
                                <form @submit.prevent="createUser()" @keydown="form.onKeydown($event)">
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="name">Name</label>
                                                    <input v-model="form.name" type="text" name="name"
                                                        class="form-control" :class="{ 'is-invalid': form.errors.has('name') }" placeholder="e.g: John Doe" id="name">
                                                    <has-error :form="form" field="name"></has-error>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="phone_number">Phone Number</label>
                                                    <input v-model="form.phone_number" type="text" name="phone_number"
                                                        class="form-control" :class="{ 'is-invalid': form.errors.has('phone_number') }" placeholder="e.g: 07********" id="phone_number">
                                                    <has-error :form="form" field="phone_number"></has-error>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input v-model="form.email" type="text" name="email"
                                                class="form-control" :class="{ 'is-invalid': form.errors.has('email') }" placeholder="e.g: johndoe@gmail.com" id="email">
                                            <has-error :form="form" field="email"></has-error>
                                        </div>
                                        <h5 class="text-center">or</h5>
                                        <div class="form-group">
                                            <label for="name">Reservation ID</label>
                                        <input v-model="form3.reservation_code" type="text" name="reservation_code"
                                            class="form-control" :class="{ 'is-invalid': form3.errors.has('reservation_code') }" placeholder="e.g: S-7855 or R-7855" id="reservation_code">
                                        <has-error :form="form3" field="reservation_code"></has-error>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-success">Proceed</button>
                                    </div>
                                    </form>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="reserve">
                                <form @submit.prevent="reserveSlot()" @keydown="form.onKeydown($event)">
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="name">Name</label>
                                                    <input v-model="form2.name" type="text" name="name"
                                                    class="form-control" :class="{ 'is-invalid': form2.errors.has('name') }" placeholder="e.g: John Doe" id="name">
                                                    <has-error :form="form2" field="name"></has-error>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="phone_number">Phone Number</label>
                                                    <input v-model="form2.phone_number" type="text" name="phone_number"
                                                        class="form-control" :class="{ 'is-invalid': form2.errors.has('phone_number') }" placeholder="e.g: 07********" id="phone_number">
                                                    <has-error :form="form2" field="phone_number"></has-error>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                        <input v-model="form2.email" type="text" name="email"
                                            class="form-control" :class="{ 'is-invalid': form2.errors.has('email') }" placeholder="e.g: johndoe@gmail.com" id="email">
                                        <has-error :form="form2" field="email"></has-error>
                                        </div>
                                        <h5 class="text-center">or</h5>
                                        <div class="form-group">
                                            <label for="name">Staff Reservation ID</label>
                                        <input v-model="form3.reservation_code" type="text" name="reservation_code"
                                            class="form-control" :class="{ 'is-invalid': form3.errors.has('reservation_code') }" placeholder="e.g: S-7855" id="reservation_code">
                                        <has-error :form="form3" field="reservation_code"></has-error>
                                        </div>
                                        <div class="form-group d-flex justify-content-around">
                                            <div class="mt-2"><label for="email">Reserved Time</label></div>
                                            <div>
                                                <vue-timepicker v-model="reserved_time"></vue-timepicker>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" v-show="!processing" class="btn btn-danger">Reserve</button>
                                    </div>
                                    </form>
                            </div>
                        </div>
                </div>
                </div>
            </div>


            <div class="modal fade" tabindex="-1" role="dialog" id="enterPhoneNumber">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Ending Session</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent="userCheckout()" @keydown="form.onKeydown($event)">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="phoneOrId">Your Phone Number or Reservation Code</label>
                                <input v-model="form1.phoneOrId" type="text" name="phoneOrId"
                                    class="form-control" :class="{ 'is-invalid': form1.errors.has('phoneOrId') }" placeholder="Enter Your Phone Number or Reservation Code" id="phoneOrId" aria-describedby="helpId">
                                <small id="helpId" class="text-muted">To end your session you have to be in sys</small>
                                <has-error :form="form1" field="phoneOrId"></has-error>
                                <!-- <input type="text" name="phoneOrId" id="phoneOrId" class="form-control" placeholder="Enter Your Phone Number or Reservation Code" aria-describedby="helpId"> -->
                            </div>
                        </div>
                            <div class="container mb-3">
                                <button type="submit" class="btn btn-primary mb-2 w-100">End Session</button>
                                <button type="button" class="btn btn-secondary w-100" data-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                </div>

                </div>

            <div class="modal fade" tabindex="-1" role="dialog" id="enterReservationId">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Park Your Vehicle</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent="reservedUserCheckout()" @keydown="form.onKeydown($event)">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="reservation_code">Your Reservation Code</label>
                                <input v-model="form3.reservation_code" type="text" name="reservation_code"
                                    class="form-control" :class="{ 'is-invalid': form3.errors.has('reservation_code') }" placeholder="Enter Your Reservation Code Here.." id="reservation_code" aria-describedby="helpId">
                                <small id="helpId" class="text-muted">Enter your reservation code for park your vehicle here</small>
                                <has-error :form="form3" field="reservation_code"></has-error>
                                <!-- <input type="text" name="phoneOrId" id="phoneOrId" class="form-control" placeholder="Enter Your Phone Number or Reservation Code" aria-describedby="helpId"> -->
                            </div>
                        </div>
                            <div class="container mb-3">
                                <button type="submit" class="btn btn-success mb-2 w-100">Proceed</button>
                                <button type="button" class="btn btn-secondary w-100" data-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                </div>

                </div>

                <div class="modal fade" tabindex="-1" role="dialog" id="paymentDetails">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Payment Details</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                        <div class="modal-body d-flex mt-3">
                            <div>
                                <div><h5>Reservation ID</h5></div>
                                <div><h5>Contact Number</h5></div>
                                <div><h5>In Time</h5></div>
                                <div><h5>Out Time</h5></div>
                                <div><h5>Total Time</h5></div>
                                <div><h4 class="text-bold">Charge</h4></div>
                            </div>
                            <div class="ml-4">
                                <div><h5>-</h5></div>
                                <div><h5>-</h5></div>
                                <div><h5>-</h5></div>
                                <div><h5>-</h5></div>
                                <div><h5>-</h5></div>
                            </div>
                            <div class="ml-4">
                                <h5><span id="ri" class="mb-4 pb-4">S-6890</span></h5>
                                <h5><span id="cn" class="mb-4 pb-4">0712381996</span></h5>
                                <h5><span id="in_time" class="">7 : 34 p.m</span></h5>
                                <h5><span id="out_time">10 : 00 p.m</span></h5>
                                <h5><span id="total_time">2h 15m</span></h5>
                                <h4><span id="charge">LKR 500</span></h4>
                            </div>
                        </div>
                            <div class="container mt-3 mb-3">
                                <button type="submit" class="btn btn-success mb-2 w-100" @click="openPaymentModal">Pay</button>
                                <button type="button" class="btn btn-secondary w-100" data-dismiss="modal">Close</button>
                            </div>
                    </div>
                </div>
                </div>
                <div class="modal fade" tabindex="-1" role="dialog" id="feedbackModal">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Your Feedback</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                            <form @submit.prevent="sendFeedback()" @keydown="form.onKeydown($event)">
                                <div class="modal-body mt-2">
                                <div class="form-group">
                                    <label for="feedback">You can help us to improve this app</label>
                                    <input v-model="form4.feedback" type="text" name="feedback"
                                    class="form-control" :class="{ 'is-invalid': form4.errors.has('feedback') }" placeholder="e.g: This is a great app :)" id="feedback">
                                    <has-error :form="form4" field="feedback"></has-error>
                                </div>
                                <div class="wrap">
                                    <ul class="stars" >
                                        <li title="5" @click="showStars(5)"></li>
                                        <li title="4" @click="showStars(4)"></li>
                                        <li title="3" @click="showStars(3)"></li> <!--pre selected -->
                                        <li title="2" @click="showStars(2)"></li>
                                        <li title="1" @click="showStars(1)"></li>
                                    </ul>
                                    <input id="rating" type="hidden" class="required">
                                    <input id="ratingval" v-model="form4.rating" name="rating" type="hidden">
                                </div>

                            </div>
                                <div class="container mt-2 mb-3">
                                    <button type="submit" class="btn btn-danger mb-2 w-100">Submit</button>
                                    <button type="button" class="btn btn-secondary w-100" data-dismiss="modal">Close</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="paymentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
<div class="card-body p-1">

<ul class="nav bg-light nav-pills rounded nav-fill mb-3" role="tablist">
	<li class="nav-item">
		<a class="nav-link active" data-toggle="pill" href="#nav-tab-card">
		<i class="fa fa-credit-card"></i> Credit Card</a></li>
	<li class="nav-item">
		<a class="nav-link" data-toggle="pill" href="#nav-tab-paypal">
		<i class="fab fa-paypal"></i>  Paypal</a></li>
	<li class="nav-item">
		<a class="nav-link" data-toggle="pill" href="#nav-tab-bank">
		<i class="fa fa-university"></i>  Bank Transfer</a></li>
</ul>

<div class="tab-content">
<div class="tab-pane fade show active" id="nav-tab-card">
	<p class="alert alert-success">Some text success or error</p>
	<form role="form">
	<div class="form-group">
		<label for="username">Full name (on the card)</label>
		<input type="text" class="form-control" name="username" placeholder="" required="">
	</div> <!-- form-group.// -->

	<div class="form-group">
		<label for="cardNumber">Card number</label>
		<div class="input-group">
			<input type="text" class="form-control" name="cardNumber" placeholder="">
			<div class="input-group-append">
				<span class="input-group-text text-muted">
					<i class="fab fa-cc-visa"></i> &nbsp; <i class="fab fa-cc-amex"></i> &nbsp;
					<i class="fab fa-cc-mastercard"></i>
				</span>
			</div>
		</div>
	</div> <!-- form-group.// -->

	<div class="row">
	    <div class="col-sm-8">
	        <div class="form-group">
	            <label><span class="hidden-xs">Expiration</span> </label>
	        	<div class="input-group">
	        		<input type="number" class="form-control" placeholder="MM" name="">
		            <input type="number" class="form-control" placeholder="YY" name="">
	        	</div>
	        </div>
	    </div>
	    <div class="col-sm-4">
	        <div class="form-group">
	            <label data-toggle="tooltip" title="" data-original-title="3 digits code on back side of the card">CVV <i class="fa fa-question-circle"></i></label>
	            <input type="number" class="form-control" required="">
	        </div> <!-- form-group.// -->
	    </div>
	</div> <!-- row.// -->
	<button class="subscribe btn btn-primary btn-block" type="button" @click="openFeedbackModal"> Confirm  </button>
	</form>
</div> <!-- tab-pane.// -->
<div class="tab-pane fade" id="nav-tab-paypal">
<p>Paypal is easiest way to pay online</p>
<p>
<button type="button" class="btn btn-primary"> <i class="fab fa-paypal"></i> Log in my Paypal </button>
</p>
<p><strong>Note:</strong> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
tempor incididunt ut labore et dolore magna aliqua. </p>
</div>
<div class="tab-pane fade" id="nav-tab-bank">
<p>Bank accaunt details</p>
<dl class="param">
  <dt>BANK: </dt>
  <dd> THE WORLD BANK</dd>
</dl>
<dl class="param">
  <dt>Accaunt number: </dt>
  <dd> 12345678912345</dd>
</dl>
<dl class="param">
  <dt>IBAN: </dt>
  <dd> 123456789</dd>
</dl>
<p><strong>Note:</strong> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
tempor incididunt ut labore et dolore magna aliqua. </p>
</div> <!-- tab-pane.// -->
</div> <!-- tab-content .// -->

</div> <!-- card-body.// -->

      </div>
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
                processing: false,
                form: new Form({
                    slot_id: '',
                    name: '',
                    email: '',
                    phone_number: '',
                    status_id: 1,
                }),
                form1: new Form({
                    phoneOrId: '',
                }),
                reserved_time: {
                            HH: moment().format('h'),
                            mm: moment().format('mm')
                        },
                form2: new Form({
                    slot_id: '',
                    name: '',
                    email: '',
                    phone_number: '',
                    status_id: 1,
                    reserved_time: ''
                }),
                form3: new Form({
                    slot_id: '',
                    reservation_code: ''
                }),
                form4: new Form({
                    feedback: '',
                    parkingid: '',
                    rating: ''
                }),
            }
        },
        computed : {
            blockName() {
                return this.b_name;
            }
        },
        mounted() {
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
            openPaymentModal() {
                $('#paymentDetails').modal('hide');
                $('#paymentModal').modal('show');
            },
            openFeedbackModal() {
                axios.post('api/parking/settled', { status: 0, parking_id: this.parking_id })
                .then(({ data }) => {
                    $('#paymentModal').modal('hide');
                    $('#feedbackModal').modal('show');
                })
                .catch((err) => {
                    console.log(err);
                })

            },
            sendFeedback() {
                this.form4.post('api/feedback').then(({ data }) => {
                    if (data.status == 200) {
                        $('#feedbackModal').modal('hide');
                        swal("Success!", "Thank you for your feedback!", "success", { timer: 2000 });
                    } else {
                        $('#feedbackModal').modal('hide');
                        swal("Error!", data.message, "error", { timer: 5000 });
                    }
                }).catch((err) => {

                })
            },
            setTrue() {
                this.onlyTime = true;
            },
            displayModal(id) {
                if (this.parked_slots.includes(id)) {
                    return;
                }
                if (this.reserved_slots.includes(id)) {
                    this.isReserved = true;
                    this.form3.reset();
                    this.form3.clear();
                    this.b_name = 'Block ' + id;
                    this.form3.slot_id = id;
                    $('#enterReservationId').modal('show');
                    return;
                } else {
                    this.isReserved = true;
                }
                this.form.reset();
                this.form.clear();
                this.form2.reset();
                this.form2.clear();
                this.form3.reset();
                this.form3.clear();
                this.b_name = 'Block ' + id;
                this.form.slot_id = id;
                this.form2.slot_id = id;
                this.form3.slot_id = id;
                $('#addnewuser').modal('show');
            },
            createUser() {
                if (this.form3.reservation_code) {
                    this.form.reset();
                    this.form.clear();
                    this.form3.post('api/staff/check').then(({ data }) => {
                    if (data.status == 200) {
                        this.$emit('updateGrid');
                        $('#addnewuser').modal('hide');
                        swal("Success!", "You can park your vehicle here!", "success", { timer: 2000 });
                    } else {
                        $('#addnewuser').modal('hide');
                        swal("Error!", data.message, "error", { timer: 5000 });
                    }
                }).catch((err) => {

                })
                } else {
                    this.form3.reset();
                    this.form3.clear();
                    this.form.post('api/parking').then(({ data }) => {
                    if (data.status == 200) {
                        this.$emit('updateGrid');
                        $('#addnewuser').modal('hide');
                        swal("Success!", "You can park your vehicle here!", "success", { timer: 2000 });
                    } else {
                        $('#addnewuser').modal('hide');
                        swal("Error!", data.message, "error", { timer: 5000 });
                    }
                }).catch((err) => {

                })
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
            userCheckout() {
                this.form1.post('api/parking/check')
                    .then(({ data }) => {
                        if (data.status == 400) {
                            $('#enterPhoneNumber').modal('hide');
                            swal("Error!", data.message, "error", { timer: 3000 });
                        } else if(data.status == 200) {
                            this.parking_id = data.parking_id;
                            this.form4.parking_id = data.parking_id;
                            this.$emit('updateGrid');
                            $('#enterPhoneNumber').modal('hide');
                            $('#feedbackModal').modal('show');
                        } else {
                            $('#enterPhoneNumber').modal('hide');
                            $('#cn').text(data.phone_number);
                            $('#ri').text(data.reservation_id != '' ? data.reservation_id : 'N/A');
                            $('#in_time').text(data.in_Time);
                            $('#out_time').text(data.out_Time);
                            $('#total_time').text(data.diff);
                            $('#charge').text('LKR ' + data.charges);
                            $('#paymentDetails').modal('show');
                            this.parking_id = data.parking_id;
                            this.form4.parking_id = data.parking_id;
                            this.$emit('updateGrid');
                        }
                    }).catch(err => console.log(err));
            },
            reserveSlot() {
                if (this.form3.reservation_code) {
                    this.form2.reset();
                    this.form2.clear();
                    this.$Progress.start();
                    this.processing = true;
                    const dataSet = {
                        slot_id: this.form3.slot_id,
                        reservation_code: this.form3.reservation_code,
                        reserved_time: this.reserved_time
                    }
                    axios.post('api/staff/reserve', dataSet).then(({ data }) => {
                    if (data.status == 200) {
                        this.$emit('updateGrid');
                        $('#addnewuser').modal('hide');
                        this.$Progress.finish();
                        this.processing = false;
                        swal("Success!", "You have reserved this block!", "success", { timer: 2000 });
                    } else {
                        this.processing = false;
                        this.$Progress.fail();
                        swal("Error!", data.message, "error", { timer: 5000 });
                    }
                }).catch((err) => {
                    this.processing = false;
                    this.$Progress.fail();
                })
                } else {
                    this.$Progress.start();
                    this.processing = true;
                    this.form2.reserved_time = this.reserved_time;
                    this.form2.post('api/reserve')
                    .then(({ data }) => {
                        if (data.status == 200) {
                            this.refreshGrid();
                            this.$Progress.finish();
                            this.processing = false;
                            $('#addnewuser').modal('hide');
                            swal("Success!", "You have reserved this block!", "success", { timer: 2000 });
                        } else {
                            this.processing = false;
                            this.$Progress.fail();
                            swal("Error!", data.message, "error", { timer: 5000 });
                        }
                    })
                    .catch((err) => {
                        this.processing = false;
                        this.$Progress.fail();
                    })
                }
            },
            reservedUserCheckout() {
                this.form3.post('api/reserve/check')
                    .then(({ data }) => {
                        if (data.status == 400) {
                            $('#enterReservationId').modal('hide');
                            swal("Error!", data.message, "error", { timer: 3000 });
                        } else {
                            this.$emit('updateGrid');
                            $('#enterReservationId').modal('hide');
                            swal("Success!", "You can park your vehicle here!", "success", { timer: 2000 });
                        }

                    }).catch(err => console.log(err));
            },
            showStars(count) {
                this.form4.rating = count;
            }
        }
    }
</script>
