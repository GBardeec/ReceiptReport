<template>
    <div class="container d-flex justify-content-center align-items-center" style="height: 90vh;">
        <table class="table">
            <thead>
            <tr>
                <th scope="col" class="text-center" colspan="4">
                    <h1>Отчет по месяцам</h1>
                </th>
            </tr>
            <tr>
                <th scope="col">Месяц</th>
                <th scope="col" v-for="(shop, index) in shops" :key="index">Магазин "{{ shop.name }}"</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="(monthData, month) in cheques" :key="month">
                <td>
                    <router-link :to="{ name: 'ReportByDays', params: { month: month } }">
                        {{ month }}
                    </router-link>
                </td>
                <td v-for="(shopSum, shopName) in monthData" :key="shopName">
                    {{ shopSum }}
                </td>
            </tr>
            </tbody>

        </table>
    </div>
</template>

<script>

export default {
    name: "MonthlyReport",

    data() {
        return {
            shops: [],
            cheques: [],
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
            axios.get("/api/MonthlyReport")
                .then((response) => {
                    this.cheques = response.data;
                    console.log(this.cheques);
                })
                .catch((error) => {
                    console.error(error);
                });
        }
    }
};
</script>
