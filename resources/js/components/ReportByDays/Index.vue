<template>
    <div class="container d-flex justify-content-center align-items-center">
        <table class="table">
            <thead>
            <tr>
                <th scope="col" class="text-center" colspan="4">
                    <h1>Отчет по дням</h1>
                </th>
            </tr>
            <tr>
                <th scope="col">День</th>
                <th scope="col" v-for="(shop, index) in shops" :key="index">Магазин "{{ shop.name }}"</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="(monthData, date) in cheques" :key="date">
                <td>
                    <router-link :to="{ name: 'ReportForTheDay', params: { date: date} }">
                        {{ date }}
                    </router-link>
                </td>
                <td v-for="(shopSum, shopName) in monthData" :key="shopName">
                    Сумма выручки: {{ shopSum.total_sum }}
                    <br>
                    Сумма чеков: {{ shopSum.total_cheques }}
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>

export default {
    name: "ReportByDays",

    data() {
        return {
            shops: [],
            cheques: [],
            selectedMonth: this.$route.params.month,
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
            axios.get(`/api/ReportByDays/${this.selectedMonth}`)
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
