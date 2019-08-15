<template>
    <b-breadcrumb :items="item"></b-breadcrumb>
</template>

<script>
export default {
    data: () => {
        return {
            item: null
        }
    },
    mounted(){
        this.item = this.$attrs.items;
    }
}
</script>

