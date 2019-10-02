<template>
    <div class="container mt-4">
        <div class="row justify-content-center">
            <parking-grid-admin></parking-grid-admin>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            this.parkingDetails();
        },
        data() {
            return {
                activatedParkings: {},
                deactivatedParkings: {},
            }
        },
        methods: {
            parkingDetails() {
                axios.get('api/parking/details')
                .then(({ data }) => {
                    console.log(data);

                    this.activatedParkings = data.active_parkings;
                    this.deactivatedParkings = data.deactivated_parkings;
                }).catch(err => console.log(err));
            },
        }
    }
</script>
