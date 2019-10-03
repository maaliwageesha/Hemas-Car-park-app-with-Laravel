<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="row justify-content-center mt-5">
            <div class="col-12" v-if="$gate.isSuperAdminOrAdmin()">
            <div class="card">
              <div class="card-header d-flex justify-content-between">
                <h3 class="card-title">Booking Details</h3>
                <div><vue-datepicker v-model="range" range @change="filterBydates" lang="en" type="date"></vue-datepicker></div>
                <div class="form-inline mr-5">
                        <div class="input-group input-group-sm">
                            <input class="form-control form-control-navbar" @keyup="searchthis" v-model="search" type="search" placeholder="Search" aria-label="Search">
                            <div class="input-group-append">
                            <button class="btn btn-navbar" @click="searchthis">
                                <i class="fas fa-search"></i>
                            </button>
                            </div>
                        </div>
                        </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0" style="height: 500px;">
                  <table class="table table-head-fixed">
                  <thead>
                    <tr>
                      <th class="text-center" style="width:100px">Name</th>
                      <th class="text-center" style="width:170px">Phone Number</th>
                      <th class="text-center" style="width:170px">Reservation No.</th>
                      <th class="text-center" style="width:170px">Slot No.</th>
                      <th class="text-center" style="width:250px">In Time</th>
                      <th class="text-center" style="width:250px">Out Time</th>
                      <th class="text-center" style="width:150px">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="parking in parkings" :key="parking.id">
                      <td class="text-center">{{ parking.name }}</td>
                      <td class="text-center">{{ parking.phone_number }}</td>
                      <td class="text-center">{{ parking.reservation_code }}</td>
                      <td class="text-center">{{ parking.slot_id }}</td>
                      <td class="text-center">{{ parking.created_at }}</td>
                      <td class="text-center">{{ parking.updated_at }}</td>
                      <!-- <td class="text-center">{{ reservation.charges }}</td> -->
                      <!-- <td><span class="tag tag-success">{{ activatedParking.created_at  }}</span></td> -->
                      <!-- <td><span class="tag tag-success">{{ activatedParking.type_name | capitalize  }}</span></td> -->
                      <td class="text-center">
                          <!-- <a href="#" @click="editModal(activatedParking)">
                              <i class="fas fa-edit ml-2"></i>
                              Edit
                          </a> -->
                          <a href="#" class="text-danger" @click="deleteBooking(parking.id)">
                              <i class="fas fa-trash ml-2"></i>
                              Delete
                          </a>
                      </td>

                    </tr>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              <!-- <div class="card-footer">
                  <pagination :data="activatedParkings" @pagination-change-page="getResults"></pagination>
              </div> -->
            </div>
            <!-- /.card -->
          </div>
        </div>
        </div>
    </div>
</template>

<script>
    export default {
        components: { VueDatepicker },
        mounted() {
            this.parkingDetails();
            this.$on('parkingChange', () => {
                this.parkingDetails()
            })
            Fire.$on('searching', () => {
                let query = this.search;
                axios.get('api/findParkingDetails?q=' + query)
                    .then((res) => {
                        this.parkings = res.data.data;
                    })
                    .catch()
            })
        },
        data() {
            return {
                parkings: {},
                range: '',
                search: '',
            }
        },
        methods: {
            searchthis: _.debounce(() => {
                Fire.$emit('searching');
            }, 1000),
            filterBydates(){
                if (!this.range[0]) {
                this.paymentDetails();
                return;
            }
            this.$Progress.start();
                axios.get('api/parkingTable/filter?date1=' + moment(this.range[0]).format() +'&date2=' + moment(this.range[1]).format())
                .then(({ data }) => {
                    console.log(data);

                    this.parkings = data.parkings;
                    this.$Progress.finish();
                }).catch(err => console.log(err));
            },
            parkingDetails() {
                this.$Progress.start();
                axios.get('api/parkingTable')
                .then(({ data }) => {
                    this.parkings = data.parkings;
                    this.$Progress.finish();
                }).catch(err => console.log(err));
            },
            
        }
    }
</script>
