<template>
    <div class="container d-flex justify-content-between mt-2">
        <div v-for="(shop, index) in shops" :key="index">
            <h2>Магазин: "{{ shop.name }}"</h2>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">№ чека</th>
                    <th scope="col">Дата и время (GMT+4)</th>
                    <th scope="col">Сумма чека</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="(cheque, index) in cheques[shop.name]" :key="index">
                    <td class="text-center">{{ cheque.id }}</td>
                    <td class="text-center">{{ cheque.datetime }}</td>
                    <td class="text-center">{{ cheque.sum }}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>

export default {
    name: "ReportByDays",

    data() {
        return {
            shops: [],
            cheques: [],
            selectedDate: this.$route.params.date,
        };
    },

    created() {
        this.getShops();
        this.getCheques();
    },

    methods: {
        getShops() {
            axios.get("/api/shop")
                .then((response) => {
                    this.shops = response.data;
                    console.log(this.shops);
                })
                .catch((error) => {
                    console.error(error);
                });
        },

        getCheques() {
            axios.get(`/api/ReportForTheDay/${this.selectedDate}`)
                .then((response) => {
                    this.cheques = response.data;
                    console.log(this.cheques);
                })
                .catch((error) => {
                    console.error(error);
                });
        },

    }
};
</script>
