<template>
    <div>
        <h1>Add Suppliers</h1>
        <form method="POST" action="/api/suppliers" @submit="AddSuppliers()">
            <div class="form-group row">
                <input
                    type="text"
                    name="name"
                    v-model="name"
                    class="form-control"
                    placeholder="Enter Name"
                    required="name"
                />
            </div>

            <input type="submit" value="Add Name" class="btn btn-primary" />
        </form>
        <hr />
    </div>
</template>

<script>
export default {
    mounted() {
        console.log("Component mounted.");
    }
};
</script>
