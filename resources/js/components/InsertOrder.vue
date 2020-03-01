<template>
    <div>
        <h1>Add Orders</h1>
        <form method="POST" action="/api/orders" @submit="AddOrders()">
            <div class="form-group row">
                <input
                    type="text"
                    name="order_number"
                    v-model="order_number"
                    class="form-control"
                    placeholder="Enter Order Number"
                    required="order_number"
                />
            </div>

            <input type="submit" value="Add Order" class="btn btn-primary" />
        </form>
        <hr />
    </div>
</template>

<script>
export default {
    data() {
        return {
            order_number: ""
        };
    },
    mounted() {
        console.log("Component mounted.");
    }
};
</script>
